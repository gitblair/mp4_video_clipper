<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MP4 Video Clipper</title>

    <!-- Bootstrap Style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />



    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- App Style -->
    <link rel="stylesheet" href="styles.css">

  </head>
  <body>
    <div class="container-lg mb-5">
      <div class="row">
        <div class="col-12">

<!-- Application -->
<?php include 'config.php'; ?>
<h1 class="my-4">MP4 Video Clipper</h1>
  <form id="uploadForm" class="mb-4">
      <div class="mb-3">
          <label for="fileInput" class="form-label">Upload Video</label>
          <input type="file" id="fileInput" name="file" class="form-control" accept="video/*" required <?php echo !$allow_uploads ? 'disabled' : ''; ?>>
      </div>

          <button type="submit" class="btn btn-primary" <?php echo !$allow_uploads ? 'disabled' : ''; ?>>Upload</button>

          <?php if (!$allow_uploads): ?>
              <div class="mt-2 text-danger">Uploads are turned off for this demonstration.</div>
              <div class="mt-2 text-success">A default video is pre-loaded for you to try the clipping functions. Enjoy!</div>
          <?php endif; ?>
  </form>

<script>
var allowUploads = <?php echo json_encode($allow_uploads); ?>;
var defaultVideoUrl = <?php echo json_encode($default_video_url); ?>;
</script>

<video id="videoPlayer" width="100%" controls></video>

<div class="mb-3 d-flex flex-column align-items-center">
<div class="center-text mt-3 text-center">Use <kbd>spacebar</kbd> to start and stop video or the video play button.</div>
<div class="center-text mt-3 mb-3 text-center">Tap the waveform or set the in & out by hand for precision.</div>
<div class="center-text mt-3 mb-3 text-center">Use <kbd>i</kbd> and <kbd>o</kbd> keyboard shortcuts or the buttons for in & out points.</div>
<div class="center-buttons my-2">
      <button id="setInPoint" class="btn btn-primary mx-2">Set IN</button>
      <button id="setOutPoint" class="btn btn-primary mx-2">Set OUT</button>
</div>
<div class="form-inline d-flex flex-column align-items-center">
    <!-- Granular In & Out Controls -->
    <label class="mt-3 mb-3 fw-bold text-center">Granular In & Out</label>
      <div class="d-flex mb-3 center-inputs align-items-center">
          <label for="inPointInput" class="me-2 fw-bold me-1">In Point:</label>
            <input type="text" id="inPointInput" class="form-control mx-2" value="00:00:00.000">
          <label for="outPointInput" class="me-2 fw-bold me-1">Out Point:</label>
            <input type="text" id="outPointInput" class="form-control mx-2" value="00:00:00.000">
      </div>
</div>
</div>

  <div id="waveform"></div>
  <button id="downloadClip" class="btn btn-success mt-3 mb-5 mx-auto d-block">Clip & Download</button>

  <div class="mt-5 mb-5 text-dark text-center">Video attribution: Pond5 Public Domain Set Free Remix.</div>


    </div> <!-- end col-12 -->
  </div> <!-- end row -->
</div> <!-- end container -->

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Wavesurfer JS Components -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/3.3.3/wavesurfer.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/3.3.3/plugin/wavesurfer.timeline.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/3.3.3/plugin/wavesurfer.regions.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Custom JS -->
    <script src="editing.js"></script>
</body>
</html>
