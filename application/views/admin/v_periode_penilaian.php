<section class="content-header" style="height: 30px;">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-users"></i> Penilaian</a></li>
        <li class="active">Periode</li>
    </ol>
</section>

<!-- Main content -->
<section class="content" style="padding-top:15px;">

    <div class="panel panel-primary">
        <div class="panel-heading">Periode 
            <button class="pull-right btn-danger" onclick="tambah_periode()">Tambah Periode + </button>
        </div>
        <div class="panel-body responsive" id="collapse1">
            <table id="tbl-periode" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr style="text-align: center;" class="info text-bold">
                        <td rowspan="2">No</td>
                        <td rowspan="2">Tgl Pembuatan Periode</td>
                        <td colspan="2">Periode</td>
                        <td rowspan="2">Pengaturan Pengajuan</td>
                        <td rowspan="2">Hapus</td>
                    </tr>
                    <tr style="text-align: center;" class="info text-bold">
                        <td>Bulan</td>
                        <td>Tahun</td>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

</section>
<script>
    var oTableUser = $('#tbl-periode').dataTable({
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
        "drawCallback": function( settings ) {
            $('.cek').on('click', function () {
                var cek = $(this).is(':checked');
                var id = $(this).attr('title');
                $.post('user/prosesEselon', {id: id, cek: cek}, function (hasil) {

                });
            });
            // alert( 'DataTables has finished its initialisation.' );
        },
        "ajax": {
            "url": "<?php echo site_url('penilaian/dt_periode') ?>",
            "type": "POST",
            "data": function (d) {
                d.status = 'User';
            }
        },
        "columnDefs": [
            {
                "targets": [-1, 0, 1, 2, 3, 4], //last column
                "orderable": false,
                "className": "text-center"
            }
        ]
    });

    function pengaturan_periode(id) {
        $.post('penilaian/get_pengaturan_periode', {id: id}, function (hasil) {
            var dt = JSON.parse(hasil);
            var flag = dt.flag_aktif;
            if (flag === "0") {
                var param = 'checked';
            } else {
                var param = '';
            }
            BootstrapDialog.show({
                size: BootstrapDialog.SIZE_SMALL,
                title: '<div style="text-align:center">Pengaturan Pengajuan</div>',
                message: '<div style="padding:10px">Tutup pengajuan periode ini <input type="checkbox" title="' + id + '" onclick="pengaturan()" class="cek_pengaturan" ' + param + ' ></div>',

            });

        });


    }

    function pengaturan() {
        var cek = $('.cek_pengaturan').is(':checked');
        var id = $('.cek_pengaturan').attr('title');
        $.post('penilaian/update_pengaturan', {id: id, cek: cek}, function (hasil) {
            alert(hasil);
        });

    }
    function hapus_periode(id) {
        var r = confirm('Yakin ingin menghapus periode ini ?');
        if (r) {
            $.post('penilaian/hapus_periode', {id: id}, function (data) {
                alert(data);
                $('#tbl-periode').DataTable().ajax.reload();
            });
        }
    }

    function tambah_periode() {
        var dialog = new BootstrapDialog({
            message: function (dialogRef) {
                var $message = $('<div></div>').load('penilaian/tambah_periode/');
                var $button = $('<button class="btn btn-primary btn-lg btn-block">Close the dialog</button>');
                $button.on('click', {dialogRef: dialogRef}, function (event) {
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
