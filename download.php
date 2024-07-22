<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filename = $_POST['filename'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    $inputFile = 'uploads/' . basename($filename);
    $outputFile = 'clips/clip_' . time() . '.mp4';

    $command = "ffmpeg -i $inputFile -ss $start -to $end -c copy $outputFile";
    exec($command, $output, $return_var);

    if ($return_var === 0) {
        echo $outputFile;
    } else {
        echo 'Error processing video';
    }
}
?>
