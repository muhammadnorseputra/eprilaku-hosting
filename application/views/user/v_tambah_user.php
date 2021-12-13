<section class="content" style="padding:0px;">
	<div class="panel panel-primary">
		<div class="panel-heading">Tambah User <a href="javascript:void(0)" class="pull-right" style="color:white;font-weight: bold;" onclick="$('.close').click()">[ x ]</a></div>
		<div class="panel-body">
			<form method="post" id="frmTambahUser">
				<div class="form-horizontal">
					<?php if($par==0){?>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-4 control-label">NIP</label>
						<div class="col-sm-6">
							<input type="text" name="nip" class="form-control" id="nip">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-4 control-label">NAMA</label>
						<div class="col-sm-6">
							<input type="text" name="nama" class="form-control" id="nip">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-4 control-label">JABATAN</label>
						<div class="col-sm-6">
							<select name="jabatan" class="form-control" width="200">
								<?php 
								foreach($jabatan as $dtJab){
									?>
									<option value="<?=$dtJab['kodejab']?>"><?php echo $dtJab['kodejab']." | ".$dtJab['jabatan'];?></option>
									<?php
								}
								?>
							</select>
						</div>
					</div>
					<?php }else{?>
					<input type="hidden" name="jabatan" value="701089">
					<?php }?>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-4 control-label">USERNAME</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="username">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-4 control-label">PASSWORD</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="password" id="password" >
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
	$("#frmTambahUser").on('submit', (function (e) {
		e.preventDefault();
		var r = confirm('Yakin ingin memproses data ini ?');
		if (r) {
					//alert("masuk2");
					$.ajax({
						//alert("masuk3");
						url: "user/prosesTambah/",
						type: "POST", // Type of request to be send, called as method
						data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
						contentType: false, // The content type used when sending data to the server.
						cache: false, // To unable request pages to be cached
						processData: false, // To send DOMDocument or non processed data file it is set to false
						success: function (data) {
							alert(data);
							$('.close').click();
							$('#tbl-admin').DataTable().ajax.reload();
							$('#tbl-user').DataTable().ajax.reload();
							
						},
						error:function(hasil){
							alert(hasil.toString());
						}
					}
					);
				}

			}));
		</script>