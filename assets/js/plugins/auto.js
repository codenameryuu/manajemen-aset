function pilih() {
	var kode_aset, nama, umur, kode;
	kode_aset 	=	document.getElementById('aset').value;
	nama 		=	$("#aset option:selected").data('nama');
	umur 		=	$("#aset option:selected").data('umur');
	kode 		= 	$("#aset option:selected").data('kode');
	jumlah 		= 	$("#aset option:selected").data('jumlah');
	document.getElementById('namavalue').value = nama;
	document.getElementById('umurvalue').value = umur;
	document.getElementById('kodevalue').value = kode;	
	document.getElementById('jumlahvalue').value = jumlah;
}