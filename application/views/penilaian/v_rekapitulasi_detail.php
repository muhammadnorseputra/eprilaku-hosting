<style>
#tbl_rekap thead{
	text-align:center;font-weight:bold;
	background-color:#3c8dbc;color:white;
}#tbl_rekap  tr td{
	border: solid 1px black;
}
</style>

<table class="table" id="tbl_rekap">
<thead>
<tr>
	<td>No</td>
	<td>Periode</td>
	<td>Nama NIP</td>
	<td>Jabatan</td>
	<td>Unit Kerja</td>
	<td>Orientasi Pelayanan</td>
	<td>Komitmen</td>
	<td>Disiplin</td>
	<td>Integritas</td>
	<td>Kerjasama</td>
	<td>Kepemimpinan</td>
</tr>
</thead>
<tbody>
<?php $no=1;foreach($rekap as $dt){?>
<tr>
	<td class="text-center"><?=$no?></td>
	<td class="text-center"><?=bulan($periode->bulan_periode).' '.$periode->tahun_periode?></td>
	<td class="text-left"><?=$dt->nama.' '.$dt->nip?></td>
	<td><?=$dt->jabatan?></td>
	<td><?=$dt->unitkerja?></td>
	<td class="text-center"><?=$dt->orientasi_pelayanan?></td>
	<td class="text-center"><?=$dt->komitmen?></td>
	<td class="text-center"><?=$dt->disiplin?></td>
	<td class="text-center"><?=$dt->integritas?></td>
	<td class="text-center"><?=$dt->kerjasama?></td>
	<td class="text-center"><?=$dt->kepemimpinan?></td>
</tr>
<?php $no++;}?>
</tbody>
</table>