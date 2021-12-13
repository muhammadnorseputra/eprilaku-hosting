<?php

class M_penilaian extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getListPeriode($page, $rowsperpage, $filter, $order_col, $order) {
        $arrColumn = array('tgl_pembuatan', 'bulan_periode', 'tahun_periode');
        $sqlPlus = "";
        if (!empty($filter)) {
            $sqlPlus .= "AND (bulan_periode LIKE '%$filter%' or tahun_periode like '%$filter%') ";
        }
        if (!empty($order_col)) {
            $order = "ORDER BY " . $arrColumn[$order_col] . " {$order}";
        } else {
            $order = "";
        }
        $sql = "select *
		from dd_periode_penilaian
		{$sqlPlus} {$order}
		limit " . $page . "," . $rowsperpage;
        $query = $this->db->query($sql);
        //die($sql);
        return $query->result();
    }

    public function getListPeriodeCount($filter) {
        $sqlPlus = "";
        if (!empty($filter)) {
            $sqlPlus .= "AND (bulan_periode LIKE '%$filter%' or tahun_periode like '%$filter%') ";
        }
        $sql = "select count(id_dd_periode_penilaian)ttl 
		from dd_periode_penilaian a
		{$sqlPlus}";
        $query = $this->db->query($sql)->row();
        $rowcount = $query->ttl;
        return $rowcount;
    }

    public function getListPenilaian($page, $rowsperpage, $filter, $order_col, $order) {
        $arrColumn = array('created_date', 'bulan_periode', 'tahun_periode', 'nama', 'nip', 'jabatan', 'unitkerja');
        $id_user = $this->session->userdata('id_user');
        $sqlPlus = "WHERE b.id_dd_user_penilai=" . $id_user;
        if (!empty($filter)) {
            $sqlPlus .= " AND (nama LIKE '%$filter%' or unitkerja like '%$filter%') ";
        }
        if (!empty($order_col)) {
            $order = "ORDER BY " . $arrColumn[$order_col] . " {$order}";
        } else {
            $order = "";
        }
        $sql = "SELECT
		a.id_opmt_penilaian,
		a.created_date,
		d.bulan_periode,
		d.tahun_periode ,
		c.nama,c.nip,e.jabatan,f.unitkerja,
		case b.flag_user when 0 then 'Atasan' WHEN 1 then'Peer' ELSE 'Bawahan' end as status,
		g.id_opmt_penilaian id_penilaian,g.created_date waktu_penilaian
		FROM
		opmt_penilaian a
		JOIN dd_penilai b ON a.id_dd_penilai = b.id_dd_penilai
		JOIN dd_user c ON c.id_dd_user = b.id_dd_user
		JOIN dd_periode_penilaian d ON d.id_dd_periode_penilaian = a.id_dd_periode_penilaian
		join tbljabatan e on e.kodejab=c.jabatan
		join tblstruktural f on f.kodeunit=c.unit_kerja
		LEFT JOIN(SELECT distinct id_opmt_penilaian,max(created_date)created_date FROM opmt_penilaian_perilaku WHERE id_dd_user={$id_user} group by id_opmt_penilaian)g on g.id_opmt_penilaian=a.id_opmt_penilaian

		{$sqlPlus} {$order}
		limit " . $page . "," . $rowsperpage;
        $query = $this->db->query($sql);
        //die($sql);
        return $query->result();
    }

    public function getListPenilaianCount($filter) {
        $id_user = $this->session->userdata('id_user');
        $sqlPlus = "WHERE b.id_dd_user_penilai=" . $id_user;
        if (!empty($filter)) {
            $sqlPlus .= " AND (nama LIKE '%$filter%' or unitkerja like '%$filter%') ";
        }
        $sql = "SELECT
		count(a.id_opmt_penilaian)ttl
		FROM
		opmt_penilaian a
		JOIN dd_penilai b ON a.id_dd_penilai = b.id_dd_penilai
		JOIN dd_user c ON c.id_dd_user = b.id_dd_user
		JOIN dd_periode_penilaian d ON d.id_dd_periode_penilaian = a.id_dd_periode_penilaian
		join tbljabatan e on e.kodejab=c.jabatan
		join tblstruktural f on f.kodeunit=c.unit_kerja
		LEFT JOIN(SELECT distinct id_opmt_penilaian FROM opmt_penilaian_perilaku WHERE id_dd_user={$id_user})g on g.id_opmt_penilaian=a.id_opmt_penilaian {$sqlPlus}
		";
        $query = $this->db->query($sql)->row();
        $rowcount = $query->ttl;
        return $rowcount;
    }

    public function getListHasil($page, $rowsperpage, $filter, $order_col, $order) {
        $arrColumn = array('created_date', 'bulan_periode', 'tahun_periode', 'nama', 'nip', 'jabatan', 'unitkerja');
        $id_user = $this->session->userdata('id_user');
        $sqlPlus = "";
        if (!empty($filter)) {
            $sqlPlus .= " AND (nama LIKE '%$filter%' or unitkerja like '%$filter%') ";
        }
        if (!empty($order_col)) {
            $order = "ORDER BY " . $arrColumn[$order_col] . " {$order}";
        } else {
            $order = "";
        }
        $sql = "SELECT 	xx.id_dd_periode_penilaian,
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
		xx.status_kelengkapan 

		{$sqlPlus} {$order}
		limit " . $page . "," . $rowsperpage;
        $query = $this->db->query($sql);
//        die($sql);
        return $query->result();
    }

    public function getListHasilCount($filter) {
        $id_user = $this->session->userdata('id_user');
        $sqlPlus = "";
        if (!empty($filter)) {
            $sqlPlus .= " AND (nama LIKE '%$filter%' or unitkerja like '%$filter%') ";
        }
        $sql = "SELECT COUNT(a.id_dd_periode_penilaian)ttl
		FROM (

		SELECT 	xx.id_dd_periode_penilaian,
		xx.bulan_periode,
		xx.tahun_periode,
		xx. tgl_pengajuan,
		xx. status_kelengkapan, SUM(xx.atasan)atasan, SUM(teman_1)teman_1, SUM(teman_2)teman_2, SUM(bawahan_1)bawahan_1, SUM(bawahan_2)bawahan_2
		FROM(
		SELECT
		x.id_dd_periode_penilaian,
		y.bulan_periode,
		y.tahun_periode,
		x.created_date tgl_pengajuan,
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
		GROUP BY
		x.id_dd_periode_penilaian,
		x.created_date,
		x.keterangan,
		x.flag_user
		)xx
		GROUP BY 
		xx.id_dd_periode_penilaian,
		xx.bulan_periode,
		xx.tahun_periode,
		xx.tgl_pengajuan ,
		xx.status_kelengkapan )a {$sqlPlus}
		";
        $query = $this->db->query($sql)->row();
        $rowcount = $query->ttl;
        return $rowcount;
    }

}
