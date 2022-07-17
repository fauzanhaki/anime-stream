<h2 class="section-title text-white" <?php
        if(!isset($_SESSION['username'])) echo 'hidden';?>>RECENT</h2>
    <div class="media-scroller snaps-inline" <?php
        if(!isset($_SESSION['username'])) echo 'hidden';?>>
        <?php
            if(isset($_SESSION['username'])){
            
            $sql = "SELECT * FROM video WHERE id IN (SELECT movieID FROM recent WHERE id='$username' ORDER BY lasttime DESC);";
            $result = mysqli_query($conn,$sql);
            if($result->num_rows>0){
                $batas = 0;
                while($row = $result->fetch_assoc() and $batas <= 10){
                    $foto = $row['CoverLandscape'];
                    $judul = $row['name'];
                    $rating = $row['rating'];
                    echo "<div class='media-element'>
                    <img src='$foto'>
                    <div class='title'>
                        <h4>$judul</h4>
                        <p>rating</p>
                        <img src='assets/img/star2.png' class='rating' width='20px'>
                        <h4 class='rating'>$rating</h4>
                    </div>
                    </div>";
                    $batas+=1;
                }
            }
        }
        ?>     
    </div>