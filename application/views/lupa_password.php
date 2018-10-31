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


</head>

<body class="red-bg">

<div class="passwordBox animated fadeInDown">
    <div class="row">

        <div class="col-md-12">
            <div class="ibox-content" style="color: grey;">

                <h2 class="font-bold">Lupa password</h2>

                <p>
                    Masukkan alamat email yang telah terdaftar, password akan direset dan diemailkan ke alamat email tersebut.
                </p>

                <div class="row">

                    <div class="col-lg-12">
                        <form class="m-t" role="form" action="#">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Alamat Email" required="">
                            </div>

                            <button type="submit" class="btn btn-danger block full-width m-b">Kirim Password Baru</button>
                            <div class="form-group">
                                <a href="<?php echo base_url('login')?>">
                                    <small>Back to Login</small>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-sm-6">
            Copyright <?php echo $nama_lembaga; ?>
        </div>
        <div class="col-sm-6 text-right">
            <small>© 2018</small>
        </div>
    </div>
</div>

</body>

</html>
