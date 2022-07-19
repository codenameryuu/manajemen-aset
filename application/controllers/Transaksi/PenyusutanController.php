<?php
class PenyusutanController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $user = $this->session->userdata('user');

        if ($user == null) {
            redirect(base_url());
        }

        $this->load->model('Aset');
        $this->load->model('DetailPenyusutan');
        $this->load->model('Jurnal');
        $this->load->model('Penyusutan');
        $this->load->model('Transaksi');
    }

    function index()
    {
        $penyusutan = $this->Penyusutan->getData();

        $this->load->view('transaksi/penyusutan/index', [
            'title' => 'Balai Besar Tekstil Bandung',
            'keywords' => '',
            'description' => '',
            'penyusutan' => $penyusutan,
        ]);
    }

    public function cariAsetDapatDisusutkan($periode)
    {
        $result = [];
        $index = 0;

        // Revisi penyusutan
        $cariTanggal = date('Y-m-d', strtotime('-1 month', strtotime($periode)));
        $aset = $this->Aset->getDataDapatDisusutkan($cariTanggal);

        foreach ($aset as $row) {
            $kodeAset = $row['kode'];

            $detailPenyusutan = $this->DetailPenyusutan->getDataByKodeAset($kodeAset);
            $jumlahPenyusutan = count($detailPenyusutan);

            $beda = abs(strtotime($periode) - strtotime($row['tanggal']));
            // Revisi penyusutan
            $beda = floor($beda / (30 * 60 * 60 * 24));

            if ($beda > $jumlahPenyusutan) {
                $lakukanPenyusutan = $beda - $jumlahPenyusutan;

                if ($lakukanPenyusutan > $row['sisa_umur'] * 12) {
                    $lakukanPenyusutan = $row['sisa_umur'] * 12;
                }

                $result[$index] = $row;
                $result[$index]['lakukan_penyusutan'] = $lakukanPenyusutan;
                $result[$index]['terakhir_penyusutan'] = null;

                if ($jumlahPenyusutan > 0) {
                    $terakhirPenyusutan = $detailPenyusutan[0]['tanggal'];
                    $result[$index]['terakhir_penyusutan'] = $terakhirPenyusutan;
                }

                $index++;
            }
        }

        return $result;
    }

    public function search()
    {
        $periode = $this->input->get('periode');
        $aset = $this->cariAsetDapatDisusutkan($periode);

        $this->load->view('transaksi/penyusutan/search', [
            'title' => 'Balai Besar Tekstil Bandung',
            'keywords' => '',
            'description' => '',
            'aset' => $aset,
            'periode' => $periode,
        ]);
    }

    public function susutkan()
    {
        $periode = $this->input->post('periode');
        $asetDapatDisusutkan = $this->cariAsetDapatDisusutkan($periode);

        $totalPenyusutan = 0;
        $tanggal = date('Y-m-d');

        $data = [
            'kode_transaksi' => '',
            'tanggal' => $tanggal,
            'total' => $totalPenyusutan,
        ];

        $lastId = $this->Penyusutan->storeData($data);

        $kodeTransaksi = $lastId;

        if ($kodeTransaksi < 10) {
            $kodeTransaksi = 'PY' . '00000' . $kodeTransaksi;
        } else if ($kodeTransaksi < 100) {
            $kodeTransaksi = 'PY' . '0000' . $kodeTransaksi;
        } else if ($kodeTransaksi < 1000) {
            $kodeTransaksi = 'PY' . '000' . $kodeTransaksi;
        } else if ($kodeTransaksi < 10000) {
            $kodeTransaksi = 'PY' . '00' . $kodeTransaksi;
        } else  if ($kodeTransaksi < 100000) {
            $kodeTransaksi = 'PY' . '0' . $kodeTransaksi;
        }

        $data = [
            'kode_transaksi' => $kodeTransaksi,
        ];

        $this->Penyusutan->updateData($data, $lastId);

        $data = [
            'kode_transaksi' => $kodeTransaksi,
            'tanggal' => $tanggal,
            'nama' => 'Penyusutan',
        ];

        $this->Transaksi->storeData($data);

        foreach ($asetDapatDisusutkan as $row) {
            $id = $row['id'];
            $lakukanPenyusutan = $row['lakukan_penyusutan'];

            for ($i = 0; $i < $lakukanPenyusutan; $i++) {
                $aset = $this->Aset->getDataById($id);
                $aset = $aset[0];

                // Metode penyusutan menggunakan garis lurus
                $nilaiPenyusutan = ($aset['harga'] - $aset['nilai_sisa']) / $aset['umur'];
                // Contoh : 90.000 / 5 = 18.000

                $nilaiBuku = $aset['nilai_buku'] - $nilaiPenyusutan;
                $sisaUmur = $aset['sisa_umur'] - 1;

                $data = [
                    'nilai_buku' => $nilaiBuku,
                    'sisa_umur' => $sisaUmur,
                    'metode_penyusutan' => 'Garis Lurus',
                ];

                $this->Aset->updateData($data, $aset['id']);

                $data = [
                    'kode_transaksi' => $kodeTransaksi,
                    'kode_aset' => $aset['kode'],
                    'tanggal' => $tanggal,
                    'umur_penyusutan' => $sisaUmur,
                    'nilai_penyusutan' => $nilaiPenyusutan,
                ];

                $this->DetailPenyusutan->storeData($data);

                $kodeAkun = '521';

                $data = [
                    'kode_akun' => $kodeAkun,
                    'kode_transaksi' => $kodeTransaksi,
                    'tanggal' => $tanggal,
                    'posisi' => 'Debit',
                    'nominal' => $nilaiPenyusutan,
                ];

                $this->Jurnal->storeData($data);

                $kodeAkun = '121';

                $data = [
                    'kode_akun' => $kodeAkun,
                    'kode_transaksi' => $kodeTransaksi,
                    'tanggal' => $tanggal,
                    'posisi' => 'Kredit',
                    'nominal' => $nilaiPenyusutan,
                ];

                $this->Jurnal->storeData($data);

                $totalPenyusutan = $totalPenyusutan + $nilaiPenyusutan;
            }
        }

        $data = [
            'total' => $totalPenyusutan,
        ];

        $this->Penyusutan->updateData($data, $lastId);

        $this->session->set_flashdata('success', 'Berhasil menambahkan data !');
        redirect('transaksi/penyusutan');
    }
}
