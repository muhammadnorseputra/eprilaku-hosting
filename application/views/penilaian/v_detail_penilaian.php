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

                <div class="panel panel-success div_group_pertanyaan" id="div_group_pertanyaan_1">

                    <div class="panel-heading">ASPEK : ORIENTASI PELAYANAN</div>

                    <div class="panel-body" style="height: 440px;overflow: auto;">

                        <table style="padding:2px;" id="tbl_pertanyaan">

                            <?php

                            $ttl = 0;

                            $no = 1;

                            foreach ($hasil_penilaian1 as $dt) {

                                ?>

                                <tr class="text-bold">

                                    <td><?= $no . ')' ?></td>

                                    <td></td>

                                    <td><?= $dt['pertanyaan'] ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= "&nbsp;&nbsp;".$dt['jawaban'] == 1 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_1"><?= "&nbsp;&nbsp;".$dt['jawaban_1'] ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= $dt['jawaban'] == 2 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_2"><?= "&nbsp;&nbsp;".$dt['jawaban_2'] ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= $dt['jawaban'] == 3 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_3"><?= "&nbsp;&nbsp;".$dt['jawaban_3'] ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= $dt['jawaban'] == 4 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_4"><?= "&nbsp;&nbsp;".$dt['jawaban_4'] ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= $dt['jawaban'] == 5 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_5"><?= "&nbsp;&nbsp;".$dt['jawaban_5'] ?></td>

                                </tr>

                                <?php

                                $no++;

                                $ttl++;

                            }

                            ?>

                        </table>



                    </div>

                    <button type="button" class="btn btn-info pull-right" onclick="step(2)">Selanjutnya</button>

                </div>



                <div class="panel panel-success div_group_pertanyaan" id="div_group_pertanyaan_2" style="display:none;">

                    <div class="panel-heading">ASPEK : KOMITMEN</div>

                    <div class="panel-body" style="height: 440px;overflow: auto;">

                        <table style="padding:2px;" id="tbl_pertanyaan">

                            <?php

                            $no = 1;

                            foreach ($hasil_penilaian2 as $dt) {

                                ?>

                                <tr class="text-bold">

                                    <td><?= $no . ')' ?></td>

                                    <td></td>

                                    <td><?= $dt['pertanyaan'] ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= $dt['jawaban'] == 1 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_1"><?= "&nbsp;&nbsp;".$dt['jawaban_1'] ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= $dt['jawaban'] == 2 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_2"><?= "&nbsp;&nbsp;".$dt['jawaban_2'] ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= $dt['jawaban'] == 3 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_3"><?= "&nbsp;&nbsp;".$dt['jawaban_3'] ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= $dt['jawaban'] == 4 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_4"><?= "&nbsp;&nbsp;".$dt['jawaban_4'] ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= $dt['jawaban'] == 5 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_5"><?= "&nbsp;&nbsp;".$dt['jawaban_5'] ?></td>

                                </tr>

                                <?php

                                $no++;

                                $ttl++;

                            }

                            ?>

                        </table>



                    </div>

                    <button type="button" class="btn btn-success pull-left" onclick="step(1)">Sebelumnya</button>

                    <button type="button" class="btn btn-info pull-right" onclick="step(3)">Selanjutnya</button>

                </div>



                <div class="panel panel-success div_group_pertanyaan" id="div_group_pertanyaan_3" style="display:none;">

                    <div class="panel-heading">ASPEK : INTEGRITAS</div>

                    <div class="panel-body" style="height: 440px;overflow: auto;">

                        <table style="padding:2px;" id="tbl_pertanyaan">

                            <?php

                            $no = 1;

                            foreach ($hasil_penilaian3 as $dt) {

                                ?>

                                <tr class="text-bold">

                                    <td><?= $no . ')' ?></td>

                                    <td></td>

                                    <td><?= $dt['pertanyaan'] ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= $dt['jawaban'] == 1 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_1"><?= "&nbsp;&nbsp;".$dt['jawaban_1'] ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= $dt['jawaban'] == 2 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_2"><?= "&nbsp;&nbsp;".$dt['jawaban_2'] ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= $dt['jawaban'] == 3 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_3"><?= "&nbsp;&nbsp;".$dt['jawaban_3'] ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= $dt['jawaban'] == 4 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_4"><?= "&nbsp;&nbsp;".$dt['jawaban_4'] ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= $dt['jawaban'] == 5 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_5"><?= "&nbsp;&nbsp;".$dt['jawaban_5'] ?></td>

                                </tr>

                                <?php

                                $no++;

                                $ttl++;

                            }

                            ?>

                        </table>



                    </div>

                    <button type="button" class="btn btn-success pull-left" onclick="step(2)">Sebelumnya</button>

                    <button type="button" class="btn btn-info pull-right" onclick="step(4)">Selanjutnya</button>

                </div>



                <div class="panel panel-success div_group_pertanyaan" id="div_group_pertanyaan_4" style="display:none;">

                    <div class="panel-heading">ASPEK : KERJASAMA</div>

                    <div class="panel-body" style="height: 440px;overflow: auto;">

                        <table style="padding:2px;" id="tbl_pertanyaan">

                            <?php

                            $no = 1;

                            foreach ($hasil_penilaian4 as $dt) {

                                ?>

                                <tr class="text-bold">

                                    <td><?= $no . ')' ?></td>

                                    <td></td>

                                    <td><?= $dt['pertanyaan'] ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= $dt['jawaban'] == 1 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_1"><?= "&nbsp;&nbsp;".$dt['jawaban_1'] ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= $dt['jawaban'] == 2 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_2"><?= "&nbsp;&nbsp;".$dt['jawaban_2'] ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= $dt['jawaban'] == 3 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_3"><?= "&nbsp;&nbsp;".$dt['jawaban_3'] ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= $dt['jawaban'] == 4 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_4"><?= "&nbsp;&nbsp;".$dt['jawaban_4'] ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= $dt['jawaban'] == 5 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_5"><?= "&nbsp;&nbsp;".$dt['jawaban_5'] ?></td>

                                </tr>

                                <?php

                                $no++;

                                $ttl++;

                            }

                            ?>

                        </table>



                    </div>

                    <button type="button" class="btn btn-success pull-left" onclick="step(3)">Sebelumnya</button>

                    <button type="button" class="btn btn-info pull-right" onclick="step(5)">Selanjutnya</button>

                </div>



                <div class="panel panel-success div_group_pertanyaan" id="div_group_pertanyaan_5" style="display:none;">

                    <div class="panel-heading">ASPEK : DISIPLIN</div>

                    <div class="panel-body" style="height: 440px;overflow: auto;">

                        <table style="padding:2px;" id="tbl_pertanyaan">

                            <?php

                            $no = 1;

                            foreach ($hasil_penilaian5 as $dt) {

                                ?>

                                <tr class="text-bold">

                                    <td><?= $no . ')' ?></td>

                                    <td></td>

                                    <td><?= $dt['pertanyaan'] ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= $dt['jawaban'] == 1 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_1"><?= "&nbsp;&nbsp;".$dt['jawaban_1'] ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= $dt['jawaban'] == 2 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_2"><?= "&nbsp;&nbsp;".$dt['jawaban_2'] ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= $dt['jawaban'] == 3 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_3"><?= "&nbsp;&nbsp;".$dt['jawaban_3'] ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= $dt['jawaban'] == 4 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_4"><?= "&nbsp;&nbsp;".$dt['jawaban_4'] ?></td>

                                </tr>

                                <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= $dt['jawaban'] == 5 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_5"><?= "&nbsp;&nbsp;".$dt['jawaban_5'] ?></td>

                                </tr>

                                <?php

                                $no++;

                                $ttl++;

                            }

                            ?>

                        </table>



                    </div>

                    <button type="button" class="btn btn-success pull-left" onclick="step(4)">Sebelumnya</button>

                    <?php if (!in_array($jabatan, array('JST', 'JS'))) { ?>

                        <button type="button" class="btn btn-info pull-right" onclick="$('.close').click();">Selesai</button>

                    <?php } else { ?>

                        <button type="button" class="btn btn-info pull-right" onclick="step(6)">Selanjutnya</button>

                    <?php } ?>

                </div>



                <?php if ($flag_eselon == 1 || in_array($jabatan, array('JST', 'JS'))) { ?>

                    <div class="panel panel-success div_group_pertanyaan" id="div_group_pertanyaan_6" style="display:none;">

                        <div class="panel-heading">ASPEK : KEPEMIMPINAN</div>

                        <div class="panel-body" style="height: 440px;overflow: auto;">

                            <table style="padding:2px;" id="tbl_pertanyaan">

                                <?php

                                $no = 1;



                                foreach ($hasil_penilaian6 as $dt) {

                                    $jawaban = $dt['jawaban'];

                                    ?>

                                    <tr class="text-bold">

                                        <td><?= $no . ')' ?></td>

                                        <td></td>

                                        <td><?= $dt['pertanyaan'] ?></td>

                                    </tr>

                                    <tr>

                                        <td></td>

                                        <td></td>

                                        <td><input type= "radio" disabled <?= $jawaban == 1 ? 'checked' : '' ?>/><?= "&nbsp;&nbsp;".$dt['jawaban_1'] ?></td>

                                    </tr>

                                    <tr>

                                        <td></td>

                                        <td></td>

                                        <td><input type= "radio" disabled <?= $jawaban == 2 ? 'checked' : '' ?> /><?= "&nbsp;&nbsp;".$dt['jawaban_2'] ?></td>

                                    </tr>

                                    <tr>

                                        <td></td>

                                        <td></td>

                                        <td><input type= "radio" disabled <?= $jawaban == 3 ? 'checked' : '' ?> /><?= "&nbsp;&nbsp;".$dt['jawaban_3'] ?></td>

                                    </tr>

                                    <tr>

                                        <td></td>

                                        <td></td>

                                        <td><input type= "radio" disabled <?= $jawaban == 4 ? 'checked' : '' ?> /><?= "&nbsp;&nbsp;".$dt['jawaban_4'] ?></td>

                                    </tr>

                                    <tr>

                                    <td></td>

                                    <td></td>

                                    <td><input type= "radio" disabled <?= $dt['jawaban'] == 5 ? 'checked' : '' ?> name="pertanyaan[<?= $ttl ?>]" value="<?= $dt['id_dd_pertanyaan'] ?>_5"><?= "&nbsp;&nbsp;".$dt['jawaban_5'] ?></td>

                                </tr>

                                    <?php

                                    $no++;

                                }

                                ?>

                            </table>



                        </div>

                        <button type="button" class="btn btn-success pull-left" onclick="step(5)">Sebelumnya</button>

                        <button type="button" class="btn btn-info pull-right" onclick="	$('.close').click();">Selesai</button>

                    </div>

                <?php } ?>

            </form>

        </div>

    </div>

</div>

<script>

    function step(id) {



        $('.div_group_pertanyaan').hide();

        $('#div_group_pertanyaan_' + id).show('slow');

    }



</script>