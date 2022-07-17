<link rel="stylesheet" href="assets/css/home.css">
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