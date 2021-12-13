<?php

class Pengaturan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function evaluator() {
        $data['id_bobot_presentase'] = $this->cek_status();
        $this->load->view('pengaturan/v_evaluator', $data);
    }
    
    public function cek_evaluator() {
        $id_user = $this->session->userdata('id_user');
        $this->db->select('id_dd_user');
        $this->db->from('opdd_status');
        $this->db->where('id_dd_user', $id_user);
        $db = $this->db->get()->result();
        if(count($db) > 0) {
            $msg = true;
        } else {
            $msg = false;
        }
        
        echo json_encode($msg);
    }

    public function dt_penilai() {
        $this->load->model("M_penilai");
        $data = array();
        $no = $_POST['start'];
        $status = $_POST['status'];
        $ordercolumn = $_POST['order']['0']['column'];
        $orderdir = $_POST['order']['0']['dir'];
        $length = $_POST['length'];
               $search = !empty($_POST['search']['value'])?$_POST['search']['value']:'';        // 1 untuk eselon
        $listPenilai = $this->M_penilai->getListPenilai($no, $length, $search, $ordercolumn, $orderdir, $status);
        $rowcount = $this->M_penilai->getListPenilaiCount($search, $status);
        $linkCek = "";
        foreach ($listPenilai as $dataPenilai) {
            $linkHapus = "<a href='#' onclick = 'hapus_penilai($dataPenilai->id_dd_penilai)'><i class='fa fa-trash'></i></a>";

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $dataPenilai->nama."<br/>"."NIP. ".$dataPenilai->nip;
            $row[] = $dataPenilai->jabatan;
            $row[] = $dataPenilai->unitkerja;
            $row[] = date('d M Y H:i', strtotime($dataPenilai->created_date));
            $row[] = $linkHapus;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $length,
            "recordsFiltered" => $rowcount,
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function proses_penilai() {
        $post = $this->input->post();
        $id_dd_user = $this->session->userdata('id_user');
        $id_dd_user_penilai = $post['id_dd_user_penilai'];
        $flag_user = $post['flag_user'];
        $created_date = date('Y-m-d H:i:s');
        $data = array('id_dd_user' => $id_dd_user, 'id_dd_user_penilai' => $id_dd_user_penilai, 'flag_user' => $flag_user, 'created_date' => $created_date);
        if ($flag_user == "0") {
            // Cek penilai atasan sudah ada / belum
            $cekPenilai = $this->db->from('dd_penilai')->where('id_dd_user', $id_dd_user)->where('flag_user', 0)->get()->row_array();
            if (count($cekPenilai) == 0) {
                $proses = $this->db->insert('dd_penilai', $data);
            } else {
                $this->db->where('id_dd_penilai', $cekPenilai['id_dd_penilai']);
                $proses = $this->db->update('dd_penilai', $data);
            }
        } else {
            if (empty($post['id_dd_penilai'])) {
                $proses = $this->db->insert('dd_penilai', $data);
            } else {
                $this->db->where('id_dd_penilai', $post['id_dd_penilai']);
                $proses = $this->db->update('dd_penilai', $data);
            }
        }
        if ($proses) {
            echo "Data Penilai berhasil diupdate";
        }
    }

    public function tambah_penilai($id) {
        $data['id'] = $id;
        $this->load->view('pengaturan/v_tambah_penilai', $data);
    }

    public function hapus_penilai() {
        $id = $this->input->post('id');
        $this->db->where('id_dd_penilai', $id);
        $hapus = $this->db->delete('dd_penilai');
        if ($hapus) {
            echo "Penilai berhasil dihapus";
        }
    }

    public function get_penilai() {
        $id_user = $this->session->userdata('id_user');
        $this->db->select('a.id_dd_penilai,a.id_dd_user_penilai,b.nip,b.nama,c.unitkerja,d.jabatan, a.created_date');
        $this->db->where('a.id_dd_user', $id_user);
        $this->db->where('a.flag_user', 0);
        $this->db->join('dd_user b', 'a.id_dd_user_penilai=b.id_dd_user', 'INNER');
        $this->db->join('tblstruktural c', 'c.kodeunit=b.unit_kerja', 'INNER');
        $this->db->join('tbljabatan d', 'b.jabatan=d.kodejab', 'INNER');
        $get = $this->db->get('dd_penilai a');
        echo json_encode($get->row_array());
    }

    public function proses_status() {
        $id_user = $this->session->userdata('id_user');
        $id_bobot_presentase = !empty($this->input->post('id_bobot_presentase'))?$this->input->post('id_bobot_presentase'):'';
        $data = array('id_dd_user' => $id_user, 'id_bobot_presentase' => $id_bobot_presentase);
        $cek = $this->db->where('id_dd_user', $id_user)->get('opdd_status')->row_array();

        if (count($cek) == 0) {
            $proses = $this->db->insert('opdd_status', $data);
        } else {
            $this->db->where('id_bobot_presentase', $cek['id_bobot_presentase']);
            $this->db->where('id_dd_user', $id_user);
            $proses = $this->db->update('opdd_status', $data);
        }
        
        if ($proses) {
            echo "Status berhasil diupdate";
        }
    }

    public function cek_status() {
        $id_user = $this->session->userdata('id_user');
        $this->db->where('id_dd_user', $id_user);
        $cek = $this->db->get('opdd_status')->row_array();
        return !empty($cek['id_bobot_presentase'])?$cek['id_bobot_presentase']:0;
    }

}
