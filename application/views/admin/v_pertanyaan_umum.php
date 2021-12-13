<section class="content-header" style="height: 30px;">
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-users"></i> Pertanyaan</a></li>
		<li class="active">Umum</li>
	</ol>
</section>

<!-- Main content -->
<section class="content" style="padding-top:15px;">
	<div class="nav-tabs-custom">
		<!-- Tabs within a box -->
		<ul class="nav nav-tabs pull-right">
			<li><a href="#tab-kepemimpinan" onclick="refresh_tab(1)" data-toggle="tab">Kepemimpinan</a></li>
			<li><a href="#tab-disiplin" onclick="refresh_tab(2)" data-toggle="tab">Disiplin</a></li>
			<li><a href="#tab-kerjasama" onclick="refresh_tab(3)" data-toggle="tab">Kerja Sama</a></li>
			<li><a href="#tab-integritas" onclick="refresh_tab(4)" data-toggle="tab">Integritas</a></li>
			<li><a href="#tab-komitmen" onclick="refresh_tab(5)" data-toggle="tab">Komitmen</a></li>
			<li class="active"><a href="#tab-orientasi" onclick="refresh_tab(6)" data-toggle="tab">Orientasi Pelayanan</a></li>
		</ul>
		<div class="tab-content no-padding">
			<!-- Morris chart - Sales -->
			<div class="tab-pane active" id="tab-kepemimpinan" style="position: relative;">
				<div class="panel panel-primary">
					<div class="panel-heading">Kepemimpinan 
						<button class="pull-right btn-danger" onclick="tambah_pertanyaan(0)">Tambah Pertanyaan + </button>
					</div>
					<div class="panel-body responsive" id="collapse1">
						<table id="tbl-kepemimpinan" class="table tbl-pertanyaan table-bordered table-striped table-hover">
							<thead>
								<tr style="text-align: center;" class="info text-bold">
									<td>No</td>
									<td>Pertanyaan / Pernyataan</td>
									<td>Detail</td>
									<td>Edit</td>
									<td>Hapus</td>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="tab-disiplin" style="position: relative;">
				<div class="panel panel-primary">
					<div class="panel-heading">Disiplin 
						<button class="pull-right btn-danger" onclick="tambah_pertanyaan(1)">Tambah Pertanyaan + </button>
					</div>
					<div class="panel-body responsive" id="collapse1">
						<table id="tbl-disiplin" class="table tbl-pertanyaan table-bordered table-striped table-hover">
							<thead>
								<tr style="text-align: center;" class="info text-bold">
									<td>No</td>
									<td>Pertanyaan / Pernyataan</td>
									<td>Detail</td>
									<td>Edit</td>
									<td>Hapus</td>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>		
			<div class="tab-pane" id="tab-kerjasama" style="position: relative;">
				<div class="panel panel-primary">
					<div class="panel-heading">Kerja Sama 
						<button class="pull-right btn-danger" onclick="tambah_pertanyaan(2)">Tambah Pertanyaan + </button>
					</div>
					<div class="panel-body responsive" id="collapse1">
						<table id="tbl-kerjasama" class="table tbl-pertanyaan table-bordered table-striped table-hover">
							<thead>
								<tr style="text-align: center;" class="info text-bold">
									<td>No</td>
									<td>Pertanyaan / Pernyataan</td>
									<td>Detail</td>
									<td>Edit</td>
									<td>Hapus</td>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="tab-integritas" style="position: relative;">
				<div class="panel panel-primary">
					<div class="panel-heading">Integritas 
						<button class="pull-right btn-danger" onclick="tambah_pertanyaan(3)">Tambah Pertanyaan + </button>
					</div>
					<div class="panel-body responsive" id="collapse1">
						<table id="tbl-integritas" class="table tbl-pertanyaan table-bordered table-striped table-hover">
							<thead>
								<tr style="text-align: center;" class="info text-bold">
									<td>No</td>
									<td>Pertanyaan / Pernyataan</td>
									<td>Detail</td>
									<td>Edit</td>
									<td>Hapus</td>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div><div class="tab-pane" id="tab-komitmen" style="position: relative;">
				<div class="panel panel-primary">
					<div class="panel-heading">Komitmen 
						<button class="pull-right btn-danger" onclick="tambah_pertanyaan(4)">Tambah Pertanyaan + </button>
					</div>
					<div class="panel-body responsive" id="collapse1">
						<table id="tbl-komitmen" class="table tbl-pertanyaan table-bordered table-striped table-hover">
							<thead>
								<tr style="text-align: center;" class="info text-bold">
									<td>No</td>
									<td>Pertanyaan / Pernyataan</td>
									<td>Detail</td>
									<td>Edit</td>
									<td>Hapus</td>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div><div class="tab-pane" id="tab-orientasi" style="position: relative;">
				<div class="panel panel-primary">
					<div class="panel-heading">Orientasi Pelayanan 
						<button class="pull-right btn-danger" onclick="tambah_pertanyaan(5)">Tambah Pertanyaan + </button>
					</div>
					<div class="panel-body responsive" id="collapse1">
						<table id="tbl-orientasi" class="table tbl-pertanyaan table-bordered table-striped table-hover">
							<thead>
								<tr style="text-align: center;" class="info text-bold">
									<td>No</td>
									<td>Pertanyaan / Pernyataan</td>
									<td>Detail</td>
									<td>Edit</td>
									<td>Hapus</td>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	var oTablePertanyaan = $('.tbl-pertanyaan').dataTable({
		"bPaginate": true, 
		"bLengthChange": false,
		"pagingType": "full_numbers", 
		"processing": true, 
		"bSort": true,
		"bInfo": true,
		"bAutoWidth": true,
		"bJqueryUI": true,            
		"serverSide": true,
		"responsive": true, "bDestroy": true,
		"initComplete": function(settings, json) {
			// alert( 'DataTables has finished its initialisation.' );
		},
		"ajax": {
			"url": "<?php echo site_url('pertanyaan/dt_pertanyaan') ?>",
			"type": "POST",
			"data": function (d) {
				d.status = $('#par').val();
			}
		},
		"columnDefs": [
		{
                    "targets": [-1,0,1,2,3], //last column
                    "orderable": false,
                    "className":"text-center"
                }
                ]
            });

	function refresh_tab(id)
	{
		$('#par').val(id);
		$('#tbl-pertanyaan').DataTable().ajax.reload();
	}

	function ubah_pertanyaan(id,par) {
		var dialog = new BootstrapDialog({
			message: function(dialogRef){
				var $message = $('<div></div>').load('pertanyaan/ubah_pertanyaan/'+id+'/'+par);
				var $button = $('<button class="btn btn-primary btn-lg btn-block">Close the dialog</button>');
				$button.on('click', {dialogRef: dialogRef}, function(event){
					event.data.dialogRef.close();
				});
				$message.append($button);

				return $message;
			},
			closable: false
		});
		dialog.realize();
		dialog.getModalHeader().hide();
		dialog.getModalFooter().hide();
		dialog.open();
	}	
	function tambah_pertanyaan(par) {
		var dialog = new BootstrapDialog({
			message: function(dialogRef){
				var $message = $('<div></div>').load('pertanyaan/tambah_pertanyaan/'+'/'+par);
				var $button = $('<button class="btn btn-primary btn-lg btn-block">Close the dialog</button>');
				$button.on('click', {dialogRef: dialogRef}, function(event){
					event.data.dialogRef.close();
				});
				$message.append($button);

				return $message;
			},
			closable: false
		});
		dialog.realize();
		dialog.getModalHeader().hide();
		dialog.getModalFooter().hide();
		dialog.open();
	}

	function hapus_pertanyaan(id) {
		var r = confirm('Yakin ingin menghapus Pertanyaan ini ?');
		if (r) {
			$.post('pertanyaan/hapus_pertanyaan', {id: id}, function (data) {
				alert(data);
				$('#tbl-pertanyaan').DataTable().ajax.reload();
			});
		}
	}

	function detail_pertanyaan(id){
		var dialog = new BootstrapDialog({
			message: function(dialogRef){
				var $message = $('<div></div>').load('pertanyaan/detail_pertanyaan/'+id);
				var $button = $('<button class="btn btn-primary btn-lg btn-block">Close the dialog</button>');
				$button.on('click', {dialogRef: dialogRef}, function(event){
					event.data.dialogRef.close();
				});
				$message.append($button);

				return $message;
			},
			closable: false
		});
		dialog.realize();
		dialog.getModalHeader().hide();
		dialog.getModalFooter().hide();
		dialog.open();
	}



</script>
