<?php
class BukuBesarController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $user = $this->session->userdata('user');

        if ($user == null) {
            redirect(base_url());
        }

        $this->load->model('Akun');
        $this->load->model('Jurnal');
        $this->load->model('SaldoAwal');
        $this->load->model('Transaksi');
    }

    public function filterDataJurnal($junal)
    {
        $result = [];
        $index = 0;

        foreach ($junal as $row) {
            $transaksi = $this->Transaksi->getDataByKodeTransaksi($row['kode_transaksi']);
            $transaksi = $transaksi[0];

            $result[$index] = $row;
            $result[$index]['keterangan'] = $transaksi['nama'];
            $index++;
        }

        return $result;
    }

    public function filterBukuBesar($tanggalAwal, $tanggalAkhir)
    {
        $akun = $this->Akun->getData();

        $result = [];
        $index = 0;

        foreach ($akun as $row) {
            $result[$index] = $row;

            $jurnal = $this->Jurnal->getDataFilterByTanggalAndKodeAkun($tanggalAwal, $tanggalAkhir, $row['kode']);
            $jurnal = $this->filterDataJurnal($jurnal);
            $result[$index]['jurnal'] = $jurnal;

            $index++;
        }

        return $result;
    }

    function index()
    {
        $tanggalAwal = $this->input->get('tanggalAwal');
        $tanggalAkhir = $this->input->get('tanggalAkhir');

        $bukuBesar = $this->filterBukuBesar($tanggalAwal, $tanggalAkhir);

        $saldoAwal = $this->SaldoAwal->getData();
        $saldoAwal = $saldoAwal[0];

        $this->load->view('laporan/buku_besar/index', [
            'title' => 'Balai Besar Tekstil Bandung',
            'keywords' => '',
            'description' => '',
            'bukuBesar' => $bukuBesar,
            'saldoAwal' => $saldoAwal,
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
        ]);
    }

    public function updateSaldoAwal()
    {
        $id = $this->input->post('id');
        $tanggal = $this->input->post('tanggal');
        $nominal = $this->input->post('nominal');

        $nominal = str_replace('.', '', $nominal);

        $data = [
            'tanggal' => $tanggal,
            'nominal' => $nominal,
        ];

        $this->SaldoAwal->updateData($data, $id);

        $this->session->set_flashdata('success', 'Berhasil mangganti saldo awal !');
        redirect('laporan/buku-besar');
    }
}
