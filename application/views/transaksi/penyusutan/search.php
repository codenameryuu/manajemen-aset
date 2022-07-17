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
                    <div class="d-flex justify-content-start mb-3">
                        <a href="<?php echo site_url('transaksi/penyusutan'); ?>">
                            <button class="btn btn-secondary">
                                <i class="icon fa fa-arrow-left"></i>
                                Kembali
                            </button>
                        </a>
                    </div>

                    <?php if (!empty($aset)) { ?>
                        <div class="d-flex justify-content-end mb-3">
                            <form id="formSusutkan" method="POST" action="<?php echo site_url('transaksi/penyusutan/susutkan'); ?>">

                                <input type="hidden" name="periode" id="periode" value="<?php echo $periode; ?>">

                                <!-- CSRF Token -->
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                <button type="button" class="btn btn-primary" onclick="konfirmasiSusutkan()">
                                    <i class="icon fa fa-plus"></i>
                                    Susutkan
                                </button>
                            </form>
                        </div>
                    <?php } ?>

                    <div class="tile-body">
                        <table class="datatable table table-hover table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Aset</th>
                                    <th>Nama Aset</th>
                                    <th>Terakhir Penyusutan</th>
                                    <th>Sisa Umur (Tahun)</th>
                                    <th>Harga Perolehan</th>
                                    <th>Dapat Disusutkan</th>
                                </tr>
                            </thead>

                            <tbody class="text-center">
                                <?php
                                $no = 1;
                                $total = 0;
                                foreach ($aset as $row) { ?>
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
                                            <?php
                                            if ($row['terakhir_penyusutan'] != null) {
                                                echo date('d F Y', strtotime($row['terakhir_penyusutan']));
                                            } else {
                                                echo 'Belum Pernah';
                                            }
                                            ?>
                                        </td>

                                        <td>
                                            <?php echo number_format($row['sisa_umur'], 0, ',', '.'); ?>
                                        </td>

                                        <td class="text-right">
                                            Rp. <?php echo number_format($row['nilai_buku'], 0, ',', '.'); ?>
                                        </td>

                                        <td>
                                            <?php echo number_format($row['lakukan_penyusutan'], 0, ',', '.'); ?> x
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                } ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="6" align="right">
                                        <h6>
                                            Total
                                        </h6>
                                    </td>

                                    <td>
                                        <h6 class="text-right">
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

    <script>
        function konfirmasiSusutkan(id) {
            Swal.fire({
                icon: 'question',
                text: 'Apakah ingin menyusutkan data ini ?',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#formSusutkan').submit();
                }
            })
        }
    </script>

</body>

</html>