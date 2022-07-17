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
                    Transaksi Perbaikan
                </h1>
            </div>

            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item">
                    <i class="fa fa-home fa-lg"></i>
                </li>

                <li class="breadcrumb-item">
                    Transaksi
                </li>

                <li class="breadcrumb-item">
                    Perbaikan
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="d-flex justify-content-start mb-3">
                        <a href="<?php echo site_url('transaksi/perbaikan'); ?>">
                            <button class="btn btn-secondary">
                                <i class="icon fa fa-arrow-left"></i>
                                Kembali
                            </button>
                        </a>
                    </div>

                    <div class="tile-body">

                        <?php $this->load->view('partials/alert') ?>

                        <div class="form-group">
                            <label class="control-label" for="tanggal">
                                Tanggal Perbaikan
                            </label>

                            <input type="text" class="form-control" name="tanggal" id="tanggal" value="<?php echo date('d F Y', strtotime($perbaikan['tanggal'])); ?>" placeholder="Masukan Tanggal Perbaikan" autocomplete="off" readonly>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="kodeAset">
                                Kode Aset
                            </label>

                            <input type="text" class="form-control" name="kodeAset" id="kodeAset" value="<?php echo $perbaikan['kode_aset']; ?>" placeholder="Masukan Kode Aset" autocomplete="off" readonly>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="namaAset">
                                Nama Aset
                            </label>

                            <input type="text" class="form-control" name="namaAset" id="namaAset" value="<?php echo $aset['nama']; ?>" placeholder="Masukan Nama Aset" autocomplete="off" readonly>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="nama">
                                Nama Perbaikan
                            </label>

                            <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $perbaikan['nama']; ?>" placeholder="Masukan Nama Perbaikan" autocomplete="off" readonly>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="nilai">
                                Nilai Perbaikan
                            </label>

                            <input type="text" class="form-control" name="nilai" id="nilai" value="Rp. <?php echo number_format($perbaikan['nilai'], 0, ',', '.'); ?>" placeholder="Masukan Nilai Perbaikan" autocomplete="off" readonly>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="keterangan">
                                Keterangan
                            </label>

                            <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Masukan keterangan" cols="30" rows="10" readonly><?php echo $perbaikan['keterangan'] ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php $this->load->view('partials/js') ?>

</body>

</html>