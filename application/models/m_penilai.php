<?php

class M_penilai extends CI_Model{
	public function __construct(){
		parent::__construct();
	}

	public function getListPenilai($page, $rowsperpage, $filter, $order_col,$order,$status) {
		$id_user=$this->session->userdata('id_user');
		$arrColumn=array('nip','nama','b.jabatan','c.unitkerja');
		$sqlPlus=" WHERE flag_user={$status} AND dp.id_dd_user={$id_user}";
		
		if (!empty($filter)) {
			$sqlPlus .= "AND (nip LIKE '%$filter%' or nama like '%$filter%' or b.jabatan like '%$filter%' or  or c.unitkerja like '%$filter%') ";
		}
		if(!empty($order_col)){
			$order="ORDER BY ".$arrColumn[$order_col]." {$order}";
		}else{
			$order="";
		}
		$sql = "select dp.id_dd_penilai,a.nip,nama,b.jabatan,c.unitkerja, dp.created_date
		from dd_penilai dp
		join dd_user a on dp.id_dd_user_penilai=a.id_dd_user
		join tbljabatan b on a.jabatan=b.kodejab
		join tblstruktural c on c.kodeunit=a.unit_kerja
		{$sqlPlus} {$order}
		limit ".$page.",".$rowsperpage;
		$query = $this->db->query($sql);
        //die($sql);
		return $query->result();
	}

	public function getListPenilaiCount($filter,$status) {
		$id_user=$this->session->userdata('id_user');
		$sqlPlus=" WHERE flag_user={$status} AND  dp.id_dd_user={$id_user} ";
		$this->db->where('flag_user',$status);
		if (!empty($filter)) {
			$sqlPlus .= "AND (nip LIKE '%$filter%' or nama like '%$filter%' or b.jabatan like '%$filter%' or  or c.unitkerja like '%$filter%') ";
		}
		$sql = "select count(dp.id_dd_penilai)ttl 
		from dd_penilai dp
		join dd_user a on dp.id_dd_user=a.id_dd_user
		join tbljabatan b on a.jabatan=b.kodejab
		join tblstruktural c on c.kodeunit=a.unit_kerja
		{$sqlPlus}";
		$query = $this->db->query($sql)->row();
		$rowcount = $query->ttl;
		return $rowcount;
	}
}