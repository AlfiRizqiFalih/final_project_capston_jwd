<?php 
  include_once("connection.php");
  include_once("header.php");
?> 


      <div class="konten-pariwisata">

        <div class="info-container">

            <?php
            // Perintah SQL untuk Mengambil data

            $sql = "SELECT * FROM paket_wisata";

            //mengeksekusi perintah sql dan menyimpan hasilnya di variable result

            $results = mysqli_query($conn,$sql);

            // melakukan perulangan untuk menampilkan seluruh data dari database menjadi array

            while ($data_paket = mysqli_fetch_array($results))
            {
                // menuliskan apa yang mau diiulang
                // awl perulangan
                $path_gambar = "images/" . $data_paket ['img_paket'];
            ?>

          <div class="paket-container">
            <img src="<?php echo $path_gambar; ?>" alt="" />
            <h3><?php echo $data_paket['nama_paket']; ?></h3> 
            <p><?php echo $data_paket['deskripsi_paket']; ?></p> 
            <a href="form_pendaftaran.php?id_paket_wisata=<?php 
            echo $data_paket['id_paket_wisata'];  ?>">Daftar</a>
          </div>
          <!--akhir dari paket-container-->
          
          <?php
          } // akhir perulangan
          ?>
        </div>
        <!--akhir dari info-container-->

        <div class="promosi-container">
        <?php 
            $results_video = mysqli_query($conn, $sql); 
            while ($data_video = mysqli_fetch_array($results_video))  
            { 
           ?>   
          <div class="video-container">
          <h3><?php echo $data_video['nama_paket'] ?></h3> 
          <?php echo $data_video['link_video']?> 
          </div>
           <!--akhir dari video-container-->
          <?php 
            } 
          ?>
        </div>
        <!--akhir dari promosi-container-->

      </div><!--akhir dari konten-pariwisata-->

    </div>
    <!--akhir dari main-container-->
<?php
  include_once("footer.php");
?>  
 </body>
</html>