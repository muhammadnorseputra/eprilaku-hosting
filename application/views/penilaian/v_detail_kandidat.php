<style>
    .judul{
        background-color: #112B40;color:white;font-weight: bold;
    }
</style>
<?php

function ket_jab($flag, $urut) {
    if ($flag == 0) {
        return 'Atasan';
    } elseif ($flag == 1 && $urut == 1) {
        return 'Peer I';
    } elseif ($flag == 1 && $urut == 2) {
        return 'Peer II';
    } elseif ($flag == 2 && $urut == 1) {
        return 'Bawahan I';
    } elseif ($flag == 2 && $urut == 2) {
        return 'Bawahan II';
    }
}
?>
<h2 class="text-center text-bold">DETAIL KANDIDAT TERPILIH</h2>
<table class="table table-bordered">
    <tr>
        <td></td>
        <td class="judul text-center">NIP</td>
        <td class="judul text-center">NAMA</td>
        <td class="judul text-center">JABATAN</td>
        <td class="judul text-center">UNIT</td>
    </tr>
<?php foreach ($detail as $dt) { ?>
        <tr>
            <td class="judul"><?= ket_jab($dt['flag_user'], $dt['urut']) ?></td>
            <td><?= $dt['nip'] ?></td>
            <td><?= $dt['nama'] ?></td>
            <td><?= $dt['jabatan'] ?></td>
            <td><?= $dt['unitkerja'] ?></td>
        </tr>
<?php } ?>
</table>