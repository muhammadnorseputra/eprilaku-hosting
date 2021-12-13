<style>
    ul,li{
        font-size:11px;
    }
    .ui-menu{
        width: 200px;
    }
    .ui-autocomplete {
        position: relative;
        overflow: auto;
        height: 200px;
        z-index: 9999;
        display: none;
        width: 160px;
        padding: 4px 0;
        margin: 2px 0 0 0;

    }
    .ui-helper-hidden-accessible{
        display:none !important;
    }
</style>
<section class="content-header" style="height: 30px;">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-users"></i> Pengaturan</a></li>
        <li class="active">Evaluator</li>
    </ol>
</section>

<!-- Main content -->
<section class="content" style="padding-top:15px;">
    <div class="nav-tabs-custom">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-status" data-toggle="tab">Status</a></li>
            <li class="tab tab-atasan" style="display:none;"><a href="#tab-atasan" data-toggle="tab" onclick="eval_atasan()">Atasan</a></li>
            <li class="tab tab-teman" style="display:none;"><a href="#tab-teman" onclick="eval_tab(1)" data-toggle="tab">Teman/Peer</a></li>
            <li class="tab tab-bawahan" style="display:none;"><a href="#tab-bawahan" onclick="eval_tab(2)" data-toggle="tab">Bawahan</a></li>

        </ul>
        <?php
            $jenis = $this->session->userdata('jenis');
            $jab = $this->session->userdata('jabatan');
            $unker = $this->session->userdata('unit_kerja');
            echo "Nama Jabatan : ".$jab." (".$jenis.")";
            echo "<br/>Unit Kerja : ".$unker;
            
        ?>
        
        <div class="tab-content no-padding">
            <!-- Morris chart - Sales -->
            <div class="tab-pane active" id="tab-status" style="position: relative;margin-top:10px;height: 560px;overflow: auto;">
                <table class="table table-bordered table-striped" id="tbl-status">
                    <tr class="info text-center text-bold">
                        <td>Status Kelengkapan</td>
                        <td>Aksi</td>
                        <td>Atasan</td>
                        <td>Peer/Teman</td>
                        <td>Bawahan</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-center text-bold" style="background-color: #222D32;color:white;">JST (Jabatan Struktural )</td>
                    </tr>
                    <tr>
                        <td>Status 1</td>
                        <td class="text-center"><input type="radio" name="radio" value="1" <?= !in_array($jenis,array('JST','JS'))? 'disabled' : '' ?>></td>
                        <td class="success text-center">60%</td>
                        <td class="success text-center">20%</td>
                        <td class="success text-center">20%</td>
                    </tr>
                    <tr>
                        <td>Status 2</td>
                        <td class="text-center"><input type="radio" name="radio" value="2" <?= !in_array($jenis,array('JST','JS')) ? 'disabled' : '' ?>></td>
                        <td class="danger text-center"></td>
                        <td class="success text-center">50%</td>
                        <td class="success text-center">50%</td>
                    </tr>
                    <tr>
                        <td>Status 3</td>
                        <td class="text-center"><input type="radio" name="radio" value="3" <?= !in_array($jenis,array('JST','JS')) ? 'disabled' : '' ?>></td>
                        <td class="success text-center">60%</td>
                        <td class="danger text-center"></td>
                        <td class="success text-center">40%</td>
                    </tr>
                    <tr>
                        <td>Status 4</td>
                        <td class="text-center"><input type="radio" name="radio" value="4" <?= !in_array($jenis,array('JST','JS')) ? 'disabled' : '' ?>></td>
                        <td class="success text-center">60%</td>
                        <td class="success text-center">40%</td>
                        <td class="danger text-center"></td>
                    </tr>
                    <tr>
                        <td>Status 5</td>
                        <td class="text-center"><input type="radio" name="radio" value="5" <?= !in_array($jenis,array('JST','JS')) ? 'disabled' : '' ?>></td>
                        <td class="danger text-center"></td>
                        <td class="danger text-center"></td>
                        <td class="success text-center">100%</td>
                    </tr>
                    <tr>
                        <td>Status 6</td>
                        <td class="text-center"><input type="radio" name="radio" value="6" <?= !in_array($jenis,array('JST','JS')) ? 'disabled' : '' ?>></td>
                        <td class="danger text-center"></td>
                        <td class="success text-center">100%</td>
                        <td class="danger text-center"></td>
                    </tr>
                    <tr>
                        <td>Status 7</td>
                        <td class="text-center"><input type="radio" name="radio" value="7" <?= !in_array($jenis,array('JST','JS')) ? 'disabled' : '' ?>></td>
                        <td class="success text-center">100%</td>
                        <td class="danger text-center"></td>
                        <td class="danger text-center"></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-center text-bold" style="background-color: #222D32;color:white;">JFT/JF (Pejabat Fungsional) atau Pelaksana</td>
                    </tr>
                    <tr>
                        <td>Status 8</td>
                        <td class="text-center"><input type="radio" name="radio" value="8" <?= in_array($jenis,array('JST','JS')) ? 'disabled' : '' ?>></td>
                        <td class="success text-center">60%</td>
                        <td class="success text-center">40%</td>
                        <td class="danger text-center"></td>
                    </tr>
                    <tr>
                        <td>Status 9</td>
                        <td class="text-center"><input type="radio" name="radio" value="9" <?= in_array($jenis,array('JST','JS')) ? 'disabled' : '' ?>></td>
                        <td class="danger text-center"></td>
                        <td class="success text-center">100%</td>
                        <td class="danger text-center"></td>
                    </tr>
                    <tr>
                        <td>Status 10</td>
                        <td class="text-center"><input type="radio" name="radio" value="10" <?= in_array($jenis,array('JST','JS')) ? 'disabled' : '' ?>></td>
                        <td class="success text-center">100%</td>
                        <td class="danger text-center"></td>
                        <td class="danger text-center"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right"><button class="btn btn-primary" id="simpan_status"><i class="glyphicon glyphicon-check"></i> SIMPAN</button></td>
                    </tr>
                </table>

            </div>

            <div class="tab-pane" id="tab-atasan" style="position: relative;margin-top:10px;padding-bottom: 10px;">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">NIP</label>
                        <div class="col-sm-4">
                            <input type="hidden" id="id_dd_user_atasan" class="form-control">
                            <input type="text" id="nip_atasan" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">NAMA</label>
                        <div class="col-sm-10">
                            <label id="nama"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">JABATAN</label>
                        <div class="col-sm-10">
                            <label id="jabatan"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">UNIT KERJA</label>
                        <div class="col-sm-10">
                            <label id="unit"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Diajukan</label>
                        <div class="col-sm-10">
                            <label id="tgl"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <button class="btn btn-primary" onclick="simpan_atasan()"> SIMPAN</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab-teman" style="position: relative;">
                <div class="panel panel-primary">
                    <div class="panel-heading">KANDIDAT TEMAN / PEER 
                        <button class="pull-right btn-danger" onclick="tambah_penilai(1)">Tambah Teman + </button>
                    </div>
                    <div class="panel-body responsive" id="collapse1">
                        <table class="table table-bordered table-striped table-hover tbl-evaluator">
                            <thead>
                                <tr style="text-align: left;" class="info text-bold">
                                    <td>No</td>
                                    <td>NIP /Nama Peer</td>
                                    <td>Jabatan</td>
                                    <td>Unit</td>
                                    <td>Tgl. Entri</td>
                                    <td>Hapus</td>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab-bawahan" style="position: relative;">
                <div class="panel panel-primary">
                    <div class="panel-heading">KANDIDAT BAWAHAN
                        <button class="pull-right btn-danger" onclick="tambah_penilai(2)">Tambah Bawahan + </button>
                    </div>
                    <div class="panel-body responsive" id="collapse1">
                        <table class="table table-bordered table-striped table-hover tbl-evaluator">
                            <thead>
                                <tr style="text-align: left;" class="info text-bold">
                                    <td>No</td>
                                    <td>NIP / Nama Peer</td>
                                    <td>Jabatan</td>
                                    <td>Unit</td>
                                    <td>Tgl. Entri</td>
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
<input type="hidden" id="id_eval" value="1">
<script>
    /*	$("#form_status").on('submit', (function (e) {
     e.preventDefault();
     
     var r = confirm('Yakin ingin memproses data ini ?');
     //var id = document.getElementById('id_tr_task').value;
     var f_asal = $("#form_status");
     //alert("masuk");
     var form = getFormData(f_asal);
     //alert("masuk1");
     if (r) {
     
     $.ajax({
     
     url: "pengaturan/proses_status", // Url to which the request is send
     type: "POST", // Type of request to be send, called as method
     data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
     contentType: false, // The content type used when sending data to the server.
     cache: false, // To unable request pages to be cached
     processData: false, // To send DOMDocument or non processed data file it is set to false
     success: function (data) {
     alert(data);
     },
     error:function(hasil){
     alert(hasil.toString());
     }
     }
     );
     }
     
     }));*/
    // cekEvaluator();
    // function cekEvaluator() {
    //     $.getJson('pengaturan/cek_evaluator', function(result) {
            
    //         if(result == true) {
    //             $("button#simpan_status").hide();
    //         } else {
    //             $("button#simpan_status").show();
    //         }
    //     })
    // }
    function tambah_penilai(id) {
        var dialog = new BootstrapDialog({
            message: function (dialogRef) {
                var $message = $('<div></div>').load('pengaturan/tambah_penilai/' + id);
                var $button = $('<button class="btn btn-primary btn-lg btn-block">Close the dialog</button>');
                $button.on('click', {dialogRef: dialogRef}, function (event) {
                    event.data.dialogRef.close();
                });
                $message.append($button);

                return $message;
            },
            closable: true
        });
        dialog.realize();
        dialog.getModalHeader().hide();
        dialog.getModalFooter().hide();
        dialog.open();
    }

    function eval_tab(id) {
        $('#id_eval').val(id);
        $('.tbl-evaluator').DataTable().ajax.reload();
    }
    var oTableEvaluator = $('.tbl-evaluator').dataTable({
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
            "url": "<?php echo site_url('pengaturan/dt_penilai') ?>",
            "type": "POST",
            "data": function (d) {
                d.status = $('#id_eval').val();
            }
        },
        "columnDefs": [
            {
                "targets": [-1, 0, 1, 2, 3, 4, 5], //last column
                "orderable": false,
                "className": "text-left"
            }
        ]
    });

    $("#nip_atasan").autocomplete({
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
            $('#id_dd_user_atasan').val(ui.item.id);
            $('#nama').html(ui.item.nama);
            $('#jabatan').html(ui.item.jabatan);
            $('#unit').html(ui.item.unitkerja);
        },
        open: function () {
            $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
        },
        close: function () {
            $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
        }
    });

    function simpan_atasan() {
        var id = $('#id_dd_user_atasan').val();
        $.post('pengaturan/proses_penilai', {id_dd_user_penilai: id, flag_user: 0}, function (hasil) {
            alert(hasil);
        });
    }

    function hapus_penilai(id) {
        var r = confirm("Yakin ingin menghapus penilai ini ?");
        if (r) {
            $.post('pengaturan/hapus_penilai', {id: id}, function (hasil) {
                alert(hasil);
                $('.tbl-evaluator').DataTable().ajax.reload();
            });
        }
    }

    function eval_atasan() {

        $.post('pengaturan/get_penilai', {}, function (hasil) {
            var atasan = JSON.parse(hasil);
//                console.log(atasan);
//                console.log(atasan.nip);
if(atasan.nip){
            $('#nip_atasan').val(atasan.nip + '-' + atasan.nama);
}
            $('#id_dd_user_atasan').val(atasan.id_dd_user_penilai);
            $('#nama').html(atasan.nama);
            $('#jabatan').html(atasan.jabatan);
            $('#unit').html(atasan.unitkerja);
            $('#tgl').html(atasan.created_date);
        });
    }

