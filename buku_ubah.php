
<h1 class="mt-4">Ubah Buku</h1>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-15">
            <form method="post" enctype="multipart/form-data">
                <?php
                $id = $_GET['id'];
                    if(isset($_POST['submit'])){
                       
                        $judul = $_POST['judul'];
                        $penulis = $_POST['penulis'];
                        $penerbit = $_POST['penerbit'];
                        $tahunTerbit = $_POST['tahunTerbit'];
                        $deskripsi = $_POST['deskripsi'];
                        $stok = $_POST['stok'];
                         if ($stok > 15) {
                            echo "<script>alert('Stok Buku Tidak Boleh lebih Dari 15')</script>";
                            // Tampilkan pesan kesalahan atau lakukan tindakan lain sesuai kebutuhan
                        }else{
                        $nama_file = $_FILES['file']['name'];
                        $ukuran_file = $_FILES['file']['size'];
                        $tmp_file = $_FILES['file']['tmp_name'];
                        $path = "assets/img/unggahan/";
                        $query = mysqli_query($koneksi,"UPDATE buku SET gambarBuku = '$nama_file',judul=' $judul',penulis='$penulis',penerbit='$penerbit',tahunTerbit='$tahunTerbit',deskripsi='$deskripsi',stok='$stok' WHERE bukuID=$id");

                        if($query){
                            echo '<script>alert("Ubah Data Berhasil.");location.href="?page=buku";</script>';
                        }else{
                            echo '<script>alert("Ubah Data Gagal.");</script>';
                        }
                    }
                }
                    $query = mysqli_query($koneksi,"SELECT * FROM buku WHERE bukuID=$id");
                    $data = mysqli_fetch_array($query);
                ?>
                <div class="row-mb-3">
                    <div class="col-mb-2">kategori</div>
                    <div class="col-mb-8">
                        <select name="kategoriID" class="form-control">
                            <?php
                                $kat = mysqli_query($koneksi,"SELECT * FROM kategori");
                                while($kategori = mysqli_fetch_array($kat)){
                            ?>
                                
                                <option <?php if($kategori['kategoriID'] == $data['kategoriID']) echo 'selected'; ?>value="<?php echo $kategori ['kategoriID'];?>"><?php echo $kategori ['namaKategori'];?></option>    
                                <?php
                                }
                                ?>
                        </select>
                    </div>
                </div>
                    <div class="row mb-1">
                        <div class="col-md-6">Masukan Cover Baru</div>
                        <div class="col-md-15"><input type="file" class="form-control" name="file" required></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-6">Judul</div>
                        <div class="col-md-15"><input type="text" class="form-control" name="judul" value="<?php echo $data['judul'];?>" required></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-6">Penulis</div>
                        <div class="col-md-15"><input type="text" class="form-control" name="penulis" value="<?php echo $data['penulis'];?>" required></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-6">Penerbit</div>
                        <div class="col-md-15"><input type="text" class="form-control" name="penerbit" value="<?php echo $data['penerbit'];?>" required></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-6">Tahun Terbit</div>
                        <div class="col-md-15"><input type="number" class="form-control" name="tahunTerbit" value="<?php echo $data['tahunTerbit'];?>" required></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-6">Deskripsi</div>
                        <div class="col-md-15">
                            <textarea row="5" class="form-control" name="deskripsi" required><?php echo $data['deskripsi'];?></textarea>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-6">Stok</div>
                        <div class="col-md-15"><input type="text" class="form-control" name="stok" value="<?php echo $data['stok'];?>" required  min="1" max="15"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-10">
                            <button type="submit" class="btn btn-primary" name="submit" value="submit">simpan</button>
                            <button type="reset" class="btn btn-secondary">reset</button>
                            <a href="?page=buku" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
            </form>
            </div>
        </div>
    </div>
</div>