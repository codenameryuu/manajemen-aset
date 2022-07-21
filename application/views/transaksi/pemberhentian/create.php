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
                    <div class="d-flex justify-content-start mb-3">
                        <a href="<?php echo site_url('transaksi/pemberhentian'); ?>">
                            <button class="btn btn-secondary">
                                <i class="icon fa fa-arrow-left"></i>
                                Kembali
                            </button>
                        </a>
                    </div>

                    <div class="tile-body">

                        <?php $this->load->view('partials/alert') ?>

                        <form method="POST" action="<?php echo site_url('transaksi/pemberhentian/store'); ?>" onsubmit="return validate()" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="control-label" for="tanggal">
                                    Tanggal Pemberhentian
                                </label>

                                <input type="text" class="form-control datepicker" name="tanggal" id="tanggal" placeholder="Masukan Tanggal Pemberhentian" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="kodeAset">
                                    Nama Aset
                                </label>

                                <select class="form-control select2" name="kodeAset" id="kodeAset">
                                    <option value="">
                                        Pilih salah satu
                                    </option>

                                    <?php foreach ($aset as $row) { ?>
                                        <option value="<?php echo $row['kode']; ?>">
                                            <?php echo $row['nama'] . ' (' . $row['kode'] . ')'; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="keterangan">
                                    Keterangan
                                </label>

                                <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Masukan keterangan" cols="30" rows="10"></textarea>
                            </div>

                            <!-- CSRF Token -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                Tambah
                            </button>
                        </form>
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
            let tanggal = $('#tanggal').val();
            let kode_aset = $('#kode_aset').val();
            let keterangan = $('#keterangan').val();

            if (tanggal == '') {
                Swal.fire({
                    icon: 'error',
                    text: 'Pilih tanggal perbaikan terlebih dahulu !',
                })

                return false;
            }

            if (kode_aset == '') {
                Swal.fire({
                    icon: 'error',
                    text: 'Pilih nama aset terlebih dahulu !',
                })

                return false;
            }

            if (keterangan == '') {
                Swal.fire({
                    icon: 'error',
                    text: 'Keterangan tidak boleh kosong !',
                })

                return false;
            }

            return true;
        }
    </script>

</body>

</html>