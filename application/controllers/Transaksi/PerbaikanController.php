<?php
class PerbaikanController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $user = $this->session->userdata('user');

        if ($user == null) {
            redirect(base_url());
        }

        $this->load->model('Aset');
        $this->load->model('Jurnal');
        $this->load->model('Perbaikan');
        $this->load->model('Transaksi');
    }

    function index()
    {
        $perbaikan = $this->Perbaikan->getData();

        $this->load->view('transaksi/perbaikan/index', [
            'title' => 'Balai Besar Tekstil Bandung',
            'keywords' => '',
            'description' => '',
            'perbaikan' => $perbaikan,
        ]);
    }

    public function create()
    {
        $aset = $this->Aset->getDataAsetAktif();

        $this->load->view('transaksi/perbaikan/create', [
            'title' => 'Balai Besar Tekstil Bandung',
            'keywords' => '',
            'description' => '',
            'aset' => $aset,
        ]);
    }

    public function store()
    {
        $tanggal = $this->input->post('tanggal');
        $kodeAset = $this->input->post('kodeAset');
        $nama = $this->input->post('nama');
        $nilai = $this->input->post('nilai');
        $keterangan = $this->input->post('keterangan');

        $nilai = str_replace('.', '', $nilai);

        $data = [
            'kode_transaksi' => '',
            'kode_aset' => $kodeAset,
            'tanggal' => $tanggal,
            'nama' => $nama,
            'nilai' => $nilai,
            'keterangan' => $keterangan,
        ];

        $lastId = $this->Perbaikan->storeData($data);

        $kodeTransaksi = $lastId;

        if ($kodeTransaksi < 10) {
            $kodeTransaksi = 'PB' . '00000' . $kodeTransaksi;
        } else if ($kodeTransaksi < 100) {
            $kodeTransaksi = 'PB' . '0000' . $kodeTransaksi;
        } else if ($kodeTransaksi < 1000) {
            $kodeTransaksi = 'PB' . '000' . $kodeTransaksi;
        } else if ($kodeTransaksi < 10000) {
            $kodeTransaksi = 'PB' . '00' . $kodeTransaksi;
        } else  if ($kodeTransaksi < 100000) {
            $kodeTransaksi = 'PB' . '0' . $kodeTransaksi;
        }

        $data = [
            'kode_transaksi' => $kodeTransaksi,
        ];

        $this->Perbaikan->updateData($data, $lastId);

        $data = [
            'kode_transaksi' => $kodeTransaksi,
            'nama' => 'Perbaikan',
            'tanggal' => $tanggal,
        ];

        $this->Transaksi->storeData($data);

        $kodeAkun = 511;

        $data = [
            'kode_akun' => $kodeAkun,
            'kode_transaksi' => $kodeTransaksi,
            'tanggal' => $tanggal,
            'posisi' => "Debit",
            'nominal' => $nilai
        ];

        $this->Jurnal->storeData($data);

        $kodeAkun = 111;

        $data = [
            'kode_akun' => $kodeAkun,
            'kode_transaksi' => $kodeTransaksi,
            'tanggal' => $tanggal,
            'posisi' => "Kredit",
            'nominal' => $nilai
        ];

        $this->Jurnal->storeData($data);

        $this->session->set_flashdata('success', 'Berhasil menambahkan data !');
        redirect('transaksi/perbaikan/create');
    }

    public function show($id)
    {
        $perbaikan = $this->Perbaikan->getDataById($id);
        $perbaikan = $perbaikan[0];
        $kodeAset = $perbaikan['kode_aset'];

        $aset = $this->Aset->getDataByKode($kodeAset);
        $aset = $aset[0];

        $this->load->view('transaksi/perbaikan/show', [
            'title' => 'Balai Besar Tekstil Bandung',
            'keywords' => '',
            'description' => '',
            'perbaikan' => $perbaikan,
            'aset' => $aset,
        ]);
    }

    public function destroy()
    {
        $id = $this->input->post('id');

        $perbaikan = $this->Perbaikan->getDataById($id);
        $perbaikan = $perbaikan[0];
        $kodeTransaksi = $perbaikan['kode_transaksi'];

        // Delete Transaksi
        $this->Transaksi->destroyDataByKodeTransaksi($kodeTransaksi);

        // Delete Jurnal
        $this->Jurnal->destroyDataByKodeTransaksi($kodeTransaksi);

        // Delete Perbaikan
        $this->Perbaikan->destroyData($id);

        $this->session->set_flashdata('success', 'Berhasil menghapus data !');
        redirect('transaksi/perbaikan');
    }
}
