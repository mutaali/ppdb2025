<?php include 'auth.php'; ?>
<?php
try {
    // Koneksi ke database
    require "db.php";

    // Periksa apakah parameter id ada
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        throw new Exception('ID tidak ditemukan.');
    }

    $id = (int)$_GET['id'];

    // Hapus data berdasarkan ID
    $stmt = $db->prepare("DELETE FROM pendaftaran WHERE id = ?");
    $stmt->execute([$id]);

    // Redirect kembali ke halaman index.php setelah berhasil menghapus
    header('Location: index.php?message=Data berhasil dihapus');
    exit;
} catch (Exception $e) {
    // Tampilkan pesan error jika terjadi kesalahan
    echo "Error: " . $e->getMessage();
}
?>