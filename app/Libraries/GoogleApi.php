<?php

namespace App\Libraries;

use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;

class GoogleApi
{
    private static $publicFolderId = '1rMmeJmPOxGtmgllSUt_ZZh3OJ0CbDX0I';

    public static function initGoogleDriveService()
    {
        $client = new Client();
        $client->setScopes('https://www.googleapis.com/auth/drive');
        $client->useApplicationDefaultCredentials();

        $drive = new Drive($client);

        return $drive;
    }

    public static function create_folder($folder_name, $parentsId = null)
    {
        $drive = self::initGoogleDriveService();

        try {
            $parentsId = $parentsId ?? self::$publicFolderId;

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

    public static function upload($file, $folderId = null, $revisi = 1)
    {
        try {
            $folderId = $folderId ?? self::$publicFolderId;

            // Use finfo_file to detect the MIME type of the uploaded file
            $finfo                = finfo_open(FILEINFO_MIME_TYPE);
            $uploadedFileMimeType = finfo_file($finfo, $file);
            finfo_close($finfo);

            $file_metadata = new DriveFile([
                'name'    => "Versi $revisi",
                'parents' => [$folderId]
            ]);
            $file_metadata->setMimeType($uploadedFileMimeType);

            // proses upload file ke Google Drive dg multipart
            $drive  = self::initGoogleDriveService();
            $result = $drive->files->create(
                $file_metadata,
                [
                    'data'              => file_get_contents($file),
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

        } catch (\Exception $e) {
            echo json_encode($e->getMessage());
        }
    }

    public static function listFilesByFolderId($folderId)
    {
        $drive = self::initGoogleDriveService();

        try {
            $results = $drive->files->listFiles([
                'q'                 => "'$folderId' in parents",
                'fields'            => 'files(id, name)',
                'pageSize'          => 100,
                // Adjust the number of files to retrieve per page
                'supportsAllDrives' => true
            ]);

            $files = $results->getFiles();

            if (empty($files)) {
                return null;
            } else {
                return $files;
            }
        } catch (\Exception $e) {
            echo json_encode($e->getMessage());
        }
    }

    public static function findFolderByName($folderName, $parentFolderId = null)
    {
        $drive = self::initGoogleDriveService();

        try {
            $parentFolderId = $parentFolderId ?? self::$publicFolderId;
            $query          = "mimeType='application/vnd.google-apps.folder' and name='$folderName' and '$parentFolderId' in parents";
            $results        = $drive->files->listFiles([
                'q'                 => $query,
                'fields'            => 'files(id, name)',
                'pageSize'          => 1,
                'supportsAllDrives' => true
            ]);

            $files = $results->getFiles();

            if (empty($files)) {
                echo "Folder not found.";
                return null;
            } else {
                return $files[0]->getId();
            }
        } catch (\Exception $e) {
            echo json_encode($e->getMessage());
            return null;
        }
    }
}