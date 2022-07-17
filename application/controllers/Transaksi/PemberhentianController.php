<?php
class PemberhentianController extends CI_Controller
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
        $this->load->model('Pemberhentian');
        $this->load->model('Transaksi');
    }

    function index()
    {
        $pemberhentian = $this->Pemberhentian->getData();

        $this->load->view('transaksi/pemberhentian/index', [
            'title' => 'Balai Besar Tekstil Bandung',
            'keywords' => '',
            'description' => '',
            'pemberhentian' => $pemberhentian,
        ]);
    }

    public function create()
    {
        $aset = $this->Aset->getDataAsetAktif();

        $this->load->view('transaksi/pemberhentian/create', [
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
        $keterangan = $this->input->post('keterangan');

        $data = [
            'kode_transaksi' => '',
            'kode_aset' => $kodeAset,
            'tanggal' => $tanggal,
            'keterangan' => $keterangan,
        ];

        $lastId = $this->Pemberhentian->storeData($data);

        $kodeTransaksi = $lastId;

        if ($kodeTransaksi < 10) {
            $kodeTransaksi = 'PM' . '00000' . $kodeTransaksi;
        } else if ($kodeTransaksi < 100) {
            $kodeTransaksi = 'PM' . '0000' . $kodeTransaksi;
        } else if ($kodeTransaksi < 1000) {
            $kodeTransaksi = 'PM' . '000' . $kodeTransaksi;
        } else if ($kodeTransaksi < 10000) {
            $kodeTransaksi = 'PM' . '00' . $kodeTransaksi;
        } else  if ($kodeTransaksi < 100000) {
            $kodeTransaksi = 'PM' . '0' . $kodeTransaksi;
        }

        $data = [
            'kode_transaksi' => $kodeTransaksi,
        ];

        $this->Pemberhentian->updateData($data, $lastId);

        $data = [
            'kode_transaksi' => $kodeTransaksi,
            'nama' => 'Pemberhentian',
            'tanggal' => $tanggal,
        ];

        $this->Transaksi->storeData($data);

        $aset = $this->Aset->getDataByKode($kodeAset);
        $aset = $aset[0];
        $asetId = $aset['id'];

        $data = [
            'umur' => 0,
            'sisa_umur' => 0,
            'status' => 'Stop',
            'nilai_buku' => 0,
        ];

        $this->Aset->updateData($data, $asetId);

        $kodeAkun = 531;

        $data = [
            'kode_akun' => $kodeAkun,
            'kode_transaksi' => $kodeTransaksi,
            'tanggal' => $tanggal,
            'posisi' => "Debit",
            'nominal' => $aset['nilai_buku'],
        ];

        $this->Jurnal->storeData($data);

        $kodeAkun = 114;

        $data = [
            'kode_akun' => $kodeAkun,
            'kode_transaksi' => $kodeTransaksi,
            'tanggal' => $tanggal,
            'posisi' => "Kredit",
            'nominal' => $aset['nilai_buku'],
        ];

        $this->Jurnal->storeData($data);

        $this->session->set_flashdata('success', 'Berhasil menambahkan data !');
        redirect('transaksi/pemberhentian/create');
    }

    public function show($id)
    {
        $pemberhentian = $this->Pemberhentian->getDataById($id);
        $pemberhentian = $pemberhentian[0];
        $kodeAset = $pemberhentian['kode_aset'];

        $aset = $this->Aset->getDataByKode($kodeAset);
        $aset = $aset[0];

        $this->load->view('transaksi/pemberhentian/show', [
            'title' => 'Balai Besar Tekstil Bandung',
            'keywords' => '',
            'description' => '',
            'pemberhentian' => $pemberhentian,
            'aset' => $aset,
        ]);
    }
}
