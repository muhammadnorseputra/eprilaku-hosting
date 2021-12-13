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
        <td colspan="2">Atasan <?php
		if(isset($atasan[0]['id_dd_user'])){
		?>
		<button class="btn btn-danger" onclick="konfirm_hapus_penilaian(<?=$atasan[0]['id_dd_user']?>,<?=$atasan[0]['id_opmt_penilaian']?>)">Hapus</button>
		<?php }
		?></td>
     
    </tr>
    <tr>
        <td class="text-center text-bold" style="font-size: 20px;"><?= ($bobot_atasan = !isset($bobot['bobot_atasan'])?0:$bobot['bobot_atasan']) * 100 ?> %</td>
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
       
     
    </tr>

    <tr>
        <td style="background-color:#112B40 ;color:white;font-weight: bold;text-align: center;"></td>
        <td style="background-color:#112B40 ;color:white;font-weight: bold;text-align: center;">Teman / Peer I<?php
		if(isset($teman_1[0]['id_dd_user'])){
		?>
		<button class="btn btn-danger" onclick="konfirm_hapus_penilaian(<?=$teman_1[0]['id_dd_user']?>,<?=$teman_1[0]['id_opmt_penilaian']?>)">Hapus</button>
		<?php }
		?></td>
        <td style="background-color:#112B40 ;color:white;font-weight: bold;text-align: center;">Teman / Peer II<?php
		if(isset($teman_2[0]['id_dd_user'])){
		?>
		<button class="btn btn-danger" onclick="konfirm_hapus_penilaian(<?=$teman_2[0]['id_dd_user']?>,<?=$teman_2[0]['id_opmt_penilaian']?>)">Hapus</button>
		<?php }
		?></td>
       
    </tr>

    <tr>
        <td class="text-center text-bold" style="font-size: 20px;"><?= ($bobot_teman =!isset($bobot['bobot_teman'])?0: $bobot['bobot_teman']) * 100 ?> %</td>

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
        
    </tr>

    <tr>
        <td style="background-color:#112B40 ;color:white;font-weight: bold;text-align: center;"></td>
        <td style="background-color:#112B40 ;color:white;font-weight: bold;text-align: center;">Bawahan I<?php
		if(isset($bawahan_1[0]['id_dd_user'])){
		?>
		<button class="btn btn-danger" onclick="konfirm_hapus_penilaian(<?=$bawahan_1[0]['id_dd_user']?>,<?=$bawahan_1[0]['id_opmt_penilaian']?>)">Hapus</button>
		<?php }
		?></td>
        <td style="background-color:#112B40 ;color:white;font-weight: bold;text-align: center;">Bawahan II<?php
		if(isset($bawahan_2[0]['id_dd_user'])){
		?>
		<button class="btn btn-danger" onclick="konfirm_hapus_penilaian(<?=$bawahan_2[0]['id_dd_user']?>,<?=$bawahan_2[0]['id_opmt_penilaian']?>)">Hapus</button>
		<?php }
		?></td>
        <td></td>
    </tr>

    <tr>
        <td class="text-center text-bold" style="font-size: 20px;"><?= ($bobot_bawahan =!isset($bobot['bobot_bawahan'])?0: $bobot['bobot_bawahan']) * 100 ?> %</td>
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
      
        <!-- Nilai Total -->
    </tr>
</table>

<script>
   
	function konfirm_hapus_penilaian(id_user,id_opmt_penilaian){

	var dialog = new BootstrapDialog({
                                    message: function (dialogRef) {
                                        var $message = $('<div></div>').load('penilaian/konfirm_hapus/'+id_user+'/'+id_opmt_penilaian);
                                        var $button = $('<button class="btn btn-primary btn-lg btn-block">Close the dialog</button>');
                                        $button.on('click', {dialogRef: dialogRef}, function (event) {
                                            event.data.dialogRef.close();
                                        });
                                        $message.append($button);

                                        return $message;
                                    },
                                    closable: true
                                });
								 dialog.setSize(BootstrapDialog.SIZE_NORMAL);
                                dialog.realize();
                                dialog.getModalHeader().hide();
                                dialog.getModalFooter().hide();
                                dialog.open();
								
	
	}
	
	
	function hapus_penilaian(id_user,id_opmt_penilaian){
	$.post('penilaian/hapus_penilaian',{id_opmt_penilaian:id_opmt_penilaian,id_user:id_user},function(res){
	$('.close').click();
		cek_detail();
		});
	
								
	
	}
	
</script>
