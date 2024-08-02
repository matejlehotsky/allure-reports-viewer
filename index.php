<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Allure Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <style>
      html, body {
        height: 100%;
        overflow: hidden;
      }

      object {
        width: 100%;
        height: 100%;
      }

      .row,
      .row > div {
        height: 100%;
        padding: 0;
      }

      .sidebar {
        position: relative;
        width: 180px;
        background: #343434;
        border-right: 1px solid #4d4d4d
      }

      .sidebar h2 {
        color: #fff;
        text-align: center;
        border-bottom: 1px solid #444;
        padding: 19px 0 18.5px;
        font-size: 28px;
      }

      .sidebar ul {
        padding: 0;
        position: relative;
        z-index: 2;
        height: calc(100% - 140px);
        overflow-y: scroll;
        overflow-x: hidden;
      }
      .sidebar ul::-webkit-scrollbar {
        display: none;
       }
      .sidebar ul::-moz-scrollbar {
        display: none;
       }
      .sidebar ul li {
        position: relative;
        list-style: none;
        padding: 6px 0;
        border-bottom: 1px solid #444;
      }
      .sidebar ul li a {
        color: #999;
        text-decoration: none;
        font-size: 14px;
        padding-left: 28px;
      }
      .sidebar ul li a.active {
        color: #fff;
      }
      .sidebar ul li a.delete {
        position: absolute;
        right: 12px;
        top: 8px;
        font-size: 14px;
      }

      .sidebar .actions {
        position: absolute;
        bottom: 0;
        width: 100%;
        display: block;
        padding: 20px 0;
        text-align: center;
        border-top: 1px solid #444;
        z-index: 3;
        background-color: #343434;
      }
      .sidebar .actions a {
        color: #97cc64;
        text-transform: uppercase;
        text-decoration: none;
        font-size: 14px;
      }
      .sidebar .actions span {
        padding-left: 8px;
      }
      .sidebar .actions svg {
        position: relative;
        width: 10px;
        height: 20px;
        bottom: 1px;
      }

      .content {
        width: calc(100% - 180px);
      }
    </style>
</head>

<body>

<div class="row align-items-start">
    <div class="sidebar">
        <h2>Reports</h2>
        <ul>
          <?php
          $reports = array_slice(scandir('reports'), 2);
          $current = $_GET['report'] ?? end($reports);

          foreach (array_reverse($reports) as $dir) {
            print '<li>
<a href="/allure-report?report=' . $dir . '" class="' . ($current == $dir ? 'active' : '') . '">' . $dir . '</a>
<a href="/allure-report/delete.php?report=' . $dir . '" class="delete">&#x2715;</a>
</li>';
          }
          ?>
        </ul>

        <div class="actions">
            <a href="upload.php">
                <svg fill="#97cc64" height="800px" width="800px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 374.116 374.116" xml:space="preserve">
                    <g>
                        <path d="M344.058,207.506c-16.568,0-30,13.432-30,30v76.609h-254v-76.609c0-16.568-13.432-30-30-30c-16.568,0-30,13.432-30,30v106.609c0,16.568,13.432,30,30,30h314c16.568,0,30-13.432,30-30V237.506C374.058,220.938,360.626,207.506,344.058,207.506z"/>
                        <path d="M123.57,135.915l33.488-33.488v111.775c0,16.568,13.432,30,30,30c16.568,0,30-13.432,30-30V102.426l33.488,33.488c5.857,5.858,13.535,8.787,21.213,8.787c7.678,0,15.355-2.929,21.213-8.787c11.716-11.716,11.716-30.71,0-42.426L208.271,8.788c-11.715-11.717-30.711-11.717-42.426,0L81.144,93.489c-11.716,11.716-11.716,30.71,0,42.426C92.859,147.631,111.855,147.631,123.57,135.915z"/>
                    </g>
                </svg>
                <span>Upload report</span>
            </a>
        </div>
    </div>
    <div class="content">
        <object id="report" data="reports/<?php print $current; ?>/artifacts/allure-report/index.html"
                type="text/html"></object>
    </div>
</div>
</body>
</html>