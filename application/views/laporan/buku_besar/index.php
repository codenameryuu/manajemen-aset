<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('partials/head') ?>

    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
</head>

<style>
    .datepicker {
        background-color: white !important;
    }
</style>

<body class="app sidebar-mini rtl">

    <?php $this->load->view('partials/header') ?>

    <?php $this->load->view('partials/sidebar') ?>

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1>
                    <i class="fa fa-th-list"></i>
                    Buku Besar
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
                    Buku Besar
                </li>
            </ul>
        </div>

        <div class="row">

            <?php $this->load->view('partials/alert') ?>

            <div class="col-md-12">
                <div class="tile">
                    <div class="my-3 box-border">
                        <form method="POST" action="<?php echo site_url('laporan/buku-besar/update-saldo-awal'); ?>" onsubmit="return validateSaldoAwal()">
                            <div class="row">
                                <input type="hidden" name="id" id="id" value="<?php echo $saldoAwal['id'] ?>">

                                <div class="col-md-2">
                                    <h3 class="text-center">
                                        Saldo Awal
                                    </h3>
                                </div>

                                <div class="col-md-4">
                                    <input type="text" class="form-control datepicker" name="tanggal" id="tanggal" value="<?php echo $saldoAwal['tanggal']; ?>" placeholder="Masukan Tanggal" autocomplete="off">
                                </div>

                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="nominal" id="nominal" value="<?php echo number_format($saldoAwal['nominal'], 0, ',', '.'); ?>" onkeypress="return /[0-9]/i.test(event.key)" placeholder="Masukan Nominal" autocomplete="off">
                                </div>

                                <!-- CSRF Token -->
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100">
                                        Ubah
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="tile">
                    <div class="my-3 box-border">
                        <form method="GET" action="<?php echo site_url('laporan/buku-besar'); ?>" onsubmit="return validate()">
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

            <?php foreach ($bukuBesar as $row) {
                if ($row['kode'] == '111') {
                    $total = $saldoAwal['nominal'];
                } else {
                    $total = 0;
                }
            ?>
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            <div class="row mt-3 mb-3">
                                <div class="col-md-6">
                                    <h4 class="text-center">
                                        <?php echo 'Kode Akun : ' . $row['kode'] ?>
                                    </h4>
                                </div>

                                <div class="col-md-6">
                                    <h4 class="text-center">
                                        <?php echo 'Nama Akun : ' . $row['nama'] ?>
                                    </h4>
                                </div>
                            </div>

                            <table class="datatable table table-hover table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Kode Transaksi</th>
                                        <th>Debit</th>
                                        <th>Kredit</th>
                                        <th>Saldo</th>
                                    </tr>
                                </thead>

                                <tbody class="text-center">
                                    <?php
                                    $no = 1;
                                    if ($row['kode'] == '111') { ?>
                                        <tr>
                                            <td>
                                                <?php echo $no ?>
                                            </td>

                                            <td>
                                                <?php echo date('d F Y', strtotime($saldoAwal['tanggal'])); ?>
                                            </td>

                                            <td>
                                                Saldo Awal
                                            </td>

                                            <td></td>
                                            <td></td>
                                            <td></td>

                                            <td class="text-right">
                                                Rp. <?php echo number_format($saldoAwal['nominal'], 0, ',', '.'); ?>
                                            </td>
                                        </tr>
                                    <?php
                                        $no++;
                                    } ?>


                                    <?php
                                    foreach ($row['jurnal'] as $jurnal) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $no ?>
                                            </td>

                                            <td>
                                                <?php echo date('d F Y', strtotime($jurnal['tanggal'])); ?>
                                            </td>

                                            <td>
                                                <?php echo $jurnal['keterangan']; ?>
                                            </td>

                                            <td>
                                                <?php echo $jurnal['kode_transaksi']; ?>
                                            </td>

                                            <td class="text-right">
                                                <?php
                                                if ($jurnal['posisi'] == 'Debit') {
                                                    $total = $total + $jurnal['nominal'];
                                                    echo 'Rp. ' . number_format($jurnal['nominal'], 0, ',', '.');
                                                } else {
                                                    echo 'Rp. 0';
                                                }
                                                ?>
                                            </td>

                                            <td class="text-right">
                                                <?php
                                                if ($jurnal['posisi'] == 'Kredit') {
                                                    $total = $total - $jurnal['nominal'];
                                                    echo 'Rp. ' . number_format($jurnal['nominal'], 0, ',', '.');
                                                } else {
                                                    echo 'Rp. 0';
                                                }
                                                ?>
                                            </td>

                                            <td class="text-right">
                                                Rp. <?php echo number_format($total, 0, ',', '.'); ?>
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
            <?php } ?>

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

                var nominal = $('#nominal');

                $(nominal).keyup(function() {
                    angka = nominal.val();
                    nominal.val(formatAngka(this.value));
                });
            });
        });
    </script>

    <script>
        function formatAngka(angka) {
            angka = String(angka);
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                angka = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                angka += separator + ribuan.join('.');
            }

            angka = split[1] != undefined ? angka + ',' + split[1] : angka;
            return angka
        }


        function validateSaldoAwal() {
            let tanggal = $('#tanggal').val();
            let nominal = $('#nominal').val();

            if (tanggal == '') {
                Swal.fire({
                    icon: 'error',
                    text: 'Pilih tanggal terlebih dahulu !',
                })

                return false;
            }

            if (nominal == '') {
                Swal.fire({
                    icon: 'error',
                    text: 'Nominal saldo awal tidak boleh kosong !',
                })

                return false;
            }

            return true;
        }


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