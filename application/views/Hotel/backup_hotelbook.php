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
        <ol class="breadcrumb" style="padding-top: 60px;">
            <li>
                <a href="<?php echo base_url('dashboard')?>">Home</a>
            </li>
            <li>
                <a href="<?php echo base_url('hotel')?>">Hotel</a>
            </li>
            <li>
                <a>Kamar</a>
            </li>
            <li class="active">
                <strong>Booking</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>


<!-- Content -->

<div class="wrapper wrapper-content article">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">

            <?php
            $this->load->view('func_custom');

            $billerid = $this->input->post('txbbillerid');
            $searchingmid = $this->input->post('txbsearchingmid');
            $internalcode = $this->input->post('txbinternalcode');
            $hotelid = $this->input->post('txbhotelid');
            $categoryid = $this->input->post('txbcategoryid');
            $roomimage = $this->input->post('txbroomimage');
            $namahotel = $this->input->post('txbhotelname');
            $typename = $this->input->post('txbtypename');

            $tglcheckin = $this->input->post('txbcheckindate');
            $split = explode('-', $tglcheckin);
            $bulan = bulan($split[1]);
            $tanggalcheckin = $split[2] . ' ' . $bulan . ' ' .$split[0];

            $tglcheckout = $this->input->post('txbcheckoutdate');
            $splitout = explode('-', $tglcheckout);
            $bulanout = bulan($splitout[1]);
            $tanggalcheckout = $splitout[2] . ' ' . $bulanout . ' ' .$splitout[0];

            $datediff = strtotime($tglcheckout) - strtotime($tglcheckin);

            $jmlmalam = round($datediff / (60 * 60 * 24));

            $jmltamu = $this->input->post('txbjmltamu');
            $jmlkamar = $this->input->post('sljmlkamar');

            $amount = $this->input->post('txbamount');
            $totalamount = $this->input->post('txbtotalamount');
            $taxamount = $this->input->post('txbtaxamount');

            $tabs = $this->input->post('tabs');

            $currency = 'IDR';


            ?>

            <div class="ibox float-e-margins">

                <div class="ibox-content red-bg">

                    <input type="hidden" value="bookhotel" name="txbpage" id="txbpage">

                    <input type="hidden" value="<?php echo $warna_lembaga ?>" name="txbwarnalembaga" id="txbwarnalembaga">

                    <div class="row">
                        <div class="col-sm-3 col-xs-4">
                            <div class="img-preview" style="width: 180px; height: 130px; border: solid 1px white;">
                                <?php
                                if($roomimage == ''){
                                    ?>
                                    <img src="<?php echo base_url('assets\img\No_Image_Available.png') ?>"
                                         style="width: 100%; height: 100%;">
                                    <?php
                                }else{
                                    ?>
                                    <img src="<?php echo $roomimage; ?>"
                                         style="width: 100%; height: 100%;">
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-sm-9 col-xs-8">
                            <h2><?php echo $namahotel; ?></h2>
                            <hr/>
                            <text style="font-size: 20px;"><?php echo $typename; ?></text>
                            <h3>
                                <i class="fa fa-calendar"></i>
                                <?php echo $tanggalcheckin ?>
                                - <?php echo $tanggalcheckout; ?>
                                | <i class="fa fa-user"></i> <?php echo $jmltamu; ?> Orang
                                | <i class="fa fa-hotel"></i> <?php echo $jmlkamar ?> Kamar
                            </h3>
                        </div>
                    </div>

                </div>

                <div class="ibox-content" style="padding: 0px; padding-top: 20px;">
                    <div class="row">

                        <div class="col-lg-12">

                            <div class="col-xs-3" style="border: solid 1px #f7f7f7;<?php if($tabs==1){echo 'background-color:'.$warna_lembaga;} ?>"><h2 id="h2judulkontak" style="<?php if($tabs==1){echo 'color: white';} ?>">1. Informasi Kontak</h2></div>
                            <div class="col-xs-3" style="border: solid 1px #f7f7f7;<?php if($tabs==2){echo 'background-color:'.$warna_lembaga;} ?>"><h2 id="h2judulkodebooking" style="<?php if($tabs==2){echo 'color: white';} ?>">2. Review Informasi</h2></div>
                            <div class="col-xs-3" style="border: solid 1px #f7f7f7;<?php if($tabs==3){echo 'background-color:'.$warna_lembaga;} ?>"><h2 id="h2judulpembayaran" style="<?php if($tabs==2){echo 'color: white';} ?>">3. Pembayaran</h2></div>
                            <div class="col-xs-3" style="border: solid 1px #f7f7f7;<?php if($tabs==4){echo 'background-color:'.$warna_lembaga;} ?>"><h2 id="h2judulselesai" style="<?php if($tabs==3){echo 'color: white';} ?>">4. Selesai</h2></div>


                        </div>

                    </div>
                </div>

                <div class="ibox-content" style="margin-top: 0px;">

                    <div id="divrincian" style="<?php if($tabs == 1){echo 'display: block;';}else{echo 'display: none;';} ?>">

                        <h2>Kontak yang dapat dihubungi</h2>

                        <hr/>

                        <form class="form-horizontal" id="formkontak" autocomplete="off" method="post">

                            <input type="text" value="<?php echo $billerid ?>" name="txbbillerid"><br/>
                            <input type="text" value="<?php echo $searchingmid ?>" name="txbsearchingmid"><br/>
                            <input type="text" value="<?php echo $jmltamu ?>" name="txbjmltamu"><br/>
                            <input type="text" value="<?php echo $jmlkamar ?>" name="sljmlkamar"><br/>
                            <input type="text" value="<?php echo $internalcode ?>" name="txbinternalcode"><br/>
                            <input type="text" value="<?php echo $hotelid ?>" name="txbhotelid"><br/>
                            <input type="text" value="<?php echo $categoryid ?>" name="txbcategoryid"><br/>
                            <input type="text" value="<?php echo $namahotel ?>" name="txbhotelname"><br/>
                            <input type="text" value="<?php echo $typename ?>" name="txbtypename"><br/>
                            <input type="text" value="<?php echo $tglcheckin ?>" name="txbcheckindate"><br/>
                            <input type="text" value="<?php echo $tglcheckout ?>" name="txbcheckoutdate"><br/>
                            <input type="text" value="<?php echo $amount ?>" name="txbamount"><br/>
                            <input type="text" value="<?php echo $totalamount ?>" name="txbtotalamount"><br/>
                            <input type="text" value="<?php echo $taxamount ?>" name="txbtaxamount"><br/>
                            <input type="text" value="<?php echo $roomimage ?>" name="txbroomimage"><br/>
                            <input type="hidden" value="2" name="tabs">

                            <div class="form-group">

                                <div class="col-lg-6">
                                    <label class="control-label" style="margin-bottom: 10px;">First Name <span style="color:#ed5565">*</span></label>
                                    <input type="text" class="form-control" id="firstnamekontak" name="txbfirstnamekontak" placeholder="Nama Kontak" required>
                                </div>
                                <div class="col-lg-6">
                                    <label class="control-label" style="margin-bottom: 10px;">Last Name <span style="color:#ed5565">*</span></label>
                                    <input type="text" class="form-control" id="lastnamekontak" name="txblastnamekontak" placeholder="Nama Kontak" required>
                                </div>

                                <div class="col-lg-4">
                                    <label class="control-label" style="margin-bottom: 10px;">Email <span style="color:#ed5565">*</span></label>
                                    <input type="email" class="form-control" id="emailkontak" name="txbemailkontak" placeholder="Email" required>
                                </div>
                                <div class="col-lg-4">
                                    <label class="control-label" style="margin-bottom: 10px;">No Telepon <span style="color:#ed5565">*</span></label>
                                    <input type="text" id="noteleponkontak" class="form-control" name="txbnotelpkontak" placeholder="No Telp : 08xxxx" required>
                                    <span class="help-block m-b-none">Contoh: 081xxxxxx, tanpa spasi, '+' atapun '( )'</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="control-label" style="margin-bottom: 10px;">Asal Kota <span style="color:#ed5565">*</span></label>
                                    <input type="text" class="form-control" id="kotakontak" name="txbkotakontak" placeholder="Asal Kota" required>
                                </div>

                                <div class="col-lg-9"></div>
                                <div class="col-lg-3">

                                    <!--                                    <button type="submit" class="btn btn-danger"> Simpan & Lanjutkan</button>-->
                                    <input class="btn btn-danger" type="button" id="btnsubmitkontak" value="Simpan & Lanjutkan" onclick="bookingroom()">


                                </div>

                            </div>

                        </form>

                    </div>

                    <div id="divpembayaran" style="<?php if($tabs == 2){echo 'display: block;';}else{echo 'display: none;';} ?>">

                        <?php
                        if($tabs == 2){
                            $bookingcode = $booking['hotel']->data->bookingCode;
                            $mid = $booking['hotel']->data->mid;
                            $transactionid = $booking['hotel']->data->transactionId;
                            $komisi = $booking['hotel']->data->komisi;
                            $timelimit = $booking['hotel']->data->timeLimit;
                            $phone = $this->input->post('txbnotelpkontak');
                            $fname = $this->input->post('txbfirstnamekontak');
                            $lname = $this->input->post('txblastnamekontak');
                            $email = $this->input->post('txbemailkontak');
                            $city = $this->input->post('txbkotakontak');

                            $rc = $booking['hotel']->rc;
                            $rd = $booking['hotel']->rd;
                            ?>

                            <h2>Total Pembayaran</h2>

                            <hr/>

                            <?php
                            if($rc == '00') {
                                ?>

                                <form class="form-horizontal" id="formbayar" autocomplete="off" method="post">

                                    <input type="hidden" value="<?php echo $billerid ?>" name="txbbillerid"><br/>
                                    <input type="hidden" value="<?php echo $searchingmid ?>" name="txbsearchingmid"><br/>
                                    <input type="hidden" value="<?php echo $jmltamu ?>" name="txbjmltamu"><br/>
                                    <input type="hidden" value="<?php echo $jmlkamar ?>" name="sljmlkamar"><br/>
                                    <input type="hidden" value="<?php echo $internalcode ?>" name="txbinternalcode"><br/>
                                    <input type="hidden" value="<?php echo $hotelid ?>" name="txbhotelid"><br/>
                                    <input type="hidden" value="<?php echo $categoryid ?>" name="txbcategoryid"><br/>
                                    <input type="hidden" value="<?php echo $namahotel ?>" name="txbhotelname"><br/>
                                    <input type="hidden" value="<?php echo $typename ?>" name="txbtypename"><br/>
                                    <input type="hidden" value="<?php echo $tglcheckin ?>" name="txbcheckindate"><br/>
                                    <input type="hidden" value="<?php echo $tglcheckout ?>" name="txbcheckoutdate"><br/>
                                    <input type="hidden" value="<?php echo $amount ?>" name="txbamount"><br/>
                                    <input type="hidden" value="<?php echo $totalamount ?>" name="txbtotalamount"><br/>
                                    <input type="hidden" value="<?php echo $taxamount ?>" name="txbtaxamount"><br/>
                                    <input type="hidden" value="<?php echo $roomimage ?>" name="txbroomimage"><br/>
                                    <input type="hidden" value="3" name="tabs">

                                    <input type="hidden" value="<?php echo $fname; ?>" name="txbfirstnamekontak"><br/>
                                    <input type="hidden" value="<?php echo $lname; ?>" name="txblastnamekontak"><br/>
                                    <input type="hidden" value="<?php echo $email; ?>" name="txbemailkontak"><br/>
                                    <input type="hidden" value="<?php echo $phone; ?>" name="txbnotelpkontak"><br/>
                                    <input type="hidden" value="<?php echo $city; ?>" name="txbkotakontak"><br/>

                                    <input type="hidden" value="<?php echo $bookingcode ?>" name="txbbookingcode">
                                    <input type="hidden" value="<?php echo $mid ?>" name="txbmid">
                                    <input type="hidden" value="<?php echo $transactionid ?>" name="txbtransactionid">
                                    <input type="hidden" value="<?php echo $komisi ?>" name="txbkomisi">
                                    <input type="hidden" value="<?php echo $timelimit ?>" name="txblimit">

                                    <div class="form-group">
                                        <div class="col-sm-2">
                                            <label>Kode Booking : </label>
                                        </div>
                                        <div class="col-sm-2"><?php echo $bookingcode; ?></div>
                                        <div class="col-sm-2">
                                            <label>MID : </label>
                                        </div>
                                        <div class="col-sm-2"><?php echo $mid; ?></div>
                                        <div class="col-sm-2">
                                            <label>ID Transaksi : </label>
                                        </div>
                                        <div class="col-sm-2"><?php echo $transactionid; ?></div>
                                    </div>

                                    <div class="form-group">

                                        <div class="col-sm-2">
                                            <label>Time Limit</label>
                                        </div>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $timelimit;
                                            ?>
                                        </div>

                                    </div>

                                    <?php
                                    for ($i = 1; $i <= $jmlmalam; $i++) {
                                        if ($jmlkamar == 1) {
                                            $jmlamount = $amount;
                                        } else {
                                            $jmlamount = $amount * $jmlkamar;
                                        }
                                        ?>

                                        <div class="form-group">

                                            <div class="col-sm-2">
                                                <label><?php echo 'Malam ' . $i . '(' . $jmlkamar . ' Kamar) ' ?></label>
                                            </div>
                                            <div class="col-sm-10">
                                                <?php
                                                $rpamount = number_format($jmlamount, 0, ',', '.');

                                                echo $currency . ' ' . $rpamount;
                                                ?>
                                            </div>

                                        </div>

                                        <?php
                                    }
                                    ?>

                                    <div class="form-group">
                                        <div class="col-sm-2">
                                            <label>Tax</label>
                                        </div>
                                        <div class="col-sm-10">
                                            <?php
                                            $rptax = number_format($taxamount, 0, ',', '.');

                                            if ($rptax == 0) {
                                                echo $rptax;
                                            } else {
                                                echo $currency . ' ' . $rptax;
                                            }
                                            ?>
                                        </div>

                                    </div>

                                    <hr/>

                                    <div class="form-group">

                                        <div class="col-sm-2">
                                            <h3>Total Amount</h3>
                                        </div>
                                        <div class="col-sm-7">
                                            <?php
                                            $rptotalamount = number_format($totalamount, 0, ',', '.');

                                            echo '<h3>' . $currency . ' ' . $rptotalamount . '</h3>';
                                            ?>
                                        </div>
                                        <div class="col-lg-3">

                                            <!--                                    <button type="submit" class="btn btn-danger"> Simpan & Lanjutkan</button>-->
                                            <input class="btn btn-danger" type="button" id="btnsubmitbooking" value="Bayar">


                                        </div>


                                    </div>


                                </form>

                                <?php

                            }else{
                                ?>

                                <div class="ibox-content">

                                    <div class="row text-center">

                                        <h1>ERROR</h1><br/>
                                        <h2>Ada masalah pada API => <?php echo $rd ?></h2><br/>
                                        <a href="<?php echo base_url('hotel') ?>">
                                            <button class="btn btn-danger">Kembali ke form pencarian</button>
                                        </a>

                                    </div>

                                </div>

                                <?php
                            }

                        }
                        ?>

                    </div>

                    <div id="divselesai" style="<?php if($tabs == 3){echo 'display: block;';}else{echo 'display: none;';} ?>">
                        selesai
                    </div>

                </div>

            </div>

        </div>
        <div class="col-lg-2"></div>
    </div>
</div>

<!-- /content -->


</div>
