<?php

class dashboard extends CI_Controller {

    public function __consstruct() {
        parent::__consstruct();
    }

    public function index() {
        $jabatan = $this->session->userdata('jabatan');
        $id_user = $this->session->userdata('id_user');
        $tahun = date('Y');
        if ($jabatan == 'Admin') {
            $q = "select a.*,ttl from dd_periode_penilaian a
                  left join(select count(distinct id_dd_user)ttl,id_dd_periode_penilaian from opmt_penilaian group by id_dd_periode_penilaian)b on a.id_dd_periode_penilaian=b.id_dd_periode_penilaian WHERE a.tahun_periode={$tahun}";
            $q2 = "select count(*) ttl from dd_user a
		join tblstruktural b on b.kodeunit=a.unit_kerja
		join tbljabatan c on c.kodejab=a.jabatan
		LEFT JOIN (select distinct id_dd_user,id_dd_periode_penilaian FROM opmt_penilaian)
		d on d.id_dd_user=a.id_dd_user
		where d.id_dd_periode_penilaian is null";
            $q3 = "SELECT
	b.bulan_periode,
	b.tahun_periode,
	count( CASE WHEN a.nilai < 50 THEN a.id_dd_user ELSE NULL END ) AS buruk,
	count( CASE WHEN a.nilai < 60 AND a.nilai > 51 THEN a.id_dd_user ELSE NULL END ) AS kurang,
	count( CASE WHEN a.nilai < 75 AND a.nilai > 61 THEN a.id_dd_user ELSE NULL END ) AS cukup,
	count( CASE WHEN a.nilai < 90 AND a.nilai > 76 THEN a.id_dd_user ELSE NULL END ) AS baik,
	count( CASE WHEN a.nilai < 100 AND a.nilai > 91 THEN a.id_dd_user ELSE NULL END ) AS sangatbaik 
FROM
	opmt_perilaku_tahunan a
	JOIN dd_periode_penilaian b ON a.id_dd_periode_penilaian = b.id_dd_periode_penilaian
        where tahun_periode={$tahun}  group by b.bulan_periode,
	b.tahun_periode";
            $data['laporan'] = $this->db->query($q)->result_array();
            $data['total'] = $this->db->query($q2)->row_array();
            $data['grafik'] = $this->db->query($q3)->result_array();
            $data['tahun'] = $tahun;
            $this->load->view('v_dashboard_admin', $data);
        } else {
            $q = "SELECT a.*,b.created_date,b.status_kelengkapan
FROM dd_periode_penilaian a
LEFT JOIN (
SELECT DISTINCT id_dd_periode_penilaian,max(created_date)created_date,keterangan status_kelengkapan
FROM opmt_penilaian a
JOIN dd_bobot_presentase b ON a.id_bobot_presentase=b.id_bobot_presentase
WHERE id_dd_user={$id_user} group by id_dd_periode_penilaian,keterangan)b ON a.id_dd_periode_penilaian=b.id_dd_periode_penilaian";
            $q2 = "SELECT
	a.created_date,
	d.bulan_periode,
	d.tahun_periode,
	c.nama,
	c.nip,
	e.jabatan,
	f.unitkerja,
CASE
	b.flag_user 
	WHEN 0 THEN
	'Atasan' 
	WHEN 1 THEN
	'Peer' ELSE 'Bawahan' 
END AS status 
FROM
	opmt_penilaian a
	JOIN dd_penilai b ON a.id_dd_penilai = b.id_dd_penilai
	JOIN dd_user c ON c.id_dd_user = b.id_dd_user
	JOIN dd_periode_penilaian d ON d.id_dd_periode_penilaian = a.id_dd_periode_penilaian
	JOIN tbljabatan e ON e.kodejab = c.jabatan
	JOIN tblstruktural f ON f.kodeunit = c.unit_kerja
	LEFT JOIN ( SELECT DISTINCT id_opmt_penilaian, id_dd_user FROM opmt_penilaian_perilaku a ) g ON g.id_opmt_penilaian = a.id_opmt_penilaian 
	AND g.id_dd_user = b.id_dd_user_penilai 
WHERE
        b.id_dd_user_penilai = {$id_user} 
	AND g.id_dd_user IS NULL";
            $data['periode'] = $this->db->query($q)->result_array();
            $data['periode2'] = $this->db->query($q2)->result_array();
            $this->load->view('v_dashboard_user', $data);
        }
    }

