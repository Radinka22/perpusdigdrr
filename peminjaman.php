<h1 class="mt-4">Peminjaman Buku</h1>
<div class="card">
    <div class="card-body">
    <div class="row">
    <div class="col-md-12">
        <a href="?page=buku" class="btn btn-primary">Pilih & Pinjam Buku</a>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <tr>
                <th>No</th>
                <th>Kode Pinjam</th>
                <th>User</th>
                <th>Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status Peminjam</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            $query = mysqli_query($koneksi,"SELECT * FROM peminjaman LEFT JOIN user on user.userID = peminjaman.userID LEFT JOIN buku on buku.bukuID = peminjaman.bukuID WHERE peminjaman.userID=".$_SESSION['user']['userID']);
            while($data = mysqli_fetch_array($query)){
            ?>
            <tr>
                <td><?php echo $no++;?></td>
                <td><?php echo $data['kodePinjam'];?></td>
                <td><?php echo $data['username'];?></td>
                <td><?php echo $data['judul'];?></td>
                <td><?php echo $data['tgl_peminjaman'];?></td>
                <td><?php echo $data['tgl_pengembalian'];?></td>
                <td><?php echo $data['statusPeminjaman'];?></td>
                <td><?php echo $data['jumlah'];?></td>
                <td>
                    <?php
                    if($data['statusPeminjaman'] != 'dikembalikan'){
                    ?>
                    <a href="?page=peminjaman_ubah&&id=<?php echo $data['peminjamanID'];?>" class="btn btn-info">Kembalikan</a>
                   <a onclick="return confirm('Apakah anda yakin menghapus data ini');" href="?page=peminjaman_hapus&&id=<?php echo $data['peminjamanID'];?>" class="btn btn-danger">Batal</a>
                   <?php
                    }
                    ?>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>
    </div>
</div>