<style>
    .x{
        width:140px !important;float:left;margin-left: 100px;
    }
    .x2{
        width:140px !important;float:left;
    }
    #tbl-detail td{
        font-size:12px;
    }
</style>

<table class="table table-bordered" id="tbl-detail">
    <tr style="background-color:#112B40 ;color:white;font-weight: bold;text-align: center;">
        <td>Bobot</td>
        <td colspan="2">Atasan</td>
        <td>Nilai</td>
        <td>Nilai Total</td>
        <td>Nilai Akhir</td>
    </tr>
    <tr>
        <td class="text-center text-bold" style="font-size: 20px;"><?= ($bobot_atasan = $bobot['bobot_atasan']) * 100 ?> %</td>
        <td colspan="2">
            <?php
            if (count($atasan) > 0) {
                foreach ($atasan as $dt) {
                    ?>
                    <span class="x"><?= $dt['group_pertanyaan'] ?></span> : <?= ($dt['ttl_jawaban'] * 4) . ' -> ' . ${"atasan_" . $dt['id_group_pertanyaan']} = $dt['ttl_jawaban'] * 4 * $bobot_atasan ?>  <br>
                    <?php
                }
            } else {
                $atasan_1 = 0;
                $atasan_2 = 0;
                $atasan_3 = 0;
                $atasan_4 = 0;
                $atasan_5 = 0;
                $atasan_6 = 0;
                ?>
                <span class="x">Orientasi Pelayanan</span> : - <br>
                <span class="x">Komitmen</span> : -<br>
                <span class="x">Integritas</span> : -<br>
                <span class="x">Kerjasama</span> : -<br>
                <span class="x">Disiplin</span> : -<br>
                <span class="x">Kepemimpinan</span> : -
            <?php } ?>
        </td>
        <td class="info">
            <?php
            if (count($atasan) > 0) {
                foreach ($atasan as $dt) {
                    ?>
                    <span class="x2"><?= $dt['group_pertanyaan'] ?></span> : <?= $dt['ttl_jawaban'] * 4 * $bobot_atasan ?>  <br>
                    <?php
                }
            } else {
                ?>
                <span class="x2">Orientasi Pelayanan</span> : - <br>
                <span class="x2">Komitmen</span> : -<br>
                <span class="x2">Integritas</span> : -<br>
                <span class="x2">Kerjasama</span> : -<br>
                <span class="x2">Disiplin</span> : -<br>
                <span class="x2">Kepemimpinan</span> : -
            <?php } ?>
        </td>	
        <!-- Nilai Total -->
        <td rowspan="5">
            <span class="x2">Orientasi Pelayanan</span> : <span id="ttl_1"></span> <br>
            <span class="x2">Komitmen</span> : <span id="ttl_2"></span><br>
            <span class="x2">Integritas</span> : <span id="ttl_3"></span><br>
            <span class="x2">Kerjasama</span> : <span id="ttl_4"></span><br>
            <span class="x2">Disiplin</span> : <span id="ttl_5"></span><br>
            <span class="x2">Kepemimpinan</span> : <span id="ttl_6"></span>
        </td>
        <td class="danger" rowspan="5">
            <span style="font-size: 24px;font-weight: bold;text-align: center;" id="nilai_akhir"></span>
        </td>
    </tr>

    <tr>
        <td style="background-color:#112B40 ;color:white;font-weight: bold;text-align: center;"></td>
        <td style="background-color:#112B40 ;color:white;font-weight: bold;text-align: center;">Teman / Peer I</td>
        <td style="background-color:#112B40 ;color:white;font-weight: bold;text-align: center;">Teman / Peer II</td>
        <td></td>
    </tr>

    <tr>
        <td class="text-center text-bold" style="font-size: 20px;"><?= ($bobot_teman = $bobot['bobot_teman']) * 100 ?> %</td>

        <td>
            <?php
            if (count($teman_1) > 0) {
                foreach ($teman_1 as $dt) {
                    ?>
                    <span class="x2"><?= $dt['group_pertanyaan'] ?></span> : <?= ($dt['ttl_jawaban'] * 4) . ' -> ' . $dt['ttl_jawaban'] * 4 * $bobot_teman ?>  <br>
                    <?php
                }
            } else {
                ?>
                <span class="x2">Orientasi Pelayanan</span> : - <br>
                <span class="x2">Komitmen</span> : -<br>
                <span class="x2">Integritas</span> : -<br>
                <span class="x2">Kerjasama</span> : -<br>
                <span class="x2">Disiplin</span> : -<br>
                <span class="x2">Kepemimpinan</span> : -
            <?php } ?>
        </td>
        <td>
            <?php
            if (count($teman_2) > 0) {
                foreach ($teman_2 as $dt) {
                    ?>
                    <span class="x2"><?= $dt['group_pertanyaan'] ?></span> : <?= ($dt['ttl_jawaban'] * 4) . ' -> ' . $dt['ttl_jawaban'] * 4 * $bobot_teman ?>  <br>
                    <?php
                }
            } else {
                ?>
                <span class="x2">Orientasi Pelayanan</span> : - <br>
                <span class="x2">Komitmen</span> : -<br>
                <span class="x2">Integritas</span> : -<br>
                <span class="x2">Kerjasama</span> : -<br>
                <span class="x2">Disiplin</span> : -<br>
                <span class="x2">Kepemimpinan</span> : -
            <?php } ?>
        </td>
        <td class="danger">
            <?php
            //Total Teman
            if (count($teman_1) > 0 && count($teman_2) > 0) {
                for ($i = 0; $i < count($teman_1); $i++) {
                    ${"ttl_teman_" . $teman_1[$i]['id_group_pertanyaan']} = $nilai = (($teman_1[$i]['ttl_jawaban'] * 4 * $bobot_teman) + ($teman_2[$i]['ttl_jawaban'] * 4 * $bobot_teman)) / 2;
                    ?>
                    <span class="x2"><?= $teman_1[$i]['group_pertanyaan'] ?></span> : <?= ${"ttl_teman_" . $dt['group_pertanyaan']} = $nilai ?>  <br>
                    <?php
                }
            } elseif (count($teman_1) > 0) {
                for ($i = 0; $i < count($teman_1); $i++) {
                    ${"ttl_teman_" . $teman_1[$i]['id_group_pertanyaan']} = $nilai = ($teman_1[$i]['ttl_jawaban'] * 4 * $bobot_teman);
                    ?>
                    <span class="x2"><?= $teman_1[$i]['group_pertanyaan'] ?></span> : <?= ${"ttl_teman_" . $dt['group_pertanyaan']} = $nilai ?>  <br>
                    <?php
                }
            } elseif (count($teman_2) > 0) {
                for ($i = 0; $i < count($teman_2); $i++) {
                    ${"ttl_teman_" . $teman_2[$i]['id_group_pertanyaan']} = $nilai = ($teman_2[$i]['ttl_jawaban'] * 4 * $bobot_teman);
                    ?>
                    <span class="x2"><?= $teman_2[$i]['group_pertanyaan'] ?></span> : <?= ${"ttl_teman_" . $teman_2[$i]['group_pertanyaan']} = $nilai ?>  <br>
                    <?php
                }
            } else {
                ?>
                <span class="x2">Orientasi Pelayanan</span> : <?= number_format(${"ttl_teman_1"} = 0) ?> <br>
                <span class="x2">Komitmen</span> : <?= number_format(${"ttl_teman_2"} = 0) ?><br>
                <span class="x2">Integritas</span> : <?= number_format(${"ttl_teman_3"} = 0) ?><br>
                <span class="x2">Kerjasama</span> : <?= number_format(${"ttl_teman_4"} = 0) ?><br>
                <span class="x2">Disiplin</span> : <?= number_format(${"ttl_teman_5"} = 0) ?><br>
                <span class="x2">Kepemimpinan</span> : <?= number_format(${"ttl_teman_6"} = 0) ?>
            <?php } ?>
        </td>	
        <!-- Nilai Total -->

    </tr>

    <tr>
        <td style="background-color:#112B40 ;color:white;font-weight: bold;text-align: center;"></td>
        <td style="background-color:#112B40 ;color:white;font-weight: bold;text-align: center;">Bawahan I</td>
        <td style="background-color:#112B40 ;color:white;font-weight: bold;text-align: center;">Bawahan II</td>
        <td></td>
    </tr>

    <tr>
        <td class="text-center text-bold" style="font-size: 20px;"><?= ($bobot_bawahan = $bobot['bobot_bawahan']) * 100 ?> %</td>
        <td>
            <?php
            if (count($bawahan_1) > 0) {
                foreach ($bawahan_1 as $dt) {
                    ?>
                    <span class="x2"><?= $dt['group_pertanyaan'] ?></span> : <?= ($dt['ttl_jawaban'] * 4) . ' -> ' . $dt['ttl_jawaban'] * 4 * $bobot_bawahan ?>  <br>
                    <?php
                }
            } else {
                ?>
                <span class="x2">Orientasi Pelayanan</span> : - <br>
                <span class="x2">Komitmen</span> : -<br>
                <span class="x2">Integritas</span> : -<br>
                <span class="x2">Kerjasama</span> : -<br>
                <span class="x2">Disiplin</span> : -<br>
                <span class="x2">Kepemimpinan</span> : -
            <?php } ?>
        </td>
        <td>
            <?php
            if (count($bawahan_2) > 0) {
                foreach ($bawahan_2 as $dt) {
                    ?>
                    <span class="x2"><?= $dt['group_pertanyaan'] ?></span> : <?= ($dt['ttl_jawaban'] * 4) . ' -> ' . $dt['ttl_jawaban'] * 4 * $bobot_bawahan ?>  <br>
                    <?php
                }
            } else {
                ?>
                <span class="x2">Orientasi Pelayanan</span> : - <br>
                <span class="x2">Komitmen</span> : -<br>
                <span class="x2">Integritas</span> : -<br>
                <span class="x2">Kerjasama</span> : -<br>
                <span class="x2">Disiplin</span> : -<br>
                <span class="x2">Kepemimpinan</span> : -
            <?php } ?>
        </td>
        <td class="danger">
            <?php
            if (count($bawahan_1) > 0 && count($bawahan_2) > 0) {
                for ($i = 0; $i < count($bawahan_1); $i++) {
                    ${"ttl_bawahan_" . $bawahan_1[$i]['id_group_pertanyaan']} = $nilai = (($bawahan_1[$i]['ttl_jawaban'] * 4 * $bobot_bawahan) + ($bawahan_2[$i]['ttl_jawaban'] * 4 * $bobot_bawahan)) / 2;
                    ?>
                    <span class="x2"><?= $bawahan_1[$i]['group_pertanyaan'] ?></span> : <?= ${"ttl_bawahan_" . $dt['group_pertanyaan']} = $nilai ?>  <br>
                    <?php
                }
            } elseif (count($bawahan_1) > 0) {
                for ($i = 0; $i < count($bawahan_1); $i++) {
                    ${"ttl_bawahan_" . $bawahan_1[$i]['id_group_pertanyaan']} = $nilai = ($bawahan_1[$i]['ttl_jawaban'] * 4 * $bobot_bawahan);
                    ?>
                    <span class="x2"><?= $bawahan_1[$i]['group_pertanyaan'] ?></span> : <?= ${"ttl_bawahan_" . $dt['group_pertanyaan']} = $nilai ?>  <br>
                    <?php
                }
            } elseif (count($bawahan_2) > 0) {
                for ($i = 0; $i < count($bawahan_2); $i++) {
                    ${"ttl_bawahan_" . $bawahan_2[$i]['id_group_pertanyaan']} = $nilai = ($bawahan_2[$i]['ttl_jawaban'] * 4 * $bobot_bawahan);
                    ?>
                    <span class="x2"><?= $bawahan_2[$i]['group_pertanyaan'] ?></span> : <?= ${"ttl_bawahan_" . $bawahan_2[$i]['group_pertanyaan']} = $nilai ?>  <br>
                    <?php
                }
            } else {
                ?>
                <span class="x2">Orientasi Pelayanan</span> : <?= number_format(${"ttl_bawahan_1"} = 0) ?> <br>
                <span class="x2">Komitmen</span> : <?= number_format(${"ttl_bawahan_2"} = 0) ?><br>
                <span class="x2">Integritas</span> : <?= number_format(${"ttl_bawahan_3"} = 0) ?><br>
                <span class="x2">Kerjasama</span> : <?= number_format(${"ttl_bawahan_4"} = 0) ?><br>
                <span class="x2">Disiplin</span> : <?= number_format(${"ttl_bawahan_5"} = 0) ?><br>
                <span class="x2">Kepemimpinan</span> : <?= number_format(${"ttl_bawahan_6"} = 0) ?>
            <?php } ?>
        </td>	
        <!-- Nilai Total -->
    </tr>
