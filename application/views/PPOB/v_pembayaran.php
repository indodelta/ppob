<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Basic Form</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url('dashboard')?>">Home</a>
            </li>
            <li class="active">
                <strong>PPOB</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>


<!-- Content -->

<div class="wrapper wrapper-content animated fadeInRight article" style="margin-top: 10px;">
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">

            <h2>
                <i class="fa fa-file-text-o" style="font-size:1.5em;margin-right:8px;color: #ED5565;"></i>
                <span style="color: #ED5565">Sistem Transaksi PPOB Online</span>
            </h2>

            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-file" style="color: #ED5565;font-size:1.5em;"></i></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2"><i class="fa fa-tablet" style="color: #ED5565;font-size:1.5em;"></i></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3"><i class="fa fa-gamepad" style="color: #ED5565;font-size:1.5em;"></i></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-4"><i class="fa fa-money" style="color: #ED5565;font-size:1.5em;"></i></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-5"><i class="fa fa-book" style="color: #ED5565;font-size:1.5em;"></i></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-6"><i class="fa fa-file-text-o" style="color: #ED5565;font-size:1.5em;"></i></a></li>
                </ul>
                <div class="tab-content">

                    <!--bill payments-->
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <h3 style="color: #ED5565">BILL PAYMENTS</h3>
                            <hr>
                            <form class="form-horizontal">

                                <div class="form-group">
                                    <label class="col-lg-3 control-label" style="color: #ED5565;">Jenis Tagihan :</label>
                                    <div class="col-lg-9">
                                        <select class="form-control m-b" name="jenistagihan">
                                            <option>- Pilih Tagihan -</option>
                                            <option>PLN Bulanan - Tagihan Bulanan PLN</option>
                                            <option>PLN Token - Voucher/Token PLN</option>
                                            <option>BPJS Kesehatan - BPJS GRUP</option>
                                            <option>PGN - Perusahaan Gas Negara</option>
                                            <option>TELKOM - Telkom Indonesia</option>
                                            <option>SPEEDY / INDIHOME - Broadband Access</option>
                                            <option>TELKOMVISION - TV Langganan</option>
                                            <option>INDOVISION - TV Langganan</option>
                                            <option>OKEVISION - TV Langganan</option>
                                            <option>TOP TV - TV Langganan</option>
                                            <option>NEXMEDIA - TV Langganan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label" style="color: #ED5565;">Nomor Pelanggan :</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="nomorpelanggan" name="nomorpelanggan">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <button class="btn btn-danger" type="submit" style="float: right;">LANJUTKAN</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                    <!--pascabayar-->
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <h3 style="color: #ED5565">PASCA BAYAR</h3>
                            <hr>
                            <form class="form-horizontal">

                                <div class="form-group">
                                    <label class="col-lg-3 control-label" style="color: #ED5565;">Jenis Tagihan :</label>
                                    <div class="col-lg-9">
                                        <select class="form-control m-b" name="jenistagihan">
                                            <option>- Pilih Tagihan -</option>
                                            <option>Tagihan HALO - Telkomsel Pascabayar</option>
                                            <option>Tagihan MATRIX - Indosat Pascabayar</option>
                                            <option>Tagihan Xplor - XL Pascabayar</option>
                                            <option>Tagihan ESIA - Esia Pascabayar</option>
                                            <option>Tagihan SMARTFREN - Smartfren Pascabayar</option>
                                            <option>Tagihan THREE - Three Pascabayar</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label" style="color: #ED5565;">Nomor Pelanggan :</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="nomorpelanggan" name="nomorpelanggan" placeholder="08XXXXXXXX">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <button class="btn btn-danger" type="submit" style="float: right;">LANJUTKAN</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                    <!--vouchergame-->
                    <div id="tab-3" class="tab-pane">
                        <div class="panel-body">

                            <h3 style="color: #ED5565">VOUCHER GAME</h3>
                            <hr>
                            <form class="form-horizontal">

                                <div class="form-group">
                                    <label class="col-lg-3 control-label" style="color: #ED5565;">Jenis Tagihan :</label>
                                    <div class="col-lg-9">
                                        <select class="form-control m-b" name="jenistagihan">
                                            <option>- GAME ONLINE -</option>
                                            <option>ASIASOFT - Voucher ASIASOFT</option>
                                            <option>BSF VOUCHER - BSF Voucher</option>
                                            <option>CC VOUCHER - CC Voucher</option>
                                            <option>DIGICASH VOUCHER - Digicash Voucher</option>
                                            <option>Facebook Game Card - Facebook Game Card</option>
                                            <option>GEMSCOOL - Voucher Gemscool</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label" style="color: #ED5565;">Nominal :</label>
                                    <div class="col-lg-9">
                                        <select class="form-control m-b" name="jenistagihan">
                                            <option>- Pilihan Nominal -</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label" style="color: #ED5565;">Potong deposit senilai :</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="potongdeposit" name="potongdeposit" style="border: none">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label" style="color: #ED5565;">Nomor Tujuan :</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="nomortujuan" name="nomortujuan" placeholder="08XXXXX">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label" style="color: #ED5565;">Login ID :</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="loginid" name="loginid">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label" style="color: #ED5565;">Password :</label>
                                    <div class="col-lg-9">
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <button class="btn btn-danger" type="submit" style="float: right;">BAYAR VOUCHER</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

                    <!--multifinance-->
                    <div id="tab-4" class="tab-pane">
                        <div class="panel-body">

                            <h3 style="color: #ED5565">MULTI FINANCE</h3>
                            <hr>
                            <form class="form-horizontal">

                                <div class="form-group">
                                    <label class="col-lg-3 control-label" style="color: #ED5565;">Jenis Tagihan :</label>
                                    <div class="col-lg-9">
                                        <select class="form-control m-b" name="jenistagihan">
                                            <option>- Pilih Tagihan -</option>
                                            <option>FIF Finance - Multifinance FIF</option>
                                            <option>MAF Finance - Multifinance MAF</option>
                                            <option>MCF Finance - Multifinance MCF</option>
                                            <option>BAF Finance - Multifinance BAF</option>
                                            <option>WOM Finance - Multifinance WOM</option>
                                            <option>ADIRA Finance - Multifinance ADIRA</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label" style="color: #ED5565;">Nomor Pelanggan :</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="nomorpelanggan" name="nomorpelanggan" placeholder="111111111">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label" style="color: #ED5565;">Login ID :</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="loginid" name="loginid">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label" style="color: #ED5565;">Password :</label>
                                    <div class="col-lg-9">
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <button class="btn btn-danger" type="submit" style="float: right;">LANJUTKAN</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

                    <!--cektagihan-->
                    <div id="tab-5" class="tab-pane">
                        <div class="panel-body">

                            <h3 style="color: #ED5565">CEK TAGIHAN</h3>
                            <hr>
                            <form class="form-horizontal">

                                <div class="form-group">
                                    <label class="col-lg-3 control-label" style="color: #ED5565;">Jenis Tagihan :</label>
                                    <div class="col-lg-9">
                                        <select class="form-control m-b" name="jenistagihan">
                                            <option>- Pilih Tagihan -</option>
                                            <option>PLN Bulanan - Tagihan Bulanan PLN</option>
                                            <option>BPJS Kesehatan - BPJS GRUP</option>
                                            <option>PGN - Perusahaan Gas Negara</option>
                                            <option>TELKOM - Telkom Indonesia</option>
                                            <option>SPEEDY / INDIHOME - Broadband Access</option>
                                            <option>TELKOMVISION - TV Langganan</option>
                                            <option>INDOVISION - TV Langganan</option>
                                            <option>OKEVISION - TV Langganan</option>
                                            <option>TOP TV - TV Langganan</option>
                                            <option>NEXMEDIA - TV Langganan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label" style="color: #ED5565;">Nomor Pelanggan :</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="nomorpelanggan" name="nomorpelanggan">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <button class="btn btn-danger" type="submit" style="float: right;">CEK TAGIHAN</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

                    <!--cetakstruk-->
                    <div id="tab-6" class="tab-pane">
                        <div class="panel-body">

                            <h3 style="color: #ED5565">CETAK STRUK</h3>
                            <hr>
                            <form class="form-horizontal">

                                <div class="form-group">
                                    <label class="col-lg-3 control-label" style="color: #ED5565;">Nomor Invoice :</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="nomorinvoice" name="nomorinvoice">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label" style="color: #ED5565;">Nomor Pelanggan :</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="nomorpelanggan" name="nomorpelanggan">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <button class="btn btn-danger" type="submit" style="float: right;">PRINT STRUK</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>

            </div>

        </div>
        <div class="col-lg-3"></div>
    </div>
</div>

<!-- /content -->


</div>
