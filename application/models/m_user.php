<?php

class M_user extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function validasi($user, $pass) {
		$this->db->from('dd_user');
		$this->db->where('username', $user);
		$this->db->where('password', base64_encode($pass));
		$validasi = $this->db->count_all_results();
		return $validasi;
	}

	public function get_data($user, $pass) {
		$this->db->from('dd_user a');
		$this->db->where('username', $user);
		$this->db->where('password', base64_encode($pass));
		$this->db->join('tbljabatan b', 'b.kodejab=a.jabatan', 'LEFT');
		$this->db->join('tblstruktural c', 'a.unit_kerja=c.kodeUnit', 'LEFT');
		return $this->db->get()->row_array();
	}

	public function update_log($user, $pass) {
		$login_terakhir = date('Y-m-d H:i:s');
		$data = array(
			'login_terakhir' => $login_terakhir,
			'ip_address' => $this->input->ip_address()
		);
		$this->db->where('username', $user);
		$this->db->where('password', base64_encode($pass));
		$update = $this->db->update('dd_user', $data);
		return $update;
	}

	public function getListUser($page, $rowsperpage, $filter, $order_col,$order,$status) {
		if($status=='Admin'){
			$sqlPlus=" WHERE b.jabatan='Admin'";
		}else{
			$sqlPlus=" WHERE b.jabatan<>'Admin'";	
		}
		$arrColumn=array('nip','nama','b.jabatan','username','password');
		if (!empty($filter)) {
			$sqlPlus .= "AND (nama LIKE '%$filter%' or b.jabatan like '%$filter%') ";
		}
		if(!empty($order_col)){
			$order="ORDER BY ".$arrColumn[$order_col]." {$order}";
		}else{
			$order="";
		}
		$sql = "select a.id_dd_user,a.nama,a.nip,a.username,a.password,a.flag_eselon,b.jabatan 
		from dd_user a
		join tbljabatan b on a.jabatan=b.kodejab
		{$sqlPlus} {$order}
		limit ".$page.",".$rowsperpage;

 /*       if ($show_count == 1) {
            return $sql;
        }
 */       $query = $this->db->query($sql);
        //die($sql);
        return $query->result();
    }

    public function getListCount($filter,$status) {
    	if($status=='Admin'){
    		$sqlPlus=" WHERE b.jabatan='Admin'";
    	}else{
    		$sqlPlus=" WHERE b.jabatan<>'Admin'";	
    	}
    	if (!empty($filter)) {
    		$sqlPlus .= "AND (nama LIKE '%$filter%' or b.jabatan like '%$filter%') ";
    	}
    	$sql = "select count(id_dd_user)ttl 
    	from dd_user a
    	join tbljabatan b on a.jabatan=b.kodejab
    	{$sqlPlus}";
    	$query = $this->db->query($sql)->row();
    	$rowcount = $query->ttl;
    	return $rowcount;
    }


}
