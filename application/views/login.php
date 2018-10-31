<?php
$nama_lembaga = $this->config->item("nama_lembaga"); $logo_lembaga = $this->config->item("logo_lembaga"); $css_lembaga = $this->config->item("css_lembaga");
if (sizeof($data_lembaga)>0) {
    $nama_lembaga = $data_lembaga[0]["nama"];
    $logo_lembaga = $data_lembaga[0]["logo"];
    $css_lembaga = $data_lembaga[0]["css"];
}
?>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" type="image/png" href="<?php echo base_url("assets/img/".$logo_lembaga);?>"/>
    <title><?php echo $nama_lembaga; ?> | Web Payment</title>

    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">


    <link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/<?php echo $css_lembaga; ?>" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/css/plugins/iCheck/red.css" rel="stylesheet">

    <script src="<?php echo base_url();?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/plugins/iCheck/icheck.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/js_login.js"></script>


</head>

<body class="red-bg">

<div class="loginColumns animated fadeInDown">
    <div class="row">

        <div class="col-md-6">

            <img src="<?php echo base_url();?>assets/img/logobank.png" style="width: 100%">

        </div>
        <div class="col-md-6">
            <div class="ibox-content">
                <?php if($this->session->flashdata('error')){ ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <?php echo $this->session->flashdata('error');?>
                    </div>
                <?php } ?>

                <?php if($this->session->flashdata('belumlogin')){ ?>
                    <div class="alert alert-warning alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        Maaf, Anda Belum Login
                    </div>
                <?php } ?>

                <?php if($this->session->flashdata('apigagallogin')){ ?>
                    <div class="alert alert-warning alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        Maaf, Ada kesalahan pada API 1. <br/>
                        <?php echo $this->session->flashdata('apigagallogin') ?>
                    </div>
                <?php } ?>

                <?php if($this->session->flashdata('api2gagallogin')){ ?>
                    <div class="alert alert-warning alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        Maaf, Ada kesalahan pada API 2. <br/>
                        <?php echo $this->session->flashdata('api2gagallogin') ?>
                    </div>
                <?php } ?>

                <form role="form" action="<?php echo base_url('login/aksi_login')?>" method="post" autocomplete="off">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Username" style="color: black" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" style="color: black" required>
                        <div class="i-checks-password" style="margin-top: 10px; margin-bottom: 10px; float: right">
                            <label> <input type="checkbox" class="showpassword" id="showpassword"> <i></i> <span style="color: #ED5565;">Show Password</span></label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger block full-width m-b">Login</button>

                    <div class="form-group">
                        <a href="<?php echo base_url('lupa_password')?>">
                            <small>Forgot password?</small>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-6">
            Copyright <?php echo $nama_lembaga; ?> &copy; 2018
        </div>
        <div class="col-md-6 text-right">
            <small>© 2018</small>
        </div>
    </div>
</div>

</body>

</html>
