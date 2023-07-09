<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;

class Test extends BaseController
{
    public function getIndex()
    {

        $client = new Client();
        $client->setScopes('https://www.googleapis.com/auth/drive');
        $client->useApplicationDefaultCredentials();

        $drive = new Drive($client);

        // $this->create_folder('test');

        // List all files in the user's My Drive
        $files = $drive->files->listFiles([
            'q'      => "mimeType='application/vnd.google-apps.folder' and name='app-surat'",
            'fields' => 'files(id)',
        ]);
        // dd($files);

        return view('test');
    }

    public function postUpload()
    {
        $data     = $this->request->getPost();
        $id       = (new \Hidehalo\Nanoid\Client())->generateId();
        $folderId = $this->create_folder($id);
        $revisi   = 1;
        $dokumen  = $this->request->getFile('dokumen');
        try {
            $file_metadata = $this->uploadMoUToDrive(
                $dokumen,
                $folderId,
                $revisi,
                'ariefandw@gmail.com'
            );
            dd($file_metadata);

            echo json_encode('success');
        } catch (\Exception $e) {
            echo json_encode('error');
        }
    }

    private $publicFolderId = '1rMmeJmPOxGtmgllSUt_ZZh3OJ0CbDX0I';

    function initGoogleDriveService()
    {
        $client = new Client();
        $client->setScopes('https://www.googleapis.com/auth/drive');
        $client->useApplicationDefaultCredentials();

        $drive = new Drive($client);

        return $drive;
    }

    function create_folder($folder_name, $parentsId = null)
    {
        $drive = $this->initGoogleDriveService();

        try {
            $parentsId = $parentsId ?? $this->publicFolderId;

            $folder = new DriveFile([
                'name'     => $folder_name,
                'parents'  => [$parentsId],
                'mimeType' => 'application/vnd.google-apps.folder'
            ]);

            $createFolder = $drive->files->create($folder, ['fields' => 'id']);
            $folderId     = $createFolder['id'];

            return $folderId;
        } catch (\Exception $e) {
            echo json_encode($e->getMessage());
        }
    }

    //fungsi upload file perjanjian ke GDrive
    function uploadMoUToDrive($file_mou, $folderId = null, $id_revisi_dokumen = 1, $pic_ugm_email = '', $type = 'docx')
    {
        try {
            $folderId = $folderId ?? $this->publicFolderId;

            if ($type == 'pdf') {
                // $file_name = 'Perjanjian-' . $judul_kerjasama . "-versi-" . $id_revisi_dokumen;
                // $result    = $this->uploadPDFToDrive($file_mou, $file_name, $folderId);

                // $docs_id = $result->id;

                // $target_emails = [$pic_ugm_email];
                // $this->share_drive_access($docs_id, $target_emails, 2);

                // return $result;
            } else {

                // Use finfo_file to detect the MIME type of the uploaded file
                $finfo                = finfo_open(FILEINFO_MIME_TYPE);
                $uploadedFileMimeType = finfo_file($finfo, $file_mou);
                finfo_close($finfo);

                $file_metadata = new DriveFile([
                    'name'    => $id_revisi_dokumen,
                    'parents' => [$folderId]
                ]);
                $file_metadata->setMimeType($uploadedFileMimeType);

                // proses upload file ke Google Drive dg multipart
                $drive  = $this->initGoogleDriveService();
                $result = $drive->files->create(
                    $file_metadata,
                    [
                        'data'              => file_get_contents($file_mou),
                        // 'mimeType'          => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'supportsAllDrives' => true,
                        'uploadType'        => 'multipart',
                        'fields'            => 'id,createdTime,name,parents,webViewLink',
                    ]
                );

                // Create a new permission for the file
                $permission = new Drive\Permission([
                    'type'               => 'anyone',
                    'role'               => 'commenter',
                    'allowFileDiscovery' => false
                ]);

                // Set the permission for the file
                $drive->permissions->create($result->id, $permission);

                return $result;
            }
        } catch (\Exception $e) {
            echo json_encode($e->getMessage());
        }
    }

    function share_drive_access($id_gdrive_dokumen, $target_emails, $access_type = 3)
    {
        try {
            $access = [
                1 => 'reader',
                2 => 'commenter',
                3 => 'writer',
            ];

            $drive = $this->initGoogleDriveService();
            $drive->getClient()->setUseBatch(true);
            $batch         = $drive->createBatch();
            $target_emails = ["ariefandw@gmail.com"];

            foreach ($target_emails as $target_email) {
                $permission = new Drive\Permission(
                    [
                        'type'         => 'user',
                        'role'         => $access[$access_type],
                        'emailAddress' => $target_email
                    ]
                );
                $request    = $drive->permissions->create(
                    $id_gdrive_dokumen,
                    $permission,
                    [
                        'fields'                => 'id',
                        'sendNotificationEmail' => 'false',
                    ]
                );
                $batch->add($request, 'user');
            }
            $batch->execute();
        } finally {
            $drive->getClient()->setUseBatch(false);
        }
    }
}