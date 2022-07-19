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
                    Data Kategori
                </h1>
            </div>

            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item">
                    <i class="fa fa-home fa-lg"></i>
                </li>

                <li class="breadcrumb-item">
                    Master Data
                </li>

                <li class="breadcrumb-item">
                    Data Kategori
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="d-flex justify-content-start mb-3">
                        <a href="<?php echo site_url('master-data/kategori'); ?>">
                            <button class="btn btn-secondary">
                                <i class="icon fa fa-arrow-left"></i>
                                Kembali
                            </button>
                        </a>
                    </div>

                    <div class="tile-body">

                        <?php $this->load->view('partials/alert') ?>

                        <form method="POST" action="<?php echo site_url('master-data/kategori/store'); ?>" onsubmit="return validate()" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="control-label" for="kode">
                                    Kode Kategori
                                </label>

                                <div class="rounded" id="divKode">
                                    <input type="text" class="form-control" name="kode" id="kode" onkeyup="cekKode()" placeholder="Masukan Kode Kategori" autocomplete="off">
                                </div>

                                <div>
                                    <span class="text-danger" id="notifKode"></span>
                                    <input type="hidden" name="statusKode" id="statusKode" value="Valid">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="nama">
                                    Nama Kategori
                                </label>

                                <div class="rounded" id="divNama">
                                    <input type="text" class="form-control" name="nama" id="nama" onkeyup="cekNama()" placeholder="Masukan Nama Kategori" autocomplete="off">
                                </div>

                                <div>
                                    <span class="text-danger" id="notifNama"></span>
                                    <input type="hidden" name="statusNama" id="statusNama" value="Valid">
                                </div>
                            </div>

                            <!-- Revisi Umur Ekonomis -->
                            <div class="form-group">
                                <label class="control-label" for="umurEkonomis">
                                    Umur Ekonomis
                                </label>

                                <input type="text" class="form-control" name="umurEkonomis" id="umurEkonomis" onkeypress="return /[0-9]/i.test(event.key)" placeholder="Masukan Umur Ekonomis" autocomplete="off">
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

    <script>
        function cekKode(statusBlock) {
            let kode = $('#kode').val();

            if (statusBlock == 'block') {
                let message = `<span class="text-dark"> Loading...</span>`;

                $("#divKode").block({
                    message: message,
                    css: {
                        padding: '5px',
                        borderRadius: '10px'
                    }
                });
            }

            $.ajax({
                url: "<?php echo site_url('master-data/kategori/cek-kode') ?>",
                method: "GET",
                dataType: "JSON",
                data: {
                    kode: kode,
                },
                success: function(data) {
                    let status = data.status;
                    let message = data.message;

                    if (statusBlock == 'block') {
                        $("#divKode").unblock();
                    }

                    if (status) {
                        $('#statusKode').val('Valid');
                        $('#notifKode').html('');
                    } else {
                        $('#statusKode').val('Invalid');
                        $('#notifKode').html('<small> ' + message + ' </small>');
                    }
                }
            });
        }

        function cekNama(statusBlock) {
            let nama = $('#nama').val();

            if (statusBlock == 'block') {
                let message = `<span class="text-dark"> Loading...</span>`;

                $("#divNama").block({
                    message: message,
                    css: {
                        padding: '5px',
                        borderRadius: '10px'
                    }
                });
            }

            $.ajax({
                url: "<?php echo site_url('master-data/kategori/cek-nama') ?>",
                method: "GET",
                dataType: "JSON",
                data: {
                    nama: nama,
                },
                success: function(data) {
                    let status = data.status;
                    let message = data.message;

                    if (statusBlock == 'block') {
                        $("#divNama").unblock();
                    }

                    if (status) {
                        $('#statusNama').val('Valid');
                        $('#notifNama').html('');
                    } else {
                        $('#statusNama').val('Invalid');
                        $('#notifNama').html('<small> ' + message + ' </small>');
                    }
                }
            });
        }

        function validate() {
            let kode = $('#kode').val();
            let nama = $('#nama').val();
            let umurEkonomis = $('#umurEkonomis').val();

            if (kode == '') {
                Swal.fire({
                    icon: 'error',
                    text: 'Kode kategori tidak boleh kosong !',
                })

                return false;
            }

            if (nama == '') {
                Swal.fire({
                    icon: 'error',
                    text: 'Nama kategori tidak boleh kosong !',
                })

                return false;
            }

            if (umurEkonomis == '') {
                Swal.fire({
                    icon: 'error',
                    text: 'Umur ekonomis tidak boleh kosong !',
                })

                return false;
            }

            return true;
        }
    </script>

</body>

</html>