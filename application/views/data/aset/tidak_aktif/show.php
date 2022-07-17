<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('partials/head') ?>
</head>

<body class="app sidebar-mini rtl">

    <?php $this->load->view('partials/header') ?>

    <?php $this->load->view('partials/sidebar') ?>

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1>
                    <i class="fa fa-th-list"></i>
                    Data Aset Tidak Aktif
                </h1>
            </div>

            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item">
                    <i class="fa fa-home fa-lg"></i>
                </li>

                <li class="breadcrumb-item">
                    Data
                </li>

                <li class="breadcrumb-item">
                    Data Aset Tidak Aktif
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="d-flex justify-content-start mb-3">
                        <a href="<?php echo site_url('data/data-aset/tidak-aktif'); ?>">
                            <button class="btn btn-secondary">
                                <i class="icon fa fa-arrow-left"></i>
                                Kembali
                            </button>
                        </a>
                    </div>

                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="kode">
                                Kode Aset
                            </label>

                            <input type="text" class="form-control" name="kode" id="kode" value="<?php echo $aset['kode']; ?>" placeholder="Masukan Kode Aset" autocomplete="off" readonly>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="nama">
                                Nama Aset
                            </label>

                            <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $aset['nama']; ?>" placeholder="Masukan Nama Aset" autocomplete="off" readonly>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="tanggal">
                                Tanggal Perolehan
                            </label>

                            <input type="text" class="form-control" name="tanggal" id="tanggal" value="<?php echo date('d F Y', strtotime($aset['tanggal'])); ?>" placeholder="Masukan Tanggal Perolehan" autocomplete="off" readonly>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="tanggalAkhirManfaat">
                                Tanggal Akhir Umur Manfaat
                            </label>

                            <input type="text" class="form-control" name="tanggalAkhirManfaat" id="tanggalAkhirManfaat" value="<?php echo date('d F Y', strtotime($aset['tanggal_akhir_umur_manfaat'])); ?>" placeholder="Masukan Tanggal Akhir Umur Manfaat" autocomplete="off" readonly>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="harga">
                                Harga Perolehan
                            </label>

                            <input type="text" class="form-control" name="harga" id="harga" value="<?php echo number_format($aset['harga'], 0, ',', '.'); ?>" placeholder="Masukan Harga Perolehan" autocomplete="off" readonly>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="kodeTransaksi">
                                Kode Transaksi
                            </label>

                            <input type="text" class="form-control" name="kodeTransaksi" id="kodeTransaksi" value="<?php echo $aset['kode_transaksi']; ?>" placeholder="Masukan Kode Transaksi" autocomplete="off" readonly>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="kodeKategori">
                                Kode Kategori
                            </label>

                            <input type="text" class="form-control" name="kodeKategori" id="kodeKategori" value="<?php echo $aset['kode_kategori']; ?>" placeholder="Masukan Kode Kategori" autocomplete="off" readonly>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="namaKategori">
                                Nama Kategori
                            </label>

                            <input type="text" class="form-control" name="namaKategori" id="namaKategori" value="<?php echo $aset['nama_kategori']; ?>" placeholder="Masukan Nama Kategori" autocomplete="off" readonly>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="umur">
                                Umur
                            </label>

                            <input type="text" class="form-control" name="umur" id="umur" value="<?php echo number_format($aset['umur'], 0, ',', '.'); ?>" placeholder="Masukan Umur" autocomplete="off" readonly>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="sisaUmur">
                                Sisa Umur
                            </label>

                            <input type="text" class="form-control" name="sisaUmur" id="sisaUmur" value="<?php echo number_format($aset['sisa_umur'], 0, ',', '.'); ?>" placeholder="Masukan Sisa Umur" autocomplete="off" readonly>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="nilaiBuku">
                                Nilai Buku
                            </label>

                            <input type="text" class="form-control" name="nilaiBuku" id="nilaiBuku" value="<?php echo number_format($aset['nilai_buku'], 0, ',', '.'); ?>" placeholder="Masukan Nilai Buku" autocomplete="off" readonly>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="nilaiSisa">
                                Nilai Sisa
                            </label>

                            <input type="text" class="form-control" name="nilaiSisa" id="nilaiSisa" value="<?php echo number_format($aset['nilai_sisa'], 0, ',', '.'); ?>" placeholder="Masukan Nilai Sisa" autocomplete="off" readonly>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="penyusutan">
                                Jumlah Penyusutan
                            </label>

                            <input type="text" class="form-control" name="nilaiSisa" id="nilaiSisa" value="<?php echo number_format($aset['jumlah_penyusutan'], 0, ',', '.'); ?>" placeholder="Masukan Nilai Sisa" autocomplete="off" readonly>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="metodePenyusutan">
                                Metode Penyusutan
                            </label>

                            <input type="text" class="form-control" name="metodePenyusutan" id="metodePenyusutan" value="<?php echo $aset['metode_penyusutan']; ?>" placeholder="Masukan Metode Penyusutan" autocomplete="off" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php $this->load->view('partials/js') ?>

</body>

</html>