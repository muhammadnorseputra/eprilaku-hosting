<div style="margin:0 auto;width:800px;">
<table class="table" style="width:50%;">
	<tr>
		<td>NIP Pegawai</td>
		<td><input type="hidden" id="id_dd_user_penilai" class="form-control">
	
			<input type="text" id="nip_penilai" class="form-control"></td>
	</tr>
	<tr>
		<td>Periode Penilaian</td>
		<td>
			<select class="form-control" id="periode" onchange="cek_detail();">
			<?php foreach($periode as $dt){?>
				<option value="<?=$dt->id_dd_periode_penilaian?>"><?=bulan($dt->bulan_periode).' '.$dt->tahun_periode?></option>
			<?php }?>
			</select>
			</td>
	</tr>
	<tr class='text-bold'>
		<td>Nama</td>
		<td>
			<div id="nama_penilai"></div>
			</td>
	</tr>
	</table>
	<div id='divDetail'></div>
	</div>
	<script>
		$("#nip_penilai").autocomplete({
		source: function (request, response) {
			$.ajax({
				url: "<?= base_url('user/get_nip') ?>",
				type: "POST",
				data: {
					q: request.term
				}, dataType: 'json',
				success: function (data) {
					response(data);
				}
			});
		},
		minLength: 4,
		select: function (event, ui) {
			$('#id_dd_user_penilai').val(ui.item.id);
			$('#nama_penilai').html(ui.item.nama);
			cek_detail();
			
		},
		open: function () {
			$(this).removeClass("ui-corner-all").addClass("ui-corner-top");
		},
		close: function () {
			$(this).removeClass("ui-corner-top").addClass("ui-corner-all");
		}
	});
	
	function cek_detail(){
	var id_dd_user=$('#id_dd_user_penilai').val();
	var periode=$('#periode').val();
	$.post('penilaian/lihat_detail_admin',{id:periode,id_user:id_dd_user},function(res){
		$('#divDetail').html(res);
		});
	}
		</script>