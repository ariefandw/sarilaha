<?php

namespace App\Controllers\Authentication\Authenticators;

use App\Models\Perusahaan;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Result;
use CodeIgniter\Shield\Entities\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Pegawai;

// use App\Models\Tendik;

class Session extends \CodeIgniter\Shield\Authentication\Authenticators\Session
{
    public function attempt(array $credentials): Result
    {
        $token      = $_POST['token'];
        $secret_key = getenv('recaptcha.secretkey');
        $url        = 'https://www.google.com/recaptcha/api/siteverify';
        $data       = array('secret' => $secret_key, 'response' => $token);
        $options    = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ),
        );
        // $context    = stream_context_create($options);
        // $result     = file_get_contents($url, false, $context);
        // $response   = json_decode($result);
        // if ($response->success) {
        $user    = (new UserModel())->findByCredentials(['email' => $credentials['email']]);
        $profile = null;
        if ($user) {
            switch ($user->getGroups()[0]) {
                case 'admin':
                    $profile = (new Pegawai())->where('user_id', $user->id)->first();
                    break;

                case 'user':
                    $profile = (new Perusahaan())->where('user_id', $user->id)->first();
                    break;

                default:
                    break;
            }
            session()->set('user', [
                'email'   => $user->getIdentity('email_password')->secret,
                'group'   => $user->getGroups()[0],
                'profile' => $profile,
            ]);
        }
        return parent::attempt($credentials);
        // } else {
        //     return new Result([
        //         'success' => false,
        //         'reason'  => 'reCAPTCHA v3 validation failed',
        //     ]);
        // }
    }
}