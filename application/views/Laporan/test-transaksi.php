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
                <div class="ibox-content">

                    <div class="table-responsive" style="margin-bottom: 0px;">

                        <?php
                        $total=0;
                        $jmlberhasil = 0;
                        $jmlgagal = 0;
                        foreach ($datatransaksi as $datatransaksi) {

                            $nom = $datatransaksi->nominal;

                            $total = $total + $nom;

                            $status = $datatransaksi->status;
                            if($status == 1){
                                $jmlberhasil = $jmlberhasil+1;
                            }
                            else{
                                $jmlgagal = $jmlgagal+1;
                            }

                        }
                        ?>

                        <table class="table table-bordered table-hover datatransaksi" id="datatransaksi">
                            <thead class="text-center">
                            <tr style="font-size: 14px;">
                                <th>ID TRX</th>
                                <th>TANGGAL</th>
                                <th>KODE</th>
                                <th>NO PELANGGAN</th>
                                <th>SN</th>
                                <th>REF</th>
                                <th>STATUS</th>
                                <th>NOMINAL</th>
                            </tr>
                            </thead>
                        </table>

                    </div>

                    <div class="table-responsive" style="margin-top: 0px;">
                        <table class="table table-bordered datatotal">
                            <tr style="font-size: 14px;">
                                <th style="width: 88%;">
                                    Total:
                                </th>
                                <th class="text-center"><?php echo number_format($total, 0, ',', '.') ?></th>
                            </tr>
                            <tr style="font-size: 12px;">
                                <td colspan="2">
                                    Jumlah Transaksi Berhasil <b><?php echo $jmlberhasil ?></b><br/>
                                    Jumlah Transaksi Gagal <b><?php echo $jmlgagal ?></b>
                                </td>
                            </tr>
                        </table>
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
        <div class="col-lg-2"></div>
    </div>

</div>

<!-- /content -->


</div>
