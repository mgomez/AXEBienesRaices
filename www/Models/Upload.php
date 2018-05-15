<?php
function Upload($folder, $files)
{
    $ds          = DIRECTORY_SEPARATOR;
    $storeFolder = $folder;

    if (!empty($files)) {
        $tempFile   = $files['file']['tmp_name'];
        $name       = $files['file']["name"];
        $ext        = end((explode(".", $name)));
        $targetPath = dirname(__FILE__) . $ds . $storeFolder . $ds;
        $nameFile = generateRandomString() . "." . $ext;
        $targetFile = $targetPath . $nameFile;

        if (!move_uploaded_file($tempFile, $targetFile)) {
            return false;
        } else {
            return $nameFile;
        }
    } else {
        return false;
    }
}

function generateRandomString($length = 10)
{
    $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString     = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
