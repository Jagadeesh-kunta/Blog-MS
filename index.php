<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog Management System</title>
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
        <img src="assets/img/logo/logo.jpg" class="img-fluid" alt="logo" width="60">
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
      <a href="create.php" class="btn btn-outline-primary">Add Blogs</a>
    </div>

    <div class="d-flex justify-content-center">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body">
            <table class="table">
              <thead class="text-center">
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Slug</th>
                  <th>Added on</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="text-center">
                <?php
                  require_once "connection.php";
                  $sql = "SELECT * FROM blogs";
                  if ($result = mysqli_query($link, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['blog_name'] . "</td>";
                        echo "<td>" . $row['blog_url'] . "</td>";
                        echo "<td>" . date("d-m-Y", strtotime($row['blog_added_on'])) . "</td>";
                        echo "<td>
                        <a href='view.php?id=".$row['id']."' class='btn btn-sm btn-info text-white me-2'>
                          <i class='bi bi-eye'></i>
                        </a>
                        <a href='edit.php?id=".$row['id']."' class='btn btn-sm btn-warning text-white me-2'>
                          <i class='bi bi-pencil-fill'></i>
                        </a>
                        <a href='delete.php?id=".$row['id']."' class='btn btn-sm btn-danger'>
                          <i class='bi bi-trash-fill'></i>
                        </a>
                      </td>";
                
                        echo "</tr>";
                      }
                    }
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/vendors/jquery/jquery.min.js"></script>
  <script src="assets/vendors/popper/popper.js"></script>
  <script src="assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="assets/vendors/ckeditor/ckeditor.js"></script>
</body>
</html>
