<div style="text-align:center;height:75px;">Apakah Anda akan menghapus Pengajuan Penilaian Perilaku <br><b><?=$user.' / '.$nip?></b><br> Pada Periode <?=bulan($bulan).' '.$tahun?>
	</div>
	<button class="btn btn-danger" onclick="$('.close').click();"> Batal</button>
	<button class="btn btn-success pull-right" onclick="hapus_pengajuan(<?=$id_user?>,<?=$id_dd_periode_penilaian?>)">Hapus Nilai</button>
	<br>