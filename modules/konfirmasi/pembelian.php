

<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";

if (isset($_POST['datakodetransaksi'])) {
  $kode_transaksi = $_POST['datakodetransaksi'];

  // fungsi query untuk menampilkan data dari tabel obat
  $query = mysqli_query($mysqli, "SELECT kode_transaksi,tanggal_pembelian,nama_obat,harga,jumlah_beli,total_harga FROM tb_pembelian WHERE kode_transaksi='$kode_transaksi'")
    or die('Ada kesalahan pada query tampil data obat: ' . mysqli_error($mysqli));

  // tampilkan data
  $data = mysqli_fetch_assoc($query);

  // $stok   = $data['stok'];
  $tanggal_pembelian = $data['tanggal_pembelian'];
  $nama_obat = $data['nama_obat'];
  $harga = $data['harga'];
  $jumlah_beli = $data['jumlah_beli'];
  $total_harga = $data['total_harga'];
  // $satuan = $data['satuan'];

  if ($tanggal_pembelian != '') {
    echo "<div class='form-group'>
                <label class='col-sm-2 control-label'>Tanggal Pembelian</label>
                <div class='col-sm-5'>
                  <div class='input-group'>
                    <input type='text' class='form-control' id='tglpembelian' name='tglpembelian' value='$tanggal_pembelian' readonly>

                  </div>
                </div>
              </div>";
  }
  if ($nama_obat != '') {
    echo "<div class='form-group'>
                <label class='col-sm-2 control-label'>Nama Obat</label>
                <div class='col-sm-5'>
                  <div class='input-group'>
                    <input type='text' class='form-control' id='namaobat' name='namaobat' value='$nama_obat' readonly>

                  </div>
                </div>
              </div>";
  }
  if ($harga != '') {
    echo "<div class='form-group'>
                <label class='col-sm-2 control-label'>Harga</label>
                <div class='col-sm-5'>
                  <div class='input-group'>
                    <input type='text' class='form-control' id='harga' name='harga' value='$harga' readonly>

                  </div>
                </div>
              </div>";
  }
  if ($jumlah_beli != '') {
    echo "<div class='form-group'>
                <label class='col-sm-2 control-label'>Jumlah Beli</label>
                <div class='col-sm-5'>
                  <div class='input-group'>
                    <input type='text' class='form-control' id='jumlahbeli' name='jumlahbeli' value='$jumlah_beli' readonly>

                  </div>
                </div>
              </div>";
  }
  if ($total_harga != '') {
    echo "<div class='form-group'>
                <label class='col-sm-2 control-label'>Total Harga</label>
                <div class='col-sm-5'>
                  <div class='input-group'>
                    <input type='text' class='form-control' id='totalharga' name='totalharga' value='$total_harga' readonly>

                  </div>
                </div>
              </div>";
  }
  // else {
  //   echo "<div class='form-group'>
  //               <label class='col-sm-2 control-label'>Nama Obat</label>
  //               <div class='col-sm-5'>
  //                 <div class='input-group'>
  //                   <input type='text' class='form-control' id='hargajual' name='hargajual' value='hargajual obat tidak ditemukan' readonly>
  //                   <span class='input-group-addon'>Harga Jual Obat tidak ditemukan</span>
  //                 </div>
  //               </div>
  //             </div>";
  // }
}
?> 