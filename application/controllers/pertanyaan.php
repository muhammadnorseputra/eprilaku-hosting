<?php

class Pertanyaan extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function umum($eselon) {
        $data['eselon'] = $eselon;
        $this->load->view('admin/v_pertanyaan', $data);
    }

    public function dt_pertanyaan() {
        $this->load->model("M_pertanyaan");
        $data = array();
        $no = $_POST['start'];
        $status = $_POST['status'];
        $eselon = $_POST['eselon'];
        $ordercolumn = $_POST['order']['0']['column'];
        $orderdir = $_POST['order']['0']['dir'];
        $length = $_POST['length'];
               $search = !empty($_POST['search']['value'])?$_POST['search']['value']:'';
        // 1 untuk eselon
        $listPertanyaan = $this->M_pertanyaan->getListPertanyaan($no, $length, $search, $ordercolumn, $orderdir, $status, $eselon);
        $rowcount = $this->M_pertanyaan->getListPertanyaanCount($search, $status, $eselon);
        $linkCek = "";
        foreach ($listPertanyaan as $dataPertanyaan) {
            $linkDetail = "<a href='#' onclick = 'detail_pertanyaan($dataPertanyaan->id_dd_pertanyaan)'><i class='fa fa-search'></i></a>";
            $linkEdit = "<a href='#' onclick = 'ubah_pertanyaan($dataPertanyaan->id_dd_pertanyaan)'><i class='fa fa-wrench'></i></a>";
            $linkHapus = "<a href='#' onclick = 'hapus_pertanyaan($dataPertanyaan->id_dd_pertanyaan)'><i class='fa fa-trash'></i></a>";

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $dataPertanyaan->pertanyaan;
            $row[] = $linkDetail;
            $row[] = $linkEdit;
            $row[] = $linkHapus;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $length,
            "recordsFiltered" => $rowcount,
            "data" => $data,
        );
//output to json format
        echo json_encode($output);
    }

    public function tambah_pertanyaan($id, $eselon) {
        $data['flag_eselon'] = $eselon;
        $data['par'] = $this->db->where('id_group_pertanyaan', $id)->from('dd_group_pertanyaan')->get()->row_array();
        $this->load->view('admin/v_tambah_pertanyaan', $data);
    }

    public function ubah_pertanyaan($id) {
        $data['pertanyaan'] = $this->db->where('id_dd_pertanyaan', $id)->from('dd_pertanyaan a')->join('dd_group_pertanyaan b', 'a.id_group_pertanyaan=b.id_group_pertanyaan', 'INNER')->get()->row_array();
        $this->load->view('admin/v_ubah_pertanyaan', $data);
    }

    public function detail_pertanyaan($id) {
        $data['flag_eselon'] = 0;
        $data['pertanyaan'] = $this->db->where('id_dd_pertanyaan', $id)->from('dd_pertanyaan a')->join('dd_group_pertanyaan b', 'a.id_group_pertanyaan=b.id_group_pertanyaan', 'INNER')->get()->row_array();
        $this->load->view('admin/v_detail_pertanyaan', $data);
    }

    public function proses_pertanyaan() {
        $post = $this->input->post();
        if (empty($post['id_dd_pertanyaan'])) {
            $proses = $this->db->insert('dd_pertanyaan', $post);
        } else {
            $this->db->where('id_dd_pertanyaan', $post['id_dd_pertanyaan']);
            $proses = $this->db->update('dd_pertanyaan', $post);
        }
        if ($proses) {
            echo 'Pertanyaan berhasil diupdate';
        }
    }

    public function tambah_jawaban($id_dd_pertanyaan, $jawaban, $nilai) {
        $data = array('id_dd_pertanyaan' => $id_dd_pertanyaan, 'jawaban' => $jawaban, 'nilai' => $nilai);
        $tambah = $this->db->insert('dd_jawaban', $data);
        return $tambah;
    }

    public function get_pertanyaan() {
        $id = $this->input->post('id');
        $this->db->where("id_dd_pertanyaan", $id);
        $get = $this->db->get('dd_pertanyaan')->row_array();
        echo json_encode($get);
    }

    public function hapus_pertanyaan() {
        $id = $this->input->post('id');
        $this->db->where('id_dd_pertanyaan', $id);
        $hapus = $this->db->delete('dd_pertanyaan');
        if ($hapus) {
            $this->db->delete('dd_jawaban');
            echo 'Pertanyaan berhasil dihapus';
        }
    }

}
