<?php
class PerolehanController extends CI_Controller
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
        $this->load->model('Kategori');
        $this->load->model('Perolehan');
        $this->load->model('Transaksi');
    }

    function index()
    {
        $perolehan = $this->Perolehan->getData();

        $this->load->view('transaksi/perolehan/index', [
            'title' => 'Balai Besar Tekstil Bandung',
            'keywords' => '',
            'description' => '',
            'perolehan' => $perolehan,
        ]);
    }

    public function create()
    {
        $kategori = $this->Kategori->getDataAscByNama();

        $this->load->view('transaksi/perolehan/create', [
            'title' => 'Balai Besar Tekstil Bandung',
            'keywords' => '',
            'description' => '',
            'kategori' => $kategori,
        ]);
    }

    public function store()
    {
        $jenis = $this->input->post('jenis');
        $tanggal = $this->input->post('tanggal');
        $nota = $this->input->post('nota');
        $nama = $this->input->post('nama');
        $kategori = $this->input->post('kategori');
        $umur = $this->input->post('umur');
        $harga = $this->input->post('harga');
        $jumlah = $this->input->post('jumlah');
        $nilaiSisa = $this->input->post('nilaiSisa');
        $total = $this->input->post('total');

        $tanggalAkhir = date('Y-m-d', strtotime("+$umur years", strtotime($tanggal)));;

        $harga = str_replace('.', '', $harga);
        $nilaiSisa = str_replace('.', '', $nilaiSisa);
        $jumlah = str_replace('.', '', $jumlah);
        $total = str_replace('.', '', $total);

        // Insert Data Tabel Perolehan
        $data = [
            'kode_transaksi' => '',
            'tanggal' => $tanggal,
            'nama' => $nama,
            'jenis' => $jenis,
            'harga' => $harga,
            'jumlah' => $jumlah,
            'nota' => $nota,
        ];

        $lastId = $this->Perolehan->storeData($data);

        $kodeTransaksi = $lastId;

        if ($kodeTransaksi < 10) {
            $kodeTransaksi = 'PO' . '00000' . $kodeTransaksi;
        } else if ($kodeTransaksi < 100) {
            $kodeTransaksi = 'PO' . '0000' . $kodeTransaksi;
        } else if ($kodeTransaksi < 1000) {
            $kodeTransaksi = 'PO' . '000' . $kodeTransaksi;
        } else if ($kodeTransaksi < 10000) {
            $kodeTransaksi = 'PO' . '00' . $kodeTransaksi;
        } else  if ($kodeTransaksi < 100000) {
            $kodeTransaksi = 'PO' . '0' . $kodeTransaksi;
        } else {
            $kodeTransaksi = 'PO' . $kodeTransaksi;
        }

        $data = [
            'kode_transaksi' => $kodeTransaksi,
        ];

        $this->Perolehan->updateData($data, $lastId);
        // Selesai Insert Data Tabel Perolehan


        // Insert Data Tabel Transaksi
        $data = [
            'kode_transaksi' => $kodeTransaksi,
            'nama' => 'Perolehan',
            'tanggal' => $tanggal,
        ];

        $this->Transaksi->storeData($data);
        // Selesai Insert Data Tabel Transaksi

        // Insert Data Tabel Aset
        for ($i = 0; $i < $jumlah; $i++) {
            $aset = $this->Aset->getLastData();
            $asetId = $aset[0]['id'];
            $asetId = $asetId + 1;

            if ($asetId < 10) {
                $kodeAset = 'A' . '000' . $asetId . $kodeTransaksi;
            } else if ($asetId < 100) {
                $kodeAset = 'A' . '00' . $asetId . $kodeTransaksi;
            } else if ($asetId < 1000) {
                $kodeAset = 'A' . '0' . $asetId . $kodeTransaksi;
            } else {
                $kodeAset = 'A' . $asetId . $kodeTransaksi;
            }

            $data = [
                "kode" => $kodeAset,
                "nama" => $nama,
                "tanggal" => $tanggal,
                "harga" => $harga,
                "kode_transaksi" => $kodeTransaksi,
                "kode_kategori" => $kategori,
                "umur" => $umur,
                "sisa_umur" => $umur,
                "status" => 'Ada',
                "nilai_sisa" => $nilaiSisa,
                "nilai_buku" => $harga,
                "tanggal_akhir_umur_manfaat" => $tanggalAkhir,
                'metode_penyusutan' => 'Belum'
            ];

            $this->Aset->storeData($data);
        }
        // Selesai Insert Data Tabel Aset

        // Insert Data Jurnal
        if ($jenis == 'Pembelian') {
            $kodeAkun = 114;

            $data = [
                'kode_akun' => $kodeAkun,
                'kode_transaksi' => $kodeTransaksi,
                'tanggal' => $tanggal,
                'posisi' => "Debit",
                'nominal' => $harga
            ];

            $this->Jurnal->storeData($data);

            $kodeAkun = '111';

            $data = [
                'kode_akun' => $kodeAkun,
                'kode_transaksi' => $kodeTransaksi,
                'tanggal' => $tanggal,
                'posisi' => "Kredit",
                'nominal' => $jumlah * $harga
            ];

            $this->Jurnal->storeData($data);
        } else if ($jenis == 'Hibah') {
            $kodeAkun = 431;

            $data = [
                'kode_akun' => $kodeAkun,
                'kode_transaksi' => $kodeTransaksi,
                'tanggal' => $tanggal,
                'posisi' => "Debit",
                'nominal' => $harga
            ];

            $this->Jurnal->storeData($data);

            $kodeAkun = '121';

            $data = [
                'kode_akun' => $kodeAkun,
                'kode_transaksi' => $kodeTransaksi,
                'tanggal' => $tanggal,
                'posisi' => "Kredit",
                'nominal' => $jumlah * $harga
            ];

            $this->Jurnal->storeData($data);
        }
        // Selesai Insert Data Jurnal

        $this->session->set_flashdata('success', 'Berhasil menambahkan data !');
        redirect('transaksi/perolehan/create');
    }

    public function show($id)
    {
        $perolehan = $this->Perolehan->getDataById($id);
        $perolehan = $perolehan[0];
        $kodeTransaksi = $perolehan['kode_transaksi'];

        $aset = $this->Aset->getDataByKodeTransaksi($kodeTransaksi);

        $this->load->view('transaksi/perolehan/show', [
            'title' => 'Balai Besar Tekstil Bandung',
            'keywords' => '',
            'description' => '',
            'aset' => $aset,
            'perolehan' => $perolehan,
        ]);
    }

    public function destroy()
    {
        $id = $this->input->post('id');

        $perolehan = $this->Perolehan->getDataById($id);
        $perolehan = $perolehan[0];
        $kodeTransaksi = $perolehan['kode_transaksi'];

        // Delete Transaksi
        $this->Transaksi->destroyDataByKodeTransaksi($kodeTransaksi);

        // Delete Jurnal
        $this->Jurnal->destroyDataByKodeTransaksi($kodeTransaksi);

        // Delete Aset
        $this->Aset->destroyDataByKodeTransaksi($kodeTransaksi);

        // Delete Perolehan
        $this->Perolehan->destroyData($id);

        $this->session->set_flashdata('success', 'Berhasil menghapus data !');
        redirect('transaksi/perolehan');
    }
}
