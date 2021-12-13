<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

    function __construct() {

        parent::__construct();
        //load model web
        $this->load->model('M_api');
    }

    public function index()
    {
    
    }

    function get_nilai_thnnip_silka() {
        //http://localhost/360/index.php/Api/get_nilai_thnnip_silka?thn='.$thn.'&nip='.$nip
        $thn = $this->input->get('thn');
        $nip = $this->input->get('nip');

        $nilai = $this->M_api->get_nilai_thnnip($thn, $nip);
        $data['nilai'] = $nilai;
        $response = array();
        $posts = array();
        //lopping data dari database
        if ($nilai != "Data tidak ditemukan") {
            foreach ($nilai as $hasil)
            {
                $posts[] = array(
                    "nip"           => $hasil->nip,
                    "tahun"     	=> $hasil->tahun,
                    "orientasi_pelayanan"     => $hasil->nilai_0,
                    "komitmen"     		=> $hasil->nilai_1,
                    "integritas"     	=> $hasil->nilai_2,
                    "kerjasama"     	=> $hasil->nilai_3,
                    "disiplin"     		=> $hasil->nilai_4,
                    "kepemimpinan"     	=> $hasil->nilai_5,
                    "nilai_akhir"     	=> $hasil->nilai_akhir
                );
            }
        
        $response['hasil'] = $posts;
        header('Content-Type: application/json');
        echo json_encode($response,TRUE);
        }        
    }

    function get_perilaku_thnnip_silka() {
        //http://localhost/360/index.php/Api/get_evaluator_thnnip_silka?thn='.$thn.'&nip='.$nip
        $thn = $this->input->get('thn');
        $nip = $this->input->get('nip');

        // BAGIAN STATUS LEVEL
        $iduser = $this->M_api->getiduser($nip);
        $status = $this->M_api->getstatuslevel($iduser);
        
        // BAGIAN BOBOT LEVEL
        $bobot = $this->M_api->getbobotlevel($status);
        //var_dump($bobot);
        foreach ($bobot as $bb)
            {
                //$hasilbobot[] = array(
                //$hasilbobot = array(
                //    "bobot_atasan"      => $bb->bobot_atasan*100,
                //    "bobot_teman"     	=> $bb->bobot_teman*100,
                //    "bobot_bawahan"     => $bb->bobot_bawahan*100,
                //    "jenis_jabatan"     => $bb->jenis_jabatan
                //);
                //break;
                
                $bobot_atasan = $bb->bobot_atasan*100;
                $bobot_teman = $bb->bobot_teman*100;
                $bobot_bawahan = $bb->bobot_bawahan*100;
                $jenis_jabatan = $bb->jenis_jabatan;
                break;
            }
        
        // BAGIAN EVALUATOR
        $eva = $this->M_api->get_evaluator_thnnip($thn, $nip);
        //lopping data dari database
        if ($eva != "Data tidak ditemukan") {
            foreach ($eva as $hasil)
            {
            	$nipevaluator = $this->M_api->getnipuser($hasil->id_dd_user_penilai);
            	if ($hasil->flag_user == 0) {
            		$flag = "ATASAN"; 
            	} else if ($hasil->flag_user == 1) {
            		$flag = "PEER";
            	} else if ($hasil->flag_user == 2) {
            		$flag = "BAWAHAN";
            	}
            	
                $eval[] = array(
                    //"tahun"     		=> $thn,
                    "nip"     	        => $nipevaluator,
                    "flag_evaluator"    => $flag,
                    "urutan"            => $hasil->urut,
                    //"created_at"     	=> $hasil->created_date
                );
            }
        }
        
        
        // BAGIAN NILAI TAHUNAN
        
        $nilai = $this->M_api->getnilaitahunan($iduser, $thn);
        if ($nilai) {
        //$hasilnilai[] = array();
        foreach ($nilai as $nl)
            {
                $hasilnilai[] = array(
                //$hasilnilai = array(
                    "orientasi_pelayanan"   => $nl->nilai_0,
                    "komitmen"     	        => $nl->nilai_1,
                    "integritas"            => $nl->nilai_2,
                    "kerjasama"             => $nl->nilai_3,
                    "disiplin"              => $nl->nilai_4,
                    "kepemimpinan"          => $nl->nilai_5,
                    "nilai_akhir"           => $nl->nilai_akhir,
                    "simpan_tgl"            => $nl->simpan_tgl
                );
                break;
            }
        } else {
            $hasilnilai ="";
        }
        
        //$response = array();
        $response['status'] = $status;
        $response['bobot_atasan'] = $bobot_atasan;
        $response['bobot_teman'] = $bobot_teman;
        $response['bobot_bawahan'] = $bobot_bawahan;
        $response['jenis_jabatan'] = $jenis_jabatan;
        $response['evaluator'] = $eval;
        $response['nilai_tahunan'] = $hasilnilai;
        header('Content-Type: application/json');
        echo json_encode($response,TRUE);
    }        
}