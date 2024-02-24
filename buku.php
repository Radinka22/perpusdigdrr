<h1 class="mt-4">Buku</h1>
<div class="card">
    <div class="card-body">
    <div class="row">
    <?php
    if($_SESSION['user']['level'] !='peminjam'){
    ?>
    <div class="col-md-12">
        <a href="?page=buku_tambah" class="btn btn-primary">+ Tambah Data</a>
    <?php
    }
    ?>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Cover Buku</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Deskripsi</th>
                <th>Stok</th>
                <th>Aksi</th>
             
            </tr>
            <?php
            $no = 1;
            $query = mysqli_query($koneksi,"SELECT * FROM buku LEFT JOIN kategori on buku.kategoriID = kategori.kategoriID");
            while($data = mysqli_fetch_assoc($query)){
            ?>
            <tr>
                <td><?php echo $no++;?></td>
                <td><?php echo $data['namaKategori'];?></td>
                <td><img src="assets/img/unggahan/<?php echo $data['gambarBuku'];?>" alt="Cover Buku" style="max-width: 150px; max: heigth 200px;"></td>
                <td><?php echo $data['judul'];?></td>
                <td><?php echo $data['penulis'];?></td>
                <td><?php echo $data['penerbit'];?></td>
                <td><?php echo $data['tahunTerbit'];?></td>
                <td><?php echo $data['deskripsi'];?></td>
                <td><?php echo $data['stok'];?></td>
                <td>
                        <?php
                                if($_SESSION['user']['level'] !='petugas' && $_SESSION['user']['level'] != 'admin'){
                        ?>
                    <a href="?page=peminjaman_tambah&&peminjaman_id=<?php echo $data['bukuID'];?>" class="btn btn-info">Pinjam Buku ini</a>
                        <?php
                                }
                        ?>

                            <?php
                            if($_SESSION['user']['level'] !='peminjam'){
                            ?>
                    <a href="?page=buku_ubah&&id=<?php echo $data['bukuID'];?>" class="btn btn-info">ubah</a>
                    <a onclick="return confirm('Apakah anda yakin menghapus data ini');" href="?page=buku_hapus&&id=<?php echo $data['bukuID'];?>" class="btn btn-danger">hapus</a>
                            <?php
                            }
                            ?>
                </td>
                <?php
                                }
                ?>
            </tr>
            
        </table>
    </div>
</div>
    </div>
</div>