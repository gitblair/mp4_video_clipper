$(document).ready(function () {
    let video = document.getElementById('videoPlayer');
    let inPoint = 0;
    let outPoint = 0;
    let uploadedFileName = '';

    $('#uploadForm').on('submit', function (event) {
        event.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: 'upload.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                uploadedFileName = response;
                let url = 'uploads/' + uploadedFileName;
                video.src = url;
                video.load();
                wavesurfer.load(url);
            },
            error: function () {
                alert('File upload failed!');
            }
        });
    });

    $('#downloadClip').on('click', function () {
        if (inPoint >= outPoint) {
            alert('Invalid in/out points');
            return;
        }
        downloadClip(uploadedFileName, inPoint, outPoint);
    });

    function downloadClip(filename, start, end) {
        $.post('download.php', {
            filename: filename,
            start: start,
            end: end
        }, function (data) {
            let a = document.createElement('a');
            a.href = data;
            a.download = 'clip.mp4';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        });
    }

    let wavesurfer = WaveSurfer.create({
        container: '#waveform',
        waveColor: 'violet',
        progressColor: 'purple',
        height: 128,
        responsive: true,
        plugins: [
            WaveSurfer.regions.create({})
        ]
    });

    function createOrUpdateRegion(id, color, start, end) {
        let region = wavesurfer.regions.list[id];
        if (region) {
            region.update({ start: start, end: end });
        } else {
            wavesurfer.addRegion({
                id: id,
                start: start,
                end: end,
                color: color,
                drag: true,
                resize: true
            });
        }
    }

    $(document).on('keydown', function (e) {
        if (e.key === ' ') {
            e.preventDefault();
            if (video.paused) {
                video.play();
            } else {
                video.pause();
            }
        } else if (e.key === 'i') {
            inPoint = video.currentTime;
            updateFormInput('inPointInput', inPoint);
            createOrUpdateRegion('inRegion', 'rgba(0, 255, 0, 0.1)', inPoint, inPoint + 0.1);
        } else if (e.key === 'o') {
            outPoint = video.currentTime;
            updateFormInput('outPointInput', outPoint);
            createOrUpdateRegion('outRegion', 'rgba(255, 0, 0, 0.1)', outPoint - 0.1, outPoint);
        }
    });

    $('#inPointInput').on('change', function () {
        inPoint = parseTime($(this).val());
        createOrUpdateRegion('inRegion', 'rgba(0, 255, 0, 0.1)', inPoint, inPoint + 0.1);
    });

    $('#outPointInput').on('change', function () {
        outPoint = parseTime($(this).val());
        createOrUpdateRegion('outRegion', 'rgba(255, 0, 0, 0.1)', outPoint - 0.1, outPoint);
    });

    function updateFormInput(id, time) {
        let timeStr = formatTime(time);
        $('#' + id).val(timeStr);
    }

    function parseTime(timeStr) {
        let parts = timeStr.split(':');
        let minutes = parseFloat(parts[0]);
        let seconds = parseFloat(parts[1]);
        let frames = parseFloat(parts[2]);
        return minutes * 60 + seconds + frames / 1000;
    }

    function formatTime(time) {
        let minutes = Math.floor(time / 60);
        let seconds = Math.floor(time % 60);
        let frames = Math.floor((time - minutes * 60 - seconds) * 1000);
        return `${pad(minutes)}:${pad(seconds)}:${pad(frames, 3)}`;
    }

    function pad(num, size = 2) {
        let s = "0" + num;
        return s.substr(s.length - size);
    }

    // Sync video and Wavesurfer when scrubbing
    wavesurfer.on('seek', function (progress) {
        let newTime = progress * video.duration;
        video.currentTime = newTime;
    });

    // Update region positions based on video time
    video.ontimeupdate = function () {
        if (wavesurfer.regions.list['inRegion']) {
            wavesurfer.regions.list['inRegion'].update({ start: inPoint, end: inPoint + 0.1 });
        }
        if (wavesurfer.regions.list['outRegion']) {
            wavesurfer.regions.list['outRegion'].update({ start: outPoint - 0.1, end: outPoint });
        }
    };

    wavesurfer.on('region-update-end', function (region) {
        if (region.id === 'inRegion') {
            inPoint = region.start;
            updateFormInput('inPointInput', inPoint);
        } else if (region.id === 'outRegion') {
            outPoint = region.end;
            updateFormInput('outPointInput', outPoint);
        }
    });
});
