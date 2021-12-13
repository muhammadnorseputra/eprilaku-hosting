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
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
            <!-- TO DO List -->
            <div class="box box-primary">
                <div class="box-header">
                    <i class="ion ion-clipboard"></i>
                    <h3 class="box-title text-center">DETAIL PERIODE TAHUN <?= date('Y') ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
                    <table class="table table-bordered table-striped">
                        <tr style="text-align: center;font-weight: bold;background-color: #0a5882;color:white;">
                            <td rowspan="2">No</td>
                            <td rowspan="2">Tgl Pembuatan Periode Penilaian</td>
                            <td colspan="2">Periode Penilaian</td>
                            <td rowspan="2">JUMLAH PEGAWAI YANG SUDAH MENGAJUKAN</td>
                            <td rowspan="2">JUMLAH PEGAWAI YANG BELUM MENGAJUKAN</td>
                            <td rowspan="2">PDF PEGAWAI YANG BELUM MENGAJUKAN</td>
                        </tr>
                        <tr style="text-align: center;font-weight: bold;background-color: #0a5882;color:white;">
                            <td style="vertical-align: middle;">BULAN</td>
                            <td>TAHUN</td>
                        </tr>
                        <?php
                        $i = 1;
                        foreach ($laporan as $dt) {
                            ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td class="text-center"><?= date('d M Y', strtotime($dt['tgl_pembuatan'])) ?></td>
                                <td class="text-center"><?= bulan($dt['bulan_periode']) ?></td>
                                <td class="text-center"><?= $dt['tahun_periode'] ?></td>
                                <td class="text-center"><?= !empty($dt['ttl']) ? number_format($dt['ttl']) : "" ?></td>
                                <td class="text-center"><?= !empty($dt['ttl']) ? number_format($total['ttl'] - $dt['ttl']) : "" ?></td>
                                <td class="text-center"><?php if (!empty($dt['ttl'])) { ?><a class="fa fa-file-pdf-o" onclick="lihat_pdf(<?= $dt['id_dd_periode_penilaian'] ?>)" href="javascript:void(0)"></a> <?php } ?></td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>

                    </table>
                </div>
            </div>
            <!-- /.box -->
            <!-- Custom tabs (Charts with tabs)-->
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                    <li class="pull-left header"><i class="fa fa-inbox"></i> PERILAKU PEGAWAI TAHUN <?= date('Y') ?></li>
                </ul>
                <div class="tab-content no-padding">
                    <div class="chart">
                        <div id="container" style="min-width: 310px; height: 300px; margin: 0 auto"></div>
                    </div>
                </div>
            </div>
            <!-- /.nav-tabs-custom -->

        </section>

        <!-- right col -->
    </div>
    <!-- /.row (main row) -->
    <div id="div_cetak" style="display: none;">

    </div>
    <script>
        function lihat_pdf(id) {
            var dialog = new BootstrapDialog({
                message: function (dialogRef) {
                    var $message = $('<iframe id="iframe_cetak" src="dashboard/cetak/' + id + '"  style="width:100%;height:400px;"></iframe>');
                    var $button = $('<button class="btn btn-primary btn-lg btn-block">Close the dialog</button>');
                    $button.on('click', {dialogRef: dialogRef}, function (event) {
                        event.data.dialogRef.close();
                    });
                    $message.append($button);

                    return $message;
                },
                closable: true,
                size: 'size-wide'
            });
            dialog.realize();
            dialog.getModalHeader().hide();
            dialog.getModalFooter().hide();
            dialog.open();
            $('#iframe_cetak').attr('src', );
        }
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'PERILAKU PEGAWAI TAHUN 2018'
            },
            credits: {
                enabled: false
            },
            xAxis: {
                categories: [
<?php
$i = 1;
foreach ($grafik as $dt) {
    $bulan = $dt['bulan_periode'];
    $tahun = $dt['tahun_periode'];
    echo '"Periode ' . $i . ' (' . bulan($bulan) . ' ' . $tahun . ')",';
    $i++;
}
?>

                ],
                crosshair: true
            },

            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            yAxis: {
                stackLabels: {
                    enabled: true,
                    align: 'center'
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                    name: 'Sangat Baik',
                    data: [<?php
for ($i = 0; $i < count($grafik); $i++) {
    echo $grafik[$i]['sangatbaik'] . ",";
}
?>]

                }, {
                    name: 'Baik',
                    data: [<?php
for ($i = 0; $i < count($grafik); $i++) {
    echo $grafik[$i]['baik'] . ",";
}
?>]

                }, {
                    name: 'Cukup',
                    data: [<?php
for ($i = 0; $i < count($grafik); $i++) {
    echo $grafik[$i]['cukup'] . ",";
}
?>]

                }, {
                    name: 'Kurang',
                    data: [<?php
for ($i = 0; $i < count($grafik); $i++) {
    echo $grafik[$i]['kurang'] . ",";
}
?>]

                }, {
                    name: 'Buruk',
                    data: [<?php
for ($i = 0; $i < count($grafik); $i++) {
    echo $grafik[$i]['buruk'] . ",";
}
?>]

                }]
        });


    </script>

</section>
<!-- /.content -->