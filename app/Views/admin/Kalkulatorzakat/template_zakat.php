<?php
$type = $_GET['type'] ?? '';

if ($type === 'maal') {
    echo view('admin/kalkulatorzakat/maal');
} elseif ($type === 'pertanian') {
    echo view('admin/kalkulatorzakat/pertanian');
} else {
    echo '<p class="text-danger">Form zakat tidak ditemukan.</p>';
}
?>
