<?php
$id = $_GET['id'];

// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "perpuspin");

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Fungsi untuk memeriksa status peminjaman buku berdasarkan ID buku
function cekStatusPeminjaman($koneksi, $id) {
    $query = "SELECT statusPeminjaman FROM peminjaman WHERE bukuID=$id";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['statusPeminjaman']; // Mengembalikan status peminjaman
    } else {
        echo "Error: " . mysqli_error($koneksi);
        return false;
    }
}

// Memeriksa status peminjaman buku
$status_peminjaman = cekStatusPeminjaman($koneksi, $id);

// Jika status peminjaman buku adalah "dipinjam", buku tidak dapat dihapus
if ($status_peminjaman == "dipinjam") {
    echo "<script>
            alert('Buku masih dalam status dipinjam dan tidak dapat dihapus.');
            window.location.href = 'index.php?page=buku';
          </script>";
} elseif ($status_peminjaman == "dikembalikan") {
    // Jika status peminjaman buku adalah "dikembalikan", buku dapat dihapus

    // Menghapus data peminjaman terlebih dahulu yang terkait dengan buku yang akan dihapus
    $query_delete_peminjaman = mysqli_query($koneksi, "DELETE FROM peminjaman WHERE bukuID=$id");

    // Memeriksa apakah penghapusan data peminjaman berhasil atau tidak
    if ($query_delete_peminjaman) {
        // Jika penghapusan data peminjaman berhasil, Anda dapat menghapus buku
        $query_delete_buku = mysqli_query($koneksi, "DELETE FROM buku WHERE bukuID=$id");

        if ($query_delete_buku) {
            // Jika penghapusan buku berhasil, tampilkan pesan berhasil
            echo "<script>
                    alert('Hapus Data Berhasil');
                    window.location.href = 'index.php?page=buku';
                  </script>";
        } else {
            // Jika terjadi kesalahan saat menghapus buku, tampilkan pesan error
            echo "Error: " . mysqli_error($koneksi);
        }
    } else {
        // Jika terjadi kesalahan saat menghapus data peminjaman, tampilkan pesan error
        echo "Error: " . mysqli_error($koneksi);
    }
}elseif ($status_peminjaman == "") {
    // Jika status peminjaman buku adalah kosong, maka buku dapat dihapus
    
    // Menghapus buku dari tabel buku
    $query_delete_buku = mysqli_query($koneksi, "DELETE FROM buku WHERE bukuID=$id");

    // Memeriksa apakah penghapusan buku berhasil atau tidak
    if ($query_delete_buku) {
        // Jika penghapusan buku berhasil, tampilkan pesan berhasil
        echo "<script>
                alert('Hapus Data Berhasil');
                window.location.href = 'index.php?page=buku';
              </script>";
    } else {
        // Jika terjadi kesalahan saat menghapus buku, tampilkan pesan error
        echo "Error: " . mysqli_error($koneksi);
    }
}

// Tutup koneksi
mysqli_close($koneksi);
?>
