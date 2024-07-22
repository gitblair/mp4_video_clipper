<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['video'])) {
        $file = $_FILES['video'];
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($file['name']);

        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            echo basename($file['name']);
        } else {
            echo 'Error uploading file';
        }
    } else {
        echo 'No file uploaded';
    }
}
?>
