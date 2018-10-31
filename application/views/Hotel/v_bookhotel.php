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
                $alamathotel = $this->input->post('txbhoteladdress');
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
                    <input type="hidden" id="txbcancelbookberhasil" value="">

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

                            <div class="col-xs-4" style="border: solid 1px #f7f7f7;<?php if($tabs==1){echo 'background-color:'.$warna_lembaga;} ?>"><h2 id="h2judulkontak" style="<?php if($tabs==1){echo 'color: white';} ?>">1. Informasi Tamu dan Kontak</h2></div>
                            <div class="col-xs-4" style="border: solid 1px #f7f7f7;<?php if($tabs==2){echo 'background-color:'.$warna_lembaga;} ?>"><h2 id="h2judulpembayaran" style="<?php if($tabs==2){echo 'color: white';} ?>">2. Review dan Pembayaran</h2></div>
                            <div class="col-xs-4" style="border: solid 1px #f7f7f7;<?php if($tabs==3){echo 'background-color:'.$warna_lembaga;} ?>"><h2 id="h2judulselesai" style="<?php if($tabs==3){echo 'color: white';} ?>">3. Selesai</h2></div>


                        </div>

                    </div>
                </div>

                <div class="ibox-content" style="margin-top: 0px;">

                    <div id="divrincian" style="<?php if($tabs == 1){echo 'display: block;';}else{echo 'display: none;';} ?>">

                        <form class="form-horizontal"
                              id="formkontak"
                              autocomplete="off"
                              method="post"
                              action="bookhotel"
                              onsubmit="return confirm('Anda telah mengisi data tamu dan kontak dengan benar serta akan digunakan untuk melakukan pembayaran ini?');">

                        <h2>Informasi Tamu</h2>

                        <hr/>

                            <div class="form-group">

                            <?php
                                for ($i = 1; $i <= $jmltamu; $i++) {
                                    ?>

                                    <div class="col-xs-1 text-right">
                                        <i class="fa fa-user fa-2x"></i>
                                    </div>
                                    <div class="col-xs-3">
                                        <input type="text" class="form-control" id="firstnametamu<?php echo $i; ?>" name="txbfirstnametamu<?php echo $i; ?>" placeholder="First Name Tamu <?php echo $i; ?>" required>
                                    </div>
                                    <div class="col-xs-3">
                                        <input type="text" class="form-control" id="lastnametamu<?php echo $i; ?>" name="txblastnametamu<?php echo $i; ?>" placeholder="Last Name Tamu <?php echo $i; ?>" required>
                                    </div>
                                    <div class="col-xs-5">
                                        <input type="text" id="idcardtamu<?php echo $i; ?>" class="form-control" name="txbidcardtamu<?php echo $i; ?>" placeholder="ID Card KTP /SIM /PASSPORT Tamu <?php echo $i; ?>" required>
                                        <span class="help-block m-b-none">< 17 tahun jika tidak memiliki ID diisi dengan tanggal lahir format hhbbtttt. Contoh: 01011993</span>
                                    </div>

                                    <?php
                                }
                            ?>

                            </div>


                        <h2>Kontak yang dapat dihubungi</h2>

                        <hr/>

                            <input type="hidden" value="<?php echo $billerid ?>" name="txbbillerid">
                            <input type="hidden" value="<?php echo $searchingmid ?>" name="txbsearchingmid">
                            <input type="hidden" value="<?php echo $jmltamu ?>" id="txbjmltamu" name="txbjmltamu">
                            <input type="hidden" value="<?php echo $jmlkamar ?>" name="sljmlkamar">
                            <input type="hidden" value="<?php echo $internalcode ?>" name="txbinternalcode">
                            <input type="hidden" value="<?php echo $hotelid ?>" name="txbhotelid">
                            <input type="hidden" value="<?php echo $categoryid ?>" name="txbcategoryid">
                            <input type="hidden" value="<?php echo $namahotel ?>" name="txbhotelname">
                            <input type="hidden" value="<?php echo $alamathotel ?>" name="txbhoteladdress">
                            <input type="hidden" value="<?php echo $typename ?>" name="txbtypename">
                            <input type="hidden" value="<?php echo $tglcheckin ?>" name="txbcheckindate">
                            <input type="hidden" value="<?php echo $tglcheckout ?>" name="txbcheckoutdate">
                            <input type="hidden" value="<?php echo $amount ?>" name="txbamount">
                            <input type="hidden" value="<?php echo $totalamount ?>" name="txbtotalamount">
                            <input type="hidden" value="<?php echo $taxamount ?>" name="txbtaxamount">
                            <input type="hidden" value="<?php echo $roomimage ?>" name="txbroomimage">
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

                                    <button type="submit" class="btn btn-danger"> Simpan dan Lanjutkan</button>
