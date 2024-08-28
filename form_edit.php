<?php
 include_once("connection.php");
 include_once("header.php");

 function selectedPaketWisata($val1, $val2){
    
    $result = "";
    if($val1 == $val2){
      $result="selected";
    }
    return $result;
 }

 function renderLayanan($val){
  $result = "";
  if($val == "Y"){
  $result="checked";
  }
  return $result;
  }

  if($_GET)
  {
    $id_daftar_pesanan = $_GET['id_daftar_pesanan'];
  }else
  {
    $id_daftar_pesanan = 1;
  }

  $sql_selected_pesanan ="SELECT * FROM daftar_pesanan WHERE id_daftar_pesanan = $id_daftar_pesanan";

  $selected_pesanan = mysqli_query($conn,$sql_selected_pesanan);

  while ($row = mysqli_fetch_array($selected_pesanan))
  {
      $id_paket_wisata = $row['id_paket_wisata'];
      $nama_pemesan = $row['nama_pemesan'];
      $no_tlp = $row['no_tlp'];
      $tanggal_pemesanan = $row['tanggal_pemesanan'];
      $jumlah_peserta = $row['jumlah_peserta'];
      $jumlah_hari = $row['jumlah_hari'];
      $akomodasi = $row['akomodasi'];
      $transportasi = $row['transportasi'];
      $makanan = $row['makanan'];
      $harga_paket = $row['harga_paket'];
      $total_tagihan = $row['total_tagihan'];
  }

  $sql_selected_paket ="SELECT * FROM paket_wisata WHERE id_paket_wisata = $id_paket_wisata";
  
  $selected_paket = mysqli_query($conn,$sql_selected_paket);

  while ($item = mysqli_fetch_array($selected_paket))
  {
    $nama_paket = $item['nama_paket'];
    $harga_penginapan = $item['harga_penginapan'];
    $harga_transportasi = $item['harga_transportasi'];
    $harga_makan = $item['harga_servis_makan'];
  }

?>



<div class="form-container">
  <h2>Edit Pemesanan Paket Wisata</h2>
  <form action="proses_edit.php" method="post">
    <input type="hidden" name="id_daftar_pesanan" value="<?php echo $id_daftar_pesanan; ?>">
    
    <label for="nama_paket">Nama Paket</label>
    
    <select name="nama_paket" id="nama_paket" >
    
    <?php
      $sql = "SELECT * FROM paket_wisata";
      $results = mysqli_query($conn, $sql);
      
      while ($data_paket = mysqli_fetch_array($results))
      {
    ?>

    <option value="<?php echo $data_paket['id_paket_wisata']?>"
      <?php echo selectedPaketWisata($data_paket ['nama_paket'], $nama_paket) ?>>
        <?php echo $data_paket['nama_paket'] ?>
    </option>

    <?php
      }
    ?>

    </select>

    <label for="nama_pemesan">Nama Pemesan</label>
    <input type="text" name="nama_pemesan" id="nama_pemesan" value="<?php echo $nama_pemesan; ?>" required/>

    <label for="no_tlp">No Tlp/Hp</label>
    <input type="text" name="no_tlp" id="no_tlp" value="<?php echo $no_tlp;?>" required />

    <label for="tgl_pesan">Tanggal Pesan</label>
    <input type="date" name="tgl_pesan" id="tgl_pesan" value="<?php echo $tanggal_pemesanan;?>" required/>
    
    <label for="jumlah_hari">Waktu Pelaksanaan
Perjalanan</label>
    <input type="number" name="jumlah_hari" id="jumlah_hari" value="<?php echo $jumlah_hari; ?>"/>

    <label for="">Pelayanan Paket Perjalanan</label>
      
    <div class="layanan-container">
      <div class="item-layanan">
        <label for="layanan_penginapan">Penginapan
          <?php
          echo " " . number_format($harga_penginapan,0, ',', '.');
          ?>
        </label>
        <input type="checkbox" name="layanan_penginapan" id="layanan_penginapan" value="<?php echo $harga_penginapan; ?>"
        
        <?php echo renderLayanan($akomodasi);?>

        />
      </div><!-- akhir dari item-layanan -->

      <div class="item-layanan">
        <label for="layanan_transportasi">Transportasi
        <?php
          echo " " . number_format($harga_transportasi, 0, ',', '.');
        ?>
        </label>

        <input type="checkbox" name="layanan_transportasi" id="layanan_transportasi" value="<?php echo $harga_transportasi; ?>"

        <?php echo renderLayanan($transportasi);?>

        />
      </div><!-- akhir dari item-layanan -->

      <div class="item-layanan">
        <label for="layanan_makan">Service Makan
          <?php
          echo " " . number_format($harga_makan, 0,
          ',', '.');
          ?>
        </label>

        <input 
        type="checkbox" 
        name="layanan_makan"
        id="layanan_makan" 
        value="<?php echo $harga_makan; ?>" 
        
        <?php echo renderLayanan($makanan);?>

        />

      </div><!-- akhir dari item-layanan -->
    </div><!-- akhir dari layanan-container -->

    <label for="jumlah_peserta">Jumlah Peserta</label>
    <input type="number" name="jumlah_peserta"
    id="jumlah_peserta" value="<?php echo
$jumlah_peserta;?>" />

    <label for="harga_paket">Harga Paket Perjalanan</label>
    <input type="text" name="harga_paket"
    id="harga_paket" value="<?php echo
number_format($harga_paket, 0, ',', '.');?>" required />

    <label for="jumlah_tagihan">Jumlah Tagihan</label>
    <input type="text" name="jumlah_tagihan"
    id="jumlah_tagihan" value="<?php echo
number_format($total_tagihan, 0, ',', '.');?>" required />

    <div class="btn-container">
      <input type="submit" value="Update" />
      <button id="btn-hitung">Hitung</button>
      <button id="btn-reset">Reset</button>
    </div>
  </form>
</div>
<!-- end form-container -->

<?php
 include_once("footer.php");
?>

<script src="https://code.jquery.com/jquery-
3.7.1.min.js" integrity="sha256-
/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
crossorigin="anonymous"></script>

<script src="index.js"></script>