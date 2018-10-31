<?php
$warna_lembaga=$_GET['warnalembaga'];
$datasaldo=$_GET['datasaldo'];
?>

<form class="form-horizontal" style="padding-left: 20px; padding-right: 20px;" >

    <div class="form-group">
        <div class="i-checks col-lg-2"><label style="color: <?php echo $warna_lembaga;?>"> <input type="radio" checked=""  value="option1" name="jenispln" id="icheckstoken" class="icheckstoken"> <i></i> Token Listrik </label></div>
        <div class="i-checks col-lg-2"><label style="color: <?php echo $warna_lembaga;?>"> <input type="radio" value="option2" name="jenispln" id="icheckstagihan" class="icheckstagihan"> <i></i> Tagihan Listrik </label></div>
    </div>

    <?php
    $datapln = $dataproduk->produk;
    $jmldatapln = count($datapln);

    for ($x = 0; $x < $jmldatapln; $x++) {
        $namaproduk = $dataproduk->produk[$x]->nama;
        if($namaproduk == 'PLN Pra Bayar (Token) '){
            $kdprodukplntoken = $dataproduk->produk[$x]->kode;
        }elseif($namaproduk == 'PLN Pasca Bayar'){
            $kdprodukplnpasca = $dataproduk->produk[$x]->kode;
        }
    };

    ?>

</form>

<form class="form-horizontal" id="formtokenpln" method="post" autocomplete="off">

    <input type="hidden" class="form-control" id="txbjenistagihan" name="txbjenistagihan" value="TOKENPLN">
    <input type="hidden" class="form-control" name="txbtab" value="2">

    <input type="hidden" name="txbproduk" id="txbproduk" value="<?php echo $kdprodukplntoken?>">

    <input type="hidden" name="txbnamaproduk" id="txbnamaproduk">
    <input type="hidden" id="txbnominaltoken" name="txbnominaltoken">

    <div class="form-group">
        <label class="col-lg-2 control-label" style="color: <?php echo $warna_lembaga;?>">Nomor / ID Pelanggan :</label>
        <div class="col-lg-10">
            <div class="input-group m-b">
                <input type="text" class="form-control" id="nomoridpelanggan" name="txbnomorpelanggan" style="height: 50px;" placeholder="CONTOH 1122334455" required>
                <span class="input-group-addon"><img alt="image" src="<?php echo base_url();?>assets/img/LOGOPLN.png" style="height: 30px; width: 20px;" /></span>
            </div>
        </div>
    </div>

    <div class="form-group" id="nominaltoken">
        <label class="col-lg-12" style="color: <?php echo $warna_lembaga;?>">Nominal :</label>
        <div class="col-lg-12">

            <?php
            $jenistoken = array("20000","50000","100000","200000","500000","1000000");
            $jmljenistoken = count($jenistoken);

            for ($x = 0; $x < $jmljenistoken; $x++) {
                $nomnaltoken = number_format($jenistoken[$x], 0, ',', '.');
                $nama = 'TOKEN PLN '.$jenistoken[$x];
                ?>

                <button
                        type="button"
                        class="btn btn-outline btn-danger"
                        onclick="pilihtoken(this)"
                        data-nominal = "<?php echo $jenistoken[$x]?>"
                        data-nomnal = "<?php echo $nomnaltoken?>"
                        data-nama = "<?php echo $nama?>"
                >
                    <?php
                        echo $nomnaltoken;
                    ?>
                </button>

                <?php

            }


            ?>


<!--            --><?php
//            for ($x = 0; $x < $jmldatapln; $x++) {
//                $namaproduk = $dataproduk->produk[$x]->nama;
//                $TOKEN = substr($dataproduk->produk[$x]->nama,0,5);
//                if($TOKEN == 'TOKEN'){
//                    $token = substr($namaproduk, strpos($namaproduk, "P") + 3);
//                    $nominaltoken = (int)$token*1000 ;
//                    $nomnaltoken = number_format($nominaltoken, 0, ',', '.');
//                    ?>
<!--                    <button-->
<!--                            type="button"-->
<!--                            class="btn btn-outline btn-danger"-->
<!--                            data-kode = "--><?php //echo $dataproduk->produk[$x]->kode?><!--"-->
<!--                            data-nominal = "--><?php //echo $nominaltoken?><!--"-->
<!--                            data-nomnal = "--><?php //echo $nomnaltoken?><!--"-->
<!--                            data-harga = "--><?php //echo $dataproduk->produk[$x]->harga?><!--"-->
<!--                            data-nama = "--><?php //echo $dataproduk->produk[$x]->nama?><!--"-->
<!--                            onclick="pilihtoken(this)"-->
<!--                    >-->
<!--                        --><?php //echo $nomnaltoken; ?>
<!--                    </button>-->
<!--                    --><?php
//                }
//            };
//            ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-2">
            <input type="hidden" value="<?php echo $datasaldo ?>" name="txbsaldosekarang" id="txbsaldosekarang">
            <input type="hidden" value="<?php echo $warna_lembaga ?>" name="txbwarnalembaga" id="txbwarnalembaga">
            <div id="nominalhargaprabayar">
<!--                <input type="hidden" name="kodetoken" id="txbkodetoken">-->
<!--                <input type="hidden" name="hargatoken" id="txbhargatoken">-->
                <label class="control-label" style="color: <?php echo $warna_lembaga;?>">Token :</label><br/>
                <h2 id="h2token"></h2>
            </div>
        </div>
        <div class="col-lg-10 text-right" id="btnbelitoken" >
            <button type="button" name="tombol" value="billtokenpln" class="btn btn-danger" style="width: 40%; margin-top: 30px;" onclick="belitoken()">BELI</button>
        </div>
    </div>


</form>

<form class="form-horizontal" id="formtagihanpln" method="post" action="<?php echo site_url("ppob/checkout"); ?>" autocomplete="off" style="display: none;">

    <div class="form-group">
        <label class="col-lg-2 control-label" style="color: <?php echo $warna_lembaga;?>">Nomor / ID Pelanggan :</label>
        <div class="col-lg-10">
            <div class="input-group m-b">
                <input type="hidden" name="txbproduk" id="txbproduk" value="<?php echo $kdprodukplnpasca?>">
                <input type="hidden" class="form-control" id="txbjenistagihan" name="txbjenistagihan" value="PLNPASCABAYAR">
                <input type="hidden" class="form-control" name="txbtab" value="2">
                <input type="text" class="form-control" id="nomorpelanggan" name="nomorpelanggan" style="height: 50px;" placeholder="CONTOH 1122334455" required>
                <span class="input-group-addon"><img alt="image" src="<?php echo base_url();?>assets/img/LOGOPLN.png" style="height: 30px; width: 20px;" /></span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-12 text-right" id="btnbayartagihan">
            <button type="submit" name="tombol" value="billpascapln" class="btn btn-danger" style="width: 40%; margin-top: 30px;">LANJUTKAN</button>
        </div>
    </div>


</form>

<script src="<?php echo base_url();?>assets/js/js_pln.js"></script>