<!-- background-image: linear-gradient(to right top, #3C8DBC, #004d7a, #008793, #00bf72, #a8eb12); -->
<div class="text-center info text-bold" style="background-color: #3C8DBC;padding:10px; ">
    <div id="div_0" class="div_pengajuan">
        Anda akan mengajukan Penilaian Perilaku Periode Bulan <?= bulan($periode['bulan_periode']) ?> Tahun <?= $periode['tahun_periode'] ?> 	<br><br>
        <button class="btn btn-danger" onclick="$('.close').click()" disabled>BATAL</button>
        <button class="btn btn-success" onclick="$('#div_0').hide();$('#div_1').show('slow');">YA</button>
    </div>
    <div id="div_1" class="div_pengajuan" style="display: none;">
        Konfirmasi Kandidat Evaluator / Penilai Atasan
        <table class="table table-bordered table-striped">
            <tr style="background-color: #112B40;color:white;font-weight: bold;text-align: center">
                <td colspan="4">ATASAN</td>
            </tr>
            <tr style="background-color: #112B40;color:white;font-weight: bold;text-align: center">
                <td>NIP</td>
                <td>Nama</td>
                <td>Jabatan</td>
                <td>Unit</td>
            </tr>	
            <tr>
                <td><?= !empty($patas['nip']) ? $patas['nip'] : '' ?></td>
                <td><?= !empty($patas['nama']) ? $patas['nama'] : '' ?></td>
                <td><?= !empty($patas['jabatan']) ? $patas['jabatan'] : '' ?></td>
                <td><?= !empty($patas['unitkerja']) ? $patas['unitkerja'] : '' ?></td>
            </tr>
        </table>
        <button class="btn btn-danger" onclick="$('.close').click()">BATAL</button>
        <button class="btn btn-success" onclick="$('#div_1').hide();$('#div_2').show('slow');">LANJUT</button>
    </div>

    <div id="div_2" class="div_pengajuan" style="display: none;">
        Konfirmasi Kandidat Evaluator / Penilai Teman Sejawat/Peer
        <table class="table table-bordered">
            <tr style="background-color: #112B40;color:white;font-weight: bold;text-align: center">
                <td colspan="5">Teman/Peer</td>
            </tr>
            <tr style="background-color: #112B40;color:white;font-weight: bold;text-align: center">
                <td>No</td>
                <td>NIP</td>
                <td>Nama</td>
                <td>Jabatan</td>
                <td>Unit</td>
            </tr>	
            <?php
            $no = 1;
            foreach ($patem as $dt) {
                ?>
                <tr style="background-color: white;">
                    <td><?= $no ?></td>
                    <td><?= !empty($dt['nip']) ? $dt['nip'] : '' ?></td>
                    <td><?= !empty($dt['nama']) ? $dt['nama'] : '' ?></td>
                    <td><?= !empty($dt['jabatan']) ? $dt['jabatan'] : '' ?></td>
                    <td><?= !empty($dt['unitkerja']) ? $dt['unitkerja'] : '' ?></td>
                </tr>
                <?php
                $no++;
            }
            ?>
        </table>
        <button class="btn btn-danger" onclick="$('.close').click()">BATAL</button>
        <button class="btn btn-success" onclick="$('#div_2').hide();$('#div_3').show('slow');">LANJUT</button>
    </div>

    <div id="div_3" class="div_pengajuan" style="display: none;">
        Konfirmasi Kandidat Evaluator / Penilai Bawahan
        <table class="table table-bordered">
            <tr style="background-color: #112B40;color:white;font-weight: bold;text-align: center">
                <td colspan="5">Bawahan</td>
            </tr>
            <tr style="background-color: #112B40;color:white;font-weight: bold;text-align: center">
                <td>No</td>
                <td>NIP</td>
                <td>Nama</td>
                <td>Jabatan</td>
                <td>Unit</td>
            </tr>	
            <?php
            $no = 1;
            foreach ($pabaw as $dt) {
                ?>
                <tr style="background-color: white;">
                    <td><?= $no ?></td>
                    <td><?= !empty($dt['nip']) ? $dt['nip'] : '' ?></td>
                    <td><?= !empty($dt['nama']) ? $dt['nama'] : '' ?></td>
                    <td><?= !empty($dt['jabatan']) ? $dt['jabatan'] : '' ?></td>
                    <td><?= !empty($dt['unitkerja']) ? $dt['unitkerja'] : '' ?></td>
                </tr>
                <?php
                $no++;
            }
            ?>
        </table>
        <button class="btn btn-danger" onclick="$('.close').click()">BATAL</button>
        <button class="btn btn-success" onclick="$('#div_3').hide();$('#div_4').show('slow');">LANJUT</button>
    </div>

    <div id="div_4" class="div_pengajuan" style="display: none;">
        Anda mengusulkan Penilaian dengan Kelengkapan Evaluator / Penilai  	<br>
        <p class="text-center " style="font-size: 18px;color:#5B1212;">Status <?= $status['id_bobot_presentase'] ?></p>
        <br>
        <button class="btn btn-danger" onclick="$('.close').click()">BATAL</button>
        <button class="btn btn-success" onclick="$('#div_4').hide();$('#div_5').show('slow');">Ajukan</button>
    </div>
    <div id="div_5" class="div_pengajuan" style="display: none;">
        Konfirmasi Penilai Sudah dilakukan.<br> Ajukan Penilaian Perilaku ? 	<br>
        <br>
        <button class="btn btn-danger" onclick="$('.close').click()">BATAL</button>
        <button class="btn btn-success" onclick="proses_pengajuan()" id="btn-ajukan">Ajukan</button>
    </div>	
    <div id="div_6" class="div_pengajuan" style="display: none;">
        Pengajuan Penilaian Perilaku Periode Bulan <?= bulan($periode['bulan_periode']) ?> Tahun <?= $periode['tahun_periode'] ?> sudah dilakukan
        <br>
        <button class="btn btn-success" onclick="$('.close').click();   menu('dashboard', 'li-dashboard');">TUTUP</button>

    </div>
</div>

<script>
    function proses_pengajuan() {
        var id =<?= $id ?>;
        $('#btn-ajukan').attr('disabled', true);
        $.post('penilaian/proses_pengajuan', {id: id}, function (hasil) {
            if (hasil == 'ok') {
                $('#div_5').hide();
                $('#div_6').show('slow');
            } else {
                alert(hasil);
                $('#div_5').hide();
                $('#div_6').show('slow');
            }


        });

    }
</script>