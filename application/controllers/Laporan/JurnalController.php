<?php
class JurnalController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $user = $this->session->userdata('user');

        if ($user == null) {
            redirect(base_url());
        }

        $this->load->model('Akun');
        $this->load->model('Aset');
        $this->load->model('DetailPenyusutan');
        $this->load->model('Jurnal');
        $this->load->model('Perolehan');
        $this->load->model('Penyusutan');
        $this->load->model('Perbaikan');
        $this->load->model('Pemberhentian');
    }

    public function filterJurnal($tanggalAwal, $tanggalAkhir)
    {
        $perolehan = $this->Perolehan->getDataFilterByTanggal($tanggalAwal, $tanggalAkhir);
        $penyusutan = $this->Penyusutan->getDataFilterByTanggal($tanggalAwal, $tanggalAkhir);
        $perbaikan = $this->Perbaikan->getDataFilterByTanggal($tanggalAwal, $tanggalAkhir);
        $pemberhentian = $this->Pemberhentian->getDataFilterByTanggal($tanggalAwal, $tanggalAkhir);

        $result = [];
        $index = 0;

        // Transaksi Perolehan
        foreach ($perolehan as $row) {
            $harga = $row['harga'];
            $jumlah = $row['jumlah'];
            $tanggal = $row['tanggal'];
            $kodeTransaksi = $row['kode_transaksi'];
            // Contoh : PO000001

            // Ambil data aset
            $aset = $this->Aset->getDataByKodeTransaksi($kodeTransaksi);
            // Ambil nama aset
            $namaAset = $aset[0]['nama'];

            // Ambil data jurnal
            $jurnal = $this->Jurnal->getDataByKodeTransaksi($kodeTransaksi);
            $kodeAkunDebit = '';
            $kodeAkunKredit = '';

            foreach ($jurnal as $row2) {
                $kodeAkun = $row2['kode_akun'];
                $posisi = $row2['posisi'];

                if ($posisi == 'Debit') {
                    $kodeAkunDebit = $kodeAkun;
                } else if ($posisi == 'Kredit') {
                    $kodeAkunKredit = $kodeAkun;
                }
            }

            // Ambil nama akun debit
            $akun = $this->Akun->getDataByKodeAkun($kodeAkunDebit);
            $namaAkunDebit = $akun[0]['nama'];

            // Ambil nama akun kredit
            $akun = $this->Akun->getDataByKodeAkun($kodeAkunKredit);
            $namaAkunKredit = $akun[0]['nama'];

            // Cek jenis perolehan
            if ($kodeAkunDebit == '114') {
                $jenis = 'Pembelian';
            } else {
                $jenis = 'Hibah';
            }

            // Ambil nominal
            $nominal = $jumlah * $harga;

            $result[$index] = [
                'transaksi' => 'Perolehan Aset ' . $namaAset . ' Melalui ' . $jenis,
                'tanggal' => $tanggal,
                'kode_akun_debit' => $kodeAkunDebit,
                'kode_akun_kredit' => $kodeAkunKredit,
                'nama_akun_debit' => $namaAkunDebit,
                'nama_akun_kredit' => $namaAkunKredit,
                'nominal' => $nominal,
            ];

            $index++;
        }

        // Transaksi Penyusutan
        foreach ($penyusutan as $row) {
            $kodeTransaksi = $row['kode_transaksi'];
            $tanggal = $row['tanggal'];

            // Ambil data detail penyusutan
            $detailPenyusutan = $this->DetailPenyusutan->getDataByKodeTransaksi($kodeTransaksi);

            foreach ($detailPenyusutan as $row2) {
                $kodeTransaksi = $row2['kode_transaksi'];
                $nilaiPenyusutan = $row2['nilai_penyusutan'];
                $kodeAset = $row2['kode_aset'];

                // Ambil data aset
                $aset = $this->Aset->getDataByKode($kodeAset);
                // Ambil nama aset
                $namaAset = $aset[0]['nama'];

                // Ambil data jurnal
                $jurnal = $this->Jurnal->getDataByKodeTransaksi($kodeTransaksi);
                $kodeAkunDebit = '';
                $kodeAkunKredit = '';

                foreach ($jurnal as $row3) {
                    $kodeAkun = $row3['kode_akun'];
                    $posisi = $row3['posisi'];

                    if ($posisi == 'Debit') {
                        $kodeAkunDebit = $kodeAkun;
                    } else if ($posisi == 'Kredit') {
                        $kodeAkunKredit = $kodeAkun;
                    }
                }

                // Ambil data akun
                $akun = $this->Akun->getDataByKodeAkun($kodeAkunDebit);
                // Ambil nama akun debit
                $namaAkunDebit = $akun[0]['nama'];

                // Ambil data akun
                $akun = $this->Akun->getDataByKodeAkun($kodeAkunKredit);
                // Ambil nama akun kredit
                $namaAkunKredit = $akun[0]['nama'];

                // Ambil nominal
                $nominal = $nilaiPenyusutan;

                $result[$index] = [
                    'transaksi' => 'Penyusutan Aset ' . $namaAset,
                    'tanggal' => $tanggal,
                    'kode_akun_debit' => $kodeAkunDebit,
                    'kode_akun_kredit' => $kodeAkunKredit,
                    'nama_akun_debit' => $namaAkunDebit,
                    'nama_akun_kredit' => $namaAkunKredit,
                    'nominal' => $nominal,
                ];

                $index++;
            }
        }

        foreach ($perbaikan as $row) {
            $kodeTransaksi = $row['kode_transaksi'];
            $kodeAset = $row['kode_aset'];
            $tanggal = $row['tanggal'];
            $nilai = $row['nilai'];

            // Ambil data aset
            $aset = $this->Aset->getDataByKode($kodeAset);
            // Ambil nama aset
            $namaAset = $aset[0]['nama'];

            $jurnal = $this->Jurnal->getDataByKodeTransaksi($kodeTransaksi);
            $kodeAkunDebit = '';
            $kodeAkunKredit = '';

            foreach ($jurnal as $row2) {
                $kodeAkun = $row2['kode_akun'];
                $posisi = $row2['posisi'];

                if ($posisi == 'Debit') {
                    $kodeAkunDebit = $kodeAkun;
                } else if ($posisi == 'Kredit') {
                    $kodeAkunKredit = $kodeAkun;
                }
            }

            // Ambil data akun
            $akun = $this->Akun->getDataByKodeAkun($kodeAkunDebit);
            // Ambil nama akun debit
            $namaAkunDebit = $akun[0]['nama'];

            // Ambil data akun
            $akun = $this->Akun->getDataByKodeAkun($kodeAkunKredit);
            // Ambil nama akun kredit
            $namaAkunKredit = $akun[0]['nama'];

            // Ambil nominal
            $nominal = $nilai;

            $result[$index] = [
                'transaksi' => 'Perbaikan Aset ' . $namaAset,
                'tanggal' => $tanggal,
                'kode_akun_debit' => $kodeAkunDebit,
                'kode_akun_kredit' => $kodeAkunKredit,
                'nama_akun_debit' => $namaAkunDebit,
                'nama_akun_kredit' => $namaAkunKredit,
                'nominal' => $nominal,
            ];

            $index++;
        }

        foreach ($pemberhentian as $row) {
            $kodeTransaksi = $row['kode_transaksi'];
            $kodeAset = $row['kode_aset'];
            $tanggal = $row['tanggal'];

            // Ambil data aset
            $aset = $this->Aset->getDataByKode($kodeAset);
            // Ambil nama aset
            $namaAset = $aset[0]['nama'];

            // Ambil jurnal
            $jurnal = $this->Jurnal->getDataByKodeTransaksi($kodeTransaksi);
            $kodeAkunDebit = '';
            $kodeAkunKredit = '';

            foreach ($jurnal as $row2) {
                $kodeAkun = $row2['kode_akun'];
                $posisi = $row2['posisi'];

                if ($posisi == 'Debit') {
                    $kodeAkunDebit = $kodeAkun;
                } else if ($posisi == 'Kredit') {
                    $kodeAkunKredit = $kodeAkun;
                }
            }

            // Ambil data akun
            $akun = $this->Akun->getDataByKodeAkun($kodeAkunDebit);
            // Ambil nama akun debit
            $namaAkunDebit = $akun[0]['nama'];

            // Ambil data akun
            $akun = $this->Akun->getDataByKodeAkun($kodeAkunKredit);
            // Ambil nama akun kredit
            $namaAkunKredit = $akun[0]['nama'];

            // Ambil nama
            $nominal = $aset[0]['harga'];

            $result[$index] = [
                'transaksi' => 'Pemberhentian Aset ' . $namaAset,
                'tanggal' => $tanggal,
                'kode_akun_debit' => $kodeAkunDebit,
                'kode_akun_kredit' => $kodeAkunKredit,
                'nama_akun_debit' => $namaAkunDebit,
                'nama_akun_kredit' => $namaAkunKredit,
                'nominal' => $nominal,
            ];

            $index++;
        }

        return $result;
    }

    function index()
    {
        $tanggalAwal = $this->input->get('tanggalAwal');
        $tanggalAkhir = $this->input->get('tanggalAkhir');

        $jurnal = $this->filterJurnal($tanggalAwal, $tanggalAkhir);

        $this->load->view('laporan/jurnal/index', [
            'title' => 'Balai Besar Tekstil Bandung',
            'keywords' => '',
            'description' => '',
            'jurnal' => $jurnal,
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
        ]);
    }
}
