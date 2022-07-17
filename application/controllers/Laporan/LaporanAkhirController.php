<?php
class LaporanAkhirController extends CI_Controller
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
        $this->load->model('Pemberhentian');
        $this->load->model('Penyusutan');
        $this->load->model('Perbaikan');
        $this->load->model('Perolehan');
    }

    function index()
    {
        $periode = $this->input->get('periode');

        if ($periode == null) {
            $periode = date('Y-m-d');
        }

        $perolehan = $this->filterPerolehan($periode);
        $perbaikan = $this->filterPerbaikan($periode);
        $pemberhentian = $this->filterPemberhentian($periode);
        $penyusutan = $this->filterPenyusutan($periode);

        // echo '<pre>';
        // print_r($pemberhentian);
        // die;


        $this->load->view('laporan/laporan_akhir/index', [
            'title' => 'Balai Besar Tekstil Bandung',
            'keywords' => '',
            'description' => '',
            'perolehan' => $perolehan,
            'perbaikan' => $perbaikan,
            'pemberhentian' => $pemberhentian,
            'penyusutan' => $penyusutan,
            'periode' => $periode,
        ]);
    }

    public function filterPerolehan($periode)
    {
        $perolehan = $this->Perolehan->getDataByTanggal($periode);

        $result = [];
        $index = 0;

        foreach ($perolehan as $row) {
            $kodeTransaksi = $row['kode_transaksi'];

            $dataAset = $this->Aset->getDataByKodeTransaksi($kodeTransaksi);

            foreach ($dataAset as $aset) {
                $result[$index] = $aset;
                $index++;
            }
        }

        return $result;
    }

    public function filterPerbaikan($periode)
    {
        $perbaikan = $this->Perbaikan->getDataByTanggal($periode);

        $result = [];
        $index = 0;

        foreach ($perbaikan as $row) {
            $kodeAset = $row['kode_aset'];

            $aset = $this->Aset->getDataByKode($kodeAset);
            $aset = $aset[0];

            $result[$index] = $row;
            $result[$index]['nama_aset'] = $aset['nama'];
            $index++;
        }

        return $result;
    }

    public function filterPemberhentian($periode)
    {
        $pemberhentian = $this->Pemberhentian->getDataByTanggal($periode);

        $result = [];
        $index = 0;

        foreach ($pemberhentian as $row) {
            $kodeAset = $row['kode_aset'];

            $aset = $this->Aset->getDataByKode($kodeAset);
            $aset = $aset[0];

            $result[$index] = $row;
            $result[$index]['nama_aset'] = $aset['nama'];
            $index++;
        }

        return $result;
    }

    public function filterPenyusutan($periode)
    {
        $penyusutan = $this->Penyusutan->getDataByTanggal($periode);

        $result = [];
        $index = 0;

        foreach ($penyusutan as $row) {
            $kodeTransaksi = $row['kode_transaksi'];

            $detailPenyusutan = $this->DetailPenyusutan->getDataByKodeTransaksi($kodeTransaksi);

            foreach ($detailPenyusutan as $detail) {
                $kodeAset = $detail['kode_aset'];

                $aset = $this->Aset->getDataByKode($kodeAset);
                $aset = $aset[0];

                $result[$index] = $detail;
                $result[$index]['nama_aset'] = $aset['nama'];
                $index++;
            }
        }

        return $result;
    }
}
