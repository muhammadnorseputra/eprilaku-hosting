<section class="content-header" style="height: 30px;">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Penilaian</a></li>
        <li class="active">Perilaku</li>
    </ol>
</section>

<section class="content" style="padding-top:15px;">

    <div class="panel panel-primary">
        <div class="panel-heading">Penilaian Perilaku			
        </div>
        <div class="panel-body responsive" id="collapse1">
            <table id="tbl-penilaian" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr style="text-align: center;" class="info text-bold">
                        <td rowspan="2">No</td>
                        <td rowspan="2">Tgl Pengajuan</td>
                        <td colspan="2">Periode Penilaian</td>
                        <td rowspan="2">Nama Pengaju</td>
                        <td rowspan="2">NIP</td>
                        <td rowspan="2">Jabatan</td>
                        <td rowspan="2">Unit</td>
                        <td rowspan="2">Anda Diajukan Sebagai</td>
                        <td rowspan="2">Penilaian Perilaku</td>
                        <td rowspan="2">Detail</td>
                        <td rowspan="2">Status</td>
                        <td rowspan="2">Tgl Penilaian</td>
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
    var oTablePenilaian = $('#tbl-penilaian').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "pagingType": "full_numbers",
        "processing": true,
        "bSort": true,
        "bInfo": true,"scrollX": true,
        "bAutoWidth": true,
        "bJqueryUI": true,
        "serverSide": true,
        "responsive": true, "bDestroy": true,
        "ajax": {
            "url": "<?php echo site_url('penilaian/dt_penilaian') ?>",
            "type": "POST",
            "data": function (d) {
                d.status = 'User';
            }
        },
        "columnDefs": [
            {
                "targets": [-1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11], //last column
                "orderable": false,
                "className": "text-center"
            }
        ],
        "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            if (aData[11] == "Belum Dinilai") {
                $(nRow).find('td:eq(11)').css('background-color', 'red');
                $(nRow).find('td:eq(11)').css('color', 'white');
                $(nRow).find('td:eq(11)').css('font-weight', 'bold');
            } else {
                $(nRow).find('td:eq(11)').css('background-color', 'green');
                $(nRow).find('td:eq(11)').css('color', 'white');
                $(nRow).find('td:eq(11)').css('font-weight', 'bold');
            }
        }
    });


    function mulai_penilaian(id) {
        var dialog = new BootstrapDialog({
            message: function (dialogRef) {
                var $message = $('<div></div>').load('penilaian/mulai_penilaian/' + id);
                var $button = $('<button class="btn btn-primary btn-lg btn-block">Close the dialog</button>');
                $button.on('click', {dialogRef: dialogRef}, function (event) {
                    event.data.dialogRef.close();
                });
                $message.append($button);

                return $message;
            },
            closable: false,
            size: 'size-wide'
        });

        dialog.realize();
        dialog.getModalHeader().hide();
        dialog.getModalFooter().hide();
        dialog.open();
    }

    function detail_penilaian(id) {
        var dialog = new BootstrapDialog({
            message: function (dialogRef) {
                var $message = $('<div></div>').load('penilaian/detail_penilaian/' + id);
                var $button = $('<button class="btn btn-primary btn-lg btn-block">Close the dialog</button>');
                $button.on('click', {dialogRef: dialogRef}, function (event) {
                    event.data.dialogRef.close();
                });
                $message.append($button);

                return $message;
            },
            closable: true,
            size: 'size-wide'
        });

        dialog.realize();
        dialog.getModalHeader().hide();
        dialog.getModalFooter().hide();
        dialog.open();
    }

</script>
