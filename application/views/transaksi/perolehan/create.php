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
                    <div class="d-flex justify-content-start mb-3">
                        <a href="<?php echo site_url('transaksi/perolehan'); ?>">
                            <button class="btn btn-secondary">
                                <i class="icon fa fa-arrow-left"></i>
                                Kembali
                            </button>
                        </a>
                    </div>

                    <div class="tile-body">

                        <?php $this->load->view('partials/alert') ?>

                        <form method="POST" action="<?php echo site_url('transaksi/perolehan/store'); ?>" onsubmit="return validate()" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="control-label" for="jenis">
                                    Jenis Perolehan
                                </label>

                                <select class="form-control select2" name="jenis" id="jenis">
                                    <option value="">
                                        Pilih salah satu
                                    </option>

                                    <option value="Pembelian">
                                        Pembelian
                                    </option>

                                    <option value="Hibah">
                                        Hibah
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="tanggal">
                                    Tanggal Perolehan
                                </label>

                                <input type="text" class="form-control datepicker" name="tanggal" id="tanggal" placeholder="Masukan Tanggal Perolehan" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="nota">
                                    No Nota / Dokumen
                                </label>

                                <input type="text" class="form-control" name="nota" id="nota" placeholder="Masukan No Nota / Dokumen" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="nama">
                                    Nama Aset
                                </label>

                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukan Nama Aset" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="kategori">
                                    Kategori Aset
                                </label>

                                <select class="form-control select2" name="kategori" id="kategori" onchange="cekKategori()">
                                    <option value="">
                                        Pilih salah satu
                                    </option>

                                    <?php foreach ($kategori as $row) { ?>
                                        <option value="<?php echo $row['kode']; ?>">
                                            <?php echo $row['nama']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="umur">
                                    Umur (Tahun)
                                </label>

                                <input type="text" class="form-control" name="umur" id="umur" placeholder="Masukan Umur (Tahun)" onkeypress="return /[0-9]/i.test(event.key)" autocomplete="off" readonly>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="harga">
                                    Harga Satuan
                                </label>

                                <input type="text" class="form-control" name="harga" id="harga" placeholder="Masukan Harga" onkeypress="return /[0-9]/i.test(event.key)" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="jumlah">
                                    Jumlah
                                </label>

                                <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Masukan Jumlah" onkeypress="return /[0-9]/i.test(event.key)" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="nilaiSisa">
                                    Nilai Sisa
                                </label>

                                <input type="text" class="form-control" name="nilaiSisa" id="nilaiSisa" placeholder="Masukan Nilai Sisa" onkeypress="return /[0-9]/i.test(event.key)" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="total">
                                    Total Harga Perolehan
                                </label>

                                <input type="text" class="form-control" name="total" id="total" value="0" placeholder="Masukan Total Harga Perolehan" autocomplete="off" readonly>
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

            var harga = $('#harga');
            var nilaiSisa = $('#nilaiSisa');
            var jumlah = $('#jumlah');

            $(harga).keyup(function() {
                angka = harga.val();
                harga.val(formatAngka(this.value));
                getTotal();
            });

            $(nilaiSisa).keyup(function() {
                angka = nilaiSisa.val();
                nilaiSisa.val(formatAngka(this.value));
            });

            $(jumlah).keyup(function() {
                angka = jumlah.val();
                jumlah.val(formatAngka(this.value));
                getTotal();
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

        function cekKategori() {
            let kategori = $('#kategori').val();

            $.ajax({
                url: "<?php echo site_url('master-data/kategori/cek-umur-ekonomis') ?>",
                method: "GET",
                dataType: "JSON",
                data: {
                    kode: kategori,
                },
                success: function(data) {
                    let kategori = data.kategori;
                    let umur = kategori.umur_ekonomis;

                    $('#umur').val(umur);
                }
            });
        }

        function getTotal() {
            let harga = $('#harga').val();
            let jumlah = $('#jumlah').val();

            if (harga == '') {
                harga = 0;
            } else {
                harga = harga.replaceAll('.', '');
                harga = Number(harga);
            }

            if (jumlah == '') {
                jumlah = 0;
            } else {
                jumlah = jumlah.replaceAll('.', '');
                jumlah = Number(jumlah);
            }

            let total = harga * jumlah;
            total = formatAngka(total);

            $("#total").val(total);
        }

        function validate() {
            let jenis = $('#jenis').val();
            let tanggal = $('#tanggal').val();
            let nota = $('#nota').val();
            let nama = $('#nama').val();
            let kategori = $('#kategori').val();
            let umur = $('#umur').val();
            let harga = $('#harga').val();
            let jumlah = $('#jumlah').val();
            let nilaiSisa = $('#nilaiSisa').val();
            let total = $('#total').val();

            if (jenis == '') {
                Swal.fire({
                    icon: 'error',
                    text: 'Pilih jenis perolehan terlebih dahulu !',
                })

                return false;
            }

            if (tanggal == '') {
                Swal.fire({
                    icon: 'error',
                    text: 'Pilih tanggal perolehan terlebih dahulu !',
                })

                return false;
            }

            if (nama == '') {
                Swal.fire({
                    icon: 'error',
                    text: 'Nama aset tidak boleh kosong !',
                })

                return false;
            }

            if (kategori == '') {
                Swal.fire({
                    icon: 'error',
                    text: 'Pilih kategori aset terlebih dahulu !',
                })

                return false;
            }

            if (umur == '') {
                Swal.fire({
                    icon: 'error',
                    text: 'Umur tidak boleh kosong !',
                })

                return false;
            }

            if ((harga == '') || (harga == '0')) {
                Swal.fire({
                    icon: 'error',
                    text: 'Harga satuan tidak boleh kosong !',
                })

                return false;
            }

            if ((jumlah == '') || (jumlah == '0')) {
                Swal.fire({
                    icon: 'error',
                    text: 'Jumlah tidak boleh kosong !',
                })

                return false;
            }

            if (nilaiSisa == '') {
                Swal.fire({
                    icon: 'error',
                    text: 'Nilai sisa tidak boleh kosong !',
                })

                return false;
            }

            if ((total == '') || (total == '0')) {
                Swal.fire({
                    icon: 'error',
                    text: 'Total harga tidak boleh kosong !',
                })

                return false;
            }

            return true;
        }
    </script>

</body>

</html>