<?php
$filePath = 'C:/laragon/www/pro1014_03/views/home.php';

if (file_exists($filePath)) {
    echo "File home.php exists!<br>";
    require_once $filePath;
} else {
    echo "File home.php does not exist at: " . $filePath . "<br>";
    $dirPath = 'C:/laragon/www/pro1014_03/views';
    if (is_dir($dirPath)) {
        echo "Directory $dirPath exists!<br>";
        $files = scandir($dirPath);
        echo "Files in directory: <pre>" . print_r($files, true) . "</pre>";
    } else {
        echo "Directory $dirPath does NOT exist!<br>";
    }
    echo "Current working directory: " . getcwd() . "<br>";
}

$functionFile = 'C:/laragon/www/pro1014_03/commons/function.php';
if (file_exists($functionFile)) {
    echo "File function.php exists!<br>";
} else {
    echo "File function.php does not exist at: " . $functionFile . "<br>";
}
?>