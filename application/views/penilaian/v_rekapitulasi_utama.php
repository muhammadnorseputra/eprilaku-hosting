<div style="padding:10px;margin-bottom:10px;">
<table class="table" style="width:85%;">
<tr>
	<td>Periode</td>
	<td>
	<select class="form-control" id="periode" style="width:150px;">
		<?php foreach($periode as $dt){?>
		<option value="<?=$dt->id_dd_periode_penilaian?>"><?=bulan($dt->bulan_periode).' '.$dt->tahun_periode?></option>
		<?php }?>
		</select>
	</td>
	<td>Unit</td>
	<td>
	<select class="form-control" id="kodeunit">
	<option value="all">All</option>
		<?php foreach($unit as $dt){?>
		<option value="<?=$dt->kodeunit?>"><?=$dt->unitkerja?></option>
		<?php }?>
	</select>
	</td>
	<td><button class="btn btn-primary" onclick="cari_penilaian()">Cari</button></td>
</tr>
</table> 
<div id="divPenilaian"></div>
<div class="pull-right" style="margin-bottom:20px;">
<button class="btn btn-danger" onclick="cetak_pdf()">Cetak PDF</button>
<button class="btn btn-success" onclick="cetak_xls()">Cetak Excel</button>
</div>
<br><br>
</div>

<script>
function cari_penilaian(){
	var periode=$('#periode').val();
	var kodeunit=$('#kodeunit').val();
	$.post('penilaian/cariPenilaian',{periode:periode,kodeunit:kodeunit},function(res){
		$('#divPenilaian').html(res);
	});
}
cari_penilaian();
function cetak_pdf(){

  var periode=$('#periode').val();
  var kodeunit=$('#kodeunit').val();
  if(kodeunit=='all'){
	alert("Harap pilih unit kerja yang diinginkan untuk mempercepat proses download data!");
  }
	 var dialog = new BootstrapDialog({
        message: function() {
            var $message = $('<iframe style="width:100%;height:100%;" src="c_pdf/cetak_rekap' + '/' + periode + '/' + kodeunit+'"></iframe>');
            return $message;
        }
    });
    dialog.realize();
    dialog.getModalHeader().hide();
    dialog.getModalBody().css('background-color', 'lightblue');
    dialog.getModalBody().css('color', '#000');
    dialog.setSize(BootstrapDialog.SIZE_WIDE);
    dialog.open();


}

function cetak_xls(){

  var periode=$('#periode').val();
	var kodeunit=$('#kodeunit').val();
	window.location.href="<?=base_url()?>c_excel/cetak_rekap/"+periode+"/"+kodeunit;

}
</script>