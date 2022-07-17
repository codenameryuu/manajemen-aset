<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('partials/head') ?>

    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
</head>

<body class="app sidebar-mini rtl">

    <?php $this->load->view('partials/header') ?>

    <?php $this->load->view('partials/sidebar') ?>

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1>
                    <i class="fa fa-th-list"></i>
                    Laporan Akhir Aset
                </h1>
            </div>

            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item">
                    <i class="fa fa-home fa-lg"></i>
                </li>

                <li class="breadcrumb-item">
                    Laporan
                </li>

                <li class="breadcrumb-item">
                    Laporan Akhir Aset
                </li>
            </ul>
        </div>

        <div class="row">

            <?php $this->load->view('partials/alert') ?>

            <div class="col-md-12">
                <div class="tile">
                    <div class="my-3 box-border">
                        <form method="GET" action="<?php echo site_url('laporan/laporan-akhir-aset'); ?>" onsubmit="return validate()">
                            <div class="row">
                                <div class="col-md-2">
                                    <h3 class="text-center">
                                        Periode
                                    </h3>
                                </div>

                                <div class="col-md-8">
                                    <input type="text" class="form-control datepicker" name="periode" id="periode" value="<?php echo $periode ?>" placeholder="Masukan Periode" autocomplete="off">
                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100">
                                        Cari
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <h2 class="text-center">
                            Perolehan Aset
                        </h2>

                        <table class="datatable table table-hover table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Kode Transaksi</th>
                                    <th>Kode Aset</th>
                                    <th>Nama</th>
                                    <th>Umur</th>
                                    <th>Status</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>

                            <tbody class="text-center">
                                <?php
                                $no = 1;
                                $total = 0;
                                foreach ($perolehan as $row) {
                                    $total = $total + $row['harga'];
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $no; ?>
                                        </td>

                                        <td>
                                            <?php echo date('d F Y', strtotime($row['tanggal'])); ?>
                                        </td>

                                        <td>
                                            <?php echo $row['kode_transaksi']; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['kode']; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['nama']; ?>
                                        </td>

                                        <td>
                                            <?php echo number_format($row['umur'], 0, ',', '.'); ?>
                                        </td>

                                        <td>
                                            <?php echo $row['status']; ?>
                                        </td>

                                        <td>
                                            Rp .<?php echo number_format($row['harga'], 0, ',', '.'); ?>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                } ?>
                            </tbody>

                            <tfoot class="text-right">
                                <tr>
                                    <td colspan="6">
                                        <h6>
                                            Total
                                        </h6>
                                    </td>

                                    <td colspan="2">
                                        <h6>
                                            Rp .<?php echo number_format($total, 0, ',', '.'); ?>
                                        </h6>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <h2 class="text-center">
                            Perbaikan Aset
                        </h2>

                        <table class="datatable table table-hover table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Kode Transaksi</th>
                                    <th>Kode Aset</th>
                                    <th>Nama Aset</th>
                                    <th>Perbaikan</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>

                            <tbody class="text-center">
                                <?php
                                $no = 1;
                                $total = 0;
                                foreach ($perbaikan as $row) {
                                    $total = $total + $row['nilai'];
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $no; ?>
                                        </td>

                                        <td>
                                            <?php echo date('d F Y', strtotime($row['tanggal'])); ?>
                                        </td>

                                        <td>
                                            <?php echo $row['kode_transaksi']; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['kode_aset']; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['nama_aset']; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['nama']; ?>
                                        </td>

                                        <td class="text-right">
                                            Rp. <?php echo number_format($row['nilai'], 0, ',', '.'); ?>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                } ?>
                            </tbody>

                            <tfoot class="text-right">
                                <tr>
                                    <td colspan="5">
                                        <h6>
                                            Total
                                        </h6>
                                    </td>

                                    <td colspan="2">
                                        <h6>
                                            Rp .<?php echo number_format($total, 0, ',', '.'); ?>
                                        </h6>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <h2 class="text-center">
                            Pemberhentian Aset
                        </h2>

                        <table class="datatable table table-hover table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Kode Transaksi</th>
                                    <th>Kode Aset</th>
                                    <th>Nama Aset</th>
                                    <th>Keterangan</th>
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
                                            <?php echo date('d F Y', strtotime($row['tanggal'])); ?>
                                        </td>

                                        <td>
                                            <?php echo $row['kode_transaksi']; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['kode_aset']; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['nama_aset']; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['keterangan']; ?>
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

            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <h2 class="text-center">
                            Penyusutan Aset
                        </h2>

                        <table class="datatable table table-hover table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Kode Transaksi</th>
                                    <th>Kode Aset</th>
                                    <th>Nama Aset</th>
                                    <th>Umur Penyusutan</th>
                                    <th>Nilai Penyusutan</th>
                                </tr>
                            </thead>

                            <tbody class="text-center">
                                <?php
                                $no = 1;
                                $total = 0;
                                foreach ($penyusutan as $row) {
                                    $nilaiPenyusutan = $row['nilai_penyusutan'];
                                    $total = $total + $nilaiPenyusutan;
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $no; ?>
                                        </td>

                                        <td>
                                            <?php echo date('d F Y', strtotime($row['tanggal'])); ?>
                                        </td>

                                        <td>
                                            <?php echo $row['kode_transaksi']; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['kode_aset']; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['nama_aset']; ?>
                                        </td>

                                        <td>
                                            <?php echo number_format($row['umur_penyusutan'], 0, ',', '.'); ?>
                                        </td>

                                        <td class="text-right">
                                            Rp. <?php echo number_format($row['nilai_penyusutan'], 0, ',', '.'); ?>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                } ?>
                            </tbody>

                            <tfoot class="text-right">
                                <tr>
                                    <td colspan="5">
                                        <h6>
                                            Total
                                        </h6>
                                    </td>

                                    <td colspan="2">
                                        <h6>
                                            Rp. <?php echo number_format($total, 0, ',', '.'); ?>
                                        </h6>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <?php $this->load->view('partials/js') ?>

    <!-- FLatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        $(document).ready(function() {
            $(function() {
                $(".datepicker").flatpickr({
                    altInput: true,
                    altFormat: "j F Y",
                    dateFormat: "Y-m-d"
                });
            });
        });
    </script>

    <script>
        function validate() {
            let = periode = $('#periode').val();

            if (periode == '') {
                Swal.fire({
                    icon: 'error',
                    text: 'Pilih peridoe terlebih dahulu !',
                })

                return false;
            }

            return true;
        }
    </script>

</body>

</html>