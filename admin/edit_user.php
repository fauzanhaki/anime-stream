<?php
include("db.php");
session_start();
if(!$_SESSION['username'] == "admin"){
  header("Location:../home.php");
}

if  (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM video WHERE id=$id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $title = $row['username'];
    $description = $row['email'];
  }
}
?>
<?php include('includes/header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="user.php?id=<?php echo $_GET['id'];?>" method="POST">
        <div class="form-group">
          <input name="username" type="text" class="form-control" value="<?php echo $title; ?>" placeholder="Update Title">
        </div>
        <div class="form-group">
          <input name="email" type="text" class="form-control" value="<?php echo $description; ?>" placeholder="Update Title">
        </div>
        <button class="btn-success" name="update">
          Update
</button>
      </form>
      </div>
    </div>
  </div>
</div>
<?php include('includes/footer.php'); ?>
