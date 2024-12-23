function hitungZakatTemuan() {
    const nilaiBarangTemuan = parseFloat(document.getElementById('nilaiBarangTemuan').value || 0);
    const zakatTemuan = nilaiBarangTemuan * 0.2; // 20% dari nilai barang temuan

    document.getElementById('zakatTemuan').value = Math.round(zakatTemuan); // Tampilkan hasil
}