//     function simpan_status() {
//         var id = $("#tbl-status input[type='radio']:checked").val();
//         console.log("id_bobot_presentase : " + id);
//         $.post('pengaturan/proses_status', {id_bobot_presentase: id}, function (hasil) {
//             console.log(hasil);
//             $("button#simpan_status").hide();
//         });
//         cek();
// //        var arr1 = [1, 3, 4, 7, 8, 10];
// //        if ($.inArray(id, arr1) > -1) {
// //
// //        }

//     }
    
    $("button#simpan_status").unbind().bind("click", function() {
        // e.preventDefault();
        var id = $("#tbl-status input[type='radio']:checked").val();
        //console.log("id_bobot_presentase : " + id);
        $.post('pengaturan/proses_status', {id_bobot_presentase: id}, function (hasil) {
            alert(hasil);
            // $("button#simpan_status").hide();
           
        });
        cek();
    })

    function cek() {
        var id = $("#tbl-status input[type='radio']:checked").val();
        if (id == 1) {
            $('.tab').show();
        } else if (id == 2) {
            $('.tab').hide();
            $('.tab-teman').show();
            $('.tab-bawahan').show();
        }else if (id == 3) {
            $('.tab').hide();
            $('.tab-atasan').show();
            $('.tab-bawahan').show();
        }else if (id == 4||id==8) {
            $('.tab').hide();
            $('.tab-teman').show();
            $('.tab-atasan').show();
        }else if (id == 5) {
            $('.tab').hide();
            $('.tab-bawahan').show();
        }else if (id == 6||id==9) {
            $('.tab').hide();
            $('.tab-teman').show();
        }else if (id == 7||id==10) {
            $('.tab').hide();
            $('.tab-atasan').show();
        }
    }
    
    $("input[name=radio][value='<?= $id_bobot_presentase ?>']").prop("checked", true);
     cek();
</script>

