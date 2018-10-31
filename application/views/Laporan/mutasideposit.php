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
                <strong>Laporan Mutasi Deposit</strong>
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
                <span style="color: <?php echo $warna_lembaga;?>">LAPORAN MUTASI DEPOSIT</span>
            </h2>
            <div class="ibox float-e-margins">
                <div class="ibox-content">

                    <input type="hidden" id="txbuserlevel" value="<?php echo $this->session->userdata('user_level'); ?>">

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover datamutasideposit" id="datamutasideposit">
                            <thead class="text-center">
                            <tr style="font-size: 14px;">
                                <th>No.</th>
                                <th>ID TRX</th>
                                <th>Tanggal</th>
                                <?php
                                if ($this->session->userdata('user_level') == 0) {
                                    ?>
                                    <th>Kode Agen</th>
                                    <?php
                                }
                                ?>
                                <th>Case</th>
                                <th>Keterangan Transaksi</th>
                                <th>Debet</th>
                                <th>Kredit</th>
                                <?php
                                if ($this->session->userdata('user_level') == 1) {
                                    ?>
                                    <th>Sisa Saldo</th>
                                    <?php
                                }else if ($this->session->userdata('user_level') == 0) {
                                    ?>
                                    <th>Komisi</th>
                                    <?php
                                }
                                ?>
                            </tr>
                            </thead>
                            <tbody class="text-center">

                            </tbody>


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
