<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous">
    </script>
</head>

<body class="justify-content-center d-flex p-2">
<?php
const PASSWORD = 'delete';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $target_dir = '../reports' . DIRECTORY_SEPARATOR . $_POST['dirname'];

  if ($_POST['password'] == PASSWORD) {
    rrmdir($target_dir);
    $msg = 'Report deleted successfully: <b>[' . $target_dir . ']</b>';

  } else {
    $error = 'Wrong password';
  }
}

function rrmdir($dir) {
  if (is_dir($dir)) {
    $objects = scandir($dir);

    foreach ($objects as $object) {
      if ($object != "." && $object != "..") {
        if (is_dir($dir . DIRECTORY_SEPARATOR . $object) && !is_link($dir . "/" . $object))
          rrmdir($dir . DIRECTORY_SEPARATOR . $object);
        else
          unlink($dir . DIRECTORY_SEPARATOR . $object);
      }
    }

    rmdir($dir);
  }
}

?>

<div class="border p-5 mt-5">
    <div class="mb-3">
      <?php if (isset($msg)): ?>
          <div class="alert alert-success" role="alert">
            <?php echo $msg; ?>
          </div>
      <?php endif; ?>

      <?php if (isset($error)): ?>
          <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
          </div>
      <?php endif; ?>
    </div>

    <a href="/allure-report" class="btn btn-danger">Back to Reports</a>
</div>
</body>
</html>