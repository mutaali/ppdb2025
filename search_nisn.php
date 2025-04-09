<?php
// Koneksi ke database SQLite
$db = new PDO('sqlite:ppdb2025.db');

// Ambil NISN dari parameter GET
$nisn = $_GET['nisn'] ?? '';

if ($nisn) {
    // Query untuk mencari data berdasarkan NISN
    $stmt = $db->prepare("SELECT * FROM pendaftaran WHERE nisn = :nisn");
    $stmt->bindParam(':nisn', $nisn);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo json_encode(['success' => true, 'nisn' => $result['nisn'], 'nama' => $result['nama'], 'jk' => $result['jk'], 'kontak1' => $result['kontak1'], 'kontak2' => $result['kontak2'], 'asal_sekolah' => $result['asal_sekolah'], 'jurusan1' => $result['jurusan1'], 'jurusan2' => $result['jurusan2'], 'alamat' => $result['alamat'], 'Timestamp' => $result['Timestamp']]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'NISN tidak valid']);
}
?>