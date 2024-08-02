<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
      $(document).ready(function () {
        $('form').on('submit', function (e) {
          e.preventDefault();
          $.ajax({
            xhr: function () {
              var xhr = new window.XMLHttpRequest();
              xhr.upload.addEventListener('progress', function (evt) {
                if (evt.lengthComputable) {
                  var percentComplete = ((evt.loaded / evt.total) * 100);
                  $('.progress-bar').width(percentComplete + '%').html(parseInt(percentComplete) + '%');
                }
              }, false);
              return xhr;
            },
            type: 'POST',
            url: '/allure-report/handlers/upload-process.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
              $('.progress-bar').width('0%');
            },
            success: function (resp) {
            $('.msg-wrapper').removeClass('d-none');
            $('.form-wrapper').addClass('d-none');
            $('.btn-primary').addClass('d-none');

            const alertElement = $('.msg-wrapper .alert');

            if(resp.msg != null) {
                alertElement.html(resp.msg).addClass('alert-success');
             }

            if(resp.error != null) {
                alertElement.html(resp.error).addClass('alert-danger');
             }
            }
          });
        });
      });
    </script>
</head>

<body class="justify-content-center d-flex p-2">
    <div class="border p-5 mt-5">
        <form enctype="multipart/form-data">
            <div class="form-wrapper">
                <div class="mb-3">
                    <label for="dirname" class="form-label">Directory</label>
                    <input required type="text" class="form-control" id="dirname" name="dirname" title="YYYY-MM-DD" maxlength="20" value="<?php echo date('Y-m-d'); ?>">
                    <small class="text-muted">exp. 2024-07-07 / exp. 2024-07-07-S</small>
                </div>
                <div class="mb-3">
                    <label for="fileToUpload" class="form-label">File</label>
                    <input required type="file" class="form-control" id="fileToUpload" name="fileToUpload" accept="application/zip">
                </div>
                <div class="progress mb-3">
                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <div class="msg-wrapper d-none">
                <div class="alert" role="alert">
                </div>
            </div>

            <a href="/allure-report" class="btn btn-danger">Back to Report</a>
            <button type="submit" class="btn btn-primary float-right">Upload</button>
        </form>
 </div>

</body>
</html>

