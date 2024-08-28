<?php
  include_once('connection.php');
  include_once('header.php');

  //function digunakan  untuk menentukan option yang terpilih pada element select
  //akan membandingkan nilai id_paket_wisata yang dikirimkan dngn nilai id_paket_wisata yng ada pada value option
  //jika sama akan dituliskan selected
  function selectedPaketWisata($val1, $val2){ 
    $result = ""; 
    if($val1 == $val2){ 
      $result="selected"; 
    } 
    return $result; 
  }//akhir function

  //menginisialisasi nilai id_paket_wisata  agar selalu ada
  if($_GET) 
  { //dari link daftar
    $id_paket_wisata = $_GET['id_paket_wisata']; 
  }else 
  { //dari link menu
    $id_paket_wisata = 1; 
  }

  //perintah SQL untuk mencari data paket wisata sesuai dengan id_paket_wisata yg terpilih
  $sql_selected_paket ="SELECT * FROM paket_wisata WHERE id_paket_wisata =  $id_paket_wisata"; 

  $selected_paket = mysqli_query($conn, $sql_selected_paket);

  while ($row = mysqli_fetch_array($selected_paket))  
  { 
    $kode_paket_wisata = $row['id_paket_wisata']; 
 
    $nama_paket = $row['nama_paket']; 
 
    $harga_penginapan = $row['harga_penginapan']; 
 
    $harga_transportasi = $row['harga_transportasi']; 
 
    $harga_makan = $row['harga_servis_makan']; 
  }
  
?>

<div class="form-container"> 
  <h2>Form Pemesanan Paket Wisata</h2> 

  <form action="proses_tambah.php" method="post">
    <label for="nama_paket">Nama Paket</label> 
    <select name="nama_paket" id="nama_paket">
        <?php 
         $sql = "SELECT * FROM paket_wisata"; 
         $results = mysqli_query($conn, $sql); 
          
         while ($data_paket = mysqli_fetch_array($results))
         {
        ?> 
        <option value="<?php echo $data_paket['id_paket_wisata'] ?>"
        <?php echo selectedPaketWisata($data_paket['nama_paket'],  $nama_paket);  ?>
        ><?php echo $data_paket['nama_paket'] ?></option>
        <?php 
         }
        ?> 
    </select>
    <label for="nama_pemesan">Nama Pemesan</label> 
    <input type="text" name="nama_pemesan" id="nama_pemesan" required/>
    <label for="no_tlp">No Tlp/Hp</label> 
    <input type="text" name="no_tlp" id="no_tlp" required />
    <label for="tgl_pesan">Tanggal Pesan</label> 
    <input type="date" name="tgl_pesan" id="tgl_pesan" required/>
    <label for="jumlah_hari">Waktu Pelaksanaan Perjalanan</label> 
    <input type="number" name="jumlah_hari" id="jumlah_hari" value="1"/>
    <label for="">Pelayanan Paket Perjalanan</label> 
       <div class="layanan-container"> 
         <div class="item-layanan"> 
           <label for="layanan_penginapan">Penginapan <?php echo ' ' . number_format ($harga_penginapan,0, ',', '.'); ?> </label> 
               <input type="checkbox" name="layanan_penginapan" id="layanan_penginapan" value="<?php echo $harga_penginapan; ?>" checked /> 
         </div><!--akhir dari item-layanan --> 
 
         <div class="item-layanan"> 
           <label for="layanan_transportasi">Transportasi<?php echo ' ' . number_format ($harga_transportasi,0, ',', '.'); ?> </label> 
           <input type="checkbox" name="layanan_transportasi" id="layanan_transportasi" value="<?php echo $harga_transportasi; ?>" checked/> 
         </div><!--akhir dari item-layanan --> 
 
         <div class="item-layanan"> 
           <label for="layanan_makan">Service Makan<?php echo ' ' . number_format ($harga_makan,0, ',', '.'); ?></label> 
           <input type="checkbox" name="layanan_makan" id="layanan_makan" value="<?php echo $harga_makan; ?>" checked /> 
         </div><!--akhir dari item-layanan --> 
       </div><!--akhir dari layanan-container -->
    <label for="jumlah_peserta">Jumlah Peserta</label> 
    <input type="number" name="jumlah_peserta" id="jumlah_peserta" value="1"/>
    <label for="harga_paket">Harga Paket Perjalanan</label>
    <input type="text" name="harga_paket" id="harga_paket" required />
    <label for="jumlah_tagihan">Jumlah Tagihan</label> 
    <input type="text" name="jumlah_tagihan" id="jumlah_tagihan" required />
       <div class="btn-container"> 
            <input type="submit" value="Simpan" /> 
            <button id="btn-hitung">Hitung</button> 
            <button id="btn-reset">Reset</button> 
       </div><!--akhir dari btn-container -->   
  </form>
</div><!--akhir dari form-container -->

<?php
  include_once('footer.php');
?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" 
integrity="sha256
/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
crossorigin="anonymous"></script> 

<script src="index.js"></script>