
<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
if (empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
else {
    if ($_GET['act']=='insert') {
        if (isset($_POST['simpan'])) {
            // ambil data hasil submit dari form
            $nama_obat = mysqli_real_escape_string($mysqli, trim($_POST['nama_obat']));
            $harga_jual = mysqli_real_escape_string($mysqli, trim($_POST['harga_jual']));
            $stok = mysqli_real_escape_string($mysqli, trim($_POST['stok']));
            $jml_beli = mysqli_real_escape_string($mysqli, trim($_POST['jml_beli']));
            $jmulah_bayar = mysqli_real_escape_string($mysqli, trim($_POST['jumlah_bayar']));

            $created_user    = $_SESSION['id_user'];

            // perintah query untuk menyimpan data ke tabel obat masuk
            $query = mysqli_query($mysqli, "INSERT INTO is_beli_obat(nama_obat,harga_jual,stok,jml_beli,jumlah_bayar,created_user) 
                                            VALUES('$nama_obat','$harga_jual','$jml_beli','$jumlah_bayar','$created_user')")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    

            // cek query
            if ($query) {
                // perintah query untuk mengubah data pada tabel obat
                $query1 = mysqli_query($mysqli, "UPDATE is_obat SET stok        = '$total_stok'
                                                              WHERE kode_obat   = '$kode_obat'")
                                                or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

                // cek query
                if ($query1) {                       
                    // jika berhasil tampilkan pesan berhasil simpan data
                    header("location: ../../main.php?module=beli_obat&alert=1");
                }
            }   
        }   
    }
}       
?>