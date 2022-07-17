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
                    Jurnal
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
                    Jurnal
                </li>
            </ul>
        </div>

        <div class="row">

            <?php $this->load->view('partials/alert') ?>

            <div class="col-md-12">
                <div class="tile">
                    <div class="my-3 box-border">
                        <form method="GET" action="<?php echo site_url('laporan/jurnal'); ?>" onsubmit="return validate()">
                            <div class="row">
                                <div class="col-md-2">
                                    <h3 class="text-center">
                                        Periode
                                    </h3>
                                </div>

                                <div class="col-md-4">
                                    <input type="text" class="form-control datepicker" name="tanggalAwal" id="tanggalAwal" value="<?php echo $tanggalAwal; ?>" placeholder="Masukan Tanggal Awal" autocomplete="off">
                                </div>

                                <div class="col-md-4">
                                    <input type="text" class="form-control datepicker" name="tanggalAkhir" id="tanggalAkhir" value="<?php echo $tanggalAkhir; ?>" placeholder="Masukan Tanggal Akhir" autocomplete="off">
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
                        <table class="datatable table table-hover table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Nama Akun</th>
                                    <th>Kode Akun</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                </tr>
                            </thead>

                            <tbody class="text-center">
                                <?php
                                $no = 1;
                                foreach ($jurnal as $row) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $no; ?>
                                        </td>

                                        <td class="text-left">
                                            <?php echo $row['transaksi'] ?>
                                        </td>

                                        <td>
                                            <?php echo date('d F Y', strtotime($row['tanggal'])); ?>
                                        </td>

                                        <td>
                                            <div class="d-flex justify-content-start">
                                                <?php echo $row['nama_akun_debit']; ?>
                                            </div>

                                            <div class="d-flex justify-content-end pt-2">
                                                <?php echo $row['nama_akun_kredit']; ?>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex justify-content-start">
                                                <?php echo $row['kode_akun_debit']; ?>
                                            </div>

                                            <div class="d-flex justify-content-end pt-2">
                                                <?php echo $row['kode_akun_kredit']; ?>
                                            </div>
                                        </td>

                                        <td class="text-right">
                                            <?php
                                            echo 'Rp. ' . number_format($row['nominal'], 0, ',', '.');
                                            ?>
                                        </td>

                                        <td class="text-right">
                                            <?php
                                            echo 'Rp. ' . number_format($row['nominal'], 0, ',', '.');
                                            ?>
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
            let tanggalAwal = $('#tanggalAwal').val();
            let tanggalAkhir = $('#tanggalAkhir').val();

            if (!tanggalAwal) {
                $('#tanggalAwal').attr('name', '');
            }

            if (!tanggalAkhir) {
                $('#tanggalAkhir').attr('name', '');
            }

            return true;
        }
    </script>

</body>

</html>