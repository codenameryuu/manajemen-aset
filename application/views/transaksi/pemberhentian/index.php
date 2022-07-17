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
                    Transaksi Pemberhentian
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
                    Pemberhentian
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="d-flex justify-content-end mb-3">
                        <a href="<?php echo site_url('transaksi/pemberhentian/create'); ?>">
                            <button class="btn btn-primary">
                                <i class="icon fa fa-plus"></i>
                                Tambah Data
                            </button>
                        </a>
                    </div>

                    <div class="tile-body">

                        <?php $this->load->view('partials/alert') ?>

                        <table class="datatable table table-hover table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Pemberhentian</th>
                                    <th>Kode Aset</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody class="text-center">
                                <?php
                                $no = 1;
                                foreach ($pemberhentian as $row) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $no; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['kode_transaksi']; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['kode_aset']; ?>
                                        </td>

                                        <td>
                                            <?php echo date('d F Y', strtotime($row['tanggal'])); ?>
                                        </td>

                                        <td>
                                            <a href="<?php echo site_url('transaksi/pemberhentian/show/' . $row['id']); ?>">
                                                <button class="btn btn-info">
                                                    <i class="icon fa fa-search"></i>
                                                </button>
                                            </a>
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