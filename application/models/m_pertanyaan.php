<?php

class M_pertanyaan extends CI_Model{
	public function __construct(){
		parent::__construct();
	}

	public function getListPertanyaan($page, $rowsperpage, $filter, $order_col,$order,$status,$status2) {
		$arrColumn=array('pertanyaan');
		$sqlPlus=" WHERE id_group_pertanyaan={$status}";
		$sqlPlus .=" AND flag_eselon={$status2}";
		if (!empty($filter)) {
			$sqlPlus .= "AND (pertanyaan LIKE '%$filter%') ";
		}
		if(!empty($order_col)){
			$order="ORDER BY ".$arrColumn[$order_col]." {$order}";
		}else{
			$order="";
		}
		$sql = "select *
		from dd_pertanyaan
		{$sqlPlus} {$order}
		limit ".$page.",".$rowsperpage;
		$query = $this->db->query($sql);
        //die($sql);
		return $query->result();
	}

	public function getListPertanyaanCount($filter,$status,$status2) {
		$sqlPlus=" WHERE id_group_pertanyaan={$status} ";
		$sqlPlus .=" AND flag_eselon={$status2}";
		if (!empty($filter)) {
			$sqlPlus .= "AND (pertanyaan LIKE '%$filter%') ";
		}
		$sql = "select count(id_dd_pertanyaan)ttl 
		from dd_pertanyaan a
		{$sqlPlus}";
		$query = $this->db->query($sql)->row();
		$rowcount = $query->ttl;
		return $rowcount;
	}
}