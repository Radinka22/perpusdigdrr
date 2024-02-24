
<h1 class="mt-4">Tambah Buku</h1>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-15">
            <form method="post" enctype="multipart/form-data">
                <?php
                    if(isset($_POST['submit'])){
                        
                        $kategoriID = $_POST['kategoriID'];
                        $judul = $_POST['judul'];
                        $penulis = $_POST['penulis'];
                        $penerbit = $_POST['penerbit'];
                        $tahunTerbit = $_POST['tahunTerbit'];
                        $deskripsi = $_POST['deskripsi'];
                        $stok = $_POST['stok'];
                        $stok = $_POST['stok'];
                        $stok = $_POST['stok'];
                        if ($stok > 15) {
                            echo "<script>alert('Stok Buku Tidak Boleh lebih Dari 15')</script>";
                            // Tampilkan pesan kesalahan atau lakukan tindakan lain sesuai kebutuhan
                        }else{
        // Tampilkan pesan kesalahan atau lakukan tindakan lain sesuai kebutuhan
    
                        $ekstensi_diperbolehkan	= array('png','jpg','jpeg');
	                    $namafile = $_FILES['file']['name'];
                        $x = explode('.', $namafile);
                        $ekstensi = strtolower(end($x));
                        $ukuran	= $_FILES['file']['size'];
                        $file_tmp = $_FILES['file']['tmp_name'];

                        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                            if($ukuran < 3044070){		
                                move_uploaded_file($file_tmp, './assets/img/unggahan/'.$namafile);    
                                $query = mysqli_query($koneksi, "INSERT INTO buku(judul,penulis,penerbit,tahunTerbit,kategoriID,deskripsi,stok,gambarBuku) 
                                
                                VALUES ('$judul','$penulis','$penerbit','$tahunTerbit','$kategoriID','$deskripsi','$stok','$namafile')");
                                if($query){
                                    echo '<script>alert("Tambah Buku Berhasil.");location.href="?page=buku";</script>';
                                }else{
                                    echo "<script>alert('Tambah Buku Gagal')</script>";
                                }
                            }else{
                                echo "<script>alert('UKURAN FILE TERLALU BESAR, MAKSIMAL UKURAN 1 MB')</script>";
                            }
                        }else{
                            echo "<script>alert('HANYA EKSTENSI .png, .jpg DAN .jpeg YANG DI PERBOLEHKAN')</script>";
                        }
    }

}

                
                    ?>

                <div class="row-mb-3">
                    <div class="col-mb-2">kategori</div>
                    <div class="col-mb-8">
                        <select name="kategoriID" class="form-control">
                            <?php
                                $kat = mysqli_query($koneksi,"SELECT * FROM kategori");
                                while($kategori = mysqli_fetch_array($kat)){
                            ?>
                                
                                <option value="<?php echo $kategori ['kategoriID'];?>"><?php echo $kategori ['namaKategori'];?></option>    
                                <?php
                                }
                                ?>
                        </select>
                    </div>
                </div>
                    <div class="row mb-1">
                        <div class="col-md-6">Judul</div>
                        <div class="col-md-15"><input type="text" class="form-control" name="judul" required ></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-6">Cover Buku</div>
                        <div class="col-md-15"><input type="file" class="form-control" name="file" accept=".png, .jpeg, .jpg" ></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-6">Penulis</div>
                        <div class="col-md-15"><input type="text" class="form-control" name="penulis" required></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-6">Penerbit</div>
                        <div class="col-md-15"><input type="text" class="form-control" name="penerbit"required></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-6">Tahun Terbit</div>
                        <div class="col-md-15"><input type="number" class="form-control" name="tahunTerbit" required></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-6">Deskripsi</div>
                        <div class="col-md-15">
                            <textarea row="5" class="form-control" name="deskripsi" required></textarea>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-6">Stok</div>
                        <div class="col-md-15"><input type="text" class="form-control" name="stok" required min="1" max="15"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-10">
                            <button type="submit" class="btn btn-primary" name="submit" value="submit">simpan</button>
                            <button type="reset" class="btn btn-secondary">reset</button>
                            <a href="?page=kategori" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
            </form>
            </div>
        </div>
    </div>
</div>