<?php
echo "PDO Drivers yang tersedia: ";
print_r(PDO::getAvailableDrivers());
echo "<br>Ekstensi SQLite: " . (extension_loaded('sqlite3') ? 'Terinstall' : 'Tidak terinstall');
echo "<br>Ekstensi PDO: " . (extension_loaded('pdo') ? 'Terinstall' : 'Tidak terinstall');
echo "<br>Ekstensi PDO SQLite: " . (extension_loaded('pdo_sqlite') ? 'Terinstall' : 'Tidak terinstall');
phpinfo();
?>