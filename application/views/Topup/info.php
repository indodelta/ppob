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

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>&nbsp;</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url('dashboard')?>">Home</a>
            </li>
            <li>
                <a href="<?php echo base_url('TopUp')?>">TopUp</a>
            </li>
            <li class="active">
                <strong>Checkout</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<!-- Content -->

<div class="wrapper wrapper-content animated fadeInRight article" style="margin-top: 10px;">
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">

            <?php $this->load->view('func_custom'); ?>

            <h2>
                <span style="color: <?php echo $warna_lembaga ?>">
                    Informasi TopUp Saldo
                </span>
            </h2>
            <div class="ibox float-e-margins" >

                <?php

                if($this->session->flashdata('dataresult')) {
                    $dataresult = $this->session->flashdata('dataresult');

                    var_dump($dataresult);

                    $paymethod = $dataresult->payMethod;
                    if($paymethod == '01'){$metode = 'Kartu Kredit';}
                    else if($paymethod == '02'){$metode = 'Transfer Bank';}
                    else if($paymethod == '03'){$metode = 'Convencience Store';}
                    else if($paymethod == '04'){$metode = 'Click Pay';}
                    else if($paymethod == '05'){$metode = 'E-Wallet';}
                    ?>

                    <form class="form-horizontal">

                    <div class="ibox-content">

                        <div class="form-group">
                            <div class="col-lg-8">
                                <label>Metode TopUp</label>
                            </div>
                            <div class="col-lg-4 text-right">
                                <h3><?php echo $metode;?></h3>
                            </div>
                        </div>
                        <hr/>
                        <input type="hidden" value="resultcode">
                        <div class="form-group">
                            <div class="col-lg-4">
                                <label>ID Transaksi</label>
                            </div>
                            <div class="col-lg-8 text-right">
                                <text style="font-size: 14px;"><?php echo $dataresult->tXid; ?></text>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-4">
                                <label>Reference No</label>
                            </div>
                            <div class="col-lg-8 text-right">
                                <text style="font-size: 14px;"><?php echo $dataresult->referenceNo; ?></text>
                            </div>
                        </div>
                        <hr/>
                        <?php
                        if($paymethod == '01')
                        {
                            ?>
                            <div class="form-group">
                                <div class="col-lg-8">
                                    <label>Cicilan </label>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <text style="font-size: 14px;"><?php echo $dataresult->instmntMon;?></text>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-4">
                                    <label>No Kartu </label>
                                </div>
                                <div class="col-lg-8 text-right">
                                    <text style="font-size: 14px;"><?php echo $dataresult->cardNo;?></text>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-4">
                                    <label>Expired Kartu </label>
                                </div>
                                <div class="col-lg-8 text-right">
                                    <text style="font-size: 14px;">
                                        <?php
                                        $cardexp = $dataresult->cardExpYymm;
                                        $tahun = substr($cardexp, 0, 2);
                                        $bulan = bulan(substr($cardexp, -2));
                                        $cardexp = $bulan . ' ' . $tahun;
                                        echo $cardexp;
                                        ?>
                                    </text>
                                </div>
                            </div>
                            <?php
                        }
                        else if($paymethod == '02')
                        {
                            ?>
                            <div class="form-group">
                                <div class="col-lg-8">
                                    <label>Tanggal Limit Pembayaran</label>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <text style="font-size: 14px; color: #ED5565;">
                                        <?php
                                        $tanggallimit = $dataresult->vacctValidDt;
                                        $tahun = substr($tanggallimit, 0, 4);
                                        $bulan = bulan(substr($tanggallimit, 4, 2));
                                        $tanggal = substr($tanggallimit, -2);
                                        $tanggallimit = $tanggal . ' ' . $bulan . ' ' . $tahun;

                                        $jamlimit = $dataresult->vacctValidTm;
                                        $jam = substr($jamlimit, 0, 2);
                                        $menit = bulan(substr($jamlimit, 2, 2));
                                        $detik = substr($jamlimit, -2);
                                        $jamlimit = $jam . ':' . $menit . ':' . $detik;
                                        echo $tanggallimit . ' ' . $jamlimit;
                                        ?>
                                    </text>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-8">
                                    <label>Kode Bank</label>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <h3><?php echo $dataresult->bankCd; ?></h3>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-8">
                                    <label>No Pembayaran</label>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <h3><?php echo $dataresult->vacctNo; ?></h3>
                                </div>
                            </div>
                            <?php
                        }
                        else if($paymethod == '03')
                        {
                            ?>
                            <div class="form-group">
                                <div class="col-lg-8">
                                    <label>Tanggal Limit Pembayaran</label>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <text style="font-size: 14px; color: #ED5565;">
                                        <?php
                                        $tanggallimit = $dataresult->payValidDt;
                                        $tahun = substr($tanggallimit, 0, 4);
                                        $bulan = bulan(substr($tanggallimit, 4, 2));
                                        $tanggal = substr($tanggallimit, -2);
                                        $tanggallimit = $tanggal . ' ' . $bulan . ' ' . $tahun;

                                        $jamlimit = $dataresult->payValidTm;
                                        $jam = substr($jamlimit, 0, 2);
                                        $menit = bulan(substr($jamlimit, 2, 2));
                                        $detik = substr($jamlimit, -2);
                                        $jamlimit = $jam . ':' . $menit . ':' . $detik;
                                        echo $tanggallimit . ' ' . $jamlimit;
                                        ?>
                                    </text>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-8">
                                    <label>Kode Mitra</label>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <h3><?php echo $dataresult->mitraCd; ?></h3>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-8">
                                    <label>No Pembayaran</label>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <h3><?php echo $dataresult->payNo; ?></h3>
                                </div>
                            </div>
                            <?php
                        }
                        else if($paymethod == '04')
                        {
                            ?>
                            <div class="form-group">
                                <div class="col-lg-8">
                                    <label>No Pembayaran</label>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <h3><?php echo $dataresult->receiptCode; ?></h3>
                                </div>
                            </div>
                            <?php
                        }
                        else if($paymethod == '05')
                        {
                            echo 'belum';
                        }
                        ?>
                        <div class="form-group">
                            <div class="col-lg-8">
                                <label>Status</label>
                            </div>
                            <div class="col-lg-4 text-right">
                                <h3><?php echo $dataresult->resultMsg; ?></h3>
                            </div>
                        </div>

                    </div>

                    <div class="ibox-content" style="margin-top: 10px;">
                        <div class="form-group">
                            <div class="col-lg-8">
                                <label>Jumlah yang harus dibayarkan</label>
                            </div>
                            <div class="col-lg-4 text-right">
                                <h2><?php echo $dataresult->currency . ' ' . number_format($dataresult->amt,0,',','.'); ?></h2>
                            </div>
                        </div>
                    </div>

                    </form>

                    <?php
                }
                ?>

            </div>

        </div>
        <div class="col-lg-4"></div>
    </div>
</div>

<!-- /content -->


</div>