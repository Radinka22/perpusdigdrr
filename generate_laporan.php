<h1 class="mt-4">Laporan Buku</h1>
<div class="card">
    <style>
        td{
            text-align:center;
        }
    </style>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <table border="1" align="center">
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Buku</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Status Peminjaman</th>
                    </tr>
                    <?php
                    require_once("koneksi.php");

                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT peminjaman.*, user.username, buku.judul FROM peminjaman 
                    LEFT JOIN user ON peminjaman.userID = user.userID 
                    LEFT JOIN buku ON peminjaman.bukuID = buku.bukuID");

                    while($data = mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?php echo $no++;?></td>
                        <td><?php echo $data['username'];?></td>
                        <td><?php echo $data['judul'];?></td>
                        <td><?php echo $data['tgl_peminjaman'];?></td>
                        <td><?php echo $data['tgl_pengembalian'];?></td>
                        <td><?php echo $data['statusPeminjaman'];?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    window.print();
    setTimeout(function(){
        window.close();
    },1000);
</script>
