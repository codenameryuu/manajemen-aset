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
                    <div class="d-flex justify-content-end mb-3">
                        <a href="<?php echo site_url('transaksi/perolehan/create'); ?>">
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
                                    <th>Kode Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody class="text-center">
                                <?php
                                $no = 1;
                                foreach ($perolehan as $row) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $no; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['kode_transaksi']; ?>
                                        </td>

                                        <td>
                                            <?php echo date('d F Y', strtotime($row['tanggal'])) ?>
                                        </td>

                                        <td>
                                            <?php echo $row['nama']; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['jenis']; ?>
                                        </td>

                                        <td>
                                            <?php echo number_format($row['jumlah'], 0, ',', '.'); ?>
                                        </td>

                                        <td class="text-right">
                                            Rp. <?php echo number_format($row['harga'], 0, ',', '.'); ?>
                                        </td>

                                        <td>
                                            <a href="<?php echo site_url('transaksi/perolehan/show/' . $row['id']); ?>">
                                                <button class="btn btn-info">
                                                    <i class="icon fa fa-search"></i>
                                                </button>
                                            </a>

                                            <form class="d-inline" id="formHapus<?php echo $row['id'] ?>" method="POST" action="<?php echo site_url('transaksi/perolehan/destroy'); ?>">

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