<style>
    .judul{
        background-color: #337AB7;color:white;font-size: 14px;
    }.judul2{
        background-color: #77933C;color:white;font-size: 14px;
    }
</style>
<!-- json_encode($periode);
echo $penilaian[1][1]['id_group_pertanyaan'];
-->
<?php
//echo count($penilaian[0]);
$arrGroupPertanyaan = array('Orientasi Pelayanan', 'Komitmen', 'Integritas', 'Kerjasama', 'Disiplin', 'Kepemimpinan');
$ttl = count($penilaian[0]);
?>

<form method="post" id="frmPerilakuTahunan">
    <table class="table table-bordered">
        <?php for ($x = 0; $x < count($periode); $x++) { ?>
            <tr>
                <td class="text-center text-bold judul" colspan="6">PERIODE BULAN <?= bulan($periode[$x]['bulan_periode']) ?> TAHUN <?= $periode[$x]['tahun_periode'] ?><br>NILAI TOTAL</td>
            </tr
            <tr class="info text-center text-bold">
                <?php for ($i = 0; $i < count($penilaian[0]); $i++) {
                    ?>
                    <td class="text-center text-bold info"><?= !empty($penilaian[$x][$i]['group_pertanyaan']) ? $penilaian[$x][$i]['group_pertanyaan'] : $arrGroupPertanyaan[$i] ?></td>
                <?php } ?>
                <?= $ttl == 5 ? '<td class="text-center text-bold info">Kepemimpinan</td>' : ''; ?>
            </tr>
            <tr class="text-center">
                <?php for ($i = 0; $i < count($penilaian[0]); $i++) {
                    ?>
                    <td>
                        <?= !empty($penilaian[$x][$i]['ttl_jawaban']) ?number_format( $nilai[] = ${"nilai_" . $i}[] = $penilaian[$x][$i]['ttl_jawaban'],2) : $nilai[] = ${"nilai_" . $i}[] = '' ?></td>
                <?php } ?>
            </tr>
            <input type="hidden" name="periode[]" value="<?= $periode[$x]['id_dd_periode_penilaian'] ?>">
            <input type="hidden" name="nilai[]" value="<?= array_sum($nilai) / $ttl ?>">
            <?php
            unset($nilai);
        }
        $nilai_0 = array_filter($nilai_0);
        $nilai_1 = array_filter($nilai_1);
        $nilai_2 = array_filter($nilai_2);
        $nilai_3 = array_filter($nilai_3);
        $nilai_4 = array_filter($nilai_4);
        if (!empty($nilai_5)) {
            $nilai_5 = array_filter($nilai_5);
        }
		$ttl_6=0;
        ?>

        <tr>
            <td class="text-center text-bold judul2" colspan="6">NILAI PERILAKU TAHUN <?= date('Y') ?></td>
        </tr>
        <tr class="success text-center text-bold">
            <td>Orientasi Pelayanan</td>
            <td>Komitmen</td>
            <td>Integritas</td>
            <td>Kerjasama</td>
            <td>Disiplin</td>
            <td>Kepemimpinan</td>
        </tr>
        <tr class="text-center">
            <td><?= $nilai_akhir[] =$ttl_1= array_sum(${"nilai_0"}) / count(${"nilai_0"}) ?></td>
            <td><?= $nilai_akhir[] =$ttl_2= array_sum(${"nilai_1"}) / count(${"nilai_1"}) ?></td>
            <td><?= $nilai_akhir[] =$ttl_3= array_sum(${"nilai_2"}) / count(${"nilai_2"}) ?></td>
            <td><?= $nilai_akhir[] =$ttl_4= array_sum(${"nilai_3"}) / count(${"nilai_3"}) ?></td>
            <td><?= $nilai_akhir[] =$ttl_5= array_sum(${"nilai_4"}) / count(${"nilai_4"}) ?></td>
            <td><?= !empty(${"nilai_5"}) ? $nilai_akhir[] =$ttl_6= array_sum(${"nilai_5"}) / count(${"nilai_5"}) : "" ?></td>
	    <input type="hidden" name="id_dd_user" value="<?= encrypt_nilai($id_user) ?>">
		<input type="hidden" name="tahun" value="<?= encrypt_nilai($periode[0]['tahun_periode']) ?>">
		<input type="hidden" name="nilai_0" value="<?= encrypt_nilai($ttl_1) ?>">
		<input type="hidden" name="nilai_1" value="<?= encrypt_nilai($ttl_2) ?>">
		<input type="hidden" name="nilai_2" value="<?= encrypt_nilai($ttl_3) ?>">
		<input type="hidden" name="nilai_3" value="<?= encrypt_nilai($ttl_4) ?>">
		<input type="hidden" name="nilai_4" value="<?= encrypt_nilai($ttl_5) ?>">
		<input type="hidden" name="nilai_5" value="<?= encrypt_nilai($ttl_6) ?>">
        </tr>
        <tr class="success">
            <td class="text-center text-bold" colspan="6" style="font-size: 16px;">
                NILAI AKHIR <?= date('Y') ?><br>
                <?= number_format(array_sum($nilai_akhir) / count($nilai_akhir), 2) ?><br>
                <input type="hidden" name="nilai_akhir" value="<?= encrypt_nilai(array_sum($nilai_akhir) / count($nilai_akhir)) ?>">
            </td>
        </tr>
        <tr>
            <td colspan="6"><button class="btn btn-success text-bold text-center" style="color:white; float:right;">Simpan</button>
            </td>
        </tr>
    </table>
</form>

<script>
    $("#frmPerilakuTahunan").on('submit', (function (e) {
        e.preventDefault();
        var r = confirm('Yakin ingin memproses data ini ?');
        if (r) {
            //alert("masuk2");
            $.ajax({
                //alert("masuk3");
                url: "penilaian/prosesPerilakuTahunan/",
                type: "POST", // Type of request to be send, called as method
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function (data) {
                    alert(data);
//                    $('.close').click();
//                    $('#tbl-admin').DataTable().ajax.reload();
//                    $('#tbl-user').DataTable().ajax.reload();

                },
                error: function (hasil) {
                    alert(hasil.toString());
                }
            }
            );
        }

    }));
</script>