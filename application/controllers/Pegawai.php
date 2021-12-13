<?php

class pegawai extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('pegawai/v_list');
    }

    public function dt_pegawai() {
        $this->load->model("M_pegawai");
        $data = array();
        $no = $_POST['start'];
        $ordercolumn = $_POST['order']['0']['column'];
        $orderdir = $_POST['order']['0']['dir'];
        $length = $_POST['length'];
        $search = $_POST['search']['value'];
        $listpegawai = $this->M_pegawai->getListpegawai($no, $length, $search, $ordercolumn, $orderdir);
        $rowcount = $this->M_pegawai->getListCount($search);
        $linkCek = "";
        foreach ($listpegawai as $datapegawai) {
            $linkDetail = "<a href='#' onclick = 'detail_pegawai($datapegawai->id_employee)'><i class='fa fa-search'></i></a>";
            $linkUbah = "<a href='#' onclick = 'ubah_pegawai($datapegawai->id_employee)'><i class='fa fa-pencil'></i></a>";
            $linkHapus = "<a href='#' onclick = 'hapus_pegawai($datapegawai->id_employee)'><i class='fa fa-trash'></i></a>";
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $datapegawai->name;
            $row[] = $datapegawai->employee_number;
            $row[] = $datapegawai->birth_date;
            $row[] = $datapegawai->phone_number;
            $row[] = $datapegawai->email;
            $row[] = $datapegawai->address;
            $row[] = $datapegawai->occupation;
            $row[] = number_format($datapegawai->salary);
            $row[] = $datapegawai->building_name;
            $row[] = $linkUbah;
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

    public function ubah_pegawai($id) {
        $data['gedung'] = $this->db->get("tbl_building")->result_array();
        $data['pegawai'] = $this->db->where('id_employee', $id)->from('tbl_employee')->get()->row_array();
        $this->load->view('pegawai/v_ubah_pegawai', $data);
    }

    public function hapus_pegawai() {
        $id = $this->input->post('id');
        $this->db->where('id_employee', $id);
        $hapus = $this->db->delete('tbl_employee');
        if ($hapus) {
            echo "Data Berhasil dihapus";
        }
    }

    public function tambah_pegawai() {
        $data['gedung'] = $this->db->get("tbl_building")->result_array();
        $this->load->view('pegawai/v_tambah_pegawai', $data);
    }

    public function proses_pegawai() {
        $post = $this->input->post();
        $id_employee = empty($post['id_employee']) ? '' : $post['id_employee'];
//        $img = empty($_FILES['pegawai_image']) ? '' : $_FILES['pegawai_image'];
//        if ($img['name'] !== "") {
//            $temporary = explode(".", $img["name"]);
//            $file_extension = end($temporary);
//            $nama_file = $post['pegawainame'] . "." . $file_extension;
//            move_uploaded_file($img['tmp_name'], 'images/pegawai/' . $nama_file);
//            $post['pegawai_image'] = 'images/pegawai/' . $nama_file;
//        } else {
//            
//        }
        if ($id_employee !== "") {
            $this->db->where('id_employee', $id_employee);
            $proses = $this->db->update('tbl_employee', $post);
            echo "Data Berhasil Diupdate";
        } else {
            $proses = $this->db->insert('tbl_employee', $post);
            echo "Data Berhasil Ditambah";
        }
    }

    public function prosesEselon() {
        $id = $this->input->post('id');
        $cek = $this->input->post('cek');
        $this->db->where('id_dd_pegawai', $id);
        if ($cek === "true") {
            $data = array(
                "flag_eselon" => 1
            );
        } else {
            $data = array(
                "flag_eselon" => 0
            );
        }
        $update = $this->db->update('dd_pegawai', $data);
        return $update;
    }

    public function prosesUbah() {
        $post = $this->input->post();
        if ($post['jabatan'] !== '701089') {
            $data = array(
                "nama" => $post['nama'],
                "pegawainame" => $post["pegawainame"],
                "password" => base64_encode($post["password"]),
                "jabatan" => $post['jabatan']
            );
        } else {
            $data = array(
                "pegawainame" => $post["pegawainame"],
                "password" => base64_encode($post["password"]),
                "jabatan" => $post['jabatan']
            );
        }
        $this->db->where('id_dd_pegawai', $post['id_dd_pegawai']);
        $update = $this->db->update('dd_pegawai', $data);
        if ($update) {
            echo "Data berhasil diupdate";
        }
    }

    public function profile() {
        $id_pegawai = $this->session->pegawaidata('id_pegawai');
        $data['pegawai'] = $this->db->where('id_dd_pegawai', $id_pegawai)->from('dd_pegawai')->get()->row_array();
        $this->load->view('pegawai/v_profile', $data);
    }

    public function email() {

        $data['email'] = $this->db->from('cfg_email')->get()->row_array();
        $this->load->view('pegawai/v_email', $data);
    }

    public function ubah_profile() {
        $pass = $this->input->post('pass');
        $email = $this->input->post('email');
        if ($pass !== "") {
            $data = array('password' => base64_encode($pass), 'email' => $email);
        } else {
            $data = array('email' => $email);
        }

        $id_dd_pegawai = $this->session->pegawaidata('id_pegawai');
        $this->db->where('id_dd_pegawai', $id_dd_pegawai);
        $ubah = $this->db->update('dd_pegawai', $data);
        if ($ubah) {
            echo "Password berhasil dirubah";
        }
    }

    public function ubah_email() {
        $post = $this->input->post();
        $cek = $this->db->from('cfg_email')->count_all_results();
        if ($cek == 0) {
            $this->db->insert('cfg_email', $post);
        } else {
            $this->db->update('cfg_email', $post);
        }
        echo 'konfigurasi berhasil disimpan';
    }

    public function get_nip() {
        $q = $this->input->post('q');
        $id_pegawai = $this->session->pegawaidata('id_pegawai');
        $dt = $this->db->query("select a.id_dd_pegawai as id,concat(nip,'-',nama) value,nama,b.jabatan,c.unitkerja
			from dd_pegawai a
			join tbljabatan b on a.jabatan=b.kodejab
			join tblstruktural c on c.kodeunit=a.unit_kerja
			where (nip LIKE '%" . $q . "%' OR nama LIKE '%" . $q . "%') AND a.id_dd_pegawai NOT IN(" . $id_pegawai . ")")->result_array();
        echo json_encode($dt);
    }

    public function get_nip_atasan() {
        $q = $this->input->post('q');
        $id_pegawai = $this->session->pegawaidata('id_pegawai');
        $dt = $this->db->query("select a.id_dd_pegawai as id,concat(nip,'-',nama) value,nama,b.jabatan,c.unitkerja
			from dd_pegawai a
			join tbljabatan b on a.jabatan=b.kodejab
			join tblstruktural c on c.kodeunit=a.unit_kerja
			where (nip LIKE '%" . $q . "%' OR nama LIKE '%" . $q . "%') AND a.id_dd_pegawai NOT IN(" . $id_pegawai . ") AND jenis IN('JST','JS')")->result_array();
        echo json_encode($dt);
    }

    public function prosesPenilaian() {
        $post = $this->input->post();

        echo $post[0];
    }

}
