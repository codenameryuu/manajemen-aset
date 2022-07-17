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
                    Data Akun
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
                    Data Akun
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="d-flex justify-content-start mb-3">
                        <a href="<?php echo site_url('master-data/akun'); ?>">
                            <button class="btn btn-secondary">
                                <i class="icon fa fa-arrow-left"></i>
                                Kembali
                            </button>
                        </a>
                    </div>

                    <div class="tile-body">

                        <?php $this->load->view('partials/alert') ?>

                        <form method="POST" action="<?php echo site_url('master-data/akun/update'); ?>" onsubmit="return validate()" enctype="multipart/form-data">

                            <input type="hidden" name="id" id="id" value="<?php echo $akun['id'] ?>">

                            <div class="form-group">
                                <label class="control-label" for="kode">
                                    Kode Akun
                                </label>

                                <div class="rounded" id="divKode">
                                    <input type="text" class="form-control" name="kode" id="kode" value="<?php echo $akun['kode'] ?>" onkeyup="cekKode()" placeholder="Masukan Kode Akun" autocomplete="off">
                                </div>

                                <div>
                                    <span class="text-danger" id="notifKode"></span>
                                    <input type="hidden" name="statusKode" id="statusKode" value="Valid">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="nama">
                                    Nama Akun
                                </label>

                                <div class="rounded" id="divNama">
                                    <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $akun['nama'] ?>" onkeyup="cekNama()" placeholder="Masukan Nama Akun" autocomplete="off">
                                </div>

                                <div>
                                    <span class="text-danger" id="notifNama"></span>
                                    <input type="hidden" name="statusNama" id="statusNama" value="Valid">
                                </div>
                            </div>

                            <!-- CSRF Token -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                            <button type="submit" class="btn btn-success w-100">
                                <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                Ubah
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
            let id = $('#id').val();
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
                url: "<?php echo site_url('master-data/akun/cek-kode') ?>",
                method: "GET",
                dataType: "JSON",
                data: {
                    id: id,
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
            let id = $('#id').val();
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
                url: "<?php echo site_url('master-data/akun/cek-nama') ?>",
                method: "GET",
                dataType: "JSON",
                data: {
                    id: id,
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

            if (kode == '') {
                Swal.fire({
                    icon: 'error',
                    text: 'Kode akun tidak boleh kosong !',
                })

                return false;
            }

            if (nama == '') {
                Swal.fire({
                    icon: 'error',
                    text: 'Nama akun tidak boleh kosong !',
                })

                return false;
            }

            // Cek Status Valid
            cekKode()
            cekNama()

            let statusKode = $('#statusKode').val();
            let statusNama = $('#statusNama').val();

            if (statusKode == 'Invalid') {
                Swal.fire({
                    icon: 'error',
                    text: 'Kode akun sudah terpakai !',
                })

                return false;
            }

            if (statusNama == 'Invalid') {
                Swal.fire({
                    icon: 'error',
                    text: 'Nama akun sudah terpakai !',
                })

                return false;
            }

            return true;
        }
    </script>

</body>

</html>