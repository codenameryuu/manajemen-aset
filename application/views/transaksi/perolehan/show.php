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
                    Transaksi Perolehan
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
                    Perolehan
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="d-flex justify-content-start mb-3">
                        <a href="<?php echo site_url('transaksi/perolehan'); ?>">
                            <button class="btn btn-secondary">
                                <i class="icon fa fa-arrow-left"></i>
                                Kembali
                            </button>
                        </a>
                    </div>

                    <div class="my-3 box-border">
                        <div class="row">
                            <div class="col-md-2">
                                <h6>
                                    Nomor Nota
                                </h6>
                            </div>

                            <div class="col-md-1">
                                <h6>:</h6>
                            </div>

                            <div class="col-md-9">
                                <h6>
                                    <?php echo $perolehan['nota']; ?>
                                </h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <h6>
                                    Kode Perolehan
                                </h6>
                            </div>

                            <div class="col-md-1">
                                <h6>:</h6>
                            </div>

                            <div class="col-md-9">
                                <h6>
                                    <?php echo $perolehan['kode_transaksi']; ?>
                                </h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <h6>
                                    Tanggal Perolehan
                                </h6>
                            </div>

                            <div class="col-md-1">
                                <h6>:</h6>
                            </div>

                            <div class="col-md-9">
                                <h6>
                                    <?php echo date('d F Y', strtotime($perolehan['tanggal'])); ?>
                                </h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <h6>
                                    Jenis Perolehan
                                </h6>
                            </div>

                            <div class="col-md-1">
                                <h6>:</h6>
                            </div>

                            <div class="col-md-9">
                                <h6>
                                    <?php echo $perolehan['jenis']; ?>
                                </h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <h6>
                                    Jumlah Aset
                                </h6>
                            </div>

                            <div class="col-md-1">
                                <h6>:</h6>
                            </div>

                            <div class="col-md-9">
                                <h6>
                                    <?php echo $perolehan['jumlah']; ?>
                                </h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <h6>
                                    Total Harga
                                </h6>
                            </div>

                            <div class="col-md-1">
                                <h6>:</h6>
                            </div>

                            <div class="col-md-9">
                                <h6>
                                    Rp. <?php echo number_format($perolehan['harga'], 0, ',', '.'); ?>
                                </h6>
                            </div>
                        </div>
                    </div>

                    <div class="tile-body">
                        <table class="datatable table table-hover table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Umur</th>
                                </tr>
                            </thead>

                            <tbody class="text-center">
                                <?php
                                $no = 1;
                                foreach ($aset as $row) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $no; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['kode_transaksi']; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['nama']; ?>
                                        </td>

                                        <td class="text-right">
                                            Rp. <?php echo number_format($row['harga'], 0, ',', '.'); ?>
                                        </td>

                                        <td>
                                            <?php echo number_format($row['umur'], 0, ',', '.'); ?>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php $this->load->view('partials/js') ?>

</body>

</html>