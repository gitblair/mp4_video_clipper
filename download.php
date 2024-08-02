<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    $filename = $_POST['filename'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    // Set uploads to false
    $allow_uploads = false;

    // Determine the input file path
    if ($allow_uploads) {
        $inputFile = 'uploads/' . basename($filename);
    } else {
        $inputFile = 'default/video.mp4'; // Adjust this path as needed
    }

    if (!file_exists($inputFile)) {
        echo json_encode(['error' => 'Input file does not exist.']);
        exit;
    }

    // Define a temporary output file path
    $tempDir = sys_get_temp_dir();
    $tempOutputFile = tempnam($tempDir, 'clip_') . '.mp4';

    // Calculate duration from start and end points
    $duration = $end - $start;

    // Ensure paths are properly escaped
    $escapedInputFile = escapeshellarg($inputFile);
    $escapedOutputFile = escapeshellarg($tempOutputFile);
    $escapedStartTime = escapeshellarg($start);
    $escapedDuration = escapeshellarg($duration);

    // Simplified FFmpeg command for clipping without re-encoding
    $command = "/usr/bin/ffmpeg -ss $escapedStartTime -i $escapedInputFile -t $escapedDuration -c copy $escapedOutputFile 2>&1";
    exec($command, $output, $return_var);

    if ($return_var !== 0 || !file_exists($tempOutputFile)) {
        echo json_encode(['error' => 'Error processing video.']);
        exit;
    }

    // Serve the file directly to the browser
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="clip_' . time() . '.mp4"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($tempOutputFile));
    header('Content-Transfer-Encoding: binary');

    // Output the file content
    readfile($tempOutputFile);

    // Clean up the temporary file
    unlink($tempOutputFile);
    exit;
}
?>
