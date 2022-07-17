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
                    <div class="d-flex justify-content-end mb-3">
                        <a href="<?php echo site_url('master-data/akun/create'); ?>">
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
                                    <th>Kode Akun</th>
                                    <th>Nama Akun</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody class="text-center">
                                <?php
                                $no = 1;
                                foreach ($akun as $row) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $no; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['kode']; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['nama']; ?>
                                        </td>

                                        <td>
                                            <a href="<?php echo site_url('master-data/akun/edit/' . $row['id']); ?>">
                                                <button class="btn btn-success">
                                                    <i class="icon fa fa-edit"></i>
                                                </button>
                                            </a>

                                            <form class="d-inline" id="formHapus<?php echo $row['id'] ?>" method="POST" action="<?php echo site_url('master-data/akun/destroy'); ?>">

                                                <input type="hidden" name="id" id="id" value="<?php echo $row['id']; ?>">

                                                <!-- CSRF Token -->
                                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                                <button type="button" class="btn btn-danger" onclick="konfirmasiHapusData(<?php echo $row['id']; ?>)">
                                                    <i class="icon fa fa-edit"></i>
                                                </button>
                                            </form>
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

    <script>
        function konfirmasiHapusData(id) {
            Swal.fire({
                icon: 'question',
                text: 'Apakah ingin menghapus data ini ?',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#formHapus' + id).submit();
                }
            })
        }
    </script>

</body>

</html>