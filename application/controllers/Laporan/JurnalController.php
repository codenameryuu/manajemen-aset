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

    // public function filterJurnal($tanggalAwal, $tanggalAkhir)
    // {
    //     $jurnal = $this->Jurnal->getDataFilterByTanggal($tanggalAwal, $tanggalAkhir);

    //     $result = [];
    //     $index = 0;

    //     foreach ($jurnal as $row) {
    //         $result[$index] = $row;
    //         $debit = 0;
    //         $kredit = 0;

    //         if ($row['posisi'] == 'Debit') {
    //             $debit = $row['nominal'];
    //         } else {
    //             $kredit = $row['nominal'];
    //         }

    //         $result[$index]['debit'] = $debit;
    //         $result[$index]['kredit'] = $kredit;

    //         $akun = $this->Akun->getDataByKodeAkun($row['kode_akun']);
    //         $akun = $akun[0];

    //         $result[$index]['nama_akun'] = $akun['nama'];
    //         $index++;
    //     }

    //     return $result;
    // }

    public function filterJurnal($tanggalAwal, $tanggalAkhir)
    {
        $perolehan = $this->Perolehan->getDataFilterByTanggal($tanggalAwal, $tanggalAkhir);
        $penyusutan = $this->Penyusutan->getDataFilterByTanggal($tanggalAwal, $tanggalAkhir);
        $perbaikan = $this->Perbaikan->getDataFilterByTanggal($tanggalAwal, $tanggalAkhir);
        $pemberhentian = $this->Pemberhentian->getDataFilterByTanggal($tanggalAwal, $tanggalAkhir);

        $result = [];
        $index = 0;

        foreach ($perolehan as $row) {
            $aset = $this->Aset->getDataByKodeTransaksi($row['kode_transaksi']);
            $namaAset = $aset[0]['nama'];

            $jurnal = $this->Jurnal->getDataByKodeTransaksi($row['kode_transaksi']);
            $kodeAkunDebit = '';
            $kodeAkunKredit = '';

            foreach ($jurnal as $row2) {
                $posisi = $row2['posisi'];

                if ($posisi == 'Debit') {
                    $kodeAkunDebit = $row2['kode_akun'];
                } else if ($posisi == 'Kredit') {
                    $kodeAkunKredit = $row2['kode_akun'];
                }
            }

            $akun = $this->Akun->getDataByKodeAkun($kodeAkunDebit);
            $namaAkunDebit = $akun[0]['nama'];

            $akun = $this->Akun->getDataByKodeAkun($kodeAkunKredit);
            $namaAkunKredit = $akun[0]['nama'];

            if ($kodeAkunDebit == '114') {
                $jenis = 'Pembelian';
            } else {
                $jenis = 'Hibah';
            }

            $nominal = $row['jumlah'] * $row['harga'];

            $result[$index] = [
                'transaksi' => 'Perolehan Aset ' . $namaAset . ' Melalui ' . $jenis,
                'tanggal' => $row['tanggal'],
                'kode_akun_debit' => $kodeAkunDebit,
                'kode_akun_kredit' => $kodeAkunKredit,
                'nama_akun_debit' => $namaAkunDebit,
                'nama_akun_kredit' => $namaAkunKredit,
                'nominal' => $nominal,
            ];

            $index++;
        }

        foreach ($penyusutan as $row) {
            $detailPenyustan = $this->DetailPenyusutan->getDataByKodeTransaksi($row['kode_transaksi']);

            foreach ($detailPenyustan as $row2) {
                $aset = $this->Aset->getDataByKode($row2['kode_aset']);
                $namaAset = $aset[0]['nama'];

                $jurnal = $this->Jurnal->getDataByKodeTransaksi($row2['kode_transaksi']);
                $kodeAkunDebit = '';
                $kodeAkunKredit = '';

                foreach ($jurnal as $row3) {
                    $posisi = $row3['posisi'];

                    if ($posisi == 'Debit') {
                        $kodeAkunDebit = $row3['kode_akun'];
                    } else if ($posisi == 'Kredit') {
                        $kodeAkunKredit = $row3['kode_akun'];
                    }
                }

                $akun = $this->Akun->getDataByKodeAkun($kodeAkunDebit);
                $namaAkunDebit = $akun[0]['nama'];

                $akun = $this->Akun->getDataByKodeAkun($kodeAkunKredit);
                $namaAkunKredit = $akun[0]['nama'];

                $nominal = $row2['nilai_penyusutan'];

                $result[$index] = [
                    'transaksi' => 'Penyusutan Aset ' . $namaAset,
                    'tanggal' => $row['tanggal'],
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
            $aset = $this->Aset->getDataByKode($row['kode_aset']);
            $namaAset = $aset[0]['nama'];

            $jurnal = $this->Jurnal->getDataByKodeTransaksi($row['kode_transaksi']);
            $kodeAkunDebit = '';
            $kodeAkunKredit = '';

            foreach ($jurnal as $row2) {
                $posisi = $row2['posisi'];

                if ($posisi == 'Debit') {
                    $kodeAkunDebit = $row2['kode_akun'];
                } else if ($posisi == 'Kredit') {
                    $kodeAkunKredit = $row2['kode_akun'];
                }
            }

            $akun = $this->Akun->getDataByKodeAkun($kodeAkunDebit);
            $namaAkunDebit = $akun[0]['nama'];

            $akun = $this->Akun->getDataByKodeAkun($kodeAkunKredit);
            $namaAkunKredit = $akun[0]['nama'];

            $nominal = $row['nilai'];

            $result[$index] = [
                'transaksi' => 'Perbaikan Aset ' . $namaAset,
                'tanggal' => $row['tanggal'],
                'kode_akun_debit' => $kodeAkunDebit,
                'kode_akun_kredit' => $kodeAkunKredit,
                'nama_akun_debit' => $namaAkunDebit,
                'nama_akun_kredit' => $namaAkunKredit,
                'nominal' => $nominal,
            ];

            $index++;
        }

        foreach ($pemberhentian as $row) {
            $aset = $this->Aset->getDataByKode($row['kode_aset']);
            $namaAset = $aset[0]['nama'];

            $jurnal = $this->Jurnal->getDataByKodeTransaksi($row['kode_transaksi']);
            $kodeAkunDebit = '';
            $kodeAkunKredit = '';

            foreach ($jurnal as $row2) {
                $posisi = $row2['posisi'];

                if ($posisi == 'Debit') {
                    $kodeAkunDebit = $row2['kode_akun'];
                } else if ($posisi == 'Kredit') {
                    $kodeAkunKredit = $row2['kode_akun'];
                }
            }

            $akun = $this->Akun->getDataByKodeAkun($kodeAkunDebit);
            $namaAkunDebit = $akun[0]['nama'];

            $akun = $this->Akun->getDataByKodeAkun($kodeAkunKredit);
            $namaAkunKredit = $akun[0]['nama'];

            $nominal = $aset[0]['harga'];

            $result[$index] = [
                'transaksi' => 'Pemberhentian Aset ' . $namaAset,
                'tanggal' => $row['tanggal'],
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
