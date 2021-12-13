<style>
    .x{
        width:140px !important;float:left;margin-left: 100px;
    }
    .x2{
        width:140px !important;float:left;
    }
    #tbl-detail td{
        font-size:12px;
    }
</style>
<table class="table table-bordered">
  <tr style="background-color:#112B40 ;color:white;font-weight: bold;text-align: center;">
	<td rowspan="2">Status Pengajuan</td>
	<td colspan="2">Periode Penilaian</td>
	<td rowspan="2">Tgl Pengajuan</td>
	<td rowspan="2">Atasan</td>
	<td rowspan="2">Peer I</td>
	<td rowspan="2">Peer II</td>
	<td rowspan="2">Bawahan I</td>
	<td rowspan="2">Bawahan II</td>
	<td rowspan="2">Hapus Pengajuan</td>
  </tr>  
   <tr style="background-color:#112B40 ;color:white;font-weight: bold;text-align: center;">
		<td>Bulan</td>
		<td>Tahun</td>
  </tr>
  <tr >
	<td><?=isset($penilaian->bulan_periode)?'Sudah Diajukan':'Belum Diajukan'?></td>
	<td><?=isset($penilaian->bulan_periode)?bulan($penilaian->bulan_periode):''?></td>
	<td><?=isset($penilaian->tahun_periode)?$penilaian->tahun_periode:''?></td>
	<td><?=isset($penilaian->tgl_pengajuan)?date('d M Y',strtotime($penilaian->tgl_pengajuan)):''?></td>
	<td><?=isset($penilaian->atasan)&&$penilaian->atasan==1?'Sudah Dinilai':'Belum Dinilai'?></td>
	<td><?=isset($penilaian->teman_1)&&$penilaian->teman_1==1?'Sudah Dinilai':'Belum Dinilai'?></td>
	<td><?=isset($penilaian->teman_2)&&$penilaian->teman_2==1?'Sudah Dinilai':'Belum Dinilai'?></td>
	<td><?=isset($penilaian->bawahan_1)&&$penilaian->bawahan_1==1?'Sudah Dinilai':'Belum Dinilai'?></td>
	<td><?=isset($penilaian->bawahan_2)&&$penilaian->bawahan_2==1?'Sudah Dinilai':'Belum Dinilai'?></td>
	<td class="text-center"><?=isset($penilaian->bulan_periode)?'<a href="javascript:void(0)" onclick="konfirm_hapus_pengajuan('.$id_user.','.$penilaian->id_dd_periode_penilaian.')"><i class="fa fa-trash text-center text-danger"></i></a>':''?></td>
  </tr>
</table>


<script>
   
	function konfirm_hapus_pengajuan(id_user,id_dd_periode_penilaian){

	var dialog = new BootstrapDialog({
                                    message: function (dialogRef) {
                                        var $message = $('<div></div>').load('penilaian/konfirm_hapus_pengajuan/'+id_user+'/'+id_dd_periode_penilaian);
                                        var $button = $('<button class="btn btn-primary btn-lg btn-block">Close the dialog</button>');
                                        $button.on('click', {dialogRef: dialogRef}, function (event) {
                                            event.data.dialogRef.close();
                                        });
                                        $message.append($button);

                                        return $message;
                                    },
                                    closable: true
                                });
								 dialog.setSize(BootstrapDialog.SIZE_NORMAL);
                                dialog.realize();
                                dialog.getModalHeader().hide();
                                dialog.getModalFooter().hide();
                                dialog.open();
								
	
	}
	
	
	function hapus_pengajuan(id_user,id_dd_periode_penilaian){
	$.post('penilaian/hapus_pengajuan',{id_dd_periode_penilaian:id_dd_periode_penilaian,id_user:id_user},function(res){
	$('.close').click();
		cek_detail();
		});
	
								
	
	}
	
</script>
