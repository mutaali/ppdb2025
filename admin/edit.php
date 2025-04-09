<?php include 'auth.php'; ?>
<?php
$db = new PDO('sqlite:../ppdb2025.db');
$id = $_GET['id'];
$data = $db->query("SELECT * FROM pendaftaran WHERE id = $id")->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $db->prepare("UPDATE pendaftaran SET nisn=?, nama=?, jk=?, kontak1=?, kontak2=?, asal_sekolah=?, jurusan1=?, jurusan2=?, alamat=? WHERE id=?");
    $stmt->execute([
        $_POST['nisn'], $_POST['nama'], $_POST['jk'], $_POST['kontak1'], $_POST['kontak2'],
        $_POST['asal_sekolah'], $_POST['jurusan1'], $_POST['jurusan2'], $_POST['alamat'], $id
    ]);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pendaftaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Edit Data Pendaftaran</h2>
        <form method="post" class="space-y-4">
            <?php
            foreach ([
                'nisn' => 'NISN',
                'nama' => 'Nama',
                'jk' => 'Jenis Kelamin',
                'kontak1' => 'Kontak 1',
                'kontak2' => 'Kontak 2',
                'asal_sekolah' => 'Asal Sekolah',
                'jurusan1' => 'Jurusan 1',
                'jurusan2' => 'Jurusan 2',
                'alamat' => 'Alamat',
            ] as $name => $label):
            ?>
                <div>
                    <label class="block font-semibold"><?= $label ?></label>
                    <?php if ($name === 'jk'): ?>
                        <select name="jk" class="w-full border rounded px-3 py-2">
                            <option value="L" <?= $data['jk'] === 'L' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= $data['jk'] === 'P' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    <?php elseif ($name === 'alamat'): ?>
                        <textarea name="alamat" class="w-full border rounded px-3 py-2"><?= htmlspecialchars($data['alamat']) ?></textarea>
                    <?php elseif ($name === 'jurusan1'): ?>
                        <select name="jurusan1" class="w-full border rounded px-3 py-2" required>
                            <option value="">-</option>
                            <option value="TJKT" <?= $data['jurusan1'] === 'TJKT' ? 'selected' : '' ?>>TJKT</option>
                            <option value="TO" <?= $data['jurusan1'] === 'TO' ? 'selected' : '' ?>>TO (TKR/TSM)</option>
                            <option value="TEKFAR" <?= $data['jurusan1'] === 'TEKFAR' ? 'selected' : '' ?>>FARMASI</option>
                            <option value="TELKA" <?= $data['jurusan1'] === 'TELKA' ? 'selected' : '' ?>>TELKA (Elektronika)</option>
                            <option value="PPLG" <?= $data['jurusan1'] === 'PPLG' ? 'selected' : '' ?>>PPLG (Pemrograman Komputer)</option>
                            <option value="MPLB" <?= $data['jurusan1'] === 'MPLB' ? 'selected' : '' ?>>MPLB</option>
                        </select>
                    <?php elseif ($name === 'jurusan2'): ?>
                        <select name="jurusan2" class="w-full border rounded px-3 py-2" required>
                            <option value="">-</option>
                            <option value="TJKT" <?= $data['jurusan2'] === 'TJKT' ? 'selected' : '' ?>>TJKT</option>
                            <option value="TO" <?= $data['jurusan2'] === 'TO' ? 'selected' : '' ?>>TO (TKR/TSM)</option>
                            <option value="TEKFAR" <?= $data['jurusan2'] === 'TEKFAR' ? 'selected' : '' ?>>FARMASI</option>
                            <option value="TELKA" <?= $data['jurusan2'] === 'TELKA' ? 'selected' : '' ?>>TELKA (Elektronika)</option>
                            <option value="PPLG" <?= $data['jurusan2'] === 'PPLG' ? 'selected' : '' ?>>PPLG (Pemrograman Komputer)</option>
                            <option value="MPLB" <?= $data['jurusan2'] === 'MPLB' ? 'selected' : '' ?>>MPLB</option>
                        </select>
                    <?php elseif ($name === 'asal_sekolah'): ?>
                        <input name="asal_sekolah" class="w-full border rounded px-3 py-2" list="asal-sekolah-list" value="<?= htmlspecialchars($data['asal_sekolah']) ?>" required>
                            <datalist id="asal-sekolah-list">
                                <option value="MTS DAARUSSALAM">
                                <option value="MTS SA AL-MUSRYFAH">
                                <option value="MTS SA AL-MUSYRIFAH">
                                <option value="MTSN 1 KOTA PALEMBANG">
                                <option value="MTSN 1 TASIKMALAYA">
                                <option value="MTSN 12 TASIKMALAYA">
                                <option value="MTSN 3 KOTA TASIKMALAYA">
                                <option value="MTSN 3 TASIKMALAYA">
                                <option value="MTSN 4 TASIKMALAYA">
                                <option value="MTSN 5 TASIKMALAYA">
                                <option value="MTSN 6 TASIKMALAYA">
                                <option value="MTSN 9 TASIKMALAYA">
                                <option value="MTSS AL ASAS">
                                <option value="MTSS AL FALAH SIMPANG">
                                <option value="MTSS AL HAMIDIYAH CIPANCUR">
                                <option value="MTSS AL HIDAYAH SATRON">
                                <option value="MTSS AL MUNIROH">
                                <option value="MTSS AL-AMANAH">
                                <option value="MTSS AL-BAROKAH">
                                <option value="MTSS AL-IKHLAS">
                                <option value="MTSS AL-IRFAN">
                                <option value="MTSS AL-ISHLAH">
                                <option value="MTSS AL-MUJTAHIDIIN 01">
                                <option value="MTSS BAHRUL ULUM">
                                <option value="MTSS CIPAINGEUN">
                                <option value="MTSS DAARUSSALAAM">
                                <option value="MTSS DARUL FALAH CIBUNGUR">
                                <option value="MTSS DARUL HUDA">
                                <option value="MTSS INSAN CENDIKIA AL UM">
                                <option value="MTSS KARYA BAKTI">
                                <option value="MTSS KH.A.WAHAB MUHSIN SUKAHIDENG">
                                <option value="MTSS MANARUL HUDA">
                                <option value="MTSS MATHLA UL FALAH">
                                <option value="MTSS MATHLAUL KHAER">
                                <option value="MTSS MIFTAHUL HUDA">
                                <option value="MTSS MIFTAHUL ULUM">
                                <option value="MTSS NURHIDAYAH">
                                <option value="MTSS NURUL ANWAR">
                                <option value="MTSS NURUL FALAH">
                                <option value="MTSS NURUL HUDA">
                                <option value="MTSS SA AL-MUSRYFAH">
                                <option value="MTSS SAMBONGJAYA">
                                <option value="MTSS SINDANG RAJA">
                                <option value="MTSS THOLABUL HIDAYAH">
                                <option value="MTSS TONJONGSARI">
                                <option value="MTSS YPI CIKONENG">
                                <option value="PPS. AL-IKHLAS">
                                <option value="SMP BINA INSAN">
                                <option value="SMP ISLAM AL-FADLILLAH">
                                <option value="SMP ISLAM AL-IKHLAS">
                                <option value="SMP ISLAM BINA INSAN MANDIRI BANTARKALONG">
                                <option value="SMP ISLAM TERPADU AL MUNAWAR">
                                <option value="SMP ISLAM TERPADU DAARUSSALAAM">
                                <option value="SMP ISLAM TRIJAYA">
                                <option value="SMP IT MADINATUL ALBAAB">
                                <option value="SMP NEGERI 1 DUKUPUNTANG">
                                <option value="SMP NEGERI 1 KUTAWARINGIN">
                                <option value="SMP NEGERI 2 CIAWIGEBANG">
                                <option value="SMP NEGERI 3 HULU SUNGKAI">
                                <option value="SMP NEGERI 3 ULU BELU">
                                <option value="SMP NEGERI 5 BANYUWANGI">
                                <option value="SMP NEGERI 8 TASIKMALAYA">
                                <option value="SMP PASUNDAN">
                                <option value="SMP PGRI 175 MARGAASIH">
                                <option value="SMP PLUS AL AFSAR">
                                <option value="SMP PLUS AL-HIKMAH">
                                <option value="SMP PLUS BANI ADAM HAWWA">
                                <option value="SMP PLUS MIFTAHUL HUDA VI GANDASOLI">
                                <option value="SMP PLUS NASHRUL HAQ">
                                <option value="SMP PUI CICURUG">
                                <option value="SMP TERPADU AL AMIN">
                                <option value="SMP Y 17 CIBALONG">
                                <option value="SMP YPI IJTIMAUL AHADIYAH">
                                <option value="SMP YPM 4 BOHAR TAMAN">
                                <option value="SMPN 1 BANTARKALONG">
                                <option value="SMPN 1 BOJONGASIH">
                                <option value="SMPN 1 CIBALONG">
                                <option value="SMPN 1 CIKATOMAS">
                                <option value="SMPN 1 CIPATUJAH">
                                <option value="SMPN 1 CULAMEGA">
                                <option value="SMPN 1 KARANGNUNGGAL">
                                <option value="SMPN 1 PARUNGPONTENG">
                                <option value="SMPN 1 SODONGHILIR">
                                <option value="SMPN 2 BANJARAN">
                                <option value="SMPN 2 BANTARKALONG">
                                <option value="SMPN 2 CIBALONG">
                                <option value="SMPN 2 CIPATUJAH">
                                <option value="SMPN 2 KARANGNUNGGAL">
                                <option value="SMPN 2 SODONGHILIR">
                                <option value="SMPN 3 CIBALONG">
                                <option value="SMPN 3 CIKALONG">
                                <option value="SMPN 3 CIPATUJAH">
                                <option value="SMPN 3 KARANGNUNGGAL">
                                <option value="SMPN 3 SODONGHILIR">
                                <option value="SMPN 4 CIPATUJAH">
                                <option value="SMPN 4 KARANGNUNGGAL">
                                <option value="SMPN 4 SODONGHILIR">
                                <option value="SMPN 5 CIKALONG">
                                <option value="SMPN 5 CIPATUJAH">
                                <option value="SMPN SATU ATAP 1 BANTARKALONG">
                                <option value="SMPN SATU ATAP 1 BOJONGASIH">
                                <option value="SMPN SATU ATAP 1 BOJONGGAMBIR">
                                <option value="SMPN SATU ATAP 1 CIPATUJAH">
                                <option value="SMPN SATU ATAP 1 CULAMEGA">
                                <option value="SMPN SATU ATAP 1 KARANGNUNGGAL">
                                <option value="SMPN SATU ATAP 1 PANCATENGAH">
                                <option value="SMPN SATU ATAP 1 SODONGHILIR">
                                <option value="SMPN SATU ATAP 2 BANTARKALONG">
                                <option value="SMPN SATU ATAP 2 BOJONGGAMBIR">
                                <option value="SMPN SATU ATAP 2 CIPATUJAH">
                                <option value="SMPN SATU ATAP 2 KARANGNUNGGAL">
                                <option value="SMPN SATU ATAP 4 CIPATUJAH">
                                <option value="SMPN SATU ATAP 5 CIPATUJAH">
                            </datalist>
                        <?php else: ?>
                        <input type="text" name="<?= $name ?>" value="<?= htmlspecialchars($data[$name]) ?>" class="w-full border rounded px-3 py-2" required>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <div class="flex justify-between mt-4">
                <a href="index.php" class="text-gray-600 hover:underline">← Kembali</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
            </div>
        </form>
    </div>
</body>
</html>
