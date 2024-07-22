<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Editor</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .video-container {
            position: relative;
        }
        .controls {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="mt-5">Video Editor</h1>
    <div class="row">
        <div class="col-md-12">
            <form id="uploadForm" enctype="multipart/form-data">
                <input type="file" name="video" id="videoUpload" class="form-control" accept="video/*">
                <button type="submit" class="btn btn-primary mt-2">Upload Video</button>
            </form>
            <div class="video-container mt-3">
                <video id="videoPlayer" width="100%" controls></video>
                <div class="controls mt-2">
                    <button id="setInPoint" class="btn btn-primary">Set In Point</button>
                    <button id="setOutPoint" class="btn btn-danger">Set Out Point</button>
                    <button id="downloadClip" class="btn btn-success">Download Clip</button>
                    <input type="range" id="zoomSlider" class="form-range" min="1" max="10" value="1">
                </div>
                <div class="timeline mt-3" id="timeline"></div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/3.3.3/wavesurfer.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/3.3.3/plugin/wavesurfer.timeline.min.js"></script>
<script src="editing.js"></script>
</body>
</html>
