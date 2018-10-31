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
            <li class="active">
                <strong>Transaksi Deposit Saldo</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>


<!-- Content -->

<div class="wrapper wrapper-content animated fadeInRight article" style="margin-top: 10px;">

    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">

            <?php
            if($this->session->flashdata('savetranssaldoberhasil')){ ?>

                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    Silahkan transfer sesuai harga ke no rek dan bank yang telah ditentukan di tabel transaksi.<br/>
                    Selanjutnya anda harus mengupload bukti transfer anda.<br/>
                    Deposit Anda terproses secara otomatis oleh sistem dengan estimasi 5-10 menit.<br/>
                    Tiket hanya berlaku selama 1 jam.<br/>
                    Tabel transaksi yang memuat no rek, nama bank, dan time limit terlihat dibawah ini.<br/>
                </div>

            <?php } ?>

            <?php
            if($this->session->flashdata('uploadgambargagal')){ ?>

                <div class="alert alert-warning alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    Ada kesalahan dalam gambar yang diupload silahkan ulangi dan ikuti sesuai petunjul gambar yang harus diupload di bawah bidang upload gambar !
                </div>

            <?php } ?>

            <?php
            if($this->session->flashdata('uploadgambarberhasil')){ ?>

                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    Berhasil, anda telah mengupload bukti transaksi deposit.<br/>
                    Selanjutnya admin kami akan memverifikasi bukti anda, Deposit anda akan terproses secara otomatis
                </div>

            <?php } ?>

            <?php
            if($this->session->flashdata('batalsaldoberhasil')){ ?>

                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    Berhasil, Anda telah membatalkan saldo untuk id transaksi <?php echo $this->session->flashdata('batalsaldoberhasil') ?>.
                </div>

            <?php } ?>

            <?php
            if($this->session->flashdata('tambahsaldoberhasil')){ ?>

                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    Berhasil, Anda telah menambahkan saldo untuk id transaksi <?php echo $this->session->flashdata('tambahsaldoberhasil') ?>.
                </div>

            <?php } ?>

            <h2>
                <i class="fa fa-list" style="font-size:1.5em;margin-right:8px;color: <?php echo $warna_lembaga ?>;"></i>
                <span style="color: <?php echo $warna_lembaga ?>">Transaksi Deposit Saldo</span>
            </h2>
            <div class="ibox float-e-margins" >

                <input type="hidden" id="txbbatalsaldoberhasil" value="<?php echo $this->session->flashdata('batalsaldoberhasil') ?>">
                <input type="hidden" id="txbtambahsaldoberhasil" value="<?php echo $this->session->flashdata('tambahsaldoberhasil') ?>">

                <div class="ibox-content" style="padding-bottom: 3px;">

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover datatransaksisaldo">

                            <thead>
                                <tr style="font-size: 14px;">
                                    <th>Id Trans</th>
                                    <th>Tanggal</th>
                                    <?php
                                    if($this->session->userdata('user_level')==0) {
                                        ?>

                                        <th>Id User</th>

                                        <?php
                                    }
                                    ?>
                                    <th>Metode</th>
                                    <th>Rek. Tujuan</th>
                                    <th>Nominal</th>
                                    <th>Status</th>
                                    <th>Time Limit</th>
                                    <th>Bukti Transaksi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                            <?php
                                foreach ($datatranssaldo as $datatranssaldo) {
                                    ?>

                                    <tr style="font-size: 12px;">
                                        <td style="vertical-align: middle;"><?php echo $datatranssaldo->id; ?></td>
                                        <td style="vertical-align: middle;">
                                            <?php
                                            $datetime = $datatranssaldo->datetime;
                                            $splitdatetime = explode(" ", $datetime);
                                            $splitdateindo = explode("-", $splitdatetime[0]);
                                            $dateindo = $splitdateindo[2] . '-' . $splitdateindo[1] . '-' .$splitdateindo[0];
                                            $datetimeindo = $dateindo.'<br/>'.$splitdatetime[1];

                                            echo $datetimeindo;
                                            ?>
                                        </td>
                                        <?php
                                        if($this->session->userdata('user_level')==0) {
                                            ?>

                                            <td style="vertical-align: middle;">
                                                <button
                                                        type="button"
                                                        class="btn btn-xs"
                                                        style="background-color: transparent; color: #75A4CC; "
                                                        data-iduser="<?php echo $datatranssaldo->id_user ?>"
                                                        onclick="lihatSaldouser(this)">
                                                    <?php echo $datatranssaldo->id_user; ?>
                                                </button>

                                            </td>

                                            <?php
                                        }
                                        ?>
                                        <td style="vertical-align: middle;"><?php echo $datatranssaldo->metode; ?></td>
                                        <td style="vertical-align: middle;">
                                            <text><?php echo $datatranssaldo->nama_bank_rek_tujuan; ?></text><br/>
                                            <text>No.Rek : <?php echo $datatranssaldo->no_rek_tujuan; ?></text><br/>
                                            <text>a/n <?php echo $datatranssaldo->an_rek_tujuan; ?></text><br/>
                                            <text>Nama Pengirim : <?php echo $datatranssaldo->namapengirim; ?></text>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <?php echo number_format($datatranssaldo->nominal, 0, ',', '.'); ?>
                                            <br/>
                                            <text>
                                                <b>Harga :</b>
                                                <?php
                                                $rupiah = "Rp " . number_format($datatranssaldo->harga,0,',','.');
                                                echo $rupiah;
                                                ?>
                                            </text>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <?php
                                            $datetimenow = date("Y-m-d H:i:s");

                                            if($datatranssaldo->timelimit < $datetimenow){

                                                if($datatranssaldo->status == 4){
                                                    ?>

                                                    <span class="label label-danger">Gagal</span>

                                                    <?php
                                                }elseif ($datatranssaldo->status == 3){
                                                    ?>

                                                    <span class="label label-danger">Gagal</span>

                                                    <?php
                                                }elseif ($datatranssaldo->status == 2){
                                                    ?>

                                                    <span class="label label-primary">Success</span>

                                                    <?php
                                                }elseif ($datatranssaldo->status == 1){
                                                    ?>

                                                    <span class="label label-success">Konfirmasi Admin</span>

                                                    <?php
                                                }elseif ($datatranssaldo->status == 5){
                                                    ?>

                                                    <span class="label label-danger">Gagal</span>

                                                    <?php
                                                }
                                                else {
                                                    ?>

                                                    <span class="label label-danger">Gagal</span>

                                                    <?php
                                                }
                                            }else{

                                                if($datatranssaldo->status == 4){
                                                    ?>

                                                        <span class="label label-success">Upload Bukti Transaksi</span>

                                                    <?php
                                                }elseif ($datatranssaldo->status == 3){
                                                    ?>

                                                        <span class="label label-danger">Gagal</span>

                                                    <?php
                                                }elseif ($datatranssaldo->status == 2){
                                                    ?>

                                                    <span class="label label-primary">Success</span>

                                                    <?php
                                                }elseif ($datatranssaldo->status == 1){
                                                    ?>

                                                    <span class="label label-success">Konfirmasi Admin</span>

                                                    <?php
                                                }elseif ($datatranssaldo->status == 5){
                                                    ?>

                                                    <span class="label label-warning">Dibatalkan, Terjadi kesalahan</span><br/><br/>

                                                    <?php
                                                    if($this->session->userdata('user_level')==1) {
                                                        ?>

                                                        <span class="label label-info">Silahkan cek kembali bukti transfer anda <br/><br/> atau silahkan hubungi call center kami.</span>

                                                        <?php

                                                    }
                                                }

                                            }
                                            ?>
                                        </td>
                                        <td style="color: #ed5565; vertical-align: middle;">
                                            <?php
                                            $datetimelimit = $datatranssaldo->timelimit;
                                            $splitdatetimelimit = explode(" ", $datetimelimit);
                                            $splitdatelimitindo = explode("-", $splitdatetimelimit[0]);
                                            $datelimitindo = $splitdatelimitindo[2] . '-' . $splitdatelimitindo[1] . '-' .$splitdatelimitindo[0];
                                            $datetimelimitindo = $datelimitindo.'<br/>'.$splitdatetimelimit[1];

                                            echo $datetimelimitindo;
                                            ?>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <?php
                                            $path = $datatranssaldo->img;
                                            $file = basename($path);
                                            ?>
                                            <button
                                                    type="button"
                                                    class="btn btn-xs"
                                                    style="background-color: transparent; color: #75A4CC; "
                                                    data-file="<?php echo $file ?>"
                                                    onclick="lihatGambar(this)">
                                                <?php echo $file;?>
                                            </button>
                                        </td>
                                        <td style="vertical-align: middle;">

                                            <?php
                                            if($this->session->userdata('user_level')==0) {

                                                if($datatranssaldo->status == 1 or $datatranssaldo->status == 5 ) {
                                                    ?>

                                                    <form id="formTambahBatalSaldo<?php echo $datatranssaldo->id;?>" method="post">

<!--                                                        <input type="hidden" id="txbsaldobank" name="txbsaldobank" value="--><?php //echo $datasaldo[0]->saldo; ?><!--">-->
                                                        <input type="hidden" id="txbidtransaksi" name="txbidtransaksi" value="<?php echo $datatranssaldo->id; ?>">
                                                        <input type="hidden" name="txbiduser" value="<?php echo $datatranssaldo->id_user; ?>">
                                                        <input type="hidden" id="txbnominal" name="txbnominal" value="<?php echo $datatranssaldo->nominal; ?>">

                                                        <button type="button"
                                                                class="btn btn-sm btn-success"
                                                                data-id="<?php echo $datatranssaldo->id; ?>"
                                                                onclick="tambahSaldo(this)">Tambah</button>
                                                        <button type="button"
                                                                class="btn btn-sm btn-danger"
                                                                data-id="<?php echo $datatranssaldo->id; ?>"
                                                                onclick="batalkanSaldo(this)">Batal</button>

                                                    </form>

                                                    <?php
                                                }
                                                elseif ($datatranssaldo->status == 2){
                                                    ?>
                                                        <i class="fa fa-check fa-2x text-navy"></i>
                                                    <?php
                                                }
                                                else{
                                                    ?>

                                                    <i class="fa fa-times fa-2x text-danger"></i>

                                                    <?php
                                                }

                                            }else {

                                                if ($datatranssaldo->timelimit < $datetimenow) {

                                                    if($datatranssaldo->status == 2){
                                                        ?>
                                                        <i class="fa fa-check fa-2x text-navy"></i>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <i class="fa fa-times fa-2x text-danger"></i>
                                                        <?php
                                                    }
                                                    ?>

                                                    <?php
                                                } else {

                                                    if ($datatranssaldo->img != null) {

                                                        if($datatranssaldo->status == 2){
                                                            ?>
                                                                <i class="fa fa-check fa-2x text-navy"></i>
                                                            <?php
                                                        }else{
                                                            ?>
                                                                <a data-toggle="modal" href="#modalTambahBukti">

                                                                    <button type="button"
                                                                            class="btn btn-sm btn-success"
                                                                            data-id="<?php echo $datatranssaldo->id_user; ?>">
                                                                        Ubah Bukti Transfer
                                                                    </button>

                                                                </a>
                                                            <?php
                                                        }

                                                    } else {
                                                        ?>

                                                        <a data-toggle="modal" href="#modalTambahBukti">

                                                            <button type="button"
                                                                    class="btn btn-sm btn-success"
                                                                    data-id="<?php echo $datatranssaldo->id_user; ?>">
                                                                Tambah Bukti Transfer
                                                            </button>

                                                        </a>

                                                        <?php
                                                    }
                                                }

                                            }
                                            ?>

                                        </td>
                                    </tr>

                                    <?php
                                }
                            ?>
                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            <div class="modal inmodal" id="modalTambahBukti" tabindex="-1" role="dialog"  aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content animated fadeIn">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <i class="fa fa-image modal-icon"></i>
                            <h4 class="modal-title">Bukti Transfer</h4>
                            <small>Anda akan menambahkan atau mengubah bukti transfer ?.</small>
                        </div>
                        <form id="formTambahBukti" method="post" enctype="multipart/form-data">

                        <div class="modal-body">

                                <input type="hidden" class="form-control" id="txbwarnalembaga" value="<?php echo $warna_lembaga?>">

                                <input name="txbidbuktitransfer" type="hidden" value="<?php echo $datatranssaldo->id; ?>">

                                <div class="form-group m-b-none">
                                    <label>Upload Image</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-default btn-file">
                                                Browse… <input type="file" name="imgInp" id="imgInp" class="imgInp">
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" id="txbNameimg" name="txbNameimg" readonly>
                                    </div>
                                    <img id='img-upload'/>
                                </div>
                                <span class="help-block m-b-none">
                                    Max Size 1000kb/1mb, Files => .jpg .png .gif
                                </span>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-right" onclick="uploadImage()"><i class="fa fa-save"> </i> Upload</button>
                        </div>

                        </form>
                    </div>
                </div>

            </div>

            <div class="modal inmodal" id="modalImgBukti" tabindex="-1" role="dialog"  aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content animated fadeIn">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <i class="fa fa-image modal-icon"></i>
                            <h4 class="modal-title">Gambar Bukti Transfer</h4>
                        </div>
                        <div class="modal-body">

                            <div id="divimg" style="max-width: 100%; max-height: 100%;">
                                <img alt="image" id="imgBuktiTransfer" style="max-width: 100%; max-height: 100%;">
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="modal inmodal" id="modalSaldoUser" tabindex="-1" role="dialog"  aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content animated fadeIn">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <i class="fa fa-money modal-icon"></i>
                            <h4 class="modal-title">Saldo User</h4>
                        </div>
                        <div class="modal-body">

                            <div id="formSaldo" class="formSaldo">

                                <form class="form-horizontal" id="formSaldouser">

                                    <div class="form-group">

                                        <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga; ?>;">ID User</label>
                                        <h3 class="col-lg-9" id="txtiduser"></h3>

                                    </div>
                                    <div class="form-group">

                                        <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga; ?>;">Nama</label>
                                        <h3 class="col-lg-9" id="txtnamauser"></h3>

                                    </div>
                                    <div class="form-group">

                                        <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga; ?>;">No Telepon</label>
                                        <h3 class="col-lg-9" id="txtnotelpuser"></h3>

                                    </div>
                                    <div class="form-group">

                                        <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga; ?>;">Email</label>
                                        <h3 class="col-lg-9" id="txtemailuser"></h3>

                                    </div>
                                    <div class="form-group">

                                        <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga; ?>;">Alamat</label>
                                        <h3 class="col-lg-9" id="txtalamatuser"></h3>

                                    </div>
                                    <div class="form-group">

                                        <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga; ?>;">Jumlah Saldo</label>
                                        <h2 class="col-lg-9" id="txtsaldouser"></h2>

                                    </div>

                                </form>

                            </div>

                        </div>
                    </div>
                </div>

            </div>


        </div>
        <div class="col-lg-1"></div>
    </div>
</div>

<!-- /content -->


</div>
