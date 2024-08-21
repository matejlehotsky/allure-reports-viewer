<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous">
    </script>
</head>

<body class="justify-content-center d-flex p-2">
<div class="border p-5 mt-5">
    <form action="handlers/delete-process.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <?php if (isset($_GET['report']) && !empty($_GET['report'])): ?>
              <label for="password" class="form-label">Password</label>
              <input required type="password" class="form-control" id="password" name="password">

              <div class="alert alert-warning mt-2" role="alert">
                  Confirm report deletion with password!
              </div>

              <input type="hidden" name="dirname" value="<?php echo $_GET['report']; ?>">

              <a href="index.php" class="btn btn-danger">Back to Report</a>
              <button type="submit" class="btn btn-primary float-right">Delete</button>
          <?php else: ?>
              <div class="alert alert-danger mt-2" role="alert">
                  Missing report parameter!
              </div>
          <?php endif; ?>
        </div>
    </form>
</div>

</body>
</html>