<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up </title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="assetss/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="assetss/css/style.css">
</head>
<body>
                                
    <div class="main">
        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="assetss/images/signin-image.jpg" alt="sing in image"></figure>
                        <a href="regis.php" class="signup-image-link">Buat Sebuah Akun</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign in</h2>
                        <?php 
                                    if(isset($_POST['login'])){ 
                                        $username = $_POST['username']; 
                                        $password = md5($_POST['password']); 
                                        
                                        if (empty($username) || empty($password)) {
                                            echo '<script>alert("Kolom username dan password harus diisi!");</script>';
                                        }else{
                                        $data = mysqli_query($koneksi, "SELECT* FROM user where username='$username' and password='$password'"); 
                                        $cek = mysqli_num_rows($data); 
                                        if($cek > 0 ){ 
                                            $_SESSION['user'] = mysqli_fetch_array($data); 
                                            echo '<script>alert("Selamat datang, Login Berhasil");location.href="index.php";</script>'; 
                                        }else{ 
                                            echo '<script>alert("maaf username atau password salah");</script>'; 
                                        } 
                                        }
                                    }
                                ?>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="username"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="username" name="username" id="username" placeholder="Username"/>
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="login"  class="form-submit" value="login"/>
                            </div>
                        </form>
                    
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