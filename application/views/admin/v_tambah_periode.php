<section class="content" style="padding:0px;">
	<div class="panel panel-primary">
		<div class="panel-heading text-center">PERIODE PENILAIAN <a href="javascript:void(0)" class="pull-right" style="color:white;font-weight: bold;" onclick="$('.close').click()">[ x ]</a></div>
		<div class="panel-body">
			<form method="post" id="frmTambahPeriode">
				<div class="form-horizontal">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-4 control-label">Bulan</label>
						<div class="col-sm-6">
							<select class="form-control" name="bulan_periode">
								<?php for($i=1;$i<=12;$i++){ ?>
								<option value="<?=$i?>"><?=$i?></option>
								<?php }?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-4 control-label">Tahun</label>
						<div class="col-sm-6">
							<select class="form-control" name="tahun_periode">
								<?php for($i=date('Y')-3;$i<=date('Y');$i++){ ?>
								<option value="<?=$i ?>" <?=$i==date('Y')?'selected':''?>><?=$i ?></option>
								<?php }?>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-4 control-label"></label>
						<div class="col-sm-6">
							<button class="btn btn-primary" >SIMPAN</button>
							
						</div>
					</div>
				</div>
			</form>

		</div>
	</div>
</section>

<script>
	$("#frmTambahPeriode").on('submit', (function (e) {
		e.preventDefault();
		var r = confirm('Yakin ingin memproses data ini ?');
		if (r) {
					//alert("masuk2");
					$.ajax({
						//alert("masuk3");
						url: "penilaian/proses_tambah_periode/",
						type: "POST", // Type of request to be send, called as method
						data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false, // The content type used when sending data to the server.
						cache: false, // To unable request pages to be cached
						processData: false, // To send DOMDocument or non processed data file it is set to false
						success: function (data) {
							
							$('.close').click();
							$('#tbl-periode').DataTable().ajax.reload();
							
						},
						error:function(hasil){
							alert(hasil.toString());
						}
					}
					);
				}

			}));
		</script>