<?php
if (isset($_GET['file'])) {
    $fileName = $_GET['file'];
    $ftpServer = 'adenmgb.duckdns.org'; // Replace with your FTP server address
    $ftpDirectory = '/'; // Replace with the directory where the files are located
    $ftpFilePath = $ftpDirectory . $fileName;

    $ftpConnection = ftp_connect($ftpServer);
    if ($ftpConnection === false) {
        echo "Failed to connect to FTP server";
        exit;
    }

    if (ftp_login($ftpConnection, 'anonymous', '')) {
        $tempDir = 'temp_download/';
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0755, true);
        }
        $localFilePath = $tempDir . $fileName;

        if (ftp_get($ftpConnection, $localFilePath, $ftpFilePath, FTP_BINARY)) {
            // File downloaded successfully, provide the link for download
            $downloadLink = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $localFilePath;
            echo "File downloaded successfully.<br>";
            echo "Download link: <a href='$downloadLink' target='_blank'>$fileName</a><br>";
        } else {
            echo "Error downloading the file.<br>";
        }
    } else {
        echo "Anonymous login failed";
    }

    ftp_close($ftpConnection);
} else {
    echo "No file specified for download.";
}
?>
