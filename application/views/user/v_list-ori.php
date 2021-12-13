<section class="content-header" style="height: 30px;">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-users"></i> User</a></li>
        <li class="active">Data User dan Admin</li>
    </ol>
</section>

<!-- Main content -->
<section class="content" style="padding-top:15px;">
    <div class="nav-tabs-custom">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs pull-right">
            <li><a href="#tab-admin" data-toggle="tab">Admin</a></li>
            <li class="active"><a href="#tab-user" data-toggle="tab">User</a></li>
        </ul>
        <div class="tab-content no-padding">
            <!-- Morris chart - Sales -->
            <div class="tab-pane active" id="tab-user" style="position: relative;">
                <div class="panel panel-primary">
                    <div class="panel-heading">User 
                        <button class="pull-right btn-danger" onclick="tambah_user(0)">Tambah User + </button>
                    </div>
                    <div class="panel-body responsive" id="collapse1">
                        <table id="tbl-user" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr style="text-align: center;" class="info text-bold">
                                    <td>No</td>
                                    <td>NIP</td>
                                    <td>Nama</td>
                                    <td>Jabatan</td>
                                    <td>Username</td>
                                    <td>Password</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Eselon I</td>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab-admin" style="position: relative;">
                <div class="panel panel-primary">
                    <div class="panel-heading">Admin 
                        <button class="pull-right btn-danger" onclick="tambah_user(1)">Tambah Admin + </button>
                    </div>
                    <div class="panel-body responsive" id="collapse1">
                        <table id="tbl-admin" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr style="text-align: center;" class="info text-bold">
                                    <td>No</td>
                                    <td>Username</td>
                                    <td>Password</td>
                                    <td></td>
                                    <td></td>
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
    var oTableUser = $('#tbl-user').dataTable({
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
            "url": "<?php echo site_url('user/dt_user') ?>",
            "type": "POST",
            "data": function (d) {
                d.status = 'User';
            }
        },
        "columnDefs": [
            {
                "targets": [-1, 0, 6, 7, 8], //last column
                "orderable": false,
                "className": "text-center"
            }
        ]
    });
    // oTableUser.fnDestroy();
    var oTableAdmin = $('#tbl-admin').dataTable({
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
        "ajax": {
            "url": "<?php echo site_url('user/dt_admin') ?>",
            "type": "POST",
            "data": function (d) {
                d.status = 'Admin';
            }
        },
        "columnDefs": [
            {
                "targets": [-1, 0, 1, 2, 3], //last column
                "orderable": false,
                "className": "text-center"
            }
        ]
    });


    function ubah_user(id, par) {
        var dialog = new BootstrapDialog({
            message: function (dialogRef) {
                var $message = $('<div></div>').load('user/ubah_user/' + id + '/' + par);
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
    function tambah_user(par) {
        var dialog = new BootstrapDialog({
            message: function (dialogRef) {
                var $message = $('<div></div>').load('user/tambah_user/' + '/' + par);
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

    function hapus_user(id) {
        var r = confirm('Yakin ingin menghapus user ini ?');
        if (r) {
            $.post('user/hapus_user', {id: id}, function (data) {
                alert(data);
                $('#tbl-admin').DataTable().ajax.reload();
                $('#tbl-user').DataTable().ajax.reload();
            });
        }
    }

    function detail_user(id) {
        var dialog = new BootstrapDialog({
            message: function (dialogRef) {
                var $message = $('<div></div>').load('user/detail_user/' + id);
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



    function cekEselon(id) {
        $.post('user/prosesEselon', {id: id}, function (hasil) {
            $('#tbl-admin').DataTable().ajax.reload();
            $('#tbl-user').DataTable().ajax.reload();
        });
    }
    oTableUser.on('search.dt', function () {
        $('.cek').on('click', function () {
            var cek = $(this).is(':checked');
            var id = $(this).attr('title');
            $.post('user/prosesEselon', {id: id, cek: cek}, function (hasil) {

            });
        });
    });

</script>


