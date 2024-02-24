<?php
$id = $_GET['id'];

// Menghapus data buku terlebih dahulu yang terkait dengan kategori yang akan dihapus
$query_delete_buku = mysqli_query($koneksi, "DELETE FROM buku WHERE kategoriID=$id");

// Memeriksa apakah penghapusan data buku berhasil atau tidak
if ($query_delete_buku) {
    // Jika penghapusan data buku berhasil, baru Anda dapat menghapus kategori
    $query_delete_kategori = mysqli_query($koneksi, "DELETE FROM kategori WHERE kategoriID=$id");

    if ($query_delete_kategori) {
        // Jika penghapusan kategori berhasil, tampilkan pesan berhasil
        echo "<script>
                alert('Hapus Data Berhasil');
                location.href = 'index.php?page=kategori';
              </script>";
    } else {
        // Jika terjadi kesalahan saat menghapus kategori, tampilkan pesan error
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    // Jika terjadi kesalahan saat menghapus data buku, tampilkan pesan error
    echo "Error: " . mysqli_error($koneksi);
}
?>
