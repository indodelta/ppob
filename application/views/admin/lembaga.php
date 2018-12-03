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
                <strong>Lembaga</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>


<!-- Content -->

<div class="wrapper wrapper-content animated fadeInRight article" style="margin-top: 10px;">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">

            <?php
            if($this->session->flashdata('success')){ ?>

                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>

            <?php } ?>

            <h2>
                <i class="fa fa-building" style="font-size:1.5em;margin-right:8px;color: <?php echo $warna_lembaga ?>;"></i>
                <span style="color: <?php echo $warna_lembaga ?>">Manajemen Lembaga</span>
            </h2>
            <div class="ibox float-e-margins" >

                <div class="ibox-content">

                    <input type="hidden" class="form-control" id="txbwarnalembaga" value="<?php echo $warna_lembaga?>">

                    <div class="row">
                        <a href="<?php echo base_url('lembaga/tambah');?>">
                            <button type="button" class="btn btn-danger col-lg-2">
                                <i class="fa fa-plus" style="font-size:1.5em;margin-right:8px;color: white;"></i>
                                Tambah Lembaga
                            </button>
                        </a>
                    </div>
                    <br/>
                    <div class="row table-responsive">

                        <table class="table table-bordered table-hover" id="dataLembaga" style="font-size: 14px;">
                            <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Lembaga</th>
                                <th>URL</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">

                            <?php
                            $i=1;
                            foreach ($lembaga as $lembaga) {
                                ?>

                                <tr>
                                    <td style="vertical-align: middle"><?= $i++; ?></td>
                                    <td style="vertical-align: middle">
                                        <img alt="image"
                                             src="<?php echo base_url('assets/img/'.$lembaga->logo);?>"
                                             style="width: 10%; height: 15%;" />
                                        <?= $lembaga->nama;?>
                                    </td>
                                    <td style="vertical-align: middle">
                                        <?= $lembaga->surl;?>
                                    </td>
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
