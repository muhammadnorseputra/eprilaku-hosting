<style>
    #hasil table td{
        padding:5px;font-size: 12px;
    }
</style>
<div id='hasil'>
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-success">
                <div class="panel-heading">Orientasi Pelayanan</div>
                <div class="panel-body">
                    <table style='padding:10px;'>
                        <?php
                        $no = 1;
                        foreach ($hasil_penilaian1 as $dt) {
                            ?>
                            <tr>
                                <td>Pertanyaan <?= $no ?></td>
                                <td> : </td>
                                <td><?= $jml[] = $dt['jawaban'] ?> x 4 = <?= $dt['jawaban'] * 4 ?></td>
                            </tr>
                            <?php
                            $no++;
                        }
                        ?>
                        <tr>
                            <td>Nilai Total Aspek</td>
                            <td> : </td>
                            <td><?= array_sum($jml) * 4 ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-success">
                <div class="panel-heading">Komitmen</div>
                <div class="panel-body">

                    <table>
                        <?php
                        unset($jml);
                        $no = 1;
                        foreach ($hasil_penilaian2 as $dt) {
                            ?>
                            <tr>
                                <td>Pertanyaan <?= $no ?></td>
                                <td> : </td>
                                <td><?= $jml[] = $dt['jawaban'] ?> x 4 = <?= $dt['jawaban'] * 4 ?></td>
                            </tr>
                            <?php
                            $no++;
                        }
                        ?>
                        <tr>
                            <td>Nilai Total Aspek</td>
                            <td> : </td>
                            <td><?= array_sum($jml) * 4 ?></td>
                        </tr>
                    </table>
                </div>	
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-success">
                <div class="panel-heading">Integritas</div>
                <div class="panel-body">
                    <table>
                        <?php
                        unset($jml);
                        $no = 1;
                        foreach ($hasil_penilaian3 as $dt) {
                            ?>
                            <tr>
                                <td>Pertanyaan <?= $no ?></td>
                                <td> : </td>
                                <td><?= $jml[] = $dt['jawaban'] ?> x 4 = <?= $dt['jawaban'] * 4 ?></td>
                            </tr>
                            <?php
                            $no++;
                        }
                        ?>
                        <tr>
                            <td>Nilai Total Aspek</td>
                            <td> : </td>
                            <td><?= array_sum($jml) * 4 ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-success">
                <div class="panel-heading">Kerjasama</div>
                <div class="panel-body">
                    <table>
                        <?php
                        unset($jml);
                        $no = 1;
                        foreach ($hasil_penilaian4 as $dt) {
                            ?>
                            <tr>
                                <td>Pertanyaan <?= $no ?></td>
                                <td> : </td>
                                <td><?= $jml[] = $dt['jawaban'] ?> x 4 = <?= $dt['jawaban'] * 4 ?></td>
                            </tr>
                            <?php
                            $no++;
                        }
                        ?>
                        <tr>
                            <td>Nilai Total Aspek</td>
                            <td> : </td>
                            <td><?= array_sum($jml) * 4 ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-success">
                <div class="panel-heading">Disiplin</div>
                <div class="panel-body">
                    <table>
                        <?php
                        unset($jml);
                        $no = 1;
                        foreach ($hasil_penilaian5 as $dt) {
                            ?>
                            <tr>
                                <td>Pertanyaan <?= $no ?></td>
                                <td> : </td>
                                <td><?= $jml[] = $dt['jawaban'] ?> x 4 = <?= $dt['jawaban'] * 4 ?></td>
                            </tr>
                            <?php
                            $no++;
                        }
                        ?>
                        <tr>
                            <td>Nilai Total Aspek</td>
                            <td> : </td>
                            <td><?= array_sum($jml) * 4 ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php if ($flag_eselon == 1 || in_array($jabatan, array('JST', 'JS'))) { ?>
        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-success">
                    <div class="panel-heading">Kepemimpinan</div>
                    <div class="panel-body">
                        <table>
                            <?php
                            unset($jml);
                            $no = 1;
                            foreach ($hasil_penilaian6 as $dt) {
                                ?>
                                <tr>
                                    <td>Pertanyaan <?= $no ?></td>
                                    <td> : </td>
                                    <td><?= $jml[] = $dt['jawaban'] ?> x 4 = <?= $dt['jawaban'] * 4 ?></td>
                                </tr>
                                <?php
                                $no++;
                            }
                            ?>
                            <tr>
                                <td>Nilai Total Aspek</td>
                                <td> : </td>
                                <td><?= array_sum($jml) * 4 ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>