<?php
if (isset($_GET["videopath"])) {
  $videopath = $_GET["videopath"];
} else {
  $videopath = "video.mp4"; // Ensure this file is accessible
}

echo "<p>File: </p>";
echo "<ul><li>" . htmlspecialchars($videopath) . "</li></ul>";

if (file_exists($videopath)) {
  $filesize = filesize($videopath);
  echo "<p>File size: </p>";
  echo "<ul>";
  echo "<li>Bytes: $filesize</li>";
  echo "<li>KB: " . number_format($filesize / 1024, 2) . "</li>";
  echo "<li>MB: " . number_format($filesize / (1024 * 1024), 2) . "</li>";
  echo "<li>GB: " . number_format($filesize / (1024 * 1024 * 1024), 2) . "</li>";
  echo "</ul>";
}

echo "<p>Server Stats: </p>";
echo "<ul>";
echo "<li>upload_max_filesize: " . ini_get('upload_max_filesize') . "</li>";
echo "<li>post_max_size: " . ini_get('post_max_size') . "</li>";
echo "<li>max_execution_time: " . ini_get('max_execution_time') . "</li>";
echo "</ul>";
?>
