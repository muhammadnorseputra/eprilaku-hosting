<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_api extends CI_Model {
	public function get_nilai_thnnip($thn, $nip)
    {
        $query = $this->db->query("select u.nip, opt.* from opmt_perilaku_tahunan_sum as opt, dd_user as u where opt.id_dd_user = u.id_dd_user and u.nip = '".$nip."' and opt.tahun = '".$thn."'");

        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else {
            return "Data tidak ditemukan";    
        }     
    }

    public function get_evaluator_thnnip($thn, $nip)
    {
        // Seluruh Evaluator
        //$query = $this->db->query("select u.nip, d.id_dd_user_penilai, d.flag_user from dd_penilai as d, dd_user as u where d.id_dd_user = u.id_dd_user and u.nip = '".$nip."' and d.created_date like '".$thn."-%' order by d.flag_user");
        
        // Hanya evaluator yang terpilih sebagai penilai saja
        //$query = $this->db->query("select u.nip, d.id_dd_user_penilai, d.flag_user from dd_penilai as d, opmt_penilaian as op, dd_user as u where op.id_dd_penilai = d.id_dd_penilai and d.id_dd_user = u.id_dd_user and u.nip = '".$nip."' and d.created_date like '".$thn."-%' order by d.flag_user");

        // Seluruh evaluator, dan yang terpilih sebagai penilai (op.id_opmt_penilaian != NULL)
        $query = $this->db->query("select d.*, op.urut from dd_penilai as d left join opmt_penilaian as op on op.id_dd_penilai = d.id_dd_penilai, dd_user as u where d.id_dd_user = u.id_dd_user and u.nip = '".$nip."' and d.created_date like '".$thn."-%' order by d.flag_user");


        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else {
            return "Data tidak ditemukan";    
        }     
    }

    function getnipuser($id_user) {
	  	$this->db->select('nip');
		$this->db->from('dd_user');
	    $this->db->where('id_dd_user', $id_user);
	    $get = $this->db->get()->row();

		return $get->nip;
	}
	
	function getiduser($nip) {
	  	$this->db->select('id_dd_user');
		$this->db->from('dd_user');
	    $this->db->where('nip', $nip);
	    $get = $this->db->get()->row();

		return $get->id_dd_user;
	}
	
	function getstatuslevel($id_user) {
	    // Ambil berdasarkan id_bobot_presentase pd tabel opmt_penilaian (tabel untuk perhitungan setiap penilai)
	    // bukan dari tabel opdd_status, karena kemungkinan user dapat merubah status.
	  	$this->db->select('id_bobot_presentase');
		$this->db->from('opmt_penilaian');
	    $this->db->where('id_dd_user', $id_user);
	    $hasil = $this->db->get()->row();
        if ($hasil) {
		    return $hasil->id_bobot_presentase;
        } else {
            return "Data tidak ditemukan";
        }
	}
	
	function getbobotlevel($id_bobot) {
	  	$this->db->select('bobot_atasan, bobot_teman, bobot_bawahan, jenis_jabatan');
		$this->db->from('dd_bobot_presentase');
	    $this->db->where('id_bobot_presentase', $id_bobot);
	    return $this->db->get()->result();
	}
	
	function getnilaitahunan($id_user, $tahun) {
	  	$this->db->select('nilai_0, nilai_1, nilai_2, nilai_3, nilai_4, nilai_5, nilai_akhir, simpan_tgl');
		$this->db->from('opmt_perilaku_tahunan_sum');
	    $this->db->where('id_dd_user', $id_user);
	    $this->db->where('tahun', $tahun);
	    return $this->db->get()->result();
	}

}