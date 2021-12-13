<section class="content-header" style="height: 30px;">
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading text-center text-bold"><?= date('Y') ?></div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-responsive">
                        <tr class="info text-center text-bold">
                            <td rowspan="2">No</td>
                            <td rowspan="2">TGL PEMBUATAN PERIODE PENILAIAN</td>
                            <td colspan="2">PERIODE PENILAIAN</td>
                            <td rowspan="2">AJUKAN PENILAIAN</td>
                            <td rowspan="2">TGL PENGAJUAN</td>
                            <td rowspan="2">STATUS KELENGKAPAN</td>
                            <td rowspan="2">STATUS</td>
                        </tr>
                        <tr class="info text-center text-bold">
                            <td>BULAN</td>
                            <td>TAHUN</td>
                        </tr>

                        <?php
                        $no = 1;
                        foreach ($periode as $per) {
                            $id = $per['id_dd_periode_penilaian'];
                            if ($per['flag_aktif'] == 1) {
                                $linkPengajuan = "<a href='javascript:void(0)' onclick='ajukan_penilaian({$id})' class='fa fa-arrow-circle-up fa-2x '></a>";
                            } else {
                                $linkPengajuan = "<a href='javascript:void(0)' onclick='alert(&#34;Periode Pengajuan Sudah Ditutup&#34;)' class='fa fa-file'></a>";
                            }
                            ?>
                            <tr>
                                <td class="text-center"><?= $no ?></td>
                                <td class="text-center"><?= date('d M Y', strtotime($per['tgl_pembuatan'])) ?></td>
                                <td class="text-center"><?= $per['bulan_periode'] ?></td>
                                <td class="text-center"><?= $per['tahun_periode'] ?></td>
                                <td class="text-center"><?= $per['created_date'] !== null ? '' : $linkPengajuan; ?></td>
                                <td class="text-center"><?= $per['created_date'] == "" ? "" : date('d M Y H:i', strtotime($per['created_date'])) ?></td>
                                <td class="text-center"><?= $per['status_kelengkapan'] ?></td>
                                <td class="text-center <?= $per['created_date'] == null ? 'danger' : 'success' ?>"><?= $per['created_date'] == null ? 'Belum Diajukan' : 'Sudah Diajukan' ?></td>
                            </tr>
                            <?php
                            $no++;
                        }
                        ?>
                    </table>

                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading text-center text-bold">DAFTAR PEGAWAI YANG BELUM ANDA NILAI</div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-responsive">
                        <tr class="info text-center text-bold">
                            <td >No</td>
                            <td>TGL PENGAJUAN</td>
                            <td >PERIODE PENILAIAN</td>
                            <td>NAMA PENGAJU</td>
                            <td >NIP</td>
                            <td>JABATAN</td>
                            <td>UNIT</td>
                            <td>ANDA DIAJUKAN SEBAGAI</td>
                        </tr>

                        <?php
                        $no = 1;
                        foreach ($periode2 as $per2) {
                            ?>
                            <tr>
                                <td class="text-center"><?= $no ?></td>
                                <td class="text-center"><?= date('d M Y', strtotime($per2['created_date'])) ?></td>
                                <td class="text-center"><?= bulan($per2['bulan_periode']) . ' ' . $per2['tahun_periode'] ?></td>
                                <td class="text-center"><?= $per2['nama'] ?></td>
                                <td class="text-center"><?= $per2['nip'] ?></td>
                                <td class="text-center"><?= $per2['jabatan'] ?></td>
                                <td class="text-center"><?= $per2['unitkerja'] ?></td>
                                <td class="text-center"> <?= $per2['status'] ?></td>
                            </tr>
                            <?php
                            $no++;
                        }
                        ?>
                    </table>

                </div>
            </div>

        </div>
    </div>
</section>

<script>
    function ajukan_penilaian(id) {
        var dialog = new BootstrapDialog({
            message: function (dialogRef) {
                var $message = $('<div></div>').load('penilaian/pengajuan/' + id);
                var $button = $('<button class="btn btn-primary btn-lg btn-block">Close the dialog</button>');
                $button.on('click', {dialogRef: dialogRef}, function (event) {
                    event.data.dialogRef.close();
                });
                $message.append($button);

                return $message;
            },
            closable: false
        });
        dialog.realize();
        dialog.getModalHeader().hide();
        dialog.getModalFooter().hide();
        dialog.open();
    }

</script>