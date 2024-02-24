<?php
 include 'koneksi.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="assetss/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="assetss/css/style.css">
</head>
<body>
                                    <?php




                                        if(isset($_POST['register'])){
                                            $username = $_POST['username'];
                                            $password = md5($_POST['password']);
                                            $namaLengkap = $_POST['namaLengkap'];
                                            $email = $_POST['email'];
                                            $telp = $_POST['telp'];
                                            $alamat = $_POST['alamat'];
                                            $level = $_POST['level'];
                                            function cekUsername($koneksi, $username) {
                                                // Query untuk memeriksa apakah nama lengkap sudah ada di database
                                                $query = "SELECT * FROM user WHERE username = '$username'";
                                                $result = mysqli_query($koneksi, $query);
                                            
                                                // Periksa apakah query berhasil
                                                if ($result && mysqli_num_rows($result) > 0) {
                                                    return true; // Nama lengkap sudah ada di database
                                                } else {
                                                    return false; // Nama lengkap belum ada di database
                                                }
                                            }
                                           
                                            if (cekUsername($koneksi, $username)) {
                                                echo '<script>alert("Username Sudah Terdaftar");</script>';
                                            }else{
                                            $insert = mysqli_query($koneksi,"INSERT INTO user (username,password,namaLengkap,email,telp,alamat,level) VALUES ('$username','$password','$namaLengkap','$email','$telp','$alamat','$level')");
                                            if($insert){
                                                echo '<script>alert("Selamat Register Berhasil");location.href="login.php";</script>';
                                            }else{
                                                echo'<script>alert("maap Registrasi gagal"); location.href="regis.php";</script>';
                                            }
                                            }
                                        }
                                      ?>
    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="post" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="nama_lengkap"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="namaLengkap" id="namaLengkap" placeholder="Nama lengkap"/>
                            </div>
                            <div class="form-group">
                                <label for="username"><i class="zmdi zmdi-face"></i></label>
                                <input type="text" name="username" id="username" placeholder="Username"/>
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="password"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="email"/>
                            </div>
                            <div class="form-group">
                                <label for="telp"><i class="zmdi zmdi-phone"></i></label>
                                <input type="number" name="telp" id="telp" placeholder="Telepon"/>
                            </div>
                            <div class="form-group">
                                <label for="alamat"><i class="zmdi zmdi-pin-drop"></i></label>
                                <input type="text" name="alamat" id="talamat" placeholder="Alamat"/>
                            </div>
                            <div class="form-group" hidden>
                            <input type="text" id="level" name="level" value="peminjam"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="register" class="form-submit" value="register"/>
                            </div>
                            
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="assetss/images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="login.php" class="signup-image-link">Saya Sudah Jadi Member</a>
                    </div>
                </div>
            </div>
        </section>

        

    </div>

    <!-- JS -->
    <script src="assetss/vendor/jquery/jquery.min.js"></script>
    <script src="assetss/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>