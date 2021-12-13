<section class="content" style="padding:0px;">
    <div class="panel panel-primary">
        <div class="panel-heading text-center">PERTANYAAN <br><?= strtoupper($pertanyaan['group_pertanyaan']) ?> 
        </div>
        <div class="panel-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Pertanyaan</label>
                    <div class="col-sm-10">
                        <input type="hidden" id="id_dd_pertanyaan" value="<?= $pertanyaan['id_dd_pertanyaan'] ?>">
                        <input type="hidden" id="id_group_pertanyaan" value="<?= $pertanyaan['id_group_pertanyaan'] ?>">
                        <textarea class="form-control" id="pertanyaan" readonly="readonly"><?= $pertanyaan['pertanyaan'] ?></textarea>
                    </div>
                </div>
                <hr>
                <div class="col-sm-12 text-center text-bold info">JAWABAN</div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-1 control-label">A</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="jawaban_5" readonly="readonly" value="<?= $pertanyaan['jawaban_5'] ?>">
                    </div>
                    <label for="inputEmail3" class="col-sm-2 control-label">(5) Nilai</label>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-1 control-label">B</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="jawaban_4" readonly="readonly" value="<?= $pertanyaan['jawaban_4'] ?>">
                    </div>
                    <label for="inputEmail3" class="col-sm-2 control-label">(4) Nilai</label>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-1 control-label">C</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="jawaban_3" readonly="readonly" value="<?= $pertanyaan['jawaban_3'] ?>">
                    </div>
                    <label for="inputEmail3" class="col-sm-2 control-label">(3) Nilai</label>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-1 control-label">D</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="jawaban_2" readonly="readonly" value="<?= $pertanyaan['jawaban_2'] ?>">
                    </div>
                    <label for="inputEmail3" class="col-sm-2 control-label">(2) Nilai</label>
                </div><div class="form-group">
                    <label for="inputEmail3" class="col-sm-1 control-label">E</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="jawaban_1" readonly="readonly" value="<?= $pertanyaan['jawaban_1'] ?>">
                    </div>
                    <label for="inputEmail3" class="col-sm-2 control-label text-left">(1) Nilai</label>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 control-label"></label>
                    <div class="col-sm-6">

                        <button class="btn btn-danger" onclick="$('.close').click()" >TUTUP</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
