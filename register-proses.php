

<?php
require_once "config/database.php";
			$username  = mysqli_real_escape_string($mysqli, trim($_POST['username']));
			$password  = md5(mysqli_real_escape_string($mysqli, trim($_POST['password'])));
			$nama_user = mysqli_real_escape_string($mysqli, trim($_POST['nama_user']));
			$nomor_handphone = mysqli_real_escape_string($mysqli, trim($_POST['nomor_handphone']));
			$email = mysqli_real_escape_string($mysqli, trim($_POST['email']));
			$hak_akses = "Pengguna";

			// perintah query untuk menyimpan data ke tabel users
            $query = mysqli_query($mysqli, "INSERT INTO is_users(username,password,nama_user,hak_akses,email,telepon)
                                            VALUES('$username','$password','$nama_user','$hak_akses','$email','$nomor_handphone')")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    

            // cek query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil simpan data
                header("location: register.php?alert=2");
            }else{
				header("Location: index.php?alert=1");
			}
	
?>