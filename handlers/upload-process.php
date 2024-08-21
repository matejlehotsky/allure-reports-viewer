<?php
$response = ['msg' => null, 'error' => null];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $target_dir = '../reports' . DIRECTORY_SEPARATOR . $_POST['dirname'];
  $target_file = $target_dir . DIRECTORY_SEPARATOR . basename($_FILES['fileToUpload']['name']);

  // Check if file was uploaded without errors
  if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == 0) {
    $file = $_FILES['fileToUpload'];
    $file_name = $file['name'];
    $file_type = $file['type'];
    $file_size = $file['size'];

    // Verify file extension
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $allowed_ext = array('zip' => 'application/zip');

    if (!array_key_exists($ext, $allowed_ext)) {
      $response['error'] = 'Error: Please select a valid file format.';
    }

    // Verify file size - 200MB max
    $maxsize = 200 * 1024 * 1024;

    if ($file_size > $maxsize) {
      $response['error'] = 'Error: File size is larger than the allowed limit.';
    }

    // Verify MIME type of the file
    if (!isset($response['error']) && in_array($file_type, $allowed_ext)) {
      if (!mkdir($target_dir, 0775, TRUE)) {
        $response['error'] = 'Error creating directory.';
      } elseif (move_uploaded_file($file['tmp_name'], $target_file)) {
        $unzip = new ZipArchive;
        $out = $unzip->open($target_file);

        if ($out === TRUE) {
          $unzip->extractTo($target_dir);
          $unzip->close();
          unlink($target_file);
          $response['msg'] = 'The file ' . $file_name . ' has been uploaded to: <b>' . $target_dir . '</b>';
        } else {
          $response['error'] = 'Error unpacking file.';
        }
      } else {
        $response['error'] = 'Sorry, there was an error uploading your file [tmp: ' . $file['tmp_name'] . ', dest: ' . $target_file . ']';
      }
    }
  } else {
    $response['error'] = 'Error: ' . $_FILES['fileToUpload']['error'];
  }
}


header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);
