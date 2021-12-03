

<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";

if (isset($_POST['dataidobat'])) {
  $kode_obat = $_POST['dataidobat'];

  // fungsi query untuk menampilkan data dari tabel obat
  $query = mysqli_query($mysqli, "SELECT kode_obat,nama_obat,harga_jual FROM is_obat WHERE kode_obat='$kode_obat'")
    or die('Ada kesalahan pada query tampil data obat: ' . mysqli_error($mysqli));

  // tampilkan data
  $data = mysqli_fetch_assoc($query);

  // $stok   = $data['stok'];
  $hargajual = $data['harga_jual'];
  // $satuan = $data['satuan'];

  if ($hargajual != '') {
    echo "<div class='form-group'>
                <label class='col-sm-2 control-label'>Harga</label>
                <div class='col-sm-5'>
                  <div class='input-group'>
                    <input type='text' class='form-control' id='hargajual' name='hargajual' value='$hargajual' readonly>
                    <span class='input-group-addon'>Rupiah</span>
                  </div>
                </div>
              </div>";
  } else {
    echo "<div class='form-group'>
                <label class='col-sm-2 control-label'>Harga</label>
                <div class='col-sm-5'>
                  <div class='input-group'>
                    <input type='text' class='form-control' id='hargajual' name='hargajual' value='hargajual obat tidak ditemukan' readonly>
                    <span class='input-group-addon'>Harga Jual Obat tidak ditemukan</span>
                  </div>
                </div>
              </div>";
  }
}
?> 