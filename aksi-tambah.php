<?php
include "koneksii.php";

    $nama =$_POST['nama_lengkap'];
    $username =$_POST['username'];
    $password =$_POST['password'];
    $no_telp =$_POST['telp'];
  
    $NEWPW = md5($password);
    $query = "CALL tambah('','$nama','$username','$NEWPW','$no_telp')";
    if($koneksi->query($query)=== TRUE){
            echo '<script>
            alert("anda telah berhasil register");
            window.location="login.php";
            </script>';
            
        } else {
            echo '<script>
            alert("terjadi kesalahan");
            window.location="regis.php";
            </script>';
        }

        $koneksi->close();
        
?>
