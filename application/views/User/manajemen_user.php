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
                <strong>Manajemen User</strong>
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

            <h2>
                <i class="fa fa-users" style="font-size:1.5em;margin-right:8px;color: <?php echo $warna_lembaga ?>;"></i>
                <span style="color: <?php echo $warna_lembaga ?>">Manajemen User</span>
            </h2>
            <div class="ibox float-e-margins" >

                <div class="ibox-content">

                    <input type="hidden" class="form-control" id="txbwarnalembaga" value="<?php echo $warna_lembaga?>">

                    <?php
                    $user_data = $this->session->userdata;
                    if($user_data['user_level'] == 1) {
                        ?>

                        <div class="alert alert-warning">
                            Anda tidak diizinkan untuk mengakses halaman ini. !! <a class="alert-link"
                                                                                    href="<?php echo base_url('dashboard') ?>">Kembali
                                Ke Dashboard</a>.
                        </div>

                        <?php
                    }else{
                    ?>

                    <div class="row">
                        <button type="button" class="btn btn-danger open_modal_tambah_user col-lg-2">
                            <i class="fa fa-plus" style="font-size:1.5em;margin-right:8px;color: white;"></i>
                            Tambah User
                        </button>

                        <input type="hidden" id="txbhapususerberhasil" value="<?php echo $this->session->flashdata('hapususerberhasil') ?>">
                        <input type="hidden" id="txbtambahuserberhasil" value="<?php echo $this->session->flashdata('saveuserberhasil') ?>">
                        <input type="hidden" id="txbubahuserberhasil" value="<?php echo $this->session->flashdata('updateuserberhasil') ?>">

                        <div class="col-lg-10">

                            <?php if($this->session->flashdata('saveuserberhasil')){ ?>
                                <div class="alert alert-success alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    Anda telah berhasil menambahkan user baru dengan ID <a href="#"><?php echo $this->session->flashdata('saveuserberhasil') ?></a>
                                </div>
                            <?php } ?>

                            <?php if($this->session->flashdata('updateuserberhasil')){ ?>
                                <div class="alert alert-success alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    Anda telah berhasil mengubah data user dengan ID <a href="#"><?php echo $this->session->flashdata('updateuserberhasil') ?></a>
                                </div>
                            <?php } ?>

                            <?php if($this->session->flashdata('hapususerberhasil')){ ?>
                                <div class="alert alert-success alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    Anda telah berhasil menghapus user dengan ID <a href="#"><?php echo $this->session->flashdata('hapususerberhasil') ?></a>
                                </div>
                            <?php } ?>

                            <?php if($this->session->flashdata('usergagal')){ ?>
                                <div class="alert alert-warning alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    Ada kesalahan pada database, Silahkan anda coba lagi
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                    <br/>
                    <div class="row table-responsive">

                        <table class="table table-bordered table-hover dataUser" id="dataUser" style="font-size: 14px;">
                            <thead class="text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>Level</th>
                                    <th>Klasifikasi Agen</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>

                    </div>

                </div>

                <?php
                }
                ?>


            </div>

            <div class="modal inmodal" id="modalTambahUser" tabindex="-1" role="dialog"  aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content animated fadeIn">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <i class="fa fa-user modal-icon"></i>
                            <h4 class="modal-title">Tambah User</h4>
                            <small>Anda akan melakukan tambah data user ?.</small>
                        </div>
                        <div class="modal-body">

                            <div id="formTambahUser" class="formTambahUser">
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="modal inmodal" id="modalUbahUser" tabindex="-1" role="dialog"  aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content animated fadeIn">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <i class="fa fa-user modal-icon"></i>
                            <h4 class="modal-title">Ubah Data User</h4>
                            <small>Anda akan melakukan ubah data user ?.</small>
                        </div>
                        <div class="modal-body">

                            <div id="formUbahUser" class="formUbahUser">
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
