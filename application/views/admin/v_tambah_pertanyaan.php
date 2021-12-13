<section class="content" style="padding:0px;">

    <div class="panel panel-primary">

        <div class="panel-heading text-center">PERTANYAAN <br><?= strtoupper($par['group_pertanyaan']) ?> 

        </div>

        <div class="panel-body">

            <div class="form-horizontal">

                <div class="form-group">

                    <label for="inputEmail3" class="col-sm-2 control-label">Pertanyaan</label>

                    <div class="col-sm-10">

                        <textarea class="form-control" id="pertanyaan"></textarea>

                    </div>

                </div>

                <hr>

                <div class="col-sm-12 text-center text-bold info">JAWABAN</div>

                <div class="form-group">

                    <label for="inputEmail3" class="col-sm-1 control-label">A</label>



                    <div class="col-sm-9">

                        <input type="text" class="form-control" id="jawaban_5">

                    </div>

                    <label for="inputEmail3" class="col-sm-2 control-label">(5) Nilai</label>

                </div>

                <div class="form-group">

                    <label for="inputEmail3" class="col-sm-1 control-label">B</label>



                    <div class="col-sm-9">

                        <input type="text" class="form-control" id="jawaban_4">

                    </div>

                    <label for="inputEmail3" class="col-sm-2 control-label">(4) Nilai</label>

                </div>

                <div class="form-group">

                    <label for="inputEmail3" class="col-sm-1 control-label">C</label>



                    <div class="col-sm-9">

                        <input type="text" class="form-control" id="jawaban_3">

                    </div>

                    <label for="inputEmail3" class="col-sm-2 control-label">(3) Nilai</label>

                </div>

                <div class="form-group">

                    <label for="inputEmail3" class="col-sm-1 control-label">D</label>



                    <div class="col-sm-9">

                        <input type="text" class="form-control" id="jawaban_2">

                    </div>

                    <label for="inputEmail3" class="col-sm-2 control-label">(2) Nilai</label>

                </div><div class="form-group">

                    <label for="inputEmail3" class="col-sm-1 control-label">E</label>



                    <div class="col-sm-9">

                        <input type="text" class="form-control" id="jawaban_1">

                    </div>

                    <label for="inputEmail3" class="col-sm-2 control-label text-left">(1) Nilai</label>

                </div>



                <div class="form-group">

                    <label for="inputEmail3" class="col-sm-5 control-label"></label>

                    <div class="col-sm-6">

                        <button class="btn btn-primary" onclick="simpan_pertanyaan()" >SIMPAN</button>

                        <button class="btn btn-danger" onclick="$('.close').click()" >BATAL</button>



                    </div>

                </div>

            </div>

        </div>

    </div>

</section>



<script>

    /*	$("#frmTambahPeriode").on('submit', (function (e) {

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

     alert(data);

     $('.close').click();

     $('#tbl-periode').DataTable().ajax.reload();

     

     },

     error:function(hasil){

     alert(hasil.toString());

     }

     }

     );

     }

     

     }));*/



    function simpan_pertanyaan() {

        var id_group_pertanyaan = '<?= $par['id_group_pertanyaan'] ?>';

        var flag_eselon = '<?= $flag_eselon ?>';

        var pertanyaan = $('#pertanyaan').val();

        var jawaban_1 = $('#jawaban_1').val();

        var jawaban_2 = $('#jawaban_2').val();

        var jawaban_3 = $('#jawaban_3').val();

        var jawaban_4 = $('#jawaban_4').val();
        
        var jawaban_5 = $('#jawaban_5').val();
        var r = confirm("Yakin ingin menyimpan pertanyaan ini?");

        if (r) {

            $.post('pertanyaan/proses_pertanyaan', {pertanyaan: pertanyaan, id_group_pertanyaan: id_group_pertanyaan, jawaban_1: jawaban_1, jawaban_2: jawaban_2, jawaban_3: jawaban_3, jawaban_4: jawaban_4,jawaban_5: jawaban_5, flag_eselon: flag_eselon}, function (hasil) {

                $('.close').click();

                alert(hasil);

                $('.tbl-pertanyaan').DataTable().ajax.reload();

            });

        }

    }

</script>