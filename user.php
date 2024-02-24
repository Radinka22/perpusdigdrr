<h1 class="mt-4">Daftar User</h1>
<div class="card">
    <div class="card-body">
    <div class="row">
    <div class="col-md-12">
        
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Email</th>
                <th>No Telepon</th>
                <th>Nama Lengkap</th>
                <th>Alamat</th>
               
            </tr>
            <?php
            $no = 1;
            $query = mysqli_query($koneksi,"SELECT * FROM user");
            while($data = mysqli_fetch_array($query)){
            ?>
            <tr>
                <td><?php echo $no++;?></td>
                <td><?php echo $data['username'];?></td>
                <td><?php echo $data['email'];?></td>
                <td><?php echo $data['telp'];?></td>
                <td><?php echo $data['namaLengkap'];?></td>
                <td><?php echo $data['alamat'];?></td>
               
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>
    </div>
</div>