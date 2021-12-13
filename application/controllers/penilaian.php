<?php

class Penilaian extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function periode() {
        $this->load->view('admin/v_periode_penilaian');
    }

    public function dt_periode() {
        $this->load->model("M_penilaian");
        $data = array();
        $no = $_POST['start'];
        $status = $_POST['status'];
        $ordercolumn = $_POST['order']['0']['column'];
        $orderdir = $_POST['order']['0']['dir'];
        $length = $_POST['length'];
        $search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : '';
        $listPeriode = $this->M_penilaian->getListPeriode($no, $length, $search, $ordercolumn, $orderdir);
        $rowcount = $this->M_penilaian->getListPeriodeCount($search);
        $linkCek = "";
        foreach ($listPeriode as $dataPeriode) {
            $linkPengaturan = "<a href='#' onclick = 'pengaturan_periode($dataPeriode->id_dd_periode_penilaian)'><i class='fa fa-wrench'></i></a>";
            $linkHapus = "<a href='#' onclick = 'hapus_periode($dataPeriode->id_dd_periode_penilaian)'><i class='fa fa-trash'></i></a>";

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = date('d F Y', strtotime($dataPeriode->tgl_pembuatan));
            $row[] = $dataPeriode->bulan_periode;
            $row[] = $dataPeriode->tahun_periode;
            $row[] = $linkPengaturan;
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

    public function tambah_periode() {
        $this->load->view('admin/v_tambah_periode');
    }

    public function proses_tambah_periode() {
        $post = $this->input->post();
        $bulan = $post['bulan_periode'];
        $tahun = $post['tahun_periode'];
        $tgl_pembuatan = date('Y-m-d');
        $data = array('bulan_periode' => $bulan, 'tahun_periode' => $tahun, 'tgl_pembuatan' => $tgl_pembuatan, 'flag_aktif' => 1);
        $tambah = $this->db->insert('dd_periode_penilaian', $data);
        if ($tambah) {
            echo 'Periode berhasil ditambah';
            $dtEmail = $this->db->query("select email from dd_user a join tbljabatan b on a.jabatan=b.kodejab where email is not null")->result_array();
            $tujuan = $dtEmail;
            $subjek = "Aplikasi 360";
            $pesan = "<b>Periode Penilaian Bulan " . bulan($bulan) . " Tahun " . $tahun . " telah dibuka</b>";
            $this->kirim_email($tujuan, $subjek, $pesan);
        }
    }

    public function get_pengaturan_periode() {
        $id = $this->input->post('id');
        $this->db->where("id_dd_periode_penilaian", $id);
        $get = $this->db->get('dd_periode_penilaian')->row_array();
        echo json_encode($get);
    }

    public function hapus_periode() {
        $id = $this->input->post('id');
        $this->db->where('id_dd_periode_penilaian', $id);
        $hapus = $this->db->delete('dd_periode_penilaian');
        if ($hapus) {
            echo 'Periode berhasil dihapus';
        }
    }

    public function update_pengaturan() {
        $id = $this->input->post('id');
        $cek = $this->input->post('cek');
        $dtPeriode = $this->db->where('id_dd_periode_penilaian', $id)->from('dd_periode_penilaian')->get()->row_array();

        if ($cek == 'true') {
            $data = array('flag_aktif' => 0);
        } else {
            $data = array('flag_aktif' => 1);
            $dtEmail = $this->db->query("select email from dd_user a join tbljabatan b on a.jabatan=b.kodejab where email is not null")->result_array();
            $tujuan = $dtEmail;
            $subjek = "Aplikasi 360";
            $pesan = "<b>Periode Penilaian Bulan " . bulan($dtPeriode['bulan_periode']) . " Tahun " . $dtPeriode['tahun_periode'] . " telah dibuka</b>";
            $this->kirim_email($tujuan, $subjek, $pesan);
        }
        $this->db->where('id_dd_periode_penilaian', $id);
        $update = $this->db->update('dd_periode_penilaian', $data);
        if ($update) {
            echo ' Pengaturan berhasil diupdate';
        }
    }

    public function pengajuan($id) {
        $data['id'] = $id;
        $id_user = $this->session->userdata('id_user');
        $data['periode'] = $this->db->where("id_dd_periode_penilaian", $id)->from('dd_periode_penilaian')->get()->row_array();
        $data['patas'] = $this->db->query('SELECT b.nip,b.nama,c.unitkerja,d.jabatan from dd_penilai a join dd_user b ON a.id_dd_user_penilai=b.id_dd_user JOIN tblstruktural c on c.kodeunit=b.unit_kerja JOIN tbljabatan d on d.kodejab=b.jabatan WHERE flag_user=0 AND a.id_dd_user=' . $id_user)->row_array();
        $data['patem'] = $this->db->query('SELECT b.nip,b.nama,c.unitkerja,d.jabatan from dd_penilai a join dd_user b ON a.id_dd_user_penilai=b.id_dd_user JOIN tblstruktural c on c.kodeunit=b.unit_kerja JOIN tbljabatan d on d.kodejab=b.jabatan WHERE flag_user=1 AND a.id_dd_user=' . $id_user)->result_array();
        $data['pabaw'] = $this->db->query('SELECT b.nip,b.nama,c.unitkerja,d.jabatan from dd_penilai a join dd_user b ON a.id_dd_user_penilai=b.id_dd_user JOIN tblstruktural c on c.kodeunit=b.unit_kerja JOIN tbljabatan d on d.kodejab=b.jabatan WHERE flag_user=2 AND a.id_dd_user=' . $id_user)->result_array();
        $data['status'] = $this->db->where('id_dd_user', $id_user)->from('opdd_status')->get()->row_array();
        $this->load->view('penilaian/v_pengajuan', $data);
    }

    public function proses_pengajuan() {
        $id = $this->input->post('id');
        $id_user = $this->session->userdata('id_user');
        $qStatus = $this->db->query("SELECT * FROM opdd_status a join dd_bobot_presentase b on a.id_bobot_presentase=b.id_bobot_presentase WHERE id_dd_user={$id_user}")->row_array();
        $id_bobot_presentase = $qStatus['id_bobot_presentase'];
        $bobot_atasan = $qStatus['bobot_atasan'];
        $bobot_teman = $qStatus['bobot_teman'];
        $bobot_bawahan = $qStatus['bobot_bawahan'];
        $qAtasan = "SELECT id_dd_penilai,b.email from dd_penilai a join dd_user b ON a.id_dd_user_penilai=b.id_dd_user JOIN tblstruktural c on c.kodeunit=b.unit_kerja JOIN tbljabatan d on d.kodejab=b.jabatan WHERE 
		flag_user=0 AND a.id_dd_user=" . $id_user;
        $qTeman = "SELECT id_dd_penilai,b.email from dd_penilai a join dd_user b ON a.id_dd_user_penilai=b.id_dd_user JOIN tblstruktural c on c.kodeunit=b.unit_kerja JOIN tbljabatan d on d.kodejab=b.jabatan WHERE flag_user=1 AND a.id_dd_user=" . $id_user . " order by rand() limit 0,2";
        $qBawahan = "SELECT id_dd_penilai,b.email from dd_penilai a join dd_user b ON a.id_dd_user_penilai=b.id_dd_user JOIN tblstruktural c on c.kodeunit=b.unit_kerja JOIN tbljabatan d on d.kodejab=b.jabatan WHERE flag_user=2 AND a.id_dd_user=" . $id_user . " order by rand() limit 0,2";
        $getPenilai = $this->db->query($qAtasan)->row_array();
        $getTeman = $this->db->query($qTeman)->result_array();
        $getBawahan = $this->db->query($qBawahan)->result_array();
        $cekPengajuan = $this->db->where('id_dd_periode_penilaian', $id)->where('id_dd_user', $id_user)->from('opmt_penilaian')->count_all_results();
        if ($cekPengajuan > 0) {
            echo "Pengajuan Penilaian Perilaku  untuk Periode ini sudah dilakukan";
            die();
        }
        $this->db->trans_start();

        if (!empty($bobot_atasan)) {
            //Insert Penilai Atasan
            $data = array(
                'id_dd_user' => $id_user,
                'created_date' => date("Y-m-d H:i:s"),
                'id_dd_periode_penilaian' => $id,
                'id_bobot_presentase' => $id_bobot_presentase,
                'id_dd_penilai' => $getPenilai['id_dd_penilai'],
                'urut' => 1
            );
            $nama = $this->session->userdata('nama');
            $nip = $this->session->userdata('nip');
            $email = $getPenilai['email'];
            $subjek = "Aplikasi 360 - Penilaian Perilaku";
            $pesan = "Anda Terpilih menjadi Penilai Perilaku User " . $nama . " / " . $nip;
            if ($email !== "") {
         //       $this->kirim_email2($email, $subjek, $pesan);
            }
            $this->db->insert('opmt_penilaian', $data);
        }
        if (!empty($bobot_teman)) {
//Insert Penilai Teman
            $urut = 1;
            foreach ($getTeman as $dt) {
                $data = array(
                    'id_dd_user' => $id_user,
                    'created_date' => date("Y-m-d H:i:s"),
                    'id_dd_periode_penilaian' => $id,
                    'id_bobot_presentase' => $id_bobot_presentase,
                    'id_dd_penilai' => $dt['id_dd_penilai'],
                    'urut' => $urut
                );
                $nama = $this->session->userdata('nama');
                $nip = $this->session->userdata('nip');
                $email = $dt['email'];
                $subjek = "Aplikasi 360 - Penilaian Perilaku";
                $pesan = "Anda Terpilih menjadi Penilai Perilaku User " . $nama . " / " . $nip;
                if ($email !== "") {
          //          $this->kirim_email2($email, $subjek, $pesan);
                }
                $this->db->insert('opmt_penilaian', $data);
                $urut++;
            }
        }
        if (!empty($bobot_bawahan)) {
            //Insert Penilai Bawahan
            $urut = 1;
            foreach ($getBawahan as $dt) {
                $data = array(
                    'id_dd_user' => $id_user,
                    'created_date' => date("Y-m-d H:i:s"),
                    'id_dd_periode_penilaian' => $id,
                    'id_bobot_presentase' => $id_bobot_presentase,
                    'id_dd_penilai' => $dt['id_dd_penilai'],
                    'urut' => $urut
                );
                $nama = $this->session->userdata('nama');
                $nip = $this->session->userdata('nip');
                $email = $dt['email'];
                $subjek = "Aplikasi 360 - Penilaian Perilaku";
                $pesan = "Anda Terpilih menjadi Penilai Perilaku User " . $nama . " / " . $nip;
                if ($email !== "") {
             //       $this->kirim_email2($email, $subjek, $pesan);
                }
                $this->db->insert('opmt_penilaian', $data);
                $urut++;
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            echo 'ok';
        }
    }

    public function kirim_email($tujuan, $subjek, $isi) {
        $cfg = $this->db->from('cfg_email')->get()->row_array();
		
        $this->load->library("PhpMailerLib");
        $mail = $this->phpmailerlib->load();
        try {
            //Server settings
            $mail->SMTPDebug = 0;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = $cfg['hostname'];  // smtp.gmail.com
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = $cfg['username'];                 // SMTP username
            $mail->Password = $cfg['password'];                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = $cfg['port_email'];                                    // TCP port to connect to
            $mail->FromName = $cfg['sender_name'];
            $mail->From = $cfg['sender_email'];
            for ($i = 0; $i < count($tujuan); $i++) {
                $mail->addAddress($tujuan[$i]['email']);
            }// Add a recipient
            // $mail->addAddress('RECEIPIENTEMAIL02');               // Name is optional
            $mail->addReplyTo($cfg['sender_email'], $cfg['sender_name']);
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subjek;
            $mail->Body = $isi;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $kirim = $mail->send();
            if ($kirim) {
                return;
            }
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }

    public function kirim_email2($tujuan, $subjek, $isi) {
		   $cfg = $this->db->from('cfg_email')->get()->row_array();
		
        $this->load->library("PhpMailerLib");
        $mail = $this->phpmailerlib->load();
        try {
            //Server settings
            $mail->SMTPDebug = 0;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = $cfg['hostname'];  // smtp.gmail.com
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = $cfg['username'];                 // SMTP username
            $mail->Password = $cfg['password'];                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = $cfg['port_email'];                                    // TCP port to connect to
            $mail->FromName = $cfg['sender_name'];
            $mail->From = $cfg['sender_email'];
            $mail->addAddress($tujuan);     // Add a recipient
            // $mail->addAddress('RECEIPIENTEMAIL02');               // Name is optional
            $mail->addReplyTo($cfg['sender_email'], $cfg['sender_name']);
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subjek;
            $mail->Body = $isi;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $kirim = $mail->send();
            if ($kirim) {
                return;
            }
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }

    public function lihat_penilaian() {
        $this->load->view('penilaian/v_penilaian');
    }

    public function dt_penilaian() {
        $this->load->model("M_penilaian");
        $data = array();
        $no = $_POST['start'];
        $status = $_POST['status'];
        $ordercolumn = $_POST['order']['0']['column'];
        $orderdir = $_POST['order']['0']['dir'];
        $length = $_POST['length'];
        $search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : '';
        $listPenilaian = $this->M_penilaian->getListPenilaian($no, $length, $search, $ordercolumn, $orderdir);
        $rowcount = $this->M_penilaian->getListPenilaianCount($search);
        $linkCek = "";
        foreach ($listPenilaian as $dt) {
            $linkPenilaian = $dt->id_penilaian == null ? "<a href='#' onclick = 'mulai_penilaian($dt->id_opmt_penilaian)'><i class='fa fa-angle-double-up fa-2x'></i></a>" : "";
            $linkDetail = "<a href='#' onclick = 'detail_penilaian($dt->id_opmt_penilaian)'><i class='fa fa-list-alt fa-2x'></i></a>";

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = date('d F Y', strtotime($dt->created_date));
            $row[] = bulan($dt->bulan_periode);
            $row[] = $dt->tahun_periode;
            $row[] = $dt->nama;
            $row[] = $dt->nip;
            $row[] = $dt->jabatan;
            $row[] = $dt->unitkerja;
            $row[] = $dt->status;
            $row[] = $linkPenilaian;
            $row[] = $linkDetail;
            $row[] = $dt->id_penilaian !== null ? 'Sudah Dinilai' : 'Belum Dinilai';
            //$row[] = $dt->waktu_penilaian == null ? '' : date('d F Y', strtotime($dt->waktu_penilaian));
            $row[] = $dt->waktu_penilaian == null ? '' : date('d F Y - H:i:s', strtotime($dt->waktu_penilaian));
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

    public function mulai_penilaian($id) {
        $id_user = $this->session->userdata('id_user');
        $getDataUser = $this->db->select('nama,nip,coalesce(flag_eselon,0)flag_eselon,c.jenis', false)->where('id_opmt_penilaian', $id)->from('opmt_penilaian a')->join('dd_user b', 'a.id_dd_user=b.id_dd_user', 'INNER')->join('tbljabatan c', 'b.jabatan=c.kodejab', 'INNER')->get()->row_array();
        $flag_eselon = $getDataUser['flag_eselon'];
        $jabatan = $getDataUser['jenis'];
        $data['flag_eselon'] = $flag_eselon;
        $data['jabatan'] = $jabatan;
        $data['nama'] = $getDataUser['nama'];
        $data['nip'] = $getDataUser['nip'];
        $data['id_user'] = $id_user;
        $data['id'] = $id;
        $data['id_opmt_penilaian'] = $id;

        $data['pertanyaan_1'] = $this->db->where('flag_eselon', $flag_eselon)->where('id_group_pertanyaan', 1)->from('dd_pertanyaan')->order_by('RAND()')->limit(5)->get()->result_array();
        $data['pertanyaan_2'] = $this->db->where('flag_eselon', $flag_eselon)->where('id_group_pertanyaan', 2)->from('dd_pertanyaan')->order_by('RAND()')->limit(5)->get()->result_array();
        $data['pertanyaan_3'] = $this->db->where('flag_eselon', $flag_eselon)->where('id_group_pertanyaan', 3)->from('dd_pertanyaan')->order_by('RAND()')->limit(5)->get()->result_array();
        $data['pertanyaan_4'] = $this->db->where('flag_eselon', $flag_eselon)->where('id_group_pertanyaan', 4)->from('dd_pertanyaan')->order_by('RAND()')->limit(5)->get()->result_array();
        $data['pertanyaan_5'] = $this->db->where('flag_eselon', $flag_eselon)->where('id_group_pertanyaan', 5)->from('dd_pertanyaan')->order_by('RAND()')->limit(5)->get()->result_array();
        $data['pertanyaan_6'] = $this->db->where('flag_eselon', $flag_eselon)->where('id_group_pertanyaan', 6)->from('dd_pertanyaan')->order_by('RAND()')->limit(5)->get()->result_array();
        $this->load->view('penilaian/v_mulai_pertanyaan', $data);
    }

    public function prosesPenilaian() {
        $id_user = $this->session->userdata('id_user');
        $created_date = date("Y-m-d H:i:s");
        $post = $this->input->post();
        $id_opmt_penilaian = $post['id_opmt_penilaian'];
        $flag_eselon = $post['flag_eselon'];
        $jabatan = $post['jabatan'];
        $this->db->trans_start();
        $pertanyaan = $post['pertanyaan'];
        if (!empty($pertanyaan)) {
            for ($i = 0; $i < count($pertanyaan); $i++) {
                $parPertanyaan = explode('_', $pertanyaan[$i]);
                $id_dd_pertanyaan = $parPertanyaan[0];
                $jawaban = $parPertanyaan[1];
                $data = array(
                    'id_dd_user' => $id_user,
                    'id_opmt_penilaian' => $id_opmt_penilaian,
                    'id_dd_pertanyaan' => $id_dd_pertanyaan,
                    'jawaban' => $jawaban,
                    'created_date' => $created_date
                );
                $this->db->insert('opmt_penilaian_perilaku', $data);
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                $q1 = "select a.jawaban from opmt_penilaian_perilaku a
			join dd_pertanyaan b on a.id_dd_pertanyaan=b.id_dd_pertanyaan
			WHERE id_opmt_penilaian={$id_opmt_penilaian} AND b.id_group_pertanyaan=1 ";
                $data['hasil_penilaian1'] = $this->db->query($q1)->result_array();
                $q2 = "select a.jawaban from opmt_penilaian_perilaku a
			join dd_pertanyaan b on a.id_dd_pertanyaan=b.id_dd_pertanyaan
			WHERE id_opmt_penilaian={$id_opmt_penilaian} AND b.id_group_pertanyaan=2 ";
                $data['hasil_penilaian2'] = $this->db->query($q2)->result_array();
                $q3 = "select a.jawaban from opmt_penilaian_perilaku a
			join dd_pertanyaan b on a.id_dd_pertanyaan=b.id_dd_pertanyaan
			WHERE id_opmt_penilaian={$id_opmt_penilaian} AND b.id_group_pertanyaan=3 ";
                $data['hasil_penilaian3'] = $this->db->query($q3)->result_array();
                $q4 = "select a.jawaban from opmt_penilaian_perilaku a
			join dd_pertanyaan b on a.id_dd_pertanyaan=b.id_dd_pertanyaan
			WHERE id_opmt_penilaian={$id_opmt_penilaian} AND b.id_group_pertanyaan=4 ";
                $data['hasil_penilaian4'] = $this->db->query($q4)->result_array();
                $q5 = "select a.jawaban from opmt_penilaian_perilaku a
			join dd_pertanyaan b on a.id_dd_pertanyaan=b.id_dd_pertanyaan
			WHERE id_opmt_penilaian={$id_opmt_penilaian} AND b.id_group_pertanyaan=5 ";
                $data['hasil_penilaian5'] = $this->db->query($q5)->result_array();
                if ($flag_eselon == 1 || in_array($jabatan, array('JST', 'JS'))) {
                    $q6 = "select a.jawaban from opmt_penilaian_perilaku a
				join dd_pertanyaan b on a.id_dd_pertanyaan=b.id_dd_pertanyaan
				WHERE id_opmt_penilaian={$id_opmt_penilaian} AND b.id_group_pertanyaan=6 ";
                    $data['hasil_penilaian6'] = $this->db->query($q6)->result_array();
                }
                $data['flag_eselon'] = $flag_eselon;
                $data['jabatan'] = $jabatan;
                $this->load->view('penilaian/v_hasil_penilaian', $data);
            }
        }
    }

    public function tes($id_opmt_penilaian) {
        $flag_eselon = 0;
        $q1 = "select a.jawaban from opmt_penilaian_perilaku a
		join dd_pertanyaan b on a.id_dd_pertanyaan=b.id_dd_pertanyaan
		WHERE id_opmt_penilaian={$id_opmt_penilaian} AND b.id_group_pertanyaan=1 ";
        $data['hasil_penilaian1'] = $this->db->query($q1)->result_array();
        $q2 = "select a.jawaban from opmt_penilaian_perilaku a
		join dd_pertanyaan b on a.id_dd_pertanyaan=b.id_dd_pertanyaan
		WHERE id_opmt_penilaian={$id_opmt_penilaian} AND b.id_group_pertanyaan=2 ";
        $data['hasil_penilaian2'] = $this->db->query($q2)->result_array();
        $q3 = "select a.jawaban from opmt_penilaian_perilaku a
		join dd_pertanyaan b on a.id_dd_pertanyaan=b.id_dd_pertanyaan
		WHERE id_opmt_penilaian={$id_opmt_penilaian} AND b.id_group_pertanyaan=3 ";
        $data['hasil_penilaian3'] = $this->db->query($q3)->result_array();
        $q4 = "select a.jawaban from opmt_penilaian_perilaku a
		join dd_pertanyaan b on a.id_dd_pertanyaan=b.id_dd_pertanyaan
		WHERE id_opmt_penilaian={$id_opmt_penilaian} AND b.id_group_pertanyaan=4 ";
        $data['hasil_penilaian4'] = $this->db->query($q4)->result_array();
        $q5 = "select a.jawaban from opmt_penilaian_perilaku a
		join dd_pertanyaan b on a.id_dd_pertanyaan=b.id_dd_pertanyaan
		WHERE id_opmt_penilaian={$id_opmt_penilaian} AND b.id_group_pertanyaan=5 ";
        $data['hasil_penilaian5'] = $this->db->query($q5)->result_array();
        if ($flag_eselon == 1) {
            $q6 = "select a.jawaban from opmt_penilaian_perilaku a
			join dd_pertanyaan b on a.id_dd_pertanyaan=b.id_dd_pertanyaan
			WHERE id_opmt_penilaian={$id_opmt_penilaian} AND b.id_group_pertanyaan=6 ";
            $data['hasil_penilaian6'] = $this->db->query($q6)->result_array();
        }
        $data['flag_eselon'] = $flag_eselon;
        $this->load->view('penilaian/v_hasil_penilaian', $data);
    }

    public function detail_penilaian($id_opmt_penilaian) {
        $getDataUser = $this->db->select('nama,nip,coalesce(flag_eselon,0)flag_eselon,c.jenis', false)->where('id_opmt_penilaian', $id_opmt_penilaian)->from('opmt_penilaian a')->join('dd_user b', 'a.id_dd_user=b.id_dd_user', 'INNER')->join('tbljabatan c', 'b.jabatan=c.kodejab', 'INNER')->get()->row_array();
        $flag_eselon = $getDataUser['flag_eselon'];
        $jabatan = $getDataUser['jenis'];
        $data['flag_eselon'] = $flag_eselon;

        $data['jabatan'] = $jabatan;
        $data['nama'] = $getDataUser['nama'];
        $data['nip'] = $getDataUser['nip'];
        $data['id'] = $id_opmt_penilaian;
        $q1 = "select b.*,a.jawaban from opmt_penilaian_perilaku a
		join dd_pertanyaan b on a.id_dd_pertanyaan=b.id_dd_pertanyaan
		WHERE id_opmt_penilaian={$id_opmt_penilaian} AND b.id_group_pertanyaan=1 ";
        $data['hasil_penilaian1'] = $this->db->query($q1)->result_array();
        $q2 = "select b.*,a.jawaban from opmt_penilaian_perilaku a
		join dd_pertanyaan b on a.id_dd_pertanyaan=b.id_dd_pertanyaan
		WHERE id_opmt_penilaian={$id_opmt_penilaian} AND b.id_group_pertanyaan=2 ";
        $data['hasil_penilaian2'] = $this->db->query($q2)->result_array();
        $q3 = "select b.*,a.jawaban from opmt_penilaian_perilaku a
		join dd_pertanyaan b on a.id_dd_pertanyaan=b.id_dd_pertanyaan
		WHERE id_opmt_penilaian={$id_opmt_penilaian} AND b.id_group_pertanyaan=3 ";
        $data['hasil_penilaian3'] = $this->db->query($q3)->result_array();
        $q4 = "select b.*,a.jawaban from opmt_penilaian_perilaku a
		join dd_pertanyaan b on a.id_dd_pertanyaan=b.id_dd_pertanyaan
		WHERE id_opmt_penilaian={$id_opmt_penilaian} AND b.id_group_pertanyaan=4 ";
        $data['hasil_penilaian4'] = $this->db->query($q4)->result_array();
        $q5 = "select b.*,a.jawaban from opmt_penilaian_perilaku a
		join dd_pertanyaan b on a.id_dd_pertanyaan=b.id_dd_pertanyaan
		WHERE id_opmt_penilaian={$id_opmt_penilaian} AND b.id_group_pertanyaan=5 ";
        $data['hasil_penilaian5'] = $this->db->query($q5)->result_array();
        if ($flag_eselon == 1 || in_array($jabatan, array('JST', 'JS'))) {
            $q6 = "select b.*,a.jawaban from opmt_penilaian_perilaku a
			join dd_pertanyaan b on a.id_dd_pertanyaan=b.id_dd_pertanyaan
			WHERE id_opmt_penilaian={$id_opmt_penilaian} AND b.id_group_pertanyaan=6 ";
            $data['hasil_penilaian6'] = $this->db->query($q6)->result_array();
        }

        $this->load->view('penilaian/v_detail_penilaian', $data);
    }

    public function hasil() {
        $this->load->view('penilaian/v_hasil');
    }

    public function dt_hasil() {
        $this->load->model("M_penilaian");
        $data = array();
        $no = $_POST['start'];
        $status = $_POST['status'];
        $ordercolumn = $_POST['order']['0']['column'];
        $orderdir = $_POST['order']['0']['dir'];
        $length = $_POST['length'];
        $search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : '';
        $listPenilaian = $this->M_penilaian->getListHasil($no, $length, $search, $ordercolumn, $orderdir);
        $rowcount = $this->M_penilaian->getListHasilCount($search);
        $linkCek = "";
//        echo json_encode($listPenilaian);
        foreach ($listPenilaian as $dt) {
            $linkDetail = "<a href='#' onclick = 'detail($dt->id_dd_periode_penilaian)'><i class='fa fa-list-alt fa-2x'></i></a>";
            $linkDetailKandidat = "<a href='#' onclick = 'detail_kandidat($dt->id_dd_periode_penilaian)'><i class='fa fa-lock text-red fa-2x'></i></a>";

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = bulan($dt->bulan_periode);
            $row[] = $dt->tahun_periode;
            $row[] = date('d F Y', strtotime($dt->tgl_pengajuan));
            $row[] = $dt->status_kelengkapan;
            if ($dt->bobot_atasan == null) {
                $row[] = '-';
            } elseif ($dt->atasan == 1) {
                $row[] = 'Sudah Dinilai';
            } else {
                $row[] = 'Belum Dinilai';
            }
            if ($dt->bobot_teman == null) {
                $row[] = '-';
            } elseif ($dt->teman_1 == 1) {
                $row[] = 'Sudah Dinilai';
            } else {
                $row[] = 'Belum Dinilai';
            }
            if ($dt->bobot_teman == null) {
                $row[] = '-';
            } elseif ($dt->teman_2 == 1) {
                $row[] = 'Sudah Dinilai';
            } else {
                $row[] = 'Belum Dinilai';
            }
            if ($dt->bobot_bawahan == null) {
                $row[] = '-';
            } elseif ($dt->bawahan_1 == 1) {
                $row[] = 'Sudah Dinilai';
            } else {
                $row[] = 'Belum Dinilai';
            };
            if ($dt->bobot_bawahan == null) {
                $row[] = '-';
            } elseif ($dt->bawahan_2 == 1) {
                $row[] = 'Sudah Dinilai';
            } else {
                $row[] = 'Belum Dinilai';
            };
            $row[] = $linkDetail;
            $row[] = $linkDetailKandidat;

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

    public function lihat_detail($id) {
        $id_user = $this->session->userdata('id_user');
        $data['bobot'] = $this->db->query("SELECT
			b.bobot_atasan,b.bobot_teman,b.bobot_bawahan 
			FROM
			opmt_penilaian a
			JOIN dd_bobot_presentase b ON a.id_bobot_presentase = b.id_bobot_presentase
			where a.id_dd_periode_penilaian=" . $id . " AND a.id_dd_user=" . $id_user)->row_array();
        $data['atasan'] = $this->db->query($this->q_detail(0, $id, 1))->result_array();
        $data['teman_1'] = $this->db->query($this->q_detail(1, $id, 1))->result_array();
        $data['teman_2'] = $this->db->query($this->q_detail(1, $id, 2))->result_array();
        $data['bawahan_1'] = $this->db->query($this->q_detail(2, $id, 1))->result_array();
        $data['bawahan_2'] = $this->db->query($this->q_detail(2, $id, 2))->result_array();
        $data['id'] = $id;
        $data['id_user'] = $id_user;

        $this->load->view('penilaian/v_detail', $data);
    }
    
    public function update_perilaku(){
        $post=$this->input->post();
        $id=$post['id'];
        
        $id_dd_user = $this->session->userdata('id_user');        
        //$id_dd_user=$post['id_user'];
        var_dump($id_dd_user);
        $getPeriode=$this->db->where('id_dd_periode_penilaian',$id)->get('dd_periode_penilaian')->row();
        $tahun=$getPeriode->tahun_periode;
        $bulan=$getPeriode->bulan_periode;
        $cek=$this->db->where('id_dd_user',$id_dd_user)->where('tahun',$tahun)->where('bulan',$bulan)->get('opmt_perilaku')->row();
        $data=array(
            'id_dd_user'=>$id_dd_user,
            'tahun'=>$tahun,
            'bulan'=>$bulan,
            'orientasi_pelayanan'=>$post['nilai_1'],
            'integritas'=>$post['nilai_2'],
            'komitmen'=>$post['nilai_3'],
            'disiplin'=>$post['nilai_4'],
            'kerjasama'=>$post['nilai_5'],
            'kepemimpinan'=>$post['nilai_6']
        
        );
        
        if(isset($cek->id_dd_user)){
            //$this->db->where('id_opmt_perilaku',$id_opmt_perilaku)->update('opmt_perilaku',$data);
            $this->db->where('id_dd_user',$id_dd_user)->where('tahun',$tahun)->where('bulan',$bulan)->update('opmt_perilaku',$data);
        }else{
            $this->db->insert('opmt_perilaku',$data);
        }
    }
    
    public function adm_hapus_penilaian(){
        $data['periode']=$this->db->order_by('tahun_periode','DESC')->order_by('bulan_periode','DESC')->get('dd_periode_penilaian')->result();
        $this->load->view('penilaian/v_admin_utama',$data);
    }
    
    public function adm_hapus_pengajuan(){
        $data['periode']=$this->db->order_by('tahun_periode','DESC')->order_by('bulan_periode','DESC')->get('dd_periode_penilaian')->result();
        $this->load->view('penilaian/v_admin_utama2',$data);
    }
    
    public function hapus_penilaian(){
        $post=$this->input->post();
        $id_opmt_penilaian=$post['id_opmt_penilaian'];
        $id_dd_user=$post['id_user'];
        $hapus=$this->db->where('id_opmt_penilaian',$id_opmt_penilaian)->where('id_dd_user',$id_dd_user)->delete('opmt_penilaian_perilaku');
        if($hapus){
            echo 'ok';
        }
    }
    
    public function hapus_pengajuan(){
        $post=$this->input->post();
        $id_user=$post['id_user'];
        $id_dd_periode_penilaian=$post['id_dd_periode_penilaian'];
        $q1="DELETE FROM opmt_penilaian_perilaku WHERE id_opmt_penilaian IN(SELECT  id_opmt_penilaian FROM opmt_penilaian WHERE id_dd_user=$id_user AND id_dd_periode_penilaian=$id_dd_periode_penilaian)";
        $hapus_penilaian=$this->db->query($q1);
        if($hapus_penilaian){
            $hapus_pengajuan=$this->db->query("DELETE FROM opmt_penilaian WHERE id_dd_user=$id_user AND id_dd_periode_penilaian=$id_dd_periode_penilaian");
            if($hapus_pengajuan){
                echo "ok";
            }
        }
    }

    public function lihat_detail_admin() {
     $post=$this->input->post();
     $id=$post['id'];
     $id_user=$post['id_user'];
        $data['bobot'] = $this->db->query("SELECT
            b.bobot_atasan,b.bobot_teman,b.bobot_bawahan 
            FROM
            opmt_penilaian a
            JOIN dd_bobot_presentase b ON a.id_bobot_presentase = b.id_bobot_presentase
            where a.id_dd_periode_penilaian=" . $id . " AND a.id_dd_user=" . $id_user)->row_array();
        
        $data['atasan'] = $this->db->query($this->q_detail_admin(0, $id, 1,$id_user))->result_array();
        $data['teman_1'] = $this->db->query($this->q_detail_admin(1, $id, 1,$id_user))->result_array();
        $data['teman_2'] = $this->db->query($this->q_detail_admin(1, $id, 2,$id_user))->result_array();
        //die($this->q_detail(1, $id, 2));
        $data['bawahan_1'] = $this->db->query($this->q_detail_admin(2, $id, 1,$id_user))->result_array();
        $data['bawahan_2'] = $this->db->query($this->q_detail_admin(2, $id, 2,$id_user))->result_array();

        $this->load->view('penilaian/v_detail_admin', $data);
    }

    public function lihat_detail_admin2() {
     $post=$this->input->post();
     $id=$post['id'];
     $id_user=$post['id_user'];
        $data['penilaian'] = $this->db->query("SELECT   xx.id_dd_periode_penilaian,
        xx.bulan_periode,
        xx.tahun_periode,
        xx. tgl_pengajuan,bobot_atasan,bobot_teman,bobot_bawahan,
        xx. status_kelengkapan, SUM(xx.atasan)atasan, SUM(teman_1)teman_1, SUM(teman_2)teman_2, SUM(bawahan_1)bawahan_1, SUM(bawahan_2)bawahan_2
        FROM(
        SELECT
        x.id_dd_periode_penilaian,
        y.bulan_periode,
        y.tahun_periode,
        x.created_date tgl_pengajuan,bobot_atasan,bobot_teman,bobot_bawahan,
        x.keterangan status_kelengkapan, IF(bobot_atasan IS NULL,'-', IF(x.flag_user=0 AND x.id_dd_user>0,1,0))atasan, IF(bobot_teman IS NULL,'-', IF(x.flag_user=1 AND x.id_dd_user>0 AND x.urut=1,1,0))teman_1, IF(bobot_teman IS NULL,'-', IF(x.flag_user=1 AND x.id_dd_user>0 AND x.urut=2,1,0))teman_2, IF(bobot_bawahan IS NULL,'-', IF(x.flag_user=2 AND x.id_dd_user>0 AND x.urut=1,1,0))bawahan_1, IF(bobot_bawahan IS NULL,'-', IF(x.flag_user=2 AND x.id_dd_user>0 AND x.urut=2,1,0))bawahan_2
        FROM
        (
        SELECT
        a.id_dd_periode_penilaian,
        a.created_date,
        a.urut,
        b.keterangan,
        b.bobot_atasan,
        b.bobot_teman,
        b.bobot_bawahan,
        c.flag_user,
        d.id_dd_user
        FROM
        opmt_penilaian a
        JOIN dd_bobot_presentase b ON a.id_bobot_presentase = b.id_bobot_presentase
        JOIN dd_penilai c ON c.id_dd_penilai = a.id_dd_penilai
        LEFT JOIN (
        SELECT DISTINCT id_opmt_penilaian, id_dd_user
        FROM opmt_penilaian_perilaku) d ON d.id_opmt_penilaian = a.id_opmt_penilaian AND c.id_dd_user_penilai = d.id_dd_user
        WHERE a.id_dd_user={$id_user}
        ) x
        JOIN dd_periode_penilaian y ON x.id_dd_periode_penilaian=y.id_dd_periode_penilaian
        WHERE x.id_dd_periode_penilaian=$id
        GROUP BY
        x.id_dd_periode_penilaian,
        x.created_date,
        x.keterangan,
        x.flag_user,
        x.urut
        )xx
        GROUP BY 
        xx.id_dd_periode_penilaian,
        xx.bulan_periode,
        xx.tahun_periode,
        xx.tgl_pengajuan ,
        xx.status_kelengkapan ")->row();
        $data['id_user']=$id_user;
        $this->load->view('penilaian/v_detail_admin2', $data);
    }

    public function q_detail_admin($flag_user, $id_dd_periode_penilaian, $urut,$id_user) {
           if ($flag_user == 0) {
            $parSelect = "e.bobot_atasan";
        } elseif ($flag_user == 1) {
            $parSelect = "e.bobot_teman";
        } else {
            $parSelect = "e.bobot_bawahan";
        }
        $q = "SELECT
        a.id_dd_user,a.id_opmt_penilaian,sum( a.jawaban ) ttl_jawaban, c.id_group_pertanyaan,
        b.id_bobot_presentase,{$parSelect},f.group_pertanyaan
        FROM
        opmt_penilaian_perilaku a
        JOIN dd_pertanyaan c ON c.id_dd_pertanyaan = a.id_dd_pertanyaan
        JOIN opmt_penilaian b ON a.id_opmt_penilaian = b.id_opmt_penilaian
        JOIN dd_penilai d ON d.id_dd_penilai = b.id_dd_penilai AND a.id_dd_user=d.id_dd_user_penilai
        join dd_bobot_presentase e on e.id_bobot_presentase =b.id_bobot_presentase
        join dd_group_pertanyaan f on f.id_group_pertanyaan=c.id_group_pertanyaan
        WHERE
        d.flag_user = " . $flag_user . " 
                AND b.id_dd_periode_penilaian = " . $id_dd_periode_penilaian . " AND b.id_dd_user={$id_user}
        AND b.urut=" . $urut . "    
        GROUP BY
        a.id_dd_user,a.id_opmt_penilaian,
        c.id_group_pertanyaan,
        b.id_bobot_presentase";
        
        return $q;
    }

    public function q_detail($flag_user, $id_dd_periode_penilaian, $urut) {
        $id_user = $this->session->userdata('id_user');
        if ($flag_user == 0) {
            $parSelect = "e.bobot_atasan";
        } elseif ($flag_user == 1) {
            $parSelect = "e.bobot_teman";
        } else {
            $parSelect = "e.bobot_bawahan";
        }
        $q = "SELECT
		sum( a.jawaban ) ttl_jawaban, c.id_group_pertanyaan,
		b.id_bobot_presentase,{$parSelect},f.group_pertanyaan
		FROM
		opmt_penilaian_perilaku a
		JOIN dd_pertanyaan c ON c.id_dd_pertanyaan = a.id_dd_pertanyaan
		JOIN opmt_penilaian b ON a.id_opmt_penilaian = b.id_opmt_penilaian
		JOIN dd_penilai d ON d.id_dd_penilai = b.id_dd_penilai
		join dd_bobot_presentase e on e.id_bobot_presentase =b.id_bobot_presentase
		join dd_group_pertanyaan f on f.id_group_pertanyaan=c.id_group_pertanyaan
		WHERE
		d.flag_user = " . $flag_user . " 
                AND b.id_dd_periode_penilaian = " . $id_dd_periode_penilaian . " AND b.id_dd_user={$id_user}
		AND b.urut=" . $urut . "	
		GROUP BY
		c.id_group_pertanyaan,
		b.id_bobot_presentase";
        return $q;
    }

    public function cek_pwd_kandidat() {
        $id_user = $this->session->userdata('id_user');
        $id_dd_periode_penilaian = $this->input->post('id');
        $pwd = $this->input->post('pwd');
        $cek = $this->db->from('cfg_password')->where('password', $pwd)->count_all_results();
        if ($cek > 0) {
            $q = "select d.nama,d.nip,a.urut,e.jabatan,f.unitkerja,c.flag_user from opmt_penilaian a 
			join dd_periode_penilaian b on a.id_dd_periode_penilaian=b.id_dd_periode_penilaian
			join dd_penilai c on a.id_dd_penilai=c.id_dd_penilai
			join dd_user d on d.id_dd_user=c.id_dd_user_penilai
			join tbljabatan e on e.kodejab=d.jabatan
			join tblstruktural f on f.kodeunit=d.unit_kerja
                        where a.id_dd_periode_penilaian={$id_dd_periode_penilaian} AND a.id_dd_user={$id_user}
			order by flag_user";
            $data['detail'] = $this->db->query($q)->result_array();
            $ket = $this->load->view('penilaian/v_detail_kandidat', $data);
            $resp = array('kode' => 1, 'ket' => $ket);
        } else {
            echo 'no';
        }
    }

    public function perilaku_tahunan() {
        $data['tahun'] = $this->db->query('SELECT DISTINCT tahun_periode tahun FROM dd_periode_penilaian')->result_array();
        $this->load->view('penilaian/v_perilaku_tahunan', $data);
    }

    public function dt_perilaku_tahunan() {
	$data['id_user']=$this->session->userdata('id_user');
        $tahun = $this->input->post('tahun');
        $dtPeriode = $this->db->where('tahun_periode', $tahun)->from('dd_periode_penilaian')->get()->result_array();
        $data['periode'] = $dtPeriode;
        foreach ($dtPeriode as $dt) {
            $id_dd_periode_penilaian = $dt['id_dd_periode_penilaian'];
            $q = $this->qPerilakuTahunan($id_dd_periode_penilaian);
//echo $q.'<br><br>';
            $dtPenilaian[] = $this->db->query($q)->result_array();
        }
        $data['penilaian'] = $dtPenilaian;
        if (count($dtPenilaian[0]) === 0) {
            die('<b>Belum ada pengajuan penilaian</b>');
        } else {

            $this->load->view('penilaian/v_detail_perilaku_tahunan', $data);
        }
    }

    public function qPerilakuTahunan($id) {
        $id_user = $this->session->userdata('id_user');
        $q = "SELECT id_group_pertanyaan,group_pertanyaan,id_dd_periode_penilaian, SUM(ttl_jawaban)ttl_jawaban
		FROM(
		SELECT SUM(a.jawaban*e.bobot_atasan*4) ttl_jawaban, c.id_group_pertanyaan,
		e.bobot_atasan bobot,f.group_pertanyaan,b.id_dd_periode_penilaian,'atasan' ket
		FROM
		opmt_penilaian_perilaku a
		JOIN dd_pertanyaan c ON c.id_dd_pertanyaan = a.id_dd_pertanyaan
		JOIN opmt_penilaian b ON a.id_opmt_penilaian = b.id_opmt_penilaian
		JOIN dd_penilai d ON d.id_dd_penilai = b.id_dd_penilai
		JOIN dd_bobot_presentase e ON e.id_bobot_presentase =b.id_bobot_presentase
		JOIN dd_group_pertanyaan f ON f.id_group_pertanyaan=c.id_group_pertanyaan
		WHERE
                d.flag_user = 0 AND b.urut=1 and b.id_dd_user={$id_user} AND b.id_dd_periode_penilaian={$id}
		GROUP BY
		c.id_group_pertanyaan,
		b.id_bobot_presentase UNION ALL
		SELECT avg(ttl_jawaban),id_group_pertanyaan,bobot_teman,group_pertanyaan,id_dd_periode_penilaian,'rata_teman'ket
		FROM(
		SELECT SUM(a.jawaban*e.bobot_teman*4) ttl_jawaban, c.id_group_pertanyaan,
		e.bobot_teman,f.group_pertanyaan,b.id_dd_periode_penilaian,'teman_1' ket
		FROM
		opmt_penilaian_perilaku a
		JOIN dd_pertanyaan c ON c.id_dd_pertanyaan = a.id_dd_pertanyaan
		JOIN opmt_penilaian b ON a.id_opmt_penilaian = b.id_opmt_penilaian
		JOIN dd_penilai d ON d.id_dd_penilai = b.id_dd_penilai
		JOIN dd_bobot_presentase e ON e.id_bobot_presentase =b.id_bobot_presentase
		JOIN dd_group_pertanyaan f ON f.id_group_pertanyaan=c.id_group_pertanyaan
		WHERE
		d.flag_user = 1 AND b.urut=1 and b.id_dd_user={$id_user} AND b.id_dd_periode_penilaian={$id}
		GROUP BY
		c.id_group_pertanyaan,
		b.id_bobot_presentase UNION ALL
		SELECT SUM(a.jawaban*e.bobot_teman*4) ttl_jawaban, c.id_group_pertanyaan,
		e.bobot_teman,f.group_pertanyaan,b.id_dd_periode_penilaian,'teman_2' ket
		FROM
		opmt_penilaian_perilaku a
		JOIN dd_pertanyaan c ON c.id_dd_pertanyaan = a.id_dd_pertanyaan
		JOIN opmt_penilaian b ON a.id_opmt_penilaian = b.id_opmt_penilaian
		JOIN dd_penilai d ON d.id_dd_penilai = b.id_dd_penilai
		JOIN dd_bobot_presentase e ON e.id_bobot_presentase =b.id_bobot_presentase
		JOIN dd_group_pertanyaan f ON f.id_group_pertanyaan=c.id_group_pertanyaan
		WHERE
		d.flag_user = 1 AND b.urut=2 and b.id_dd_user={$id_user} AND b.id_dd_periode_penilaian={$id}
		GROUP BY
		c.id_group_pertanyaan,
		b.id_bobot_presentase 
		)a
		group by id_group_pertanyaan,bobot_teman,group_pertanyaan,id_dd_periode_penilaian
		UNION ALL
		SELECT avg(ttl_jawaban),id_group_pertanyaan,bobot_bawahan,group_pertanyaan,id_dd_periode_penilaian,'rata_teman'ket
		FROM(
		SELECT SUM(a.jawaban*e.bobot_bawahan*4) ttl_jawaban, c.id_group_pertanyaan,
		e.bobot_bawahan,f.group_pertanyaan,b.id_dd_periode_penilaian,'bawahan_1' ket
		FROM
		opmt_penilaian_perilaku a
		JOIN dd_pertanyaan c ON c.id_dd_pertanyaan = a.id_dd_pertanyaan
		JOIN opmt_penilaian b ON a.id_opmt_penilaian = b.id_opmt_penilaian
		JOIN dd_penilai d ON d.id_dd_penilai = b.id_dd_penilai
		JOIN dd_bobot_presentase e ON e.id_bobot_presentase =b.id_bobot_presentase
		JOIN dd_group_pertanyaan f ON f.id_group_pertanyaan=c.id_group_pertanyaan
		WHERE
		d.flag_user = 2 AND b.urut=1 and b.id_dd_user={$id_user} AND b.id_dd_periode_penilaian={$id}
		GROUP BY
		c.id_group_pertanyaan,
		b.id_bobot_presentase UNION ALL
		SELECT SUM(a.jawaban*e.bobot_bawahan*4) ttl_jawaban, c.id_group_pertanyaan,
		e.bobot_bawahan,f.group_pertanyaan,b.id_dd_periode_penilaian,'bawahan_2' ket
		FROM
		opmt_penilaian_perilaku a
		JOIN dd_pertanyaan c ON c.id_dd_pertanyaan = a.id_dd_pertanyaan
		JOIN opmt_penilaian b ON a.id_opmt_penilaian = b.id_opmt_penilaian
		JOIN dd_penilai d ON d.id_dd_penilai = b.id_dd_penilai
		JOIN dd_bobot_presentase e ON e.id_bobot_presentase =b.id_bobot_presentase
		JOIN dd_group_pertanyaan f ON f.id_group_pertanyaan=c.id_group_pertanyaan
		WHERE
		d.flag_user = 2 AND b.urut=2 and b.id_dd_user={$id_user} AND b.id_dd_periode_penilaian={$id}
		GROUP BY
		c.id_group_pertanyaan,
		b.id_bobot_presentase 
		)a
		group by id_group_pertanyaan,bobot_bawahan,group_pertanyaan,id_dd_periode_penilaian
		)a 
		WHERE id_dd_periode_penilaian={$id}
		GROUP BY id_group_pertanyaan,group_pertanyaan,id_dd_periode_penilaian ORDER BY id_group_pertanyaan ASC";
        return $q;
    }

    public function prosesPerilakuTahunan() {
        $post = $this->input->post();
        $periode = $post['periode'];
        $nilai = $post['nilai'];
        $id_user = $this->session->userdata('id_user');
        
        for ($i = 0; $i < count($periode); $i++) {
            $id_dd_periode_penilaian = $periode[$i];
            if ($nilai[$i] > 0) {
                $cek = $this->db->where('id_dd_user', $id_user)->where('id_dd_periode_penilaian', $id_dd_periode_penilaian)->from('opmt_perilaku_tahunan')->count_all_results();
                if ($cek == 0) {
                    $data = array(
                        'id_dd_user' => $id_user,
                        'id_dd_periode_penilaian' => $id_dd_periode_penilaian,
                        'nilai' => $nilai[$i],
                        'created_date' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('opmt_perilaku_tahunan', $data);
                } else {
                    $data = array(
                        'nilai' => $nilai[$i],
                        'created_date' => date('Y-m-d H:i:s')
                    );
                    $this->db->where('id_dd_user', $id_user);
                    $this->db->where('id_dd_periode_penilaian', $id_dd_periode_penilaian);
                    $this->db->update('opmt_perilaku_tahunan', $data);
                }
            }
        }
	    $dtTahunan['id_dd_user']= decrypt_nilai($post['id_dd_user']);
		$dtTahunan['tahun']= decrypt_nilai($post['tahun']);
		$dtTahunan['nilai_0']= decrypt_nilai($post['nilai_0']);
		$dtTahunan['nilai_1']= decrypt_nilai($post['nilai_1']);
		$dtTahunan['nilai_2']= decrypt_nilai($post['nilai_2']);
		$dtTahunan['nilai_3']= decrypt_nilai($post['nilai_3']);
		$dtTahunan['nilai_4']= decrypt_nilai($post['nilai_4']);
		$dtTahunan['nilai_5']= decrypt_nilai($post['nilai_5']);
		$dtTahunan['nilai_akhir']= decrypt_nilai($post['nilai_akhir']);
		$dtTahunan['simpan_oleh']= $dtTahunan['id_dd_user'];
		$dtTahunan['simpan_tgl']= date("Y-m-d H:i:s");
		//$cek=$this->db->from('opmt_perilaku_tahunan_sum')->where('id_dd_user',$post['id_dd_user'])->where('tahun',$post['tahun'])->get()->row();
		//if($cek){
		    
		$hitung = $this->db->where('id_dd_user', $dtTahunan['id_dd_user'])->where('tahun', $dtTahunan['tahun'])->from('opmt_perilaku_tahunan_sum')->count_all_results();
		$data=$this->db->from('opmt_perilaku_tahunan_sum')->where('id_dd_user',$dtTahunan['id_dd_user'])->where('tahun',$dtTahunan['tahun'])->get()->row();
		
		if($hitung>0){ // WARNING : 500 (Internal Server Error)
			$this->db->where('id_opmt_perilaku_tahunan_sum',$data->id_opmt_perilaku_tahunan_sum);
			$proses=$this->db->update('opmt_perilaku_tahunan_sum',$dtTahunan);
		}else{
			$proses=$this->db->insert('opmt_perilaku_tahunan_sum',$dtTahunan);
		}
        echo 'SUKSES, Data Berhasil Disimpan';
    }
    
    public function konfirm_hapus($id_user,$id_penilaian){
    $getUser=$this->db->where('id_dd_user',$id_user)->get('dd_user')->row();
    $data['user']=$getUser->nama;
    $data['id_user']=$id_user;
    $data['id_opmt_penilaian']=$id_penilaian;
    $data['id_penilaian']=$id_penilaian;
    $this->load->view('penilaian/v_konfirm_hapus',$data);
        
    }
    
    public function konfirm_hapus_pengajuan($id_user,$id_dd_periode_penilaian){
    $getUser=$this->db->where('id_dd_user',$id_user)->get('dd_user')->row();
    $getPeriode=$this->db->where('id_dd_periode_penilaian',$id_dd_periode_penilaian)->get('dd_periode_penilaian')->row();
    $data['id_dd_periode_penilaian']=$id_dd_periode_penilaian;
    $data['id_user']=$id_user;
    $data['user']=$getUser->nama;
    $data['nip']=$getUser->nip;
    $data['bulan']=$getPeriode->bulan_periode;
    $data['tahun']=$getPeriode->tahun_periode;

    $this->load->view('penilaian/v_konfirm_hapus_pengajuan',$data);
        
    }
    
    
    public function update_penilaian(){
    $post=$this->input->post();
    $id_user=$this->session->userdata('id_user');
    $getJawaban=explode("_",$post['jawaban']);
    $id_dd_pertanyaan=$getJawaban[0];
    $jawaban=$getJawaban[1];
    $data['jawaban']=$jawaban;
    $update=$this->db->where('id_dd_user',$id_user)->where('id_dd_pertanyaan',$id_dd_pertanyaan)->update('opmt_penilaian_perilaku',$data);
    if($update){
    echo "sukses";
    }
    }
    
    public function rekapitulasi(){
          $data['unit'] = $this->db->order_by('unitkerja','asc')->where('SUBSTR(kodeunit,4,2)','00')->get('tblstruktural')->result();
        $data['periode']=$this->db->order_by('tahun_periode','DESC')->order_by('bulan_periode','DESC')->get('dd_periode_penilaian')->result();
        $this->load->view('penilaian/v_rekapitulasi_utama',$data);
    }
    
    public function cariPenilaian(){
        $post=$this->input->post();
        $periode=$post['periode'];
        $kodeunit=$post['kodeunit'];
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
        $this->load->view('penilaian/v_rekapitulasi_detail',$data);
    }

}
