<?php
require_once "connection.php";

$blog_name = $blog_content = "";
$id = "";

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
                exit("No blog found with this ID.");
            }
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }
    mysqli_stmt_close($stmt);

} else if (isset($_POST["id"]) && !empty(trim($_POST["id"]))) {
    $blog_name   = $_POST["blog_name"];
    $blog_content = $_POST["blog_content"];
    $id          = $_POST["id"];

    $sql = "UPDATE blogs SET blog_name=?, blog_content=? WHERE id=?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssi", $param_blog_name, $param_blog_content, $param_id);

        $param_blog_name   = $blog_name;
        $param_blog_content = $blog_content;
        $param_id          = $id;

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
  <title>Edit | Blog Management System</title>
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
      <h5>Edit Blogs</h5>
    </div>

    <div class="d-flex justify-content-center">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              
              <div class="mb-2">
                <label class="form-label">Blog Name</label>
                <input type="text" class="form-control" name="blog_name"
                       placeholder="Enter Blog Name"
                       value="<?php echo htmlspecialchars($blog_name); ?>">
              </div>

              <div class="mb-2">
                <label class="form-label">Blog Content</label>
                <textarea class="form-control" id="blog_content" name="blog_content"
                          placeholder="Enter Blog Content"><?php echo htmlspecialchars($blog_content); ?></textarea>
              </div>

              <div class="mb-2">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                <a href="index.php" class="btn btn-danger">Cancel</a>
                <input type="submit" class="btn btn-success" value="Save Blog">
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
  <script src="assets/vendors/ckeditor/ckeditor.js"></script>
  <script>
    CKEDITOR.replace("blog_content");
  </script>
</body>
</html>
