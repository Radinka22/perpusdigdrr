<?php

// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "perpuspin");

// Periksa koneksi
if (mysqli_connect_errno()) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

function hapusPeminjaman($koneksi, $peminjamanId) {
    // Mendapatkan informasi peminjaman
    $query_peminjaman = "SELECT bukuID,jumlah FROM peminjaman WHERE peminjamanID = $peminjamanId";
    $result_peminjaman = mysqli_query($koneksi, $query_peminjaman);

    if ($result_peminjaman && mysqli_num_rows($result_peminjaman) > 0) {
        $row = mysqli_fetch_assoc($result_peminjaman);
        $bukuId = $row['bukuID'];
        $jumlahPinjam = $row['jumlah'];

        // Hapus entri peminjaman
        $query_delete = "DELETE FROM peminjaman WHERE peminjamanID = $peminjamanId";
        $result_delete = mysqli_query($koneksi, $query_delete);

        if ($result_delete) {
            // Tambahkan jumlah stok buku yang dikembalikan
            $query_update_stok = "UPDATE buku SET stok = stok + $jumlahPinjam WHERE bukuID = $bukuId";
            $result_update_stok = mysqli_query($koneksi, $query_update_stok);
            if ($result_update_stok) {
                echo '<script>alert("Hapus peminjaman Berhasil.");location.href="?page=peminjaman";</script>';
            } else {
                echo "Error: " . mysqli_error($koneksi);
            }
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    } else {
        echo '<script>alert("peminjaman tidak ditemukan");location.href="?page=peminjaman";</script>';
    }
}

if(isset($_GET['id'])) {
    // Mendapatkan ID peminjaman dari URL
    $peminjamanId = $_GET['id'];
    // Panggil fungsi hapusPeminjaman dengan ID yang diberikan
    hapusPeminjaman($koneksi, $peminjamanId);
} else {
    echo "ID peminjaman tidak ditemukan dalam URL.";
}
// Tutup koneksi database
mysqli_close($koneksi);

?>
