<?php include("db.php");
session_start();
if(!$_SESSION['username'] == "admin"){
  header("Location:../home.php");
}
if (isset($_POST['save_task'])) {
  $name = $_POST['username'];
  $email = $_POST['email'];
  $pass = md5($_POST['pass']);
  $query = "INSERT INTO users(pw,email,username) VALUES ('$pass', '$email','$name')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $message = 'Akun berhasil dibuat';
  $message_type = 'success';
}
if(isset($_GET['id'])) {
  if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $name= $_POST['username'];
    $email = $_POST['email'];
    $query = "UPDATE users set email = '$email',username = '$name' WHERE id=$id";
    mysqli_query($conn, $query);
    $message = 'Task Updated Successfully';
    $message_type = 'warning';
  }
  else{
  $id = $_GET['id'];
  $query = "DELETE FROM users WHERE id = $id";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }
  $message = 'Data Berhasil di Hapus';
  $message_type = 'danger';
  }
}

?>

<?php include('includes/header.php'); ?>

<main class="container p-4">
  <div class="row">
    <div class="col-md-4">
      <!-- MESSAGES -->

      <?php if (isset($message)) { ?>
      <div class="alert alert-<?= $message_type?> alert-dismissible fade show" role="alert">
        <?= $message?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php session_unset(); } ?>

      <!-- ADD TASK FORM -->
      <div class="card card-body">
        <form method="POST" action="user.php">
          <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Nama User" autofocus>
          </div>
          <div class="form-group">
            <input type="text" name="email" rows="2" class="form-control" placeholder="Email User"></input>
          </div>
          <div class="form-group">
            <input type="text" name="pass" rows="3" class="form-control" placeholder="Password"></input>
          </div>
          <input type="submit" name="save_task" class="btn btn-success btn-block" value="Tambah User">
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = "SELECT * FROM users";
          $result_tasks = mysqli_query($conn, $query);    
          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['pw']; ?></td>
            <td>
              <a href="edit_user.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
              </a>
              <a href="user.php?id=<?php echo $row['id']?>" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
              </a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<?php include('includes/footer.php'); ?>
