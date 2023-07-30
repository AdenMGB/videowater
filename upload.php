<?php
if (isset($_FILES['fileToUpload'])) {
    $ftpServer = 'adenmgb.duckdns.org'; // Replace with your FTP server address
    $ftpDirectory = '/'; // Replace with the directory where you want to upload the file

    $file = $_FILES['fileToUpload']['tmp_name'];
    $fileName = $_FILES['fileToUpload']['name'];
    $ftpFilePath = $ftpDirectory . $fileName;

    $ftpConnection = ftp_connect($ftpServer);
    if ($ftpConnection === false) {
        echo "Failed to connect to FTP server";
        exit;
    }

    if (ftp_login($ftpConnection, 'anonymous', '')) {
        if (ftp_put($ftpConnection, $ftpFilePath, $file, FTP_BINARY)) {
            echo "File uploaded successfully.<br>";
        } else {
            echo "Error uploading the file.<br>";
        }
    } else {
        echo "Anonymous login failed";
    }

    ftp_close($ftpConnection);
}
?>
