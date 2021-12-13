<?php
class C_excel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', 0);
		$this->cek_sesi();
	}

	 public function cek_sesi() {
        if ($this->session->userdata('id_user') == "") {
            $this->session->sess_destroy();
            echo '<script>';
            echo "alert('Sesi anda telah berakhir, silahkan login kembali');";
            echo 'window.parent.location = "./"';
            echo '</script>';
        }
    }
	
	  public function cetak_rekap($periode,$kodeunit) {
       $par="";
		 if ($kodeunit != "all") {
            $kodeunit=substr($kodeunit,0,3);
            $par = " AND left(a.unit_kerja,3)='{$kodeunit}' ";
        }
		
		$q="SELECT a.nama,a.nip,d.jabatan,b.unitkerja,c.*
FROM dd_user a
INNER JOIN tblstruktural b ON a.unit_kerja=b.kodeunit
LEFT JOIN(
SELECT d.*
FROM dd_periode_penilaian c
INNER JOIN opmt_perilaku d ON d.tahun=c.tahun_periode AND d.bulan=c.bulan_periode
WHERE c.id_dd_periode_penilaian=$periode
) c ON c.id_dd_user=a.id_dd_user
INNER JOIN tbljabatan d ON d.kodejab=a.jabatan WHERE 1=1 $par";
$periode=$this->db->where('id_dd_periode_penilaian',$periode)->get('dd_periode_penilaian')->row();
		$rekap=$this->db->query($q)->result();
			  
        $this->load->library('excel');
	
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("EKINERJA")->setLastModifiedBy("EKINERJA")->setTitle("BMS")->setSubject("DAFTAR TAMBAHAN PENGHASILAN PNS")->setDescription("EKINERJA")->setKeywords("office 2007 openxml php")->setCategory("DAFTAR PENGHASILAN TAMBAHAN PNS");
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
     
// Add some data
	  $bulan=$periode->bulan_periode;
	  $tahun=$periode->tahun_periode;
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'REKAP PENILAIAN PERILAKU')
                ->setCellValue('A2', 'Bulan '.bulan($periode->bulan_periode).' Tahun '.$periode->tahun_periode)
                ->setCellValue('A5', 'No')
                ->setCellValue('B5', 'Periode')
                ->setCellValue('C5', 'Nama')
                ->setCellValue('D5', 'NIP')
                ->setCellValue('E5', 'Jabatan')
                ->setCellValue('F5', 'Unit Kerja')
                ->setCellValue('G5', 'Orientasi Pelayanan')
                ->setCellValue('H5', 'Komitmen')
                ->setCellValue('I5', 'Disiplin')
                ->setCellValue('J5', 'Integritas')
                ->setCellValue('K5', 'Kerja sama')
                ->setCellValue('L5', 'Kepemimpinan')
          
        ;
   
        $i = 7;
        $no = 1;
        $j = 0;
        foreach ($rekap as $data) {
           
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $no);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, bulan($bulan).' '.$tahun);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $data->nama);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, " ".$data->nip);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $data->jabatan);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $data->unitkerja);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $data->orientasi_pelayanan);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $data->komitmen);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $data->disiplin);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $data->integritas);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $data->kerjasama);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($j++, $i, $data->kepemimpinan);

            $i++;
            $no++;
            $j = 0;
        }
//        $objPHPExcel->getActiveSheet()->getStyle("A13:H" . $total)->getFont()->setSize(9);
        $objPHPExcel->getActiveSheet()->setTitle('DAFTAR REKAP PENILAIAN PERILAKU');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        $i=$i-1;
        $objPHPExcel->getActiveSheet()->getStyle('A5:L'.$i)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()
    ->getStyle('C5:C'.$i)
    ->getNumberFormat()
    ->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
//Format Warna Kolom
$default_border = array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('rgb' => 'FFFFFF'));
// Format Header
        $style_header = array('borders' => array('bottom' => $default_border, 'left' => $default_border, 'top' => $default_border, 'right' => $default_border,), 'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '002a80'),), 'font' => array('bold' => false, 'size' => '14'), 'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ));
        $style_center = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        ));
        $style_left = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
        ));
        $style_right = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        ));
        $style_font = array('font' => array('bold' => true, 'size' => '14'));
        $style_font2 = array('font2' => array('bold' => true, 'size' => '12'));



        //SET BORDER ISI
        $styleArray2 = array(
            'borders' => array(
                'vertical' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                )
            ),
        );

        $border_bottom = array(
            'borders' => array(
                'bottom' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                )
            ),
        );
        $objPHPExcel->getActiveSheet()->getStyle('C4:C1000')->getNumberFormat()->setFormatCode('###0');


        $objPHPExcel->getActiveSheet()->getStyle('A5:L6')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
        $objPHPExcel->getActiveSheet()->getStyle('A1:L6')->applyFromArray($style_font);
        $objPHPExcel->getActiveSheet()->getStyle('A5:L6')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('A5:L6')->applyFromArray($styleArray2);
//        $objPHPExcel->getActiveSheet()->getStyle('A1:D10')->applyFromArray($style_font);
// Rata Tulisan
        $objPHPExcel->getActiveSheet()->getStyle('A1:L6')->applyFromArray($style_center);
        $objPHPExcel->getActiveSheet()->getStyle('A3:A4')->applyFromArray($style_left);
        $objPHPExcel->getActiveSheet()->getStyle('A7:B'.$i)->applyFromArray($style_center);
        $objPHPExcel->getActiveSheet()->getStyle('D7:D'.$i)->applyFromArray($style_center);
        $objPHPExcel->getActiveSheet()->getStyle('D7:L'.$i)->applyFromArray($style_left);
        $objPHPExcel->getActiveSheet()->getStyle('H7:H'.$i)->applyFromArray($style_center);
        $objPHPExcel->getActiveSheet()->getStyle('A3:A4')->applyFromArray($style_font2);
        
        $objPHPExcel->getActiveSheet()->freezePane('A7');
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(60);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(55);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(130);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(23);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(23);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(23);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(23);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(23);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(23);

        $objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

        $objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 5);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);
// Set Margin
        $objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.5);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.5);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.5);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.5);

        $tanggal = date("d M Y");
        $objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L Tanggal Cetak ' . $tanggal . ' Waktu Cetak &T &RHal &P of &N');
//$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&RHal &P of &N');


        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		
        header('Content-Disposition: attachment;filename="Laporan Rekapitulasi.xls"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
// Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
// always modified
        header('Cache-Control: cache, must-revalidate');
// HTTP/1.1
        header('Pragma: public');
// HTTP/1.0
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
        // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	//	$objWriter->save('_files/Laporan Rekapitulasi.xlsx');
	//	header('_files/Laporan Rekapitulasi.xlsx');
       $objWriter->save('php://output');
		//    die('tes');
//        $objWriter->save('‪\backup');
        exit;
		
    }


}
