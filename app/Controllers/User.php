<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Events\Events;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Authentication\Authenticators\Session;
use CodeIgniter\Shield\Authentication\Passwords;
use CodeIgniter\Shield\Config\Auth;
use CodeIgniter\Shield\Exceptions\ValidationException;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Traits\Viewable;
use Psr\Log\LoggerInterface;

/**
 * Class RegisterController
 *
 * Handles displaying registration form,
 * and handling actual registration flow.
 */
class User extends BaseController
{
    use Viewable;

    protected $helpers = ['setting'];

    /**
     * Auth Table names
     */
    private array $tables;

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ): void {
        parent::initController(
            $request,
            $response,
            $logger
        );

        /** @var Auth $authConfig */
        $authConfig   = config('Auth');
        $this->tables = $authConfig->tables;
    }

    /**
     * Displays the registration form.
     *
     * @return RedirectResponse|string
     */
    public function getIndex()
    {
        $model = $this->getUserProvider();
        $data  = $this->request->getGet();
        $q     = $data['q'] ?? '';
        $users = $model
            ->select('
                users.id, username, active, last_active,
                mahasiswa_prodi.nama_prodi,
                IF(mahasiswa.nama IS NOT NULL, mahasiswa.nama, "") nama
            ')
            ->join('mahasiswa', 'mahasiswa.user_id = users.id', 'left')
            ->join('prodi as mahasiswa_prodi', 'mahasiswa.prodi_id = mahasiswa_prodi.id', 'left')
            ->where("CONCAT(IFNULL(username, '')) LIKE '%{$q}%'")
            ->paginate(20);
        $data  = [
            'rows'  => $users,
            'pager' => $model->pager,
            'q'     => $q,
        ];
        return view('user/index', $data);
    }

    public function getNew()
    {
        $data = [
            'row'    => $this->getUserProvider(),
            'action' => 'create',
        ];
        return view('user/form', $data);
    }

    /**
     * Attempts to register the user.
     */
    public function postCreate(): RedirectResponse
    {
        // if (auth()->loggedIn()) {
        //     return redirect()->to(config('Auth')->registerRedirect());
        // }

        // Check if registration is allowed
        if (!setting('Auth.allowRegistration')) {
            return redirect()->back()->withInput()
                ->with('error', lang('Auth.registerDisabled'));
        }

        $users = $this->getUserProvider();

        // Validate here first, since some things,
        // like the password, can only be validated properly here.
        $rules = $this->getValidationRules();

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Save the user
        $allowedPostFields = array_keys($rules);
        $data              = $this->request->getPost($allowedPostFields);
        $user              = $this->getUserEntity();
        $user->fill($this->request->getPost($allowedPostFields));

        // Workaround for email only registration/login
        if ($user->username === null) {
            $user->username = null;
        }

        try {
            $users->save($user);
        } catch (ValidationException $e) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        // To get the complete user object with ID, we need to get from the database
        $user = $users->findById($users->getInsertID());

        // Add to group
        $user->addGroup($data['group']);

        Events::trigger('register', $user);

        $user->activate();

        return redirect(site_url('user'));
        // return redirect()->to(config('Auth')->registerRedirect())
        //     ->with('message', lang('Auth.registerSuccess'));
    }

    /**
     * Returns the User provider
     */
    protected function getUserProvider(): UserModel
    {
        $provider = model(setting('Auth.userProvider'));

        assert($provider instanceof UserModel, 'Config Auth.userProvider is not a valid UserProvider.');

        return $provider;
    }

    /**
     * Returns the Entity class that should be used
     */
    protected function getUserEntity(): \CodeIgniter\Shield\Entities\User
    {
        return new \CodeIgniter\Shield\Entities\User();
    }

    /**
     * Returns the rules that should be used for validation.
     *
     * @return array<string, array<string, array<string>|string>>
     * @phpstan-return array<string, array<string, string|list<string>>>
     */
    protected function getValidationRules(): array
    {
        $registrationUsernameRules = array_merge(
            config('AuthSession')->usernameValidationRules,
            [sprintf('is_unique[%s.username]', $this->tables['users'])]
        );
        $registrationEmailRules    = array_merge(
            config('AuthSession')->emailValidationRules,
            [sprintf('is_unique[%s.secret]', $this->tables['identities'])]
        );

        return setting('Validation.registration') ?? [
            'username'         => [
                'label' => 'Auth.username',
                'rules' => $registrationUsernameRules,
            ],
            'email'            => [
                'label' => 'Auth.email',
                'rules' => $registrationEmailRules,
            ],
            'password'         => [
                'label'  => 'Auth.password',
                'rules'  => 'required|' . Passwords::getMaxLenghtRule() . '|strong_password',
                'errors' => [
                    'max_byte' => 'Auth.errorPasswordTooLongBytes',
                ],
            ],
            'password_confirm' => [
                'label' => 'Auth.passwordConfirm',
                'rules' => 'required|matches[password]',
            ],
            'group'            => [
                'label' => 'Group',
                'rules' => 'required',
            ],
        ];
    }
}