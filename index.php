<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AdenMGB's Downloads</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f0f0f0;
    }
    header {
      background-color: #333;
      color: #fff;
      padding: 20px;
      text-align: center;
    }
    main {
      max-width: 1600px;
      margin: 200px auto;
      padding: 30px;
      background-color: #fff;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
      margin-top: 0;
    }
    .download-links {
      display: flex;
      flex-wrap: wrap;
    }
    .download-link {
      flex: 1 0 25%; /* Two links per row; adjust as needed */
      padding: 50px;
      text-align: center;
      text-decoration: none;
      color: #252121;
      position: relative;
      border-radius: 30%;
      background-color: #f0f0f0;
      transition: transform 0.3s ease;
      overflow: hidden;
    }
    .download-link:hover {
      transform: scale(1.2);
    }
  </style>

</head>
<body>

  <header>
    <h1>AdenMGB's Downloads</h1>
  </header>
  <main>
  <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload File" name="submit">
    </form>

    <div class="download-links">
            <?php
            $ftpServer = 'adenmgb.duckdns.org'; // Replace with your FTP server address
            $ftpDirectory = '/'; // Replace with the directory where the files are located

            $ftpConnection = ftp_connect($ftpServer);
            if ($ftpConnection === false) {
                echo "Failed to connect to FTP server";
                exit;
            }

            if (ftp_login($ftpConnection, 'anonymous', '')) {
                $files = ftp_nlist($ftpConnection, $ftpDirectory);
                if ($files !== false) {
                    foreach ($files as $file) {
                        $fileName = basename($file);
                        // Generate the download link with the file name as a URL parameter
                        $downloadLink = "download.php?file=$fileName";
                        echo "<a href='$downloadLink'>$fileName</a><br>";
                    }
                } else {
                    echo "Error getting the file list.<br>";
                }
            } else {
                echo "Anonymous login failed";
            }

            ftp_close($ftpConnection);
            ?>
        </div>
  
    <div class="download-links">
            <!-- The PHP script will generate the download links dynamically -->
        </div>
    
    
  
  </main>
</body>
</html>
