<section class="content-header" style="height: 30px;">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Penilaian</a></li>
        <li class="active">Perilaku Tahunan</li>
    </ol>
</section>
<style>
    #tbl_perilaku_tahunan_param td{
        padding:10px;
    }
</style>
<section class="content" style="padding-top:15px;">
    <table id="tbl_perilaku_tahunan_param">
        <tr>
            <td>Tahun</td>
            <td><select class="form-control" id="tahun_pt">
                    <?php foreach ($tahun as $dt) { ?>
                        <option value="<?= $dt['tahun'] ?>"><?= $dt['tahun'] ?></option>
                    <?php } ?>
                </select></td>
            <td><button class="btn btn-primary" onclick="tampil_pt()">Tampilkan</button></td>
        </tr>
    </table>

    <div id="div_perilaku_tahunan"></div>
</section>

<script>
    function tampil_pt() {
        var tahun = $('#tahun_pt').val();
        $.post('penilaian/dt_perilaku_tahunan', {tahun: tahun}, function (hasil) {
            $('#div_perilaku_tahunan').html(hasil);
        });
    }
</script>
