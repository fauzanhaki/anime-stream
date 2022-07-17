<?php
    include 'config.php';
    session_start();
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM users WHERE username='$username' or email='$username'";
        $result = mysqli_query($conn,$sql);
        if($result->num_rows>0){
            $row = $result->fetch_assoc();
            $foto=$row['foto'];
        }
    }
    else{
        echo "<script>
        alert('Silahkan login say sebelum masuk halaman ini');
        window.location.href='home.php';
        </script>";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watchlist</title>
    <link rel="icon" type="image/x-icon" href="assets/img/icon.png">
    <!-- bootstrap -->
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <!-- css  -->
    <link rel="stylesheet" href="assets/css/list.css">
    <link rel="stylesheet" href="assets/css/search.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/footer.css">
</head>

<body>
<nav id="navigation" class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <ul class="navbar-nav mb-2">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="home.php">ROXO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="home.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Menu
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="recent.php">Recent</a></li>
                        <li><a class="dropdown-item" href="trending.php">Trending</a></li>
                        <li><a class="dropdown-item" href="new.php">New Realeses</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Genre
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="genre.php?genre=action">Action</a></li>
                        <li><a class="dropdown-item" href="genre.php?genre=adventure">Adventure</a></li>
                        <li><a class="dropdown-item" href="genre.php?genre=comedy">Comedy</a></li>
                        <li><a class="dropdown-item" href="genre.php?genre=drama">Drama</a></li>
                        <li><a class="dropdown-item" href="genre.php?genre=ecchi">Ecchi</a></li>
                        <li><a class="dropdown-item" href="genre.php?genre=isekai">Isekai</a></li>
                        <li><a class="dropdown-item" href="genre.php?genre=magic">Magic</a></li>
                        <li><a class="dropdown-item" href="genre.php?genre=romance">Romance</a></li>
                        <li><a class="dropdown-item" href="genre.php?genre=school">School</a></li>
                        <li><a class="dropdown-item" href="genre.php?genre=sliceoflife">Slice Of Life</a></li>
                    </ul>
                <li class="nav-item">
                    <a class="nav-link " href="about.php">About</a>
                </li>
                    </ul>
                </li>
            </ul>
            <!-- end dm -->

            <div class="search-center">
                <form autocomplete="off" method="GET" action="./search.php">
                    <div class="autocomplete" style="width:300px;">
                        <input id="myInput" class="form-control me-2" type="search" name="search" placeholder="Search">
                    </div>
                    <input type="submit" name="searchsub" hidden>
                </form>
            </div>
            <div class="d-flex pp">
                <?php
                    if(!isset($username)){
                        echo '<button class="btn btn-outline-custom-light" type="submit"><a class="text-decoration-none text-light"
                        href="loginpg.php">SIGN IN</a> </button>
                        <button class="btn btn-outline-custom-light" type="submit"><a class="text-decoration-none text-light"
                        href="regpg.php">CREATE ACCOUNT</a> </button>';
                    }
                    else{
                        
                        echo "<p class='navtext mx-end my-auto'>$username</p>
                        <img class='avanav mx-end' src='$foto'><button class='btn btn-outline-danger mx-3' type='submit'><a class='text-decoration-none text-light'
                        href='logout.php'>Log Out</a> </button> ";
                    }
                ?>
            <!-- <button class="btn btn-outline-custom-light" type="submit"><a class="text-decoration-none text-light"
                    href="loginpg.php">SIGN IN</a> </button>
            <button class="btn btn-outline-custom-light" type="submit"><a class="text-decoration-none text-light"
                    href="regpg.php">CREATE ACCOUNT</a> </button> -->
                    
            </div>
        </div>
    </nav>
    <!-- GENRE LIST-->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- ACTION -->
                    <section id="action">
                        <div class="action__product" style="text-decoration: none;">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <div class="section-title">
                                        <h4>Watchlist</h4>
                                        <hr style="color: white;" width="850">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <?php
                                    $sql = "SELECT * FROM video WHERE id in (SELECT movieID FROM watchlist WHERE users=$id)";
                                    $result = mysqli_query($conn,$sql);
                                    if($result->num_rows>0){
                                        while($row = $result->fetch_assoc()){
                                            $name = $row['name'];
                                            $watch = $row['watch'];
                                            $cover = $row['CoverPotrait'];
                                            $rating = $row['rate'];
                                            echo "<div class='col-lg-4 col-md-6 col-sm-6'>
                                            <a href='stream.php?id=$id'><div class='product__item'>
                                                <div class='product__item__pic set-bg'>
                                                    <img src='$cover' width='229' height='325'>
                                                    <div class='comment'><i class='fa fa-comments'></i>$rating</div>
                                                    <div class='view'><i class='fa fa-eye'></i> $watch</div>
                                                </div>
                                                <div class='product__item__text'>
                                                    <h5><a href='#'>$name</a></h5>
                                                </div>
                                            </div></a>
                                        </div>";
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        </div>
        <!-- END GENRE LIST -->

        <!-- JS -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.js"></script>
        <script src="assets/js/navbar.js"></script>
        <script src="assets/js/search.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script>
        var search = [];
        <?php
    $sql = "SELECT name FROM video";
    $result = mysqli_query($conn,$sql);
    if($result->num_rows>0){
      while($row = $result->fetch_assoc()){
        $nama = $row['name'];
        echo "search.push('$nama');";
      }
    }
    ?>
    autocomplete(document.getElementById("myInput"), search);
    </script>
</body>
<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="footer-col-5">
					<img src="assets/img/icon.png" alt="" class="fa-align-left">
					<h5 style="font-size: 50px;">ROXO-NIME</h5>
				</div>
				<div class="footer-col-5">
					<ul>
						<p style="text-indent: 30px;">
							Roxo adalah layanan yang memungkinkan pengguna menonton tayangan Anime kesukaan di mana pun,
							kapan pun, dan hampir lewat medium apa pun (smartphone, smartTV, tablet, PC, dan laptop).
							Roxo ibarat toko penyewaan DVD, tetapi menawarkan film digital di dunia maya dan gratis.
							Roxo bisa juga disamakan dengan layanan video di YouTube. Roxo bersih dari iklan, penonton
							tak perlu menunggu jadwal penayangan serial anime di televisi, dan bisa menentukan sendiri
							konten yang ingin dinikmati
						</p>
					</ul>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="footer-col">
					<h4>Menu</h4>
					<ul>
						<li><a href="#">Recent</a></li>
						<li><a href="#">Trending</a></li>
						<li><a href="#">New Releases</a></li>
						<li><a href="#">Shounen</a></li>
					</ul>
				</div>
				<div class="footer-col">
					<h4>Genre</h4>
					<ul>
						<?php
							$sql = "SELECT DISTINCT genre FROM genre";
							$result = mysqli_query($conn,$sql);
							while($row = $result->fetch_assoc()) {
                                $genre = $row['genre'];
								echo "<li><a href='genre.php?genre=$genre'>$genre</a></li>";
							}
						?>
					</ul>
				</div>
				<div class="footer-col">
					<h4>Contact</h4>
					<p>addres :</p><br>
					<p>Jl. Ring Road Utara, Ngringin, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa
						Yogyakarta 55281</p>
				</div>
			</div>
		</div>
		<div class="footer__copyright">
			&copy; Copyright 2022 Roxo Inc.
		</div>
	</footer>
</html>