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
            <li class="active">
                <strong>Laporan Transaksi</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>


<!-- Content -->


<div class="wrapper wrapper-content  animated fadeInRight article">

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">

            <h2>
                <i class="fa fa-book" style="font-size:1em;margin-right:10px;color: <?php echo $warna_lembaga;?>"></i>
                <span style="color: <?php echo $warna_lembaga;?>">LAPORAN TRANSAKSI</span>
            </h2>
            <div class="ibox float-e-margins">
                <div class="ibox-content" style="padding-top: 10px;">

                    <?php

                    $today = date("d/m/Y");
                    $nextweek = date("d/m/Y", strtotime("+1 week"));

                    if($this->input->get("start") == ''){
                        $datestart = '';
                        $dateend = '';
                        $valstart = $today;
                        $valend = $nextweek;
                        $start = '';
                        $end= '';
                    }else{
                        $start = $this->input->get("start");
                        $end = $this->input->get("end");

                        $splitstart = explode('/', $start);
                        $datestart= $splitstart[2].'-'.$splitstart[1].'-'.$splitstart[0].' 00:00:00';

                        $splitend = explode('/', $end);
                        $dateend= $splitend[2].'-'.$splitend[1].'-'.$splitend[0].' 23:59:59';

                        $valstart = $start;
                        $valend = $end;
                    }

                    ?>

                    <input type="hidden" class="input-sm form-control" id="datestart" name="datestart" value="<?php echo $datestart; ?>"/>
                    <input type="hidden" class="input-sm form-control" id="dateend" name="dateend" value="<?php echo $dateend; ?>"/>


                    <form style="margin-bottom: 30px;" autocomplete="off" method="get" action="<?php echo base_url('Laporan/transaksi')?>">

                        <div class="form-group" id="datefilter">
                            <div class="col-lg-3">
                                <label class="font-normal">Filter Tanggal</label>
                                <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" class="input-sm form-control" id="start" name="start" value="<?php echo $valstart; ?>"/>
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="input-sm form-control" id="end" name="end" value="<?php echo $valend; ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-danger btn-sm" style="margin-top: 20px;">Cari</button>
                            <?php if($this->input->get("start") != '') {?>
                            <a href="transaksi"><button type="button" class="btn btn-warning btn-sm" style="margin-top: 20px;">Hapus</button></a>
                            <?php } ?>
                        </div>
                    </form>



                    <hr/>

                    <div class="table-responsive" style="margin-bottom: 0px;">

                        <input type="hidden" id="txbuserlevel" value="<?php echo $this->session->userdata('user_level'); ?>">

                        <table class="table table-bordered table-hover datatransaksi" id="datatransaksi">
                            <thead class="text-center">
                            <tr style="font-size: 14px;">
                                <th>NO</th>
                                <th>ID TRX</th>
                                <th>TANGGAL</th>
                                <?php
                                if ($this->session->userdata('user_level') == 0) {
                                    ?>
                                    <th>KODE AGEN</th>
                                    <?php
                                }
                                ?>
                                <th>KODE</th>
                                <th>NO PELANGGAN</th>
                                <th>SN</th>
                                <th>REF</th>
                                <th>STATUS</th>
                                <th>DETAIL</th>
                                <th>NOMINAL</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">

                            </tbody>

                        </table>

                    </div>

                    <div class="table-responsive" style="margin-top: 0px;">
                        <table class="table table-bordered datatotal">
                            <tr style="font-size: 14px;">
                                <th style="width: 88%;">
                                    Total:
                                </th>
                                <th class="text-center">
                                    <?php
                                    echo number_format($datatotal[0]->nominal,0, ',', '.');
//                                    echo number_format($total, 0, ',', '.')
                                    ?>
                                </th>
                            </tr>
                            <tr style="font-size: 12px;">
                                <td colspan="2">
                                    Jumlah Transaksi Berhasil <b><?php echo $datajumlahberhasil ?></b><br/>
                                    Jumlah Transaksi Gagal <b><?php echo $datajumlahgagal ?></b>
                                </td>
                            </tr>
                            <tr style="font-size: 14px;">
                                <td class="text-center" colspan="2">
                                    <a href="<?php echo base_url('Laporan/download_excel?start='.$start.'&end='.$end)?>">
                                        <text><i class="fa fa-file-excel-o" style="color: green"></i> Download to Excel</text>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>

            <div class="modal inmodal" id="modalLihatDetail" tabindex="-1" role="dialog" aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content animated fadeIn">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <i class="fa fa-file-text modal-icon"></i>
                            <h4 class="modal-title">Detail Tansaksi</h4>
                        </div>
                        <div class="modal-body">

                            <form class="form-horizontal">

                                <div class="form-group">

                                    <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga; ?>;">ID Transaksi</label>
                                    <h3 class="col-lg-9" id="txtidtrx"></h3>

                                </div>

                                <div class="form-group">

                                    <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga; ?>;">Nama Produk</label>
                                    <h3 class="col-lg-9" id="txtnmproduk"></h3>

                                </div>

                                <div class="form-group">

                                    <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga; ?>;">Nama Pelanggan</label>
                                    <h3 class="col-lg-9" id="txtnmpelanggan"></h3>

                                </div>

                                <div class="form-group">

                                    <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga; ?>;">No Pelanggan</label>
                                    <h3 class="col-lg-9" id="txtnopelanggan"></h3>

                                </div>

                                <div class="form-group">

                                    <label class="col-lg-3 control-label" style="color: <?php echo $warna_lembaga; ?>;">Nominal</label>
                                    <h3 class="col-lg-9" id="txtnominal"></h3>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="col-lg-2"></div>
    </div>

</div>

<!-- /content -->


</div>
