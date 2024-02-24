
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register</title>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Tambah User</h3></div>
                                    <div class="card-body">
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
                                        <form method='post'>
                                            
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="namaLengkap" type="text" placeholder="masukan nama lengkap" required/>
                                                <label for="namaLengkap">Nama Lengkap</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="username" type="text" placeholder="masukan username" required/>
                                                <label for="username">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="password" type="password" placeholder="masukan password" required/>
                                                <label for="password">Password</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="email" type="email" placeholder="name@example.com" />
                                                <label for="email">Email</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="telp" type="text" placeholder="masukan no telp" required/>
                                                <label for="telp">Telepon</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="alamat" type="text" placeholder="masukan alamat" required/>
                                                <label for="alamat">Alamat</label>
                                            </div>
                                            <div class="input-group mb-3">
                                            <select name="level" id="level" class="form-control form-control fs-6" required>
                                                <option value="admin">Admin</option>
                                                <option value="petugas">petugas</option>
                                            </select>
                </div>
                                           
                                            
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><button class="btn btn-primary btn-block" type="submit" name="register" value="register">Create Account</button></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
          
        </div>
        
    </body>
</html>
