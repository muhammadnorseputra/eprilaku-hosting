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
            <table id="tbl-hasil" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr style="text-align: center;" class="info text-bold">
                        <td rowspan="2">No</td>
                        <td colspan="2">Periode Penilaian</td>
                        <td rowspan="2">Tgl Pengajuan</td>
                        <td rowspan="2">Status Kelengkapan</td>
                        <td rowspan="2">Atasan</td>
                        <td rowspan="2">Teman/Peer I</td>
                        <td rowspan="2">Teman/Peer II</td>
                        <td rowspan="2">Bawahan I</td>
                        <td rowspan="2">Bawahan II</td>
                        <td rowspan="2">Detail<br/>Penilaian</td>
                        <td rowspan="2">Detail<br/>Evaluator</td>
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
    var oTablePenilaian = $('#tbl-hasil').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "pagingType": "full_numbers",
        "processing": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": true,
        "bJqueryUI": true,
        "serverSide": true,"scrollX": true,
        "responsive": true, "bDestroy": true,
        "ajax": {
            "url": "<?php echo site_url('penilaian/dt_hasil') ?>",
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
            if (aData[5] == "Belum Dinilai" && aData[5] !== "-") {
                $(nRow).find('td:eq(5)').css('background-color', 'red');
                $(nRow).find('td:eq(5)').css('color', 'white');
                $(nRow).find('td:eq(5)').css('font-weight', 'bold');
            } else if (aData[5] == "Sudah Dinilai" && aData[5] !== "-") {
                $(nRow).find('td:eq(5)').css('background-color', 'green');
                $(nRow).find('td:eq(5)').css('color', 'white');
                $(nRow).find('td:eq(5)').css('font-weight', 'bold');
            }
            if (aData[6] == "Belum Dinilai" && aData[6] !== "-") {
                $(nRow).find('td:eq(6)').css('background-color', 'red');
                $(nRow).find('td:eq(6)').css('color', 'white');
                $(nRow).find('td:eq(6)').css('font-weight', 'bold');
            } else if (aData[6] == "Sudah Dinilai" && aData[7] !== "-") {
                $(nRow).find('td:eq(6)').css('background-color', 'green');
                $(nRow).find('td:eq(6)').css('color', 'white');
                $(nRow).find('td:eq(6)').css('font-weight', 'bold');
            }
            if (aData[7] == "Belum Dinilai" && aData[7] !== "-") {
                $(nRow).find('td:eq(7)').css('background-color', 'red');
                $(nRow).find('td:eq(7)').css('color', 'white');
                $(nRow).find('td:eq(7)').css('font-weight', 'bold');
            } else if (aData[7] == "Sudah Dinilai" && aData[7] !== "-") {
                $(nRow).find('td:eq(7)').css('background-color', 'green');
                $(nRow).find('td:eq(7)').css('color', 'white');
                $(nRow).find('td:eq(7)').css('font-weight', 'bold');
            }
            if (aData[8] == "Belum Dinilai" && aData[8] !== "-") {
                $(nRow).find('td:eq(8)').css('background-color', 'red');
                $(nRow).find('td:eq(8)').css('color', 'white');
                $(nRow).find('td:eq(8)').css('font-weight', 'bold');
            } else if (aData[8] == "Sudah Dinilai" && aData[8] !== "-") {
                $(nRow).find('td:eq(8)').css('background-color', 'green');
                $(nRow).find('td:eq(8)').css('color', 'white');
                $(nRow).find('td:eq(8)').css('font-weight', 'bold');
            }
            if (aData[9] == "Belum Dinilai" && aData[9] !== "-") {
                $(nRow).find('td:eq(9)').css('background-color', 'red');
                $(nRow).find('td:eq(9)').css('color', 'white');
                $(nRow).find('td:eq(9)').css('font-weight', 'bold');
            } else if (aData[9] == "Sudah Dinilai" && aData[9] !== "-") {
                $(nRow).find('td:eq(9)').css('background-color', 'green');
                $(nRow).find('td:eq(9)').css('color', 'white');
                $(nRow).find('td:eq(9)').css('font-weight', 'bold');
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

    function detail(id) {

        var dialog = new BootstrapDialog({
            message: function (dialogRef) {
                var $message = $('<div></div>').load('penilaian/lihat_detail/' + id);
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
        $('.modal-lg').attr('width', '1024');
    }

    function detail_kandidat(id) {
        var dialog = new BootstrapDialog({
            message: function (dialogRef) {
                var $message = $message = $('<div id="detail_kandidat" style="padding:10px;font-size:12px;"><div class="row"><div class="col-md-3">Password</div><div class="col-md-9"><input type="password" id="pwd_kandidat" class="form-control"></div></div><div class="row" style="margin-top:5px;"><div class="col-md-3">&nbsp;</div><div class="col-md-9"><button class="btn btn-primary" onclick="cek_kandidat(' + id + ')">Ok</button></div></div> </div>');
                // var $button = $('<button class="btn btn-primary btn-lg btn-block">Close the dialog</button>');
                // $button.on('click', {dialogRef: dialogRef}, function(event){
                // 	event.data.dialogRef.close();
                // });
                // $message.append($button);

                return $message;
            },
            closable: true,
            size: 'size-small'
        });
        dialog.realize();
        dialog.getModalHeader().hide();
        dialog.getModalFooter().hide();
        dialog.open();
    }

    function cek_kandidat(id) {
        var pwd = $('#pwd_kandidat').val();
if(pwd==''){
	alert('password kandidat belum diisi');
}else{
        $.post('penilaian/cek_pwd_kandidat', {pwd: pwd, id: id}, function (hasil) {
            if (hasil == 'no') {
                alert("Password salah");
            } else {
                $('.close').click();
                tampil_kandidat(hasil);
                $('#pwd_kandidat').focus();
            }
        });
    }
}

    function tampil_kandidat(html) {
        var dialog = new BootstrapDialog({
            message: function (dialogRef) {
                var $message = $message = $('<div>' + html + '</div>');
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
