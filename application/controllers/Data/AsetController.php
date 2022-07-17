<?php
class AsetController extends CI_Controller
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
        $this->load->model('Kategori');
    }

    function index()
    {
        $aset = $this->Aset->getDataAsetAktif();

        $this->load->view('data/aset/aktif/index', [
            'title' => 'Balai Besar Tekstil Bandung',
            'keywords' => '',
            'description' => '',
            'aset' => $aset,
        ]);
    }

    public function showAktif($id)
    {
        $aset = $this->Aset->getDataById($id);
        $aset = $aset[0];

        // Get Nama Kategori
        $kategori = $this->Kategori->getDataByKode($aset['kode_kategori']);
        $kategori = $kategori[0];
        $aset['nama_kategori'] = $kategori['nama'];

        // Get detail penyusutan
        $detailPenyusutan = $this->DetailPenyusutan->getDataByKodeAset($aset['kode']);
        $jumlahPenyusutan = count($detailPenyusutan);
        $aset['jumlah_penyusutan'] = $jumlahPenyusutan;

        $this->load->view('data/aset/aktif/show', [
            'title' => 'Balai Besar Tekstil Bandung',
            'keywords' => '',
            'description' => '',
            'aset' => $aset,
        ]);
    }

    function tidakAktif()
    {
        $aset = $this->Aset->getDataAsetTidakAktif();

        $this->load->view('data/aset/tidak_aktif/index', [
            'title' => 'Balai Besar Tekstil Bandung',
            'keywords' => '',
            'description' => '',
            'aset' => $aset,
        ]);
    }

    public function showTidakAktif($id)
    {
        $aset = $this->Aset->getDataById($id);
        $aset = $aset[0];

        // Get Nama Kategori
        $kategori = $this->Kategori->getDataByKode($aset['kode_kategori']);
        $kategori = $kategori[0];
        $aset['nama_kategori'] = $kategori['nama'];

        // Get detail penyusutan
        $detailPenyusutan = $this->DetailPenyusutan->getDataByKodeAset($aset['kode']);
        $jumlahPenyusutan = count($detailPenyusutan);
        $aset['jumlah_penyusutan'] = $jumlahPenyusutan;

        $this->load->view('data/aset/tidak_aktif/show', [
            'title' => 'Balai Besar Tekstil Bandung',
            'keywords' => '',
            'description' => '',
            'aset' => $aset,
        ]);
    }

    public function destroy()
    {
        $id = $this->input->post('id');

        $this->Aset->destroyData($id);

        $prevLink = $_SERVER['HTTP_REFERER'];

        $this->session->set_flashdata('success', 'Berhasil menghapus data !');
        redirect($prevLink);
    }
}
