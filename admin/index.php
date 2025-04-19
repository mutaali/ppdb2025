<?php include 'auth.php'; ?>
<?php
require "db.php";

$keyword = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$total = $db->query("SELECT COUNT(*) FROM pendaftaran WHERE nama LIKE '%$keyword%' OR nisn LIKE '%$keyword%'")->fetchColumn();
$pages = ceil($total / $limit);

$stmt = $db->prepare("SELECT * FROM pendaftaran WHERE nama LIKE ? OR nisn LIKE ? ORDER BY id DESC LIMIT ? OFFSET ?");
$stmt->execute(["%$keyword%", "%$keyword%", $limit, $offset]);
$pendaftar = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Query untuk menghitung jumlah pendaftar berdasarkan jurusan1
$jurusanCounts = $db->query("
    SELECT jurusan1, COUNT(*) as total 
    FROM pendaftaran 
    GROUP BY jurusan1
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pendaftaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Data Pendaftaran</h2>
            <div>
                <a href="tambah.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Tambah</a>
                <a href="logout.php" class="ml-2 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</a>
            </div>
        </div>

        <form method="get" class="mb-4">
            <input type="text" name="search" placeholder="Cari nama atau NISN..." value="<?= htmlspecialchars($keyword) ?>" class="px-4 py-2 rounded border w-1/2">
            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Cari</button>
            Jumlah : 
                <?php foreach ($jurusanCounts as $jurusan): ?>
                    <?= htmlspecialchars($jurusan['jurusan1']) ?>
                    <?= htmlspecialchars($jurusan['total']) ?> | 
                <?php endforeach; ?>
        </form>

        <div class="overflow-x-auto bg-white shadow rounded">
            <table class="min-w-full table-auto text-sm text-left">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Timestamp</th>
                        <th class="px-4 py-2">NISN</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">JK</th>
                        <th class="px-4 py-2">Kontak 1</th>
                        <th class="px-4 py-2">Kontak 2</th>
                        <th class="px-4 py-2">Asal Sekolah</th>
                        <th class="px-4 py-2">Jurusan 1</th>
                        <th class="px-4 py-2">Jurusan 2</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pendaftar)): ?>
                        <tr><td colspan="7" class="px-4 py-2 text-center">Tidak ada data</td></tr>
                    <?php endif; ?>
                    <?php foreach ($pendaftar as $i => $row): ?>
                    <tr class="border-t">
                        <td class="px-4 py-2"><?= ($offset + $i + 1) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['Timestamp']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['nisn']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['nama']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['jk']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['kontak1']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['kontak2']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['asal_sekolah']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['jurusan1']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['jurusan2']) ?></td>
                        <td class="px-4 py-2 space-x-2">
                            <a href="edit.php?id=<?= $row['id'] ?>" class="text-blue-500 hover:underline">Edit</a>
                            <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin?')" class="text-red-500 hover:underline">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4 flex justify-center space-x-2">
            <?php for ($i = 1; $i <= $pages; $i++): ?>
                <a href="?search=<?= urlencode($keyword) ?>&page=<?= $i ?>"
                   class="px-3 py-1 border rounded <?= $i == $page ? 'bg-blue-500 text-white' : 'bg-white text-gray-700' ?>">
                   <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>
    </div>
</body>
</html>
