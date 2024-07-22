<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Video Editor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        #waveform {
            position: relative;
            width: 100%;
            height: 128px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }
        .form-inline {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Video Editor</h1>
        <form id="uploadForm" class="mb-4">
            <div class="mb-3">
                <label for="fileInput" class="form-label">Upload Video</label>
                <input type="file" id="fileInput" name="file" class="form-control" accept="video/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>

        <video id="videoPlayer" width="100%" controls></video>

        <div class="form-inline mb-3">
            <label for="inPointInput">In Point:</label>
            <input type="text" id="inPointInput" class="form-control" value="00:00:00.000">
            <label for="outPointInput">Out Point:</label>
            <input type="text" id="outPointInput" class="form-control" value="00:00:00.000">
        </div>

        <div id="waveform"></div>
        <button id="downloadClip" class="btn btn-success">Download Clip</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/3.3.3/wavesurfer.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/3.3.3/plugin/wavesurfer.timeline.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/3.3.3/plugin/wavesurfer.regions.min.js"></script>
    <script src="editing.js"></script>
</body>
</html>
