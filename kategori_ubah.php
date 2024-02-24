
<h1 class="mt-4">Ubah Kategori Buku</h1>
<div class="card">
    <div class="card-body">
    <div class="row">
    <div class="col-md-12">
        <form method="post">

        <?php
            $id = $_GET['id'];
            if(isset($_POST['submit'])){
                $kategori = $_POST['kategori'];
                $query = mysqli_query($koneksi,"UPDATE kategori set namaKategori='$kategori' WHERE kategoriID=$id");

                if($query){
                    echo '<script>alert("Tambah Data Berhasil.");location.href="?page=kategori";</script>';
                }else{
                    echo '<script>alert("Tambah Data Gagal.");</script>';
                }
            }
            $query = mysqli_query($koneksi,"SELECT * FROM kategori WHERE kategoriID=$id");
            $data = mysqli_fetch_array($query);
        ?>

            <div class="row mb-3">
                <div class="col-md-2">Nama Kategori</div>
                <div class="col-md-10"><input type="text" class="form-control" value="<?php echo $data['namaKategori'];?>" name="kategori"></div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
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