<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        //alexsya2255 admin2
        $pesan = $this->session->flashdata('pesan');
        if ($pesan) {
            $data['pesan'] = $this->session->flashdata('pesan');
        } else {
            $data['pesan'] = "";
        }
        if (empty($this->session->userdata('username'))) {
           $this->load->view('v_login', $data);
       // redirect('../portal');

        } else {
            $id_user = $this->session->userdata('id_user');
            $data['nama'] = $this->session->userdata('nama');
            $data['nip'] = $this->session->userdata('nip');
            $data['jabatan'] = $this->session->userdata('jabatan');
            $data['nama_uker'] = $this->session->userdata('nama_uker');
            /* $data['ttl_dsp'] = $this->db->query("select count(*) ttl FROM opmt_disposisi WHERE id_dd_user={$id_user} AND status_disposisi_bawahan is null")->row_array(); */
            $this->load->view('v_main', $data);
        }
    }

    public function validasi() {
        $this->load->model("M_user");
        $user = $this->input->post('username');
        $pass = $this->input->post('password');
        $validasi = $this->M_user->validasi($user, $pass);
        if ($validasi == 0) {
            //  echo $validasi;
            $this->session->set_flashdata('pesan', 'Username / Password Anda Salah !!!');
            redirect('./');
        } else {

            $usr = $this->M_user->get_data($user, $pass);

            $this->session->set_userdata('id_user', $usr['id_dd_user']);
            $this->session->set_userdata('username', $usr['username']);
            $this->session->set_userdata('nip', $usr['nip']);
            $this->session->set_userdata('nama', $usr['nama']);
            $this->session->set_userdata('kodejab', $usr['kodejab']);
            $this->session->set_userdata('jenis', $usr['jenis']);
            $this->session->set_userdata('jabatan', $usr['jabatan']);
            $this->session->set_userdata('unit_kerja', $usr['unitkerja']);
            $this->session->set_userdata('nama_uker', $usr['unitkerja']);
            $this->session->set_userdata('flag_eselon', $usr['flag_eselon']);
            $this->session->set_userdata('email', $usr['email']);

            $this->M_user->update_log($user, $pass);
            redirect('./');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
       // redirect('../portal');
 redirect('./');

    }

}
