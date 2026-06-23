<?php
require_once "connection.php";

if (isset($_POST["id"]) && !empty(trim($_POST["id"]))) {
    $id = $_POST["id"];

    $sql = "DELETE FROM blogs WHERE id=?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = $id;

        if (mysqli_stmt_execute($stmt)) {
            header("location: index.php");
            exit;
        } else {
            echo "Something went wrong. Please try again later.";
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
  <title>Delete | Blog Management System</title>
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
  .table tbody tr:hover {
    background-color: #f1f1f1; 
    cursor: pointer;
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
      <a href="#" class="navbar-brand">
        <img src="assets/img/logo/logo.jpg" class="img-fluid" alt="logo" width="30">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
        <i class="bi bi-list"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbar">
        <div class="navbar-nav ms-auto">
          Blogs
        </div>
      </div>
    </div>
  </nav>

  <div class="container p-5">
    <div class="mb-3">
      <h5>Delete Blog</h5>
    </div>

    <div class="d-flex justify-content-center">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              
              <div class="mb-2">
                <label class="form-label">Are you sure you want to delete this blog?</label>
              </div>

              <div class="mb-2">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET["id"]); ?>">
                <a href="index.php" class="btn btn-danger">Cancel</a>
                <input type="submit" class="btn btn-success" value="Delete Blog">
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/vendors/jquery/jquery.min.js"></script>
  <script src="assets/vendors/popper/popper.js"></script>
  <script src="assets/vendors/bootstrap/js/bootstrap.js"></script>
</body>
</html>
