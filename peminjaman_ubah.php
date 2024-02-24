
<h1 class="mt-4">Pengembalian Buku</h1>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-15">
            <form method="post">
                <?php
                $id = $_GET['id'];
                    if(isset($_POST['submit'])){
                       
                        $bukuID = $_POST['bukuID'];
                        $userID = $_SESSION['user']['userID'];
                        $tgl_peminjaman = $_POST['tgl_peminjaman'];
                        $tgl_pengembalian = $_POST['tgl_pengembalian'];
                        $statusPeminjaman = $_POST['statusPeminjaman'];
                        $query = mysqli_query($koneksi,"UPDATE peminjaman SET bukuID=' $bukuID',tgl_peminjaman='$tgl_peminjaman',tgl_pengembalian='$tgl_pengembalian',statusPeminjaman='$statusPeminjaman' WHERE peminjamanID=$id");

                        if($query){
                            echo '<script>alert("Ubah Data Berhasil.");location.href="?page=peminjaman";</script>';
                        }else{
                            echo '<script>alert("Ubah Data Gagal.");</script>';
                        }
                    }
                    $query = mysqli_query($koneksi,"SELECT * FROM peminjaman WHERE peminjamanID=$id");
                    $data = mysqli_fetch_array($query);
                ?>
                <div class="row-mb-3">
                    <div class="col-mb-2">Buku</div>
                    <div class="col-mb-8">
                        <select name="bukuID" class="form-control">
                            <?php
                                $buk = mysqli_query($koneksi,"SELECT * FROM buku");
                                while($buku = mysqli_fetch_array($buk)){
                            ?>
                                
                                <option  <?php if($buku['bukuID'] == $data['bukuID']) echo 'selected'; ?> value="<?php echo $buku ['bukuID'];?>"><?php echo $buku ['judul'];?></option>    
                                <?php
                                }
                                ?>
                        </select>
                    </div>
                </div>
                    <div class="row mb-1">
                        <div class="col-md-6">Tanggal Peminjaman</div>
                        <div class="col-md-15"><input type="date" class="form-control" name="tgl_peminjaman" value="<?php echo $data['tgl_peminjaman'];?>" readonly></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-6">Tanggal Pengembalian</div>
                        <div class="col-md-15"><input type="date" class="form-control" name="tgl_pengembalian" value="<?php echo $data['tgl_pengembalian'];?>" readonly></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-6">Status Peminjaman</div>
                        <div class="col-md-15">
                            <select class="form-control"  name="statusPeminjaman" >
                                <option value="dipinjam" <?php if($data['statusPeminjaman'] == 'dipinjam') echo 'selected'; ?>>Dipinjam</option>
                                <option value="dikembalikan" <?php if($data['statusPeminjaman'] == 'dikembalikan') echo 'selected'; ?>>Dikembalikan</option>
                            </select>
                        </div>
                   
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-15">
                            <button type="submit" class="btn btn-primary" name="submit" value="submit">simpan</button>
                            <button type="reset" class="btn btn-secondary">reset</button>
                            <a href="?page=peminjaman" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
            </form>
            </div>
        </div>
    </div>
</div>