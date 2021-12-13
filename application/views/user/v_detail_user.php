<section class="content" style="padding:0px;">
	<div class="panel panel-primary">
		<div class="panel-heading">Detail User</div>
		<div class="panel-body">
			<div class="form-horizontal">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-4 control-label">NIP</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="nip" value="<?=$detail['nip']?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-4 control-label">NAMA</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="nama" value="<?=$detail['nama']?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-4 control-label">JABATAN</label>
					<div class="col-sm-6">
					<input type="text" class="form-control" id="nip" value="<?=$detail['jabatan']?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-4 control-label">USERNAME</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="nip" value="<?=$detail['username']?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-4 control-label">PASSWORD</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="nip" value="<?=base64_decode($detail['password'])?>">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-4 control-label"></label>
					<div class="col-sm-6">
						<button class="btn btn-primary" onclick="$('.close').click()">TUTUP</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
