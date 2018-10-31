<form class="form-horizontal" method="post" autocomplete="off" id="formsaveuser">

    <?php $warna_lembaga=$_GET['warnalembaga']; ?>

    <input type="hidden" class="form-control" id="txbwarnalembaga" value="<?php echo $warna_lembaga?>">

    <div class="form-group">

        <h3 class="col-lg-12" style="margin-bottom: 10px;">DATA PERSONAL</h3>
        <hr style="border: solid 1px;"/>

        <label class="control-label col-lg-3" style="margin-bottom: 10px;">Nama Lengkap <span style="color:#ed5565">*</span></label>

        <div class="col-lg-9">
            <input type="text" class="form-control" id="txbfullname" name="txbfullname" required>
        </div>

    </div>
    <div class="form-group">

        <label class="control-label col-lg-3" style="margin-bottom: 10px;">Level <span style="color:#ed5565">*</span></label>

        <div class="col-lg-9">
            <select class="form-control m-b" name="txblevel" required>
                <option value="1">Agent</option>
                <option value="0">Admin</option>
            </select>
        </div>

    </div>
    <div class="form-group" id="slklasifikasi">

        <label class="control-label col-lg-3" style="margin-bottom: 10px;">Klasifikasi <span style="color:#ed5565">*</span></label>

        <div class="col-lg-9">
            <select class="form-control m-b" id="txbklasifikasi" name="txbklasifikasi" required>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
                <option value="G">G</option>
            </select>
        </div>

    </div>
    <div class="form-group">

        <label class="control-label col-lg-3" style="margin-bottom: 10px;">Email <span style="color:#ed5565">*</span></label>

        <div class="col-lg-9">
            <input type="email" class="form-control" id="txbemail" name="txbemail" required>
            <span class="help-block m-b-none">Contoh: xxxx@gmail.com</span>
        </div>

    </div>
    <div class="form-group">

        <label class="control-label col-lg-3" style="margin-bottom: 10px;">No Telepon <span style="color:#ed5565">*</span></label>

        <div class="col-lg-9">
            <input type="text" class="form-control" id="txbnotelepon" name="txbnotelepon" required>
            <span class="help-block m-b-none">Contoh: 081xxxxxx, tanpa spasi, '+' atapun '( )'</span>
        </div>

    </div>
    <div class="form-group">

        <label class="control-label col-lg-3" style="margin-bottom: 10px;">Alamat <span style="color:#ed5565">*</span></label>

        <div class="col-lg-9">
            <textarea class="form-control" id="txbalamat" name="txbalamat" required></textarea>
        </div>

    </div>
    <div class="form-group">

        <h3 class="col-lg-12" style="margin-bottom: 10px;">DATA USERNAME DAN PASSWORD</h3>
        <hr style="border: solid 1px;"/>

        <label class="control-label col-lg-3" style="margin-bottom: 10px;">Username <span style="color:#ed5565">*</span></label>

        <div class="col-lg-9">
            <input type="text" class="form-control" id="txbusername" name="txbusername" required>
        </div>
    </div>

    <div class="form-group">

        <label class="control-label col-lg-3" style="margin-bottom: 10px;">Password <span style="color:#ed5565">*</span></label>

        <div class="col-lg-9">
            <input type="text" class="form-control" id="txbpassword" name="txbpassword" required>
        </div>

    </div>

    <div class="form-group">
        <button type="button" class="btn btn-danger pull-right" onclick="saveUser()"><i class="fa fa-save"> </i> SAVE</button>
    </div>

</form>

<script src="<?php echo base_url();?>assets/js/js_user.js"></script>