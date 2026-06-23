<?php
require_once "connection.php";

$blog_name = $blog_content = "";
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $id = trim($_GET["id"]);
    $sql = "SELECT * FROM blogs WHERE id=?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = $id;

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $blog_name = $row["blog_name"];
                $blog_content = $row["blog_content"];
            } else {
                exit("Blog not found.");
            }
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($link);
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>View Blog | Blog Management System</title>
  <link href="assets/vendors/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="assets/vendors/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
    }
    .card {
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .btn {
      border-radius: 8px;
      transition: all 0.2s ease-in-out;
    }
    .btn:hover {
      transform: scale(1.05);
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a href="index.php" class="navbar-brand">
        <img src="assets/img/logo/logo.jpg" class="img-fluid" alt="logo" width="30">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
        <i class="bi bi-list"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbar">
        <div class="navbar-nav ms-auto">Blogs</div>
      </div>
    </div>
  </nav>

  <div class="container p-5">
    <div class="d-flex justify-content-center">
      <div class="col-lg-8 col-md-10 col-sm-12">
        <div class="card p-4">
          <h3 class="mb-3"><?php echo $row["blog_content"]; ?> </h3>
         
          <div class="mt-3">
            <a href="index.php" class="btn btn-primary">Back to Blogs</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/vendors/bootstrap/js/bootstrap.js"></script>
</body>
</html>
