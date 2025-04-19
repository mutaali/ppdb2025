<?php
try {
    $db = new PDO('sqlite:../ppdb2025.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Koneksi gagal: ' . $e->getMessage();
        exit;
    }