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
                    Transaksi Penyusutan
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
                    Penyusutan
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="my-3 box-border">
                        <form method="GET" action="<?php echo site_url('transaksi/penyusutan/cari'); ?>" onsubmit="return validate()">
                            <div class="row">
                                <div class="col-md-2">
                                    <h3 class="text-center">
                                        Periode
                                    </h3>
                                </div>

                                <div class="col-md-8">
                                    <input type="text" class="form-control datepicker" name="periode" id="periode" placeholder="Masukan Periode" autocomplete="off">
                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100">
                                        Cari
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tile-body">

                        <?php $this->load->view('partials/alert') ?>

                        <table class="datatable table table-hover table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                </tr>
                            </thead>

                            <tbody class="text-center">
                                <?php
                                $no = 1;
                                foreach ($penyusutan as $row) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $no; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['kode_transaksi']; ?>
                                        </td>

                                        <td>
                                            <?php echo date('d F Y', strtotime($row['tanggal'])); ?>
                                        </td>

                                        <td>
                                            <?php echo number_format($row['total'], 0, ',', '.'); ?>
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