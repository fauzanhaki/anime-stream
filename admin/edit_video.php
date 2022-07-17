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
    $name = $row['name'];
    $deskripsi = $row['descr'];
    $rating = $row['rate'];
    $path = $row['path'];
    $covland = $row['CoverLandscape'];
    $covpot = $row['CoverPotrait'];
  }
}
?>
<?php include('includes/header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="video.php?id=<?php echo $_GET['id'];?>" method="POST">
        <div class="form-group">
        <div class="form-group">
            <input type="text" name="judul" class="form-control" value="<?php echo $name; ?>" placeholder="Judul Film" autofocus>
          </div>
          <div class="form-group">
            <textarea type="text" name="deskripsi" rows="2" value="" class="form-control"><?php echo $deskripsi; ?></textarea>
          </div>
          <div class="form-group">
            <input type="text" name="rating" rows="3" value="<?php echo $rating; ?>" class="form-control" placeholder="Rating"></input>
          </div>
          <div class="form-group">
            <input type="text" name="path" rows="4" value="<?php echo $path; ?>" class="form-control" placeholder="Path Film"></input>
          </div>
          <div class="form-group">
            <input type="text" name="covland" rows="5" value="<?php echo $covland; ?>" class="form-control" placeholder="Path Cover Landscape"></input>
          </div>
          <div class="form-group">
            <input type="text" name="covpot" rows="6" value="<?php echo $covpot; ?>" class="form-control" placeholder="Path Cover Potrait"></input>
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