<!--                                    <input class="btn btn-danger" type="button" id="btnsubmitkontak" value="Simpan & Lanjutkan" onclick="bookingroom()">-->


                                </div>

                            </div>

                        </form>

                    </div>

                    <div id="divpembayaran" style="<?php if($tabs == 2){echo 'display: block;';}else{echo 'display: none;';} ?>">

                        <?php
                        if($tabs == 2){

                            $rc = $booking['booking']->rc;
                            $rd = $booking['booking']->rd;

//                            $rc = '00';

                            if($rc == '00') {

                                $transactionid = $booking['booking']->data->transactionId;
                                $mid = $booking['booking']->data->mid;
                                $komisi = $booking['booking']->data->komisi;
                                $bookingcode = $booking['booking']->data->bookingCode;
                                $timelimit = $booking['booking']->data->timeLimit;
//                                $bookingcode = '';
//                                $mid = '';
//                                $transactionid = '';
//                                $komisi = '';
//                                $timelimit = '';
                                $phone = $this->input->post('txbnotelpkontak');
                                $fname = $this->input->post('txbfirstnamekontak');
                                $lname = $this->input->post('txblastnamekontak');
                                $email = $this->input->post('txbemailkontak');
                                $city = $this->input->post('txbkotakontak');

                                ?>

                                <form class="form-horizontal"
                                      id="formbayar"
                                      autocomplete="off"
                                      method="post"
                                      action="bookhotel"
                                      onsubmit="return confirm('Anda yakin dengan transaksi hotel ini dan transaksi hotel tidak dapat dibatalkan?');">

                                    <div class="row">

                                        <div class="col-sm-6">

                                            <h2>Informasi Tamu</h2>

                                            <hr/>

                                            <div class="form-group">

                                                <?php
                                                for ($i = 1; $i <= $jmltamu; $i++) {
                                                    $namatxbfirstnametamu = 'txbfirstnametamu'.$i;
                                                    $namatxblastnametamu = 'txblastnametamu'.$i;
                                                    $namatxbidcardtamu = 'txbidcardtamu'.$i;

                                                    $txbfirstnametamu = $this->input->post($namatxbfirstnametamu);
                                                    $txblastnametamu = $this->input->post($namatxblastnametamu);
                                                    $namatamu = $txbfirstnametamu.' '.$txblastnametamu;
                                                    $txbidcardtamu = $this->input->post($namatxbidcardtamu);

                                                    ?>
                                                    <input type="hidden" class="form-control" value="<?php echo $txbfirstnametamu;?>" name="txbfirstnametamu<?php echo $i; ?>">
                                                    <input type="hidden" class="form-control" value="<?php echo $txblastnametamu;?>" name="txblastnametamu<?php echo $i; ?>">



                                                    <div class="col-xs-2 text-right">
                                                        <i class="fa fa-user fa-2x"></i>
                                                    </div>
                                                    <div class="col-xs-5">
                                                        <input type="text" class="form-control" value="<?php echo $namatamu;?>" readonly style="border: none; background-color: transparent;">
                                                    </div>
                                                    <div class="col-xs-5">
                                                        <input type="text" class="form-control" value="<?php echo $txbidcardtamu;?>" name="txbidcardtamu<?php echo $i; ?>" readonly style="border: none; background-color: transparent;">
                                                    </div>

                                                    <?php
                                                }
                                                ?>

                                            </div>

                                        </div>
                                        <div class="col-sm-6">

                                            <h2>Informasi Kontak</h2>

                                            <hr/>

                                            <div class="form-group">
                                                <div class="col-xs-4"><label class="control-label" >Nama Kontak</label></div>
                                                <div class="col-xs-8"><input type="text" class="form-control" value="<?php echo $fname.' '.$lname;?>" readonly style="border: none; background-color: transparent;"></div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-xs-4"><label class="control-label" >Email</label></div>
                                                <div class="col-xs-8"><input type="text" class="form-control" value="<?php echo $email;?>" readonly style="border: none; background-color: transparent;"></div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-xs-4"><label class="control-label" >No Telepon</label></div>
                                                <div class="col-xs-8"><input type="text" class="form-control" value="<?php echo $phone;?>" readonly style="border: none; background-color: transparent;"></div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-xs-4"><label class="control-label" >Asal Kota</label></div>
                                                <div class="col-xs-8"><input type="text" class="form-control" value="<?php echo $city;?>" readonly style="border: none; background-color: transparent;"></div>
                                            </div>

                                        </div>

                                    </div>

                                    <h2>Informasi Pembayaran</h2>

                                    <hr/>

                                    <div class="row">

                                        <div class="col-xs-6">

                                            <div class="form-group">
                                                <div class="col-xs-4">
                                                    <label>Kode Booking </label>
                                                </div>
                                                <div class="col-xs-8"><h3 class="text-info"><?php echo $bookingcode; ?></h3></div>
                                            </div>

                                            <div class="form-group">

                                                <div class="col-xs-4">
                                                    <label>Time Limit</label>
                                                </div>
                                                <div class="col-xs-8">
                                                    <p class="text-danger">
                                                        <?php
                                                        echo $timelimit;
                                                        ?>
                                                    </p>
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

                                                    <div class="col-xs-4">
                                                        <label><?php echo 'Malam ' . $i . ' (' . $jmlkamar . ' Kamar) ' ?></label>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <?php
                                                        $rpamount = number_format($jmlamount, 0, ',', '.');

                                                        echo $currency . ' ' . $rpamount;
                                                        ?>
                                                    </div>

                                                </div>

                                                <?php
                                            }

                                            ?>

                                        </div>
                                        <div class="col-xs-6">

                                            <div class="form-group">
                                                <div class="col-lg-4">
                                                    <label>Metode Pembayaran </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <select class="form-control" id="slmethodpayment" name="slmethodpayment" required onchange="changepaymentmethod()">
                                                        <option value="Tunai">Tunai</option>
                                                        <option value="Transfer">Transfer</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div id="divtransfer" style="border: solid 2px #f7f7f7; padding: 10px; display: none;">
                                                <div class="form-group">
                                                    <div class="col-lg-4">
                                                        <label>Nama Bank </label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control" id="namabank" name="txbnamabank" placeholder="Nama Bank Pengirim" value="-" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-4">
                                                        <label>No Rekening </label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control" id="norekening" name="txbnorekening" placeholder="No Rekening Pengirim" value="-" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-4">
                                                        <label>Nama Pengirim </label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control" id="namapengirim" name="txbnamapengirim" placeholder="Nama Pengirim" value="-" required>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <hr/>

                                    <input type="hidden" value="<?php echo $billerid ?>" name="txbbillerid">
                                    <input type="hidden" value="<?php echo $searchingmid ?>" name="txbsearchingmid">
                                    <input type="hidden" value="<?php echo $jmltamu ?>" name="txbjmltamu">
                                    <input type="hidden" value="<?php echo $jmlkamar ?>" name="sljmlkamar">
                                    <input type="hidden" value="<?php echo $internalcode ?>" name="txbinternalcode">
                                    <input type="hidden" value="<?php echo $hotelid ?>" name="txbhotelid">
                                    <input type="hidden" value="<?php echo $categoryid ?>" name="txbcategoryid">
                                    <input type="hidden" value="<?php echo $namahotel ?>" name="txbhotelname">
                                    <input type="hidden" value="<?php echo $alamathotel ?>" name="txbhoteladdress">
                                    <input type="hidden" value="<?php echo $typename ?>" name="txbtypename">
                                    <input type="hidden" value="<?php echo $tglcheckin ?>" name="txbcheckindate">
                                    <input type="hidden" value="<?php echo $tglcheckout ?>" name="txbcheckoutdate">
                                    <input type="hidden" value="<?php echo $amount ?>" name="txbamount">
                                    <input type="hidden" value="<?php echo $totalamount ?>" name="txbtotalamount">
                                    <input type="hidden" value="<?php echo $taxamount ?>" name="txbtaxamount">
                                    <input type="hidden" value="<?php echo $roomimage ?>" name="txbroomimage">
                                    <input type="hidden" value="3" name="tabs">

                                    <input type="hidden" value="<?php echo $fname; ?>" name="txbfirstnamekontak">
                                    <input type="hidden" value="<?php echo $lname; ?>" name="txblastnamekontak">
                                    <input type="hidden" value="<?php echo $email; ?>" name="txbemailkontak">
                                    <input type="hidden" value="<?php echo $phone; ?>" name="txbnotelpkontak">
                                    <input type="hidden" value="<?php echo $city; ?>" name="txbkotakontak">

                                    <input type="hidden" value="<?php echo $bookingcode ?>" name="txbbookingcode">
                                    <input type="hidden" value="<?php echo $mid ?>" name="txbmid">
                                    <input type="hidden" value="<?php echo $transactionid ?>" name="txbtransactionid">
                                    <input type="hidden" value="<?php echo $komisi ?>" name="txbkomisi">
                                    <input type="hidden" value="<?php echo $timelimit ?>" name="txbtimelimit">

                                    <input type="hidden" value="<?php echo $datasaldo[0]->saldo ?>" name="txbsaldosekarang" id="txbsaldosekarang">

                                    <div class="form-group">

                                        <div class="col-xs-2">
                                            <h3>Total Bayar</h3>
                                            <text style="font-size: 10px;">* Belum termasuk Biaya Admin</text>
                                        </div>
                                        <div class="col-xs-7">
                                            <?php
                                            $rpnominal = number_format($totalamount, 0, ',', '.');

                                            echo '<h2 class="text-info">' . $currency . ' ' . $rpnominal . '</h2>';
                                            ?>
                                        </div>
                                        <div class="col-xs-1">
                                            <button type="button" class="btn btn-warning" onclick="cancelbook()"> Cancel</button>
                                        </div>
                                        <div class="col-xs-2">
                                            <button type="submit" class="btn btn-danger"> Book Now !</button>
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

                        <?php
                        if($tabs == 3) {

                            $rc = $payment['payment']->errorCode;
                            $rd = $payment['payment']->errorMsg;

                            if($rc == '00') {

                                $transactionid = $payment['payment']->data->data->transactionId;
                                if($transactionid == ''){
                                    $transactionid = $this->input->post('txbtransactionid');
                                }
                                $urletiket = $payment['payment']->data->data->url_etiket;
                                $urlstruk = $payment['payment']->data->data->url_struk;
                                $nominal = $payment['payment']->data->data->nominal;
                                $nominalAdmin = $payment['payment']->data->data->nominalAdmin;
                                if($nominalAdmin == ''){
                                    $nominalAdmin = 0;
                                }
                                $mid = $payment['payment']->data->data->mid;
                                $komisi = $payment['payment']->data->data->komisi;
                                if($komisi == null){
                                    $komisi = $this->input->post('txbkomisi');
                                }
                                $bookingcode = $this->input->post('txbbookingcode');

                                $phone = $this->input->post('txbnotelpkontak');
                                $fname = $this->input->post('txbfirstnamekontak');
                                $lname = $this->input->post('txblastnamekontak');
                                $email = $this->input->post('txbemailkontak');
                                $city = $this->input->post('txbkotakontak');
                                ?>

                                <form class="form-horizontal">

                                    <div class="row text-center">

                                        <h1 style="color: green;">SELAMAT</h1><br/>
                                        <h2>Anda telah melakukan transaksi Hotel, dengan rincian sebagai berikut:</h2><br/>

                                        <hr/>

                                    </div>

                                    <div class="row">

                                        <div class="col-sm-6">

                                            <h2>Informasi Tamu</h2>

                                            <hr/>

                                            <div class="form-group">

                                                <?php
                                                for ($i = 1; $i <= $jmltamu; $i++) {
                                                    $namatxbfirstnametamu = 'txbfirstnametamu'.$i;
                                                    $namatxblastnametamu = 'txblastnametamu'.$i;
                                                    $namatxbidcardtamu = 'txbidcardtamu'.$i;

                                                    $txbfirstnametamu = $this->input->post($namatxbfirstnametamu);
                                                    $txblastnametamu = $this->input->post($namatxblastnametamu);
                                                    $namatamu = $txbfirstnametamu.' '.$txblastnametamu;
                                                    $txbidcardtamu = $this->input->post($namatxbidcardtamu);

                                                    ?>

                                                    <div class="col-xs-2 text-right">
                                                        <i class="fa fa-user fa-2x"></i>
                                                    </div>
                                                    <div class="col-xs-5">
                                                        <input type="text" class="form-control" value="<?php echo $namatamu;?>" readonly style="border: none; background-color: transparent;">
                                                    </div>
                                                    <div class="col-xs-5">
                                                        <input type="text" class="form-control" value="<?php echo $txbidcardtamu;?>" name="txbidcardtamu<?php echo $i; ?>" readonly style="border: none; background-color: transparent;">
                                                    </div>

                                                    <?php
                                                }
                                                ?>

                                            </div>

                                        </div>
                                        <div class="col-sm-6">

                                            <h2>Informasi Kontak</h2>

                                            <hr/>

                                            <div class="form-group">

                                                <div class="form-group">
                                                    <div class="col-xs-4"><label class="control-label" >Nama Kontak</label></div>
                                                    <div class="col-xs-8"><input type="text" class="form-control" value="<?php echo $fname.' '.$lname;?>" readonly style="border: none; background-color: transparent;"></div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-xs-4"><label class="control-label" >Email</label></div>
                                                    <div class="col-xs-8"><input type="text" class="form-control" value="<?php echo $email;?>" readonly style="border: none; background-color: transparent;"></div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-xs-4"><label class="control-label" >No Telepon</label></div>
                                                    <div class="col-xs-8"><input type="text" class="form-control" value="<?php echo $phone;?>" readonly style="border: none; background-color: transparent;"></div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-xs-4"><label class="control-label" >Asal Kota</label></div>
                                                    <div class="col-xs-8"><input type="text" class="form-control" value="<?php echo $city;?>" readonly style="border: none; background-color: transparent;"></div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <h2>Informasi Pembayaran</h2>

                                        <hr/>

                                        <div class="form-group">
                                            <div class="col-xs-2">
                                                <label>ID Transaction</label>
                                            </div>
                                            <div class="col-xs-10"><h2 class="text-info"><?php echo $transactionid; ?></h2></div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-2">
                                                <label>Kode Booking </label>
                                            </div>
                                            <div class="col-xs-10"><h3 class="text-info"><?php echo $bookingcode; ?></h3></div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-2">
                                                <label>URL E-Struk</label>
                                            </div>
                                            <div class="col-xs-10"><a href="<?php echo $urlstruk; ?>"><?php echo $urlstruk; ?></a></div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-2">
                                                <label>URL E-Tiket</label>
                                            </div>
                                            <div class="col-xs-10"><a href="<?php echo $urletiket; ?>"><?php echo $urletiket; ?></a></div>
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

                                                <div class="col-xs-2">
                                                    <label><?php echo 'Malam ' . $i . ' (' . $jmlkamar . ' Kamar) ' ?></label>
                                                </div>
                                                <div class="col-xs-10">
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
                                            <div class="col-xs-2">
                                                <label>Biaya Admin</label>
                                            </div>
                                            <div class="col-xs-10">
                                                <?php
                                                if($nominalAdmin == 0){
                                                    echo $nominalAdmin;
                                                }else{
                                                    $rpnominaladmin = number_format($nominalAdmin, 0, ',', '.');

                                                    echo $currency . ' ' . $rpnominaladmin;
                                                }
                                                ?>
                                            </div>
                                        </div>

                                    </div>

                                    <hr/>

                                    <div class="form-group">

                                        <div class="col-xs-2">
                                            <h3>Total</h3>
                                        </div>
                                        <div class="col-xs-7">
                                            <?php
                                            $rpnominal = number_format($nominal, 0, ',', '.');

                                            echo '<h2 class="text-info">' . $currency . ' ' . $rpnominal . '</h2>';
                                            ?>
                                        </div>
                                        <div class="col-xs-3">
                                            <a href="<?php echo base_url('hotel')?>" class="text-danger">
                                                <input type="button" class="btn btn-danger" value="Kembali ke Form Pencarian Hotel">
                                            </a>
                                        </div>


                                    </div>

                                    <hr/>

                                    <div class="form-group">

                                        <div class="col-xs-12">
                                            <text style="font-size: 10px;">
                                                * Anda dapat melihat transaksi hotel ini pada laporan transaksi dengan id <b><?php echo $payment['idtransaksi'] ?></b> dan pada laporan deposit dengan id depo <b><?php echo $payment['iddepo'] ?></b>
                                            </text>
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
                                        <a href="<?php echo base_url('hotel')?>">
                                            <button class="btn btn-danger">Kembali ke form pencarian</button>
                                        </a>

                                    </div>

                                </div>

                                <?php

                            }

                        }
                        ?>

                    </div>

                </div>

            </div>

        </div>
        <div class="col-lg-2"></div>
    </div>
</div>

<!-- /content -->
