<div>
    <div class="row" style="margin-top:10px;">
        <div class="col-md-12 text-center text-bold">Nama : <?= $nama ?> / <?= $nip ?></div>
    </div>
    <hr>
    <style>
        #tbl_pertanyaan td{
            padding:5px;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <form id="frm-pertanyaan">
                <input type="hidden" name="id_opmt_penilaian" value="<?= $id ?>">
                <input type="hidden" name="flag_eselon" value="<?= $flag_eselon ?>">
                <input type="hidden" name="jabatan" value="<?= $jabatan ?>">
                <div class="panel panel-danger div_group_pertanyaan" id="div_group_pertanyaan_1">
                    <div class="panel-heading">ASPEK : ORIENTASI PELAYANAN</div>
                    <div class="panel-body" style="height: 440px;overflow: auto;">
                        <table style="padding:2px;" id="tbl_pertanyaan">
                            <?php
                            $ttl = 0;
                            $no = 1;

                            foreach ($pertanyaan_1 as $dt) {
                                $arrNumber = array(1, 2, 3, 4, 5);
                                ?>
                                <tr class="text-bold">
                                    <td><?= $no . ')' ?></td>
                                    <td></td>
                                    <td><?= $dt['pertanyaan'] ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $b = array_rand($arrNumber);
                                    $a = $arrNumber[$b];
                                    ?>
                                    <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                    <?php unset($arrNumber[$b]); ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $b = array_rand($arrNumber);
                                    $a = $arrNumber[$b];
                                    ?>
                                    <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                    <?php unset($arrNumber[$b]); ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $b = array_rand($arrNumber);
                                    $a = $arrNumber[$b];
                                    ?>
                                    <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                    <?php unset($arrNumber[$b]); ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $b = array_rand($arrNumber);
                                    $a = $arrNumber[$b];
                                    ?>
                                    <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                    <?php unset($arrNumber[$b]); ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $b = array_rand($arrNumber);
                                    $a = $arrNumber[$b];
                                    ?>
                                    <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                    <?php unset($arrNumber[$b]); ?>
                                </tr>
                                <?php
                                $no++;
                                $ttl++;
                            }
                            ?>
                        </table>

                    </div>
                    <button type="button" class="btn btn-info pull-right" onclick="step(1, 2)">Selanjutnya</button>
                </div>

                <div class="panel panel-danger div_group_pertanyaan" id="div_group_pertanyaan_2" style="display:none;">
                    <div class="panel-heading">ASPEK : KOMITMEN</div>
                    <div class="panel-body" style="height: 440px;overflow: auto;">
                        <table style="padding:2px;" id="tbl_pertanyaan">
                            <?php
                            $no = 1;
                            foreach ($pertanyaan_2 as $dt) {
                                $arrNumber = array(1, 2, 3, 4, 5);
                                ?>
                                <tr class="text-bold">
                                    <td><?= $no . ')' ?></td>
                                    <td></td>
                                    <td><?= $dt['pertanyaan'] ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $b = array_rand($arrNumber);
                                    $a = $arrNumber[$b];
                                    ?>
                                    <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                    <?php unset($arrNumber[$b]); ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $b = array_rand($arrNumber);
                                    $a = $arrNumber[$b];
                                    ?>
                                    <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                    <?php unset($arrNumber[$b]); ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $b = array_rand($arrNumber);
                                    $a = $arrNumber[$b];
                                    ?>
                                    <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                    <?php unset($arrNumber[$b]); ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $b = array_rand($arrNumber);
                                    $a = $arrNumber[$b];
                                    ?>
                                    <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                    <?php unset($arrNumber[$b]); ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $b = array_rand($arrNumber);
                                    $a = $arrNumber[$b];
                                    ?>
                                    <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                    <?php unset($arrNumber[$b]); ?>
                                </tr>   <?php
                                $no++;
                                $ttl++;
                            }
                            ?>
                        </table>

                    </div>
                    <button type="button" class="btn btn-success pull-left" onclick="step(2, 1)">Sebelumnya</button>
                    <button type="button" class="btn btn-info pull-right" onclick="step(2, 3)">Selanjutnya</button>
                </div>

                <div class="panel panel-danger div_group_pertanyaan" id="div_group_pertanyaan_3" style="display:none;">
                    <div class="panel-heading">ASPEK : INTEGRITAS</div>
                    <div class="panel-body" style="height: 440px;overflow: auto;">
                        <table style="padding:2px;" id="tbl_pertanyaan">
                            <?php
                            $no = 1;
                            foreach ($pertanyaan_3 as $dt) {
                                $arrNumber = array(1, 2, 3, 4, 5);
                                ?>
                                <tr class="text-bold">
                                    <td><?= $no . ')' ?></td>
                                    <td></td>
                                    <td><?= $dt['pertanyaan'] ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $b = array_rand($arrNumber);
                                    $a = $arrNumber[$b];
                                    ?>
                                    <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                    <?php unset($arrNumber[$b]); ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $b = array_rand($arrNumber);
                                    $a = $arrNumber[$b];
                                    ?>
                                    <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                    <?php unset($arrNumber[$b]); ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $b = array_rand($arrNumber);
                                    $a = $arrNumber[$b];
                                    ?>
                                    <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                    <?php unset($arrNumber[$b]); ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $b = array_rand($arrNumber);
                                    $a = $arrNumber[$b];
                                    ?>
                                    <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                    <?php unset($arrNumber[$b]); ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $b = array_rand($arrNumber);
                                    $a = $arrNumber[$b];
                                    ?>
                                    <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                    <?php unset($arrNumber[$b]); ?>
                                </tr> <?php
                                $no++;
                                $ttl++;
                            }
                            ?>
                        </table>

                    </div>
                    <button type="button" class="btn btn-success pull-left" onclick="step(3, 2)">Sebelumnya</button>
                    <button type="button" class="btn btn-info pull-right" onclick="step(3, 4)">Selanjutnya</button>
                </div>

                <div class="panel panel-danger div_group_pertanyaan" id="div_group_pertanyaan_4" style="display:none;">
                    <div class="panel-heading">ASPEK : KERJASAMA</div>
                    <div class="panel-body" style="height: 440px;overflow: auto;">
                        <table style="padding:2px;" id="tbl_pertanyaan">
                            <?php
                            $no = 1;
                            foreach ($pertanyaan_4 as $dt) {
                                $arrNumber = array(1, 2, 3, 4, 5);
                                ?>
                                <tr class="text-bold">
                                    <td><?= $no . ')' ?></td>
                                    <td></td>
                                    <td><?= $dt['pertanyaan'] ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $b = array_rand($arrNumber);
                                    $a = $arrNumber[$b];
                                    ?>
                                    <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                    <?php unset($arrNumber[$b]); ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $b = array_rand($arrNumber);
                                    $a = $arrNumber[$b];
                                    ?>
                                    <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                    <?php unset($arrNumber[$b]); ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $b = array_rand($arrNumber);
                                    $a = $arrNumber[$b];
                                    ?>
                                    <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                    <?php unset($arrNumber[$b]); ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $b = array_rand($arrNumber);
                                    $a = $arrNumber[$b];
                                    ?>
                                    <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                    <?php unset($arrNumber[$b]); ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $b = array_rand($arrNumber);
                                    $a = $arrNumber[$b];
                                    ?>
                                    <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                    <?php unset($arrNumber[$b]); ?>
                                </tr>  <?php
                                $no++;
                                $ttl++;
                            }
                            ?>
                        </table>

                    </div>
                    <button type="button" class="btn btn-success pull-left" onclick="step(4, 3)">Sebelumnya</button>
                    <button type="button" class="btn btn-info pull-right" onclick="step(4, 5)">Selanjutnya</button>
                </div>

                <div class="panel panel-danger div_group_pertanyaan" id="div_group_pertanyaan_5" style="display:none;">
                    <div class="panel-heading">ASPEK : DISIPLIN</div>
                    <div class="panel-body" style="height: 440px;overflow: auto;">
                        <table style="padding:2px;" id="tbl_pertanyaan">
                            <?php
                            $no = 1;
                            foreach ($pertanyaan_5 as $dt) {
                                $arrNumber = array(1, 2, 3, 4, 5);
                                ?>
                                <tr class="text-bold">
                                    <td><?= $no . ')' ?></td>
                                    <td></td>
                                    <td><?= $dt['pertanyaan'] ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $b = array_rand($arrNumber);
                                    $a = $arrNumber[$b];
                                    ?>
                                    <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                    <?php unset($arrNumber[$b]); ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $b = array_rand($arrNumber);
                                    $a = $arrNumber[$b];
                                    ?>
                                    <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                    <?php unset($arrNumber[$b]); ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $b = array_rand($arrNumber);
                                    $a = $arrNumber[$b];
                                    ?>
                                    <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                    <?php unset($arrNumber[$b]); ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $b = array_rand($arrNumber);
                                    $a = $arrNumber[$b];
                                    ?>
                                    <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                    <?php unset($arrNumber[$b]); ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $b = array_rand($arrNumber);
                                    $a = $arrNumber[$b];
                                    ?>
                                    <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                    <?php unset($arrNumber[$b]); ?>
                                </tr>  <?php
                                $no++;
                                $ttl++;
                            }
                            ?>
                        </table>

                    </div>
                    <button type="button" class="btn btn-success pull-left" onclick="step(5, 4)">Sebelumnya</button>
                    <?php if (!in_array($jabatan, array('JST', 'JS'))) { ?>
                        <button type="button" class="btn btn-info pull-right" onclick="selesai_step()">Selesai</button>
                    <?php } else { ?>
                        <button type="button" class="btn btn-info pull-right" onclick="step(5, 6)">Selanjutnya</button>
                    <?php } ?>
                </div>

                <?php if ($flag_eselon == 1 || in_array($jabatan, array('JST', 'JS'))) { ?>
                    <div class="panel panel-danger div_group_pertanyaan" id="div_group_pertanyaan_6" style="display:none;">
                        <div class="panel-heading">ASPEK : KEPEMIMPINAN</div>
                        <div class="panel-body" style="height: 440px;overflow: auto;">
                            <table style="padding:2px;" id="tbl_pertanyaan">
                                <?php
                                $no = 1;
                                foreach ($pertanyaan_6 as $dt) {
                                    $arrNumber = array(1, 2, 3, 4, 5);
                                    ?>
                                    <tr class="text-bold">
                                        <td><?= $no . ')' ?></td>
                                        <td></td>
                                        <td><?= $dt['pertanyaan'] ?></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <?php
                                        $b = array_rand($arrNumber);
                                        $a = $arrNumber[$b];
                                        ?>
                                        <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                        <?php unset($arrNumber[$b]); ?>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <?php
                                        $b = array_rand($arrNumber);
                                        $a = $arrNumber[$b];
                                        ?>
                                        <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                        <?php unset($arrNumber[$b]); ?>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <?php
                                        $b = array_rand($arrNumber);
                                        $a = $arrNumber[$b];
                                        ?>
                                        <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                        <?php unset($arrNumber[$b]); ?>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <?php
                                        $b = array_rand($arrNumber);
                                        $a = $arrNumber[$b];
                                        ?>
                                        <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                        <?php unset($arrNumber[$b]); ?>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <?php
                                        $b = array_rand($arrNumber);
                                        $a = $arrNumber[$b];
                                        ?>
                                        <td><input type="radio" name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] . "_" . $a ?>"><?= "&nbsp;&nbsp;".$dt['jawaban_' . $a] ?></td>
                                        <?php unset($arrNumber[$b]); ?>
                                    </tr>    <?php
                                    $no++;
                                    $ttl++;
                                }
                                ?>
                            </table>

                        </div>
                        <button type="button" class="btn btn-success pull-left" onclick="step(6, 5)">Sebelumnya</button>
                        <button type="button" class="btn btn-info pull-right" onclick="selesai_step()">Selesai</button>
                    </div>
                <?php } ?>
                <input type="hidden" name="ttl_pertanyaan" id="ttl_pertanyaan">
            </form>
            <div class="panel panel-success div_group_pertanyaan" id="div_hasil_pertanyaan" style="display:none;">
                <div class="panel-heading">NILAI PERILAKU</div>
                <div class="panel-body" style="height: 440px;overflow: auto;" id="div_nilai_perilaku">
                </div>
                <button type="button" class="btn btn-success pull-right" onclick="$('.close').click();"">TUTUP</button>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function step(val, id) {
        var ttl = 0;
        $('.div_group_pertanyaan').hide();
        $('#div_group_pertanyaan_' + id).show('slow');
        $('#div_group_pertanyaan_' + val + ' input:radio').each(function ()
        {
            if ($(this).prop('checked')) {
                ttl++;
            }
        });
        if (ttl == 5) {
            $('#div_group_pertanyaan_' + val).removeClass('panel-danger').addClass('panel-success');
        }
    }
    function cek_jawaban() {
        var ttl = 0;
        $('input:radio').each(function ()
        {
            if ($(this).prop('checked')) {
                ttl++;
            }
        });
        return ttl;
    }

    function selesai_step() {
        var flag_eselon =<?= $flag_eselon ?>;
        var jabatan = '<?= $jabatan ?>';
        if (flag_eselon == 1 || jabatan == 'JST' || jabatan == 'JS') {
            var ttl = 30;
        } else {
            var ttl = 25;
        }
        if (ttl !== cek_jawaban()) {
            alert('Masih ada soal yang belum diisi jawaban, silahkan periksa kembali jawaban anda');
        } else {
            var r = confirm("Apakah Anda Sudah Selesai Melakukan Penilaian Perilaku? Hasil penenilaian yang sudah disetujui tidak dapat diulangi kembali.");
            if (r) {
                $('#frm-pertanyaan').submit();
            }
        }
    }

    $("#frm-pertanyaan").on('submit', (function (e) {
        e.preventDefault();

        //alert("masuk2");
        $.ajax({
            //alert("masuk3");
            url: "penilaian/prosesPenilaian/",
            type: "POST", // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOMDocument or non processed data file it is set to false
            success: function (data) {
                $('.div_group_pertanyaan').hide();
                $('#div_nilai_perilaku').html(data);
                $('#div_hasil_pertanyaan').show();


                $('#tbl-penilaian').DataTable().ajax.reload();
                /*$('#tbl-admin').DataTable().ajax.reload();
                 $('#tbl-user').DataTable().ajax.reload();*/
                cek_penilaian();
            },
            error: function (hasil) {
                alert(hasil.toString());
            }
        }
        );

    }));
</script>