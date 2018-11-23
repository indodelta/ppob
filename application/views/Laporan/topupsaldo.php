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
                <strong>Laporan Topup Saldo</strong>
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
                <span style="color: <?php echo $warna_lembaga;?>">LAPORAN TOPUP SALDO</span>
            </h2>
            <div class="ibox float-e-margins">
                <div class="ibox-content">

                    <input type="hidden" id="txbuserlevel" value="<?php echo $this->session->userdata('user_level'); ?>">

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover datausertopup" id="datausertopup">
                            <thead class="text-center">
                            <tr class="text-center" style="font-size: 14px;">
                                <th class="text-center">No.</th>
                                <th class="text-center">ID TRX</th>
                                <th class="text-center">Tanggal</th>
                                <?php
                                if ($this->session->userdata('user_level') == 0) {
                                    ?>
                                    <th class="text-center">Kode Agen</th>
                                    <?php
                                }
                                ?>
                                <th class="text-center">No Ref</th>
                                <th class="text-center">Method</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">

                            <?php
                            $i=0;
                            foreach ($datatopup as $datatopup) {
                                ?>

                                <tr style="font-size: 12px;">
                                    <td><?= $i++;?></td>
                                    <td><?= $datatopup->txId;?></td>
                                    <td><?= $datatopup->date;?></td>
                                    <td><?= $datatopup->id_user;?></td>
                                    <td><?= $datatopup->refNo;?></td>
                                    <td><?= $datatopup->method;?></td>
                                    <td><?= $datatopup->status_msg;?></td>
                                    <td></td>
                                </tr>

                                <?php
                            }
                            ?>

                            </tbody>


                        </table>

                    </div>

                </div>
            </div>

        </div>
        <div class="col-lg-2"></div>
    </div>

</div>

<!-- /content -->


</div>
