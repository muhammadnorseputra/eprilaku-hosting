<?php

class C_pdf extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->cek_sesi();
	}
	
	 public function cek_sesi() {
        if ($this->session->userdata('id_user') == "") {
            $this->session->sess_destroy();
            echo '<script>';
            echo "alert('Sesi anda telah berakhir, silahkan login kembali');";
            echo 'window.parent.location = "./"';
            echo '</script>';
        }
    }

    public function cetak_rekap($periode,$kodeunit) {
	ini_set('memory_limit', '-1');
        $params = array('type' => 'L', 'width' => '520', 'height' => '300');
        $this->load->library('html2pdf_lib', $params);
        $content = file_get_contents(base_url() . 'c_pdf/pdf_cetak_rekap/' . $periode . '/' . $kodeunit );
        $filename = 'Rekap.pdf';
        $this->html2pdf = new HTML2PDF('L', 'A4', 'en', true, 'UTF-8', array(0, 0, 0, 0));
        $save_to = $this->config->item('upload_root');
        if ($this->html2pdf_lib->converHtml2pdf($content, $filename, $save_to)) {
            echo $save_to . '/' . $filename;
        } else {
            echo 'failed';
        }
    }

    public function pdf_cetak_rekap($periode,$kodeunit) {
	
        $par="";
		 if ($kodeunit != "all") {
            $kodeunit=substr($kodeunit,0,3);
            $par = " AND left(a.unit_kerja,3)={$kodeunit} ";
        }
		$data['periode']=$this->db->where('id_dd_periode_penilaian',$periode)->get('dd_periode_penilaian')->row();
		$q="SELECT a.nama,a.nip,d.jabatan,b.unitkerja,c.*
FROM dd_user a
INNER JOIN tblstruktural b ON a.unit_kerja=b.kodeunit
LEFT JOIN(
SELECT d.*
FROM dd_periode_penilaian c
INNER JOIN opmt_perilaku d ON d.tahun=c.tahun_periode AND d.bulan=c.bulan_periode
WHERE c.id_dd_periode_penilaian=$periode
) c ON c.id_dd_user=a.id_dd_user
INNER JOIN tbljabatan d ON d.kodejab=a.jabatan WHERE 1=1 $par AND  a.jabatan not in(999998,999997)";
		$data['rekap']=$this->db->query($q)->result();
        $this->load->view('pdf/v_cetak_rekap', $data);
    }

}

?>