<?php include("db.php");
session_start();
if(!$_SESSION['username'] == "admin"){
  header("Location:../home.php");
}
if (isset($_POST['save_task'])) {
  $name = $_POST['judul'];
  $deskripsi = $_POST['deskripsi'];
  $rating = $_POST['rating'];
  $path = $_POST['path'];
  $covland = $_POST['covland'];
  $covpot = $_POST['covpot'];
  $query = "INSERT INTO video(name,descr,rate,path,coverlandscape,coverpotrait) VALUES ('$name', '$deskripsi',$rating,'$path','$covland','$covpot')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $message = 'Video berhasil dibuat';
  $message_type = 'success';
}
if(isset($_GET['id'])) {
  if (isset($_POST['update'])) {
    $name = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $rating = $_POST['rating'];
    $path = $_POST['path'];
    $covland = $_POST['covland'];
    $covpot = $_POST['covpot'];
    $query = "UPDATE video set name = '$name',descr = '$deskripsi',rate = $rating,path = '$path',coverlandscape = '$covland',coverpotrait = '$covpot' where id=$id";
    mysqli_query($conn, $query);
    $message = 'Data berhasil di update';
    $message_type = 'warning';
  }
  else{
  $id = $_GET['id'];
  $query = "DELETE FROM video WHERE id = $id";
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
        <form method="POST" action="video.php">
          <div class="form-group">
            <input type="text" name="judul" class="form-control" placeholder="Judul Film" autofocus>
          </div>
          <div class="form-group">
            <textarea type="text" name="deskripsi" rows="2" class="form-control" placeholder="Deskripsi Film"></textarea>
          </div>
          <div class="form-group">
            <input type="text" name="rating" rows="3" class="form-control" placeholder="Rating"></input>
          </div>
          <div class="form-group">
            <input type="text" name="path" rows="4" class="form-control" placeholder="Path Film"></input>
          </div>
          <div class="form-group">
            <input type="text" name="covland" rows="5" class="form-control" placeholder="Path Cover Landscape"></input>
          </div>
          <div class="form-group">
            <input type="text" name="covpot" rows="6" class="form-control" placeholder="Path Cover Potrait"></input>
          </div>
          <input type="submit" name="save_task" class="btn btn-success btn-block" value="Tambah Video">
        </form>
      </div>
    </div>
    <div class="col-md-8" style="overflow-x:auto;">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Rating</th>
            <th>Watch</th>
            <th>Path</th>
            <th>Cover Landscape</th>
            <th>Cover Potrait</th>
            <th>Waktu Upload</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = "SELECT * FROM video";
          $result_tasks = mysqli_query($conn, $query);    
          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['descr']; ?></td>
            <td><?php echo $row['rate']; ?></td>
            <td><?php echo $row['watch']; ?></td>
            <td><?php echo $row['path']; ?></td>
            <td><?php echo $row['CoverLandscape']; ?></td>
            <td><?php echo $row['CoverPotrait']; ?></td>
            <td><?php echo $row['upload']; ?></td>
            <td>
              <a href="edit_video.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
              </a>
              <a href="video.php?id=<?php echo $row['id']?>" class="btn btn-danger">
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
