<style>
#tbl_rekap thead{
	text-align:center;font-weight:bold;
	background-color:#3c8dbc;color:black;
}#tbl_rekap  tr td{
	border: solid 1px black;
}.text-center{
	text-align:center;
}
</style>

<table class="table" id="tbl_rekap" style="  border-collapse: collapse;">
<thead>
<tr>
	<td>No</td>
	<td>Periode</td>
	<td>Nama</td>
	<td>NIP</td>
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
	<td class="text-center" width="50"><?=$no?></td>
	<td class="text-center" width="150"><?=bulan($periode->bulan_periode).' '.$periode->tahun_periode?></td>
	<td width="200"><?=$dt->nama?></td>
	<td width="150"><?=$dt->nip?></td>
	<td width="180"><?=$dt->jabatan?></td>
	<td width="200"><?=$dt->unitkerja?></td>
	<td width="150"><?=$dt->orientasi_pelayanan?></td>
	<td width="150"><?=$dt->komitmen?></td>
	<td width="150"><?=$dt->disiplin?></td>
	<td width="150"><?=$dt->integritas?></td>
	<td width="150"><?=$dt->kerjasama?></td>
	<td width="150"><?=$dt->kepemimpinan?></td>
</tr>
<?php $no++;}?>
</tbody>
</table>