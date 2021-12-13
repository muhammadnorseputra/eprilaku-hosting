<div class="form-horizontal" style="padding:10px;">
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">NIP</label>
		<div class="col-sm-6">
			<input type="hidden" id="id_dd_user_penilai" class="form-control">
			<input type="hidden" id="flag_user" value="<?=$id?>" class="form-control">
			<input type="text" id="nip_penilai" class="form-control">
		</div>
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">NAMA</label>
		<div class="col-sm-10">
			<label id="nama_penilai"></label>
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">JABATAN</label>
		<div class="col-sm-10">
			<label id="jabatan_penilai"></label>
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label">UNIT</label>
		<div class="col-sm-10">
			<label id="unit_penilai"></label>
		</div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 control-label"></label>
		<div class="col-sm-10">
			<button class="btn btn-primary" onclick="simpan_penilai()">SIMPAN</button>
		</div>
	</div>
</div>

<script type="text/javascript">
	function simpan_penilai(){
		var id=$('#id_dd_user_penilai').val();
		var flag_user=$('#flag_user').val();
		var r=confirm("Yakin ingin menyimpan data ini ?");
		if(r){
			$.post('pengaturan/proses_penilai',{id_dd_user_penilai:id,flag_user:flag_user},function(hasil){
				alert(hasil);
				$('.tbl-evaluator').DataTable().ajax.reload();
				$('.close').click();
			});
		}
	}


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
			$('#jabatan_penilai').html(ui.item.jabatan);
			$('#unit_penilai').html(ui.item.unitkerja);
		},
		open: function () {
			$(this).removeClass("ui-corner-all").addClass("ui-corner-top");
		},
		close: function () {
			$(this).removeClass("ui-corner-top").addClass("ui-corner-all");
		}
	});
</script>