    public function cek_jumlah_penilaian() {
        $id_user = $this->session->userdata('id_user');
        $q2 = "SELECT
		a.created_date
		
		FROM
		opmt_penilaian a
		JOIN dd_penilai b ON a.id_dd_penilai = b.id_dd_penilai
		JOIN dd_user c ON c.id_dd_user = b.id_dd_user
		JOIN dd_periode_penilaian d ON d.id_dd_periode_penilaian = a.id_dd_periode_penilaian
		join tbljabatan e on e.kodejab=c.jabatan
		join tblstruktural f on f.kodeunit=c.unit_kerja
		LEFT JOIN(SELECT distinct id_opmt_penilaian,created_date FROM opmt_penilaian_perilaku WHERE id_dd_user={$id_user})g on g.id_opmt_penilaian=a.id_opmt_penilaian
		WHERE b.id_dd_user_penilai=" . $id_user . " AND g.id_opmt_penilaian is null";
        $cek = $this->db->query($q2)->result_array();
        echo count($cek);
    }

    function cetak($id) {
        $getPeriode = $this->db->query("SELECT * FROM dd_periode_penilaian WHERE id_dd_periode_penilaian={$id}")->row_array();
        $periode = "Bulan " . bulan($getPeriode['bulan_periode']) . " Tahun " . $getPeriode['tahun_periode'];
        $q = "select a.nama,a.nip,b.unitkerja,c.jabatan from dd_user a
		join tblstruktural b on b.kodeunit=a.unit_kerja
		join tbljabatan c on c.kodejab=a.jabatan
		LEFT JOIN (select distinct id_dd_user,id_dd_periode_penilaian FROM opmt_penilaian WHERE id_dd_periode_penilaian={$id})
		d on d.id_dd_user=a.id_dd_user
		where d.id_dd_periode_penilaian is null";
        $temp_rec = $this->db->query($q);
        // ambil data dengan memanggil fungsi di model
        $num_rows = $temp_rec->num_rows();

        if ($num_rows > 0) { // jika data ada di database
            // memanggil (instantiasi) class reportProduct di file print_rekap_helper.php
            $a = new report();
            // anda dapat membuat report lainnya dalam satu file print_rekap_helper.php
            // dengan cukup mengubah setKriteria dan membuat kondisi (elseif) di file print_rekap_helper.php
            $a->setKriteria("transkip");
            // judul report
            $a->setNama("DATA USER BELUM MENGAJUKAN PENILAIAN PERIODE " . $periode);
            // buat halaman
            $a->AliasNbPages();
            // Potrait ukuran A4
            $a->AddPage("P", "A4");

            // ambil data dari database
            $data = $temp_rec->row();

//            $a->Ln(2); // spasi enter
//            $a->SetFont('Arial', 'B', 8); // set font,size,dan properti (B=Bold)
//            $a->Cell(0, 4, 'Data Pegawai Belum Mengajukan Penilaian', 0, 1, 'L');
//            $a->Cell(0, 4, 'Periode : ' . $periode, 0, 1, 'L');
            // $a->Cell(0,4,'Harga Satuan : '.number_format($data->hargasatuan,"2",",","."),0,1,'L');
//            $a->Ln(2);

            $a->SetFont('Arial', '', 8);
            // set lebar tiap kolom tabel transaksi
            $a->SetWidths(array(10, 50, 35, 50, 50));
            // set align tiap kolom tabel transaksi
            $a->SetAligns(array("C", "L", "L", "L", "L"));
            $a->SetFont('Arial', 'B', 7);
//            $a->Ln(2);
//            // set nama header tabel transaksi
//            $a->Cell(10, 7, 'No.', 1, 0, 'C');
//            $a->Cell(50, 7, 'NAMA', 1, 0, 'C');
//            $a->Cell(35, 7, 'NIP', 1, 0, 'C');
//            $a->Cell(50, 7, 'JABATAN', 1, 0, 'C');
//            $a->Cell(50, 7, 'UNIT KERJA', 1, 0, 'C');
//            $a->Ln(7);

            $a->SetFont('Arial', '', 8);

            $rec = $temp_rec->result();
            $n = 0;
            foreach ($rec as $r) {
                $n++;
                $a->Row(array(($n), trim($r->nama), trim($r->nip), trim($r->jabatan), trim($r->unitkerja)));
            }

            $a->Output();
        } else { // jika data kosong
            redirect('report');
        }

        exit();
    }

}
?>

