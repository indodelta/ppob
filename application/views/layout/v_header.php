<?php
$nama_lembaga = $this->config->item("nama_lembaga"); $logo_lembaga = $this->config->item("logo_lembaga");
$css_lembaga = $this->config->item("css_lembaga"); $warna_lembaga = $this->config->item("warna_lembaga");
if (sizeof($data_lembaga)>0) {
    $nama_lembaga = $data_lembaga[0]["nama"];
    $logo_lembaga = $data_lembaga[0]["logo"];
    $css_lembaga = $data_lembaga[0]["css"];
    $warna_lembaga = $data_lembaga[0]["warna"];
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
    <link href="<?php echo base_url();?>assets/css/plugins/iCheck/red.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/plugins/ladda/ladda-themeless.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/plugins/textSpinners/spinners.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/plugins/slick/slick.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/plugins/slick/slick-theme.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/plugins/fullcalendar/fullcalendar.print.css" rel="stylesheet" media='print'>

    <link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/<?php echo $css_lembaga; ?>" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet">

    <?php date_default_timezone_set('Asia/Jakarta'); ?>

</head>


<body class="canvas-menu">

    <div id="wrapper">

        <!-- sidebar -->

        <nav class="navbar-default navbar-static-side" role="navigation" style="margin-top: 45px;">

            <?php
            $url = current_url();
            $expurl = explode("/", $url);
            $urlcurrent = $expurl[4];
            ?>

            <div class="sidebar-collapse" style="background-color: #640000">
                <a class="close-canvas-menu"><i class="fa fa-times"></i> </a>
                <ul class="nav metismenu" id="side-menu">

                    <li class="nav-header" style="background-image: url('<?php echo base_url();?>assets/css/patterns/header-profile-red.jpg');">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" src="<?php echo base_url();?>assets/img/<?php echo $logo_lembaga;?>" style="width: 100%; height: 15%;" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <?php
                                $user_data = $this->session->userdata;
                                if($user_data['user_level'] == 0) {
                                    $userlevel = 'Admin';
                                }else if($user_data['user_level'] == 1){
                                    $userlevel = 'User';
                                }
                                ?>

                                <span class="clear">
                                    <span class="block m-t-xs">
                                        <strong class="font-bold"><?php echo $nama_lembaga ?></strong>
                                    </span>
                                    <span class="text-muted text-xs block">
                                        <?php echo $userlevel ?>
                                        <b class="caret"></b>
                                    </span>
                                </span>

                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="<?php echo base_url('profil')?>">Akun Profil</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo base_url('login/logout')?>">Logout</a></li>
                            </ul>

                        </div>
                    </li>

                    <li
                        <?php
                        if(current_url() == base_url('dashboard')){
                            echo 'class="active"';
                        }
                        ?>
                    >
                        <a href="<?php echo base_url('dashboard')?>"><i class="fa fa-diamond"></i> <span class="nav-label">DASHBOARD</span></a>
                    </li>
                    <?php
                    if($user_data['user_level'] == 0) {
                        ?>
                        <li
                            <?php
                            if (current_url() == base_url('user')) {
                                echo 'class="active"';
                            }
                            ?>
                        >
                            <a href="<?php echo base_url('user') ?>"><i class="fa fa-users"></i> <span
                                        class="nav-label">MANAJEMEN USER</span></a>
                        </li>
                        <?php
                    }
                    ?>
                    <li
                        <?php
                        if(($urlcurrent == 'pesawat')){
                            echo 'class="active"';
                        }else if(($urlcurrent == 'kereta')){
                            echo 'class="active"';
                        }else if(($urlcurrent == 'bus')){
                            echo 'class="active"';
                        }else if(($urlcurrent == 'pelni')){
                            echo 'class="active"';
                        }else if(($urlcurrent == 'hotel')){
                            echo 'class="active"';
                        }else if(($urlcurrent == 'wisata')){
                            echo 'class="active"';
                        }else if(($urlcurrent == 'pulsa')){
                            echo 'class="active"';
                        }else if(($urlcurrent == 'ppob')){
                            echo 'class="active"';
                        }
                        ?>
                    >
                        <a href="#"><i class="fa fa-list"></i> <span class="nav-label">PRODUK DAN JASA</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li
                                <?php
                                if(($urlcurrent == 'pesawat')){
                                    echo 'class="active"';
                                }
                                ?>
                            >
                                <a href="<?php echo base_url('pesawat')?>"><i class="fa fa-plane"></i>PESAWAT</a>
                            </li>
                            <li
                                <?php
                                if(($urlcurrent == 'kereta')){
                                    echo 'class="active"';
                                }
                                ?>
                            >
                                <a href="<?php echo base_url('kereta')?>"><i class="fa fa-train"></i>KERETA</a>
                            </li>
                            <li
                                <?php
                                if(($urlcurrent == 'pelni')){
                                    echo 'class="active"';
                                }
                                ?>
                            >
                                <a href="<?php echo base_url('pelni')?>"><i class="fa fa-ship"></i>PELNI</a>
                            </li>
                            <li
                                <?php
                                if(($urlcurrent == 'bus')){
                                    echo 'class="active"';
                                }
                                ?>
                            >
                                <a href="<?php echo base_url('bus')?>"><i class="fa fa-bus"></i>TRAVEL BUS</a>
                            </li>
                            <li
                                <?php
                                if(($urlcurrent == 'hotel')){
                                    echo 'class="active"';
                                }
                                ?>
                            >
                                <a href="<?php echo base_url('hotel')?>"><i class="fa fa-hotel"></i>HOTEL</a>
                            </li>
                            <li
                                <?php
                                if(($urlcurrent == 'wisata')){
                                    echo 'class="active"';
                                }
                                ?>
                            >
                                <a href="<?php echo base_url('wisata')?>"><i class="fa fa-snowflake-o"></i>WISATA</a>
                            </li>
                            <li
                                <?php
                                if(($urlcurrent == 'pulsa')){
                                    echo 'class="active"';
                                }
                                ?>
                            >
                                <a href="<?php echo base_url('pulsa')?>"><i class="fa fa-tablet"></i>PULSA</a>
                            </li>
                            <li
                                <?php
                                if(($urlcurrent == 'ppob')){
                                    echo 'class="active"';
                                }
                                ?>
                            >
                                <a href="<?php echo base_url('ppob')?>"><i class="fa fa-file-text-o"></i>PPOB</a>
                            </li>
                        </ul>
                    </li>

                    <li
                        <?php
                        if(current_url() == base_url('Laporan/topupsaldo')){
                            echo ' class="active"';
                        }else if(current_url() == base_url('Laporan/mutasideposit')){
                            echo ' class="active"';
                        }else if(current_url() == base_url('Laporan/transaksi')){
                            echo ' class="active"';
                        }
                        ?>>
                        <a href="#"><i class="fa fa-book"></i> <span class="nav-label">LAPORAN</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li<?php if (current_url() == base_url('Laporan/topupsaldo')) {echo ' class="active"';} ?>>
                                <a href="<?php echo base_url('Laporan/topupsaldo') ?>"><i class="fa fa-book"></i>LAPORAN TOPUP SALDO</a>
                            </li>

                            <li<?php if (current_url() == base_url('Laporan/mutasideposit')) {echo ' class="active"';} ?>>
                                <a href="<?php echo base_url('Laporan/mutasideposit') ?>"><i class="fa fa-book"></i>LAPORAN MUTASI DEPOSIT</a>
                            </li>

                            <li<?php if(current_url() == base_url('Laporan/transaksi')) { echo ' class="active"'; } ?>>
                                <a href="<?php echo base_url('Laporan/transaksi')?>"><i class="fa fa-book"></i> LAPORAN TRANSAKSI</a>
                            </li>
                        </ul>
                    </li>

                    <li
                    <?php
                    if(current_url() == base_url('Topup')){
                        echo ' class="active"';
                    }else if(current_url() == base_url('Deposit/topup')){
                        echo ' class="active"';
                    }else if(current_url() == base_url('Deposit/deposit')){
                        echo ' class="active"';
                    }
                    ?>>
                        <a href="#"><i class="fa fa-credit-card"></i> <span class="nav-label">DEPOSIT</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li<?php if(current_url() == base_url('Topup')) { echo ' class="active"'; } ?>>
                                <a href="<?php echo base_url('Topup')?>"><i class="fa fa-download"></i>Isi Saldo / TOPUP</a>
                            </li>
                            <li<?php if(current_url() == base_url('Deposit/topup')) { echo ' class="active"'; } ?>>
                                <a href="<?php echo base_url('Deposit/topup')?>"><i class="fa fa-money"></i>TOP UP</a>
                            </li>
                            <li<?php if(current_url() == base_url('Deposit/deposit')) { echo ' class="active"'; } ?>>
                                <a href="<?php echo base_url('Deposit/deposit')?>"><i class="fa fa-list-ul"></i>TRANS DEPOSIT</a>
                            </li>
                        </ul>
                    </li>

                    <?php
                    if ($user_data['user_level'] == 0){
                        ?>
                        <li<?php
                        if(current_url() == base_url('admin/profile')){
                            echo ' class="active"';
                        }
                        else if(current_url() == base_url('admin/password')){
                            echo ' class="active"';
                        }
                        else if(current_url() == base_url('admin/user')){
                            echo ' class="active"';
                        }
                        else if(current_url() == base_url('admin/lembaga')){
                            echo ' class="active"';
                        }
                        else if(current_url() == base_url('admin/api_setting')){
                            echo ' class="active"';
                        }
                        else if(current_url() == base_url('api_doc')){
                            echo ' class="active"';
                        }
                        ?>>
                            <a href="#"><i class="fa fa-gear"></i> <span class="nav-label">ADMIN</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li<?php if (current_url() == base_url('admin/profile')) { echo ' class="active"'; } ?>>
                                    <a href="<?php echo base_url('admin/profile')?>"><i class="fa fa-user-o"></i>PROFILE</a>
                                </li>
                                <li<?php if (current_url() == base_url('admin/password')) { echo ' class="active"'; } ?>>
                                    <a href="<?php echo base_url('admin/password')?>"><i class="fa fa-key"></i>PASSWORD</a>
                                </li>
                                <li<?php if (current_url() == base_url('admin/user')) { echo ' class="active"'; } ?>>
                                    <a href="<?php echo base_url('admin/user')?>"><i class="fa fa-users"></i>PENGGUNA</a>
                                </li>
                                <li<?php if (current_url() == base_url('admin/lembaga')) { echo ' class="active"'; } ?>>
                                    <a href="<?php echo base_url('admin/lembaga')?>"><i class="fa fa-building"></i>LEMBAGA</a>
                                </li>
                                <li<?php if (current_url() == base_url('admin/api_setting')) { echo ' class="active"'; } ?>>
                                    <a href="<?php echo base_url('admin/api_setting')?>"><i class="fa fa-gears"></i>API SETTING</a>
                                </li>
                                <li<?php if (current_url() == base_url('admin/api_doc')) { echo ' class="active"'; } ?>>
                                    <a href="<?php echo base_url('admin/api_doc')?>"><i class="fa fa-file-text-o"></i>DOKUMENTASI API</a>
                                </li>
                            </ul>
                        </li>
                        <?php
                    }
                    else {
                        ?>

                        <li<?php
                        if(current_url() == base_url('admin/profile')){
                            echo ' class="active"';
                        }
                        else if(current_url() == base_url('admin/password')){
                            echo ' class="active"';
                        }
                        ?>>
                            <a href="#"><i class="fa fa-gear"></i> <span class="nav-label">PROFIL & PASSWORD</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li<?php if (current_url() == base_url('admin/profile')) { echo ' class="active"'; } ?>>
                                    <a href="<?php echo base_url('admin/profile')?>"><i class="fa fa-user-o"></i>PROFILE</a>
                                </li>
                                <li<?php if (current_url() == base_url('admin/password')) { echo ' class="active"'; } ?>>
                                    <a href="<?php echo base_url('admin/password')?>"><i class="fa fa-key"></i>PASSWORD</a>
                                </li>
                            </ul>
                        </li>

                        <?php
                    }
                    ?>

                </ul>

            </div>
        </nav>

        <!-- /sidebar -->


        <div id="page-wrapper" class="gray-bg">

            <!-- Header -->

            <div class="row border-bottom">

                <nav class="navbar navbar-fixed-top red-bg" role="navigation" style="height: 0px;">
                    <div class="navbar-header">
                        <a class="navbar-minimalize" href="#">
                            <button type="button" class="btn btn-danger" style="margin-top: 0px; background-color: #640000; height: 49px;">
                                <i class="fa fa-bars" style="color: white"></i>
                                <text color="white">MENU</text>
                            </button>
                        </a>
                        <?php
                        $user_data = $this->session->userdata;
                        if ($user_data['user_level'] == 0) {
                            $saldo = number_format($datasaldo->saldo, 0, ',', '.');
                        }else{
                            $saldo = number_format($datasaldo[0]->saldo, 0, ',', '.');
                        }
                        ?>
                        <text style="color: white;">SALDO : <?php echo $saldo; ?></text>
                    </div>

                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <button type="button" class="btn btn-outline btn-danger"
                                    style="height: 49px;
                                           <?php
                                                if ($urlcurrent == 'pesawat') { echo ' border-bottom: solid 3px #19AA8D'; }
                                           ?>">
                            <a href="<?php echo base_url('pesawat')?>">
                                <i class="fa fa-plane" style="color: white; padding: 0px;"></i> <font color="white"> PESAWAT</font>
                            </a>
                            </button>
                        </li>

                        <li>
                            <button type="button" class="btn btn-outline btn-danger"
                                    style="height: 49px;
                                           <?php
                                                if ($urlcurrent == 'kereta') { echo ' border-bottom: solid 3px #19AA8D'; }
                                           ?>">
                            <a href="<?php echo base_url('kereta')?>">
                                <i class="fa fa-train" style="color: white"></i> <font color="white"> KERETA</font>
                            </a>
                            </button>
                        </li>

                        <li>
                            <button type="button" class="btn btn-outline btn-danger"
                                    style="height: 49px;
                                            <?php
                                                if ($urlcurrent == 'hotel') { echo ' border-bottom: solid 3px #19AA8D'; }
                                            ?>">
                            <a href="<?php echo base_url('hotel')?>">
                                <i class="fa fa-hotel" style="color: white"></i> <font color="white"> HOTEL</font>
                            </a>
                            </button>
                        </li>

                        <li>
                            <button type="button" class="btn btn-outline btn-danger"
                                    style="height: 49px;
                                           <?php
                                                if ($urlcurrent == 'pulsa') { echo ' border-bottom: solid 3px #19AA8D'; }
                                           ?>">
                            <a href="<?php echo base_url('Pulsa')?>">
                                <i class="fa fa-tablet" style="color: white"></i> <font color="white"> PULSA</font>
                            </a>
                            </button>
                        </li>

                        <li>
                            <button type="button" class="btn btn-outline btn-danger"
                                    style="height: 49px;
                                           <?php
                                    if ($urlcurrent == 'ppob') { echo ' border-bottom: solid 3px #19AA8D'; }
                                    ?>">
                                <a href="<?php echo base_url('ppob')?>">
                                    <i class="fa fa-file-text-o" style="color: white"></i> <font color="white"> PPOB</font>
                                </a>
                            </button>
                        </li>

                        <li>
                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-danger dropdown-toggle" style="height: 49px;">
                                    LAINNYA <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li <?php if(($urlcurrent == 'pelni')){echo 'class="active"';} ?> style="color: black;">
                                        <a href="<?php echo base_url('pelni')?>">
                                            <i class="fa fa-ship"></i> PELNI
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li <?php if(($urlcurrent == 'bus')){echo 'class="active"';} ?> style="color: black;">
                                        <a href="<?php echo base_url('bus')?>">
                                            <i class="fa fa-bus"></i> BUS TRAVEL
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li <?php if(($urlcurrent == 'wisata')){echo 'class="active"';} ?> style="color: black;">
                                        <a href="<?php echo base_url('wisata')?>">
                                            <i class="fa fa-snowflake-o"></i> PAKET WISATA
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li style="color: black;">
                                        <a href="<?php echo base_url('login/logout')?>">
                                            <i class="fa fa-sign-out"></i> LOGOUT
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

<!--                        <li>-->
<!--                            <button type="button" class="btn btn-outline btn-danger" style="height: 49px;">-->
<!--                                <a href="--><?php //echo base_url('login/logout')?><!--">-->
<!--                                    <i class="fa fa-sign-out" style="color: white"></i>-->
<!--                                    <font color="white">Logout</font>-->
<!--                                </a>-->
<!--                            </button>-->
<!--                        </li>-->

                    </ul>

                </nav>

            </div>

            <!-- /header -->