<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $uploadDirectory = 'uploads/';
    $uploadFilePath = $uploadDirectory . basename($file['name']);

    if (move_uploaded_file($file['tmp_name'], $uploadFilePath)) {
        echo basename($file['name']);
    } else {
        http_response_code(500);
        echo 'Error uploading file';
    }
}
?>
