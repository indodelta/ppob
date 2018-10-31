<form class="form-horizontal" method="post" autocomplete="off" id="formupdateuser">

    <?php
    $warna_lembaga=$_GET['warnalembaga'];
    $iduser = $_GET['iduser'];
    $namauser = $datauser[0]->nama;
    $emailuser = $datauser[0]->email;
    $teleponuser = $datauser[0]->telepon;
    $alamatuser = $datauser[0]->alamat;
    $leveluser = $datauser[0]->user_level;
    $klasuser = $datauser[0]->klasifikasi;
    $statususer = $datauser[0]->user_status;
    ?>

    <input type="hidden" class="form-control" id="txbwarnalembaga" value="<?php echo $warna_lembaga?>">

    <div class="form-group">

        <label class="control-label col-lg-3" style="margin-bottom: 10px;">Nama Lengkap <span style="color:#ed5565">*</span></label>

        <div class="col-lg-9">
            <input type="hidden" class="form-control" id="txbiduser" name="txbiduser" value="<?php echo $iduser?>">
            <input type="text" class="form-control" id="txbfullname" name="txbfullname" value="<?php echo $namauser?>">
        </div>

    </div>
    <div class="form-group">

        <label class="control-label col-lg-3" style="margin-bottom: 10px;">Email <span style="color:#ed5565">*</span></label>

        <div class="col-lg-9">
            <input type="email" class="form-control" id="txbemail" name="txbemail" value="<?php echo $emailuser?>">
            <span class="help-block m-b-none">Contoh: xxxx@gmail.com</span>
        </div>

    </div>
    <div class="form-group">

        <label class="control-label col-lg-3" style="margin-bottom: 10px;">No Telepon <span style="color:#ed5565">*</span></label>

        <div class="col-lg-9">
            <input type="text" class="form-control" id="txbnotelepon" name="txbnotelepon" value="<?php echo $teleponuser?>">
            <span class="help-block m-b-none">Contoh: 081xxxxxx, tanpa spasi, '+' atapun '( )'</span>
        </div>

    </div>
    <div class="form-group">

        <label class="control-label col-lg-3" style="margin-bottom: 10px;">Alamat <span style="color:#ed5565">*</span></label>

        <div class="col-lg-9">
            <textarea class="form-control" id="txbalamat" name="txbalamat"><?php echo $alamatuser;?></textarea>
        </div>

    </div>
    <div class="form-group">

        <label class="control-label col-lg-3" style="margin-bottom: 10px;">Level <span style="color:#ed5565">*</span></label>

        <div class="col-lg-9">
            <select class="form-control m-b" id="txblevelubah" name="txblevel" required onchange="pilihlevelubah()">
                <option value="1" <?php if($leveluser == '1'){echo 'selected="selected"';} ?>>Agent</option>
                <option value="0" <?php if($leveluser == '0'){echo 'selected="selected"';} ?>>Admin</option>
            </select>
        </div>

    </div>
    <div class="form-group" id="slklasifikasi">

        <label class="control-label col-lg-3" style="margin-bottom: 10px;">Klasifikasi <span style="color:#ed5565">*</span></label>

        <div class="col-lg-9">
            <select class="form-control m-b" id="txbklasifikasiubah" name="txbklasifikasi" required <?php if($leveluser == '0'){echo 'disabled';} ?>>
                <option value="A" <?php if($klasuser == 'A'){echo 'selected="selected"';} ?>>A</option>
                <option value="B" <?php if($klasuser == 'B'){echo 'selected="selected"';} ?>>B</option>
                <option value="C" <?php if($klasuser == 'C'){echo 'selected="selected"';} ?>>C</option>
                <option value="D" <?php if($klasuser == 'D'){echo 'selected="selected"';} ?>>D</option>
                <option value="E" <?php if($klasuser == 'E'){echo 'selected="selected"';} ?>>E</option>
                <option value="F" <?php if($klasuser == 'F'){echo 'selected="selected"';} ?>>F</option>
                <option value="G" <?php if($klasuser == 'G'){echo 'selected="selected"';} ?>>G</option>
            </select>
        </div>

    </div>
    <div class="form-group">

        <label class="control-label col-lg-3" style="margin-bottom: 10px;">Status <span style="color:#ed5565">*</span></label>

        <div class="col-lg-9">
            <select class="form-control m-b" name="txbstatus">
                <option value="0" <?php if($statususer == '0'){echo 'selected="selected"';} ?>>Tidak Aktif</option>
                <option value="1" <?php if($statususer == '1'){echo 'selected="selected"';} ?>>Aktif</option>
            </select>
        </div>

    </div>


    <div class="form-group">
        <button type="button" class="btn btn-danger pull-right" onclick="updateUser()"><i class="fa fa-save"> </i> SAVE</button>
    </div>

</form>

<script src="<?php echo base_url();?>assets/js/js_user.js"></script>