<?php

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('user/v_list');
    }

    public function dt_user() {
        $this->load->model("M_user");
        $data = array();
        $no = $_POST['start'];
        $status = $_POST['status'];
        $ordercolumn = $_POST['order']['0']['column'];
        $orderdir = $_POST['order']['0']['dir'];
        $length = $_POST['length'];
               $search = !empty($_POST['search']['value'])?$_POST['search']['value']:'';
        $listUser = $this->M_user->getListUser($no, $length, $search, $ordercolumn, $orderdir, $status);
        $rowcount = $this->M_user->getListCount($search, $status);
        $nama_group = $this->session->userdata("nama_group");
        $linkCek = "";
        foreach ($listUser as $dataUser) {
            if ($dataUser->flag_eselon == 1) {
                $attrEselon = "checked";
            } else {
                $attrEselon = "";
            }
            $linkDetail = "<a href='#' onclick = 'detail_user($dataUser->id_dd_user)'><i class='fa fa-search'></i></a>";
            $linkUbah = "<a href='#' onclick = 'ubah_user($dataUser->id_dd_user,0)'><i class='fa fa-pencil'></i></a>";
            $linkHapus = "<a href='#' onclick = 'hapus_user($dataUser->id_dd_user)'><i class='fa fa-trash'></i></a>";
            if ($dataUser->jabatan !== "Admin") {
                $linkCek = "<input type='checkbox' class='cek' title='" . $dataUser->id_dd_user . "' {$attrEselon}>";
            }
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $dataUser->nip;
            $row[] = $dataUser->nama;
            $row[] = $dataUser->jabatan;
            $row[] = $dataUser->username;
            $row[] = base64_decode($dataUser->password);
            $row[] = $linkDetail;
            $row[] = $linkUbah;
            $row[] = $linkHapus;
            $row[] = $linkCek;
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

    public function dt_admin() {
        $this->load->model("M_user");
        $data = array();
        $no = $_POST['start'];
        $status = $_POST['status'];
        $ordercolumn = $_POST['order']['0']['column'];
        $orderdir = $_POST['order']['0']['dir'];
        $length = $_POST['length'];
               $search = !empty($_POST['search']['value'])?$_POST['search']['value']:'';        $listUser = $this->M_user->getListUser($no, $length, $search, $ordercolumn, $orderdir, $status);
        $rowcount = $this->M_user->getListCount($search, $status);
        $nama_group = $this->session->userdata("nama_group");
        $linkCek = "";
        foreach ($listUser as $dataUser) {
            $linkUbah = "<a href='#' onclick = 'ubah_user($dataUser->id_dd_user,1)'><i class='fa fa-pencil'></i></a>";
            $linkHapus = "<a href='#' onclick = 'hapus_user($dataUser->id_dd_user)'><i class='fa fa-trash'></i></a>";
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $dataUser->username;
            $row[] = base64_decode($dataUser->password);
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

    public function password_kandidat() {
        $data['pwd'] = $this->db->get('cfg_password')->row_array();
        $this->load->view('user/v_password_kandidat', $data);
    }

    public function simpan_pwd_kandidat() {
        $pwd = $this->input->post('pwd');
        $cek = $this->db->from('cfg_password')->count_all_results();

        if ($cek === 0 || $cek === null) {
            $this->db->insert('cfg_password', array('password' => $pwd));
            $resp = array('status' => 1, 'pesan' => 'Password Detail Kandidat berhasil ditambah');
        } else {
            $data = array('password' => $pwd);
                  $this->db->update('cfg_password', $data,false);
            $resp = array('status' => 1, 'pesan' => 'Password Detail Kandidat berhasil diupdate');
        }

        echo json_encode($resp);
    }

    public function detail_user($id) {
        $data['detail'] = $this->db->where('id_dd_user', $id)->from('dd_user')->get()->row_array();
        $this->load->view('user/v_detail_user', $data);
    }

    public function ubah_user($id, $par) {
        $data['par'] = $par;
        $data['jabatan'] = $this->db->get('tbljabatan')->result_array();
        $data['detail'] = $this->db->where('id_dd_user', $id)->from('dd_user')->get()->row_array();
        $this->load->view('user/v_ubah_user', $data);
    }

    public function hapus_user() {
        $id = $this->input->post('id');
        $this->db->where('id_dd_user', $id);
        $hapus = $this->db->delete('dd_user');
        if ($hapus) {
            echo "Data Berhasil dihapus";
        }
    }

    public function tambah_user($par) {
        $data['par'] = $par;
        $data['jabatan'] = $this->db->get('tbljabatan')->result_array();
        $this->load->view('user/v_tambah_user', $data);
    }

    public function prosesTambah() {
        $post = $this->input->post();
        $post['password'] = base64_encode($post['password']);
        $tambah = $this->db->insert('dd_user', $post);
        if ($tambah) {
            echo "Data Berhasil Ditambah";
        }
    }

    public function prosesEselon() {
        $id = $this->input->post('id');
        $cek = $this->input->post('cek');
        $this->db->where('id_dd_user', $id);
        if ($cek === "true") {
            $data = array(
                "flag_eselon" => 1
            );
        } else {
            $data = array(
                "flag_eselon" => 0
            );
        }
        $update = $this->db->update('dd_user', $data);
        return $update;
    }

    public function prosesUbah() {
        $post = $this->input->post();
        if ($post['jabatan'] !== '701089') {
            $data = array(
                "nama" => $post['nama'],
                "username" => $post["username"],
                "password" => base64_encode($post["password"]),
                "jabatan" => $post['jabatan']
            );
        } else {
            $data = array(
                "username" => $post["username"],
                "password" => base64_encode($post["password"]),
                "jabatan" => $post['jabatan']
            );
        }
        $this->db->where('id_dd_user', $post['id_dd_user']);
        $update = $this->db->update('dd_user', $data);
        if ($update) {
            echo "Data berhasil diupdate";
        }
    }

    public function profile() {
        $id_user = $this->session->userdata('id_user');
        $data['user'] = $this->db->where('id_dd_user', $id_user)->from('dd_user')->get()->row_array();
        $this->load->view('user/v_profile', $data);
    }

    public function email() {

        $data['email'] = $this->db->from('cfg_email')->get()->row_array();
        $this->load->view('user/v_email', $data);
    }

    public function ubah_profile() {
        $pass = $this->input->post('pass');
        $email = $this->input->post('email');
        if (!empty($pass)) {
            $data = array('password' => base64_encode($pass), 'email' => $email);
        } else {
            $data = array('email' => $email);
        }

        $id_dd_user = $this->session->userdata('id_user');
        $this->db->where('id_dd_user', $id_dd_user);
        $ubah = $this->db->update('dd_user', $data);
        if ($ubah) {
            echo "Profile berhasil dirubah";
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
        $id_user = $this->session->userdata('id_user');
        $dt = $this->db->query("select a.id_dd_user as id,concat(nip,'-',nama) value,nama,b.jabatan,c.unitkerja
			from dd_user a
			join tbljabatan b on a.jabatan=b.kodejab
			join tblstruktural c on c.kodeunit=a.unit_kerja
			where (nip LIKE '%" . $q . "%' OR nama LIKE '%" . $q . "%') AND a.id_dd_user NOT IN(" . $id_user . ")")->result_array();
        echo json_encode($dt);
    }

    public function get_nip_atasan() {
        $q = $this->input->post('q');
        $id_user = $this->session->userdata('id_user');
        $dt = $this->db->query("select a.id_dd_user as id,concat(nip,'-',nama) value,nama,b.jabatan,c.unitkerja
			from dd_user a
			join tbljabatan b on a.jabatan=b.kodejab
			join tblstruktural c on c.kodeunit=a.unit_kerja
			where (nip LIKE '%" . $q . "%' OR nama LIKE '%" . $q . "%') AND a.id_dd_user NOT IN(" . $id_user . ") AND b.jenis IN('JST','JS')")->result_array();
        echo json_encode($dt);
    }
    public function prosesPenilaian() {
        $post = $this->input->post();

        echo $post[0];
    }

}