</table>
<?php
// die($teman_1);
$ttl_nilai1 = $atasan_1 + $ttl_teman_1 + $ttl_bawahan_1;
$ttl_nilai2 = $atasan_2 + $ttl_teman_2 + $ttl_bawahan_2;
$ttl_nilai3 = $atasan_3 + $ttl_teman_3 + $ttl_bawahan_3;
$ttl_nilai4 = $atasan_4 + $ttl_teman_4 + $ttl_bawahan_4;
$ttl_nilai5 = $atasan_5 + $ttl_teman_5 + $ttl_bawahan_5;
if (!empty($atasan_6) || !empty($ttl_teman_6) || !empty($ttl_bawahan_6)) {
    $ttl_nilai6 = $atasan_6 + $ttl_teman_6 + $ttl_bawahan_6;
    $rata_nilai = ($ttl_nilai1 + $ttl_nilai2 + $ttl_nilai3 + $ttl_nilai4 + $ttl_nilai5 + $ttl_nilai6) / 6;
} else {
    $ttl_nilai6 = 0;
    $rata_nilai = number_format(($ttl_nilai1 + $ttl_nilai2 + $ttl_nilai3 + $ttl_nilai4 + $ttl_nilai5) / 5, 2);
}
?>
<script>
    $('#ttl_1').html('<?= $ttl_nilai1 ?>');
    $('#ttl_2').html('<?= $ttl_nilai2 ?>');
    $('#ttl_3').html('<?= $ttl_nilai3 ?>');
    $('#ttl_4').html('<?= $ttl_nilai4 ?>');
    $('#ttl_5').html('<?= $ttl_nilai5 ?>');
    $('#ttl_6').html('<?= $ttl_nilai6 ?>');
    $('#nilai_akhir').html('<?= number_format($rata_nilai, 2) ?>');
    
    function simpan_perilaku() {
        var nilai_1=<?=$ttl_nilai1?>;
        var nilai_2=<?=$ttl_nilai2?>;
        var nilai_3=<?=$ttl_nilai3?>;
        var nilai_4=<?=$ttl_nilai4?>;
        var nilai_5=<?=$ttl_nilai5?>;
        var nilai_6=<?=$ttl_nilai6?>;
        var id=<?=$id?>;
        var id_user=<?=$id_user?>;
        $.post('penilaian/update_perilaku',{nilai_1:nilai_1,nilai_2:nilai_2,nilai_3:nilai_3,nilai_4:nilai_4,nilai_5:nilai_5,nilai_6:nilai_6,id:id,id_user:id_user},function(res) {
            });
    }

    simpan_perilaku();
    
</script>
