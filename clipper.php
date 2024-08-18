<?php
header('Content-Type: application/json');
require "config.php";
$response = [
    'success' => false,
    'error' => ''
];

$debug = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $startTime = $_POST['startTime'];
    $duration = $_POST['duration'];
    $clipName = $_POST['clipName'];
    $inputFile = $_POST['videopath'];

    $outputFile = tempnam(sys_get_temp_dir(), 'clip_') . ".mp4";

    $debug[] = "Input file: $inputFile";
    $debug[] = "Start Time: $startTime, Duration: $duration";
    $debug[] = "Clip Name: $clipName, Output File: $outputFile";

    // Ensure paths are properly escaped
    $escapedInputFile = escapeshellarg($inputFile);
    $escapedOutputFile = escapeshellarg($outputFile);
    $escapedStartTime = escapeshellarg($startTime);
    $escapedDuration = escapeshellarg($duration);

    $command = "$ffmpegPath -ss $escapedStartTime -i $escapedInputFile -t $escapedDuration -c copy $escapedOutputFile 2>&1";

    $debug[] = "Executing command: $command";

    exec($command, $output, $return_var);

    if ($return_var !== 0 || !file_exists($outputFile)) {
        $response['error'] = 'Error processing video.';
        $response['debug'] = $debug;
        echo json_encode($response);
        exit;
    }

    // Serve the file directly to the browser
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="clip_' . time() . '.mp4"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($outputFile));

    // Output the file content
    readfile($outputFile);

    // Clean up the temporary file
    unlink($outputFile);
    exit;
}
?>
