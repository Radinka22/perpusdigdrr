




<?php
// Koneksi ke database (contoh menggunakan mysqli)
$koneksi = mysqli_connect("localhost", "root", "", "perpuspin");

// Periksa apakah koneksi berhasil
if (mysqli_connect_errno()) {
    echo "Gagal terhubung ke MySQL: " . mysqli_connect_error();
    exit();
}

// Memastikan session telah dimulai
if(!isset($_SESSION)) { 
    session_start(); 
}

// Fungsi untuk memeriksa jumlah buku yang sedang dipinjam oleh pengguna
function cekJumlahPeminjaman($koneksi, $id_pengguna) {
    $query = "SELECT COUNT(*) AS jumlah_peminjaman FROM peminjaman WHERE userID = $id_pengguna AND statuspeminjaman = 'dipinjam'";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['jumlah_peminjaman'];
}

// ID pengguna (contoh, bisa diambil dari sesi login atau input pengguna)
$id_pengguna = $_SESSION['user']['userID'];

// Periksa jumlah peminjaman buku yang sedang dipinjam oleh pengguna
$jumlah_peminjaman_dipinjam = cekJumlahPeminjaman($koneksi, $id_pengguna);

// Batas maksimum peminjaman buku
$batas_peminjaman = 3;
?>

 <h1 class="mt-4">tambah peminjam Buku</h1>
 <div class="card">
     <div class="card-body">
         <div class="row">
             <div class="col-md-15">
             <form method="post">
                  <?php
                  if(isset($_GET['peminjaman_id'])) {
                     $bukuID = $_GET['peminjaman_id'];
                 
                     // Mengambil informasi buku berdasarkan bukuID
                     $query = mysqli_query($koneksi, "SELECT * FROM buku WHERE bukuID = '$bukuID'");
                     $buku = mysqli_fetch_assoc($query);
                 
                     // Memastikan buku ditemukan
                     if($buku) {
                         // Menetapkan nilai bukuID ke dalam variabel
                         $selected_bukuID = $buku['bukuID'];
                     }
                 }
                     // Memastikan session telah dimulai
                     if(!isset($_SESSION)) { 
                         session_start(); 
                     }
 
                     $mk = mysqli_query($koneksi,"SELECT MAX(SUBSTRING(kodePinjam,3)) as max_code FROM peminjaman");
                     $row = mysqli_fetch_array($mk);
                     $max_kode = $row['max_code'];
                     if ($max_kode == null){
                         $new_kode = 'PK001';
                     } else {
                         $new_kode = 'PK' . str_pad($max_kode + 1, 3, '0', STR_PAD_LEFT);
                     }
// Periksa apakah pengguna telah mencapai batas maksimum peminjaman
if ($jumlah_peminjaman_dipinjam >= $batas_peminjaman) {
    echo '<script>alert("Maaf, Anda sudah meminjam maksimum '.$batas_peminjaman.' buku.");location.href="?page=peminjaman";</script>';
} else {
    if(isset($_POST['submit'])){
         
       
                    
                        $kodePinjam = $new_kode; // Mendapatkan kode pinjam baru
                        $bukuID = $_POST['bukuID'];
                        $userID = $_SESSION['user']['userID'];
                        $tgl_peminjaman = $_POST['tgl_peminjaman'];
                        $tgl_pengembalian = $_POST['tgl_pengembalian'];
                        $statusPeminjaman = $_POST['statusPeminjaman'];
                        $jumlah = $_POST['jumlah'];
                        $query = mysqli_query($koneksi,"INSERT INTO peminjaman(kodePinjam, bukuID, userID, tgl_peminjaman, tgl_pengembalian, statuspeminjaman, jumlah) VALUES ('$kodePinjam', '$bukuID', '$userID', '$tgl_peminjaman', '$tgl_pengembalian', '$statusPeminjaman' ,'$jumlah')");

                        if($query){
                            echo '<script>alert("Tambah Data Berhasil.");location.href="?page=peminjaman";</script>';
                        } else {
                            echo '<script>alert("Tambah Data Gagal.");</script>';
                        }
                    }

                    $bukuQuery = mysqli_query($koneksi,"SELECT * FROM buku");
                    ?>
                <div class="row-mb-3">
                    <div class="col-mb-2">Buku</div>
                    <div class="col-mb-8">
                    <select name="bukuID" class="form-control">
                                <?php
                                // Menampilkan opsi buku dengan nilai yang diambil dari parameter peminjaman_id
                                if(isset($selected_bukuID)) {
                                    echo "<option value='".$selected_bukuID."' selected>".$buku['judul']."</option>";
                                }
                                ?>
                            </select>
                    </div>
                </div>
                    <div class="row mb-1">
                    <div class="col-md-6">Kode Pinjam</div>
                        <div class="col-md-15"><input type="text" class="form-control" name="tgl_peminjaman" value="<?php echo $new_kode;  ?>" readonly></div>
                    </div>
                    <div class="row mb-1">
                    <div class="col-md-6">Tanggal Pinjam</div>
                        <div class="col-md-15"><input type="date" class="form-control" name="tgl_peminjaman" value="<?php echo date('Y-m-d');  ?>" readonly></div>
                    </div>
                    <div class="row mb-1">
                    <div class="col-md-6">Tanggal Pengembalian</div>
                        <div class="col-md-15"><input type="date" class="form-control" name="tgl_pengembalian"  value="<?php echo date('Y-m-d', strtotime('+7 days')); ?>" readonly></div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-3">Jumlah Yang Akan Dipinjam</div>
                        <div class="col-md-15"><input type="number" class="form-control" name="jumlah" value="1" readonly></div>
                    </div>
                    
                    <div class="row mb-1">
                        <div class="col-md-6">Status Peminjaman</div>
                        <div class="col-md-15">
                            <select class="form-control"  name="statusPeminjaman">
                                <option value="dipinjam">Dipinjam</option>
                                <option value="dikembalikan">Dikembalikan</option>
                            </select>
                        </div>
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-15">
                            <button type="submit" class="btn btn-primary" name="submit" value="submit">simpan</button>
                            
                            <a href="?page=buku" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
            </form>

            </div>
        </div>
    </div>
</div>
<?php
     
    }

?>