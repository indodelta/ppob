$(document).ready(function(){

    $('#dataUser').DataTable( {
        "destroy": true,
        "aaSorting": [ [0,'desc']],
        "processing": true,
        "serverSide": true,
        "ajax": "user/get_data_user",
        "columns": [
            {
                "data": 0,
                "class": "text-center",
            },
            {
                "data": 1,
                "class": "text-center",
            },
            {
                "data": 2,
                "class": "text-center",
            },
            {
                "data": 3,
                "class": "text-center",
            },
            {
                "data": 4,
                "class": "text-center",
            },
            {
                "data": 5,
                "class": "text-center",
            },
            {
                "data": 6,
                "class": "text-center",
            },
        ],
    } );

    var txbhapususerberhasil = document.getElementById('txbhapususerberhasil').value;
    var txbtambahuserberhasil = document.getElementById('txbtambahuserberhasil').value;
    var txbubahuserberhasil = document.getElementById('txbubahuserberhasil').value;

    if(txbhapususerberhasil != ''){
        swal({
            title: "Berhasil!",
            text: "Anda telah menghapus user!",
            type: "success"
        });

        document.getElementById('txbhapususerberhasil').value = '';
    }

    if(txbtambahuserberhasil != ''){
        swal({
            title: "Berhasil!",
            text: "Anda telah menambahkan user!",
            type: "success"
        });

        document.getElementById('txbtambahuserberhasil').value = '';
    }

    if(txbubahuserberhasil != ''){
        swal({
            title: "Berhasil!",
            text: "Anda telah menambahkan user!",
            type: "success"
        });

        document.getElementById('txbubahuserberhasil').value = '';
    }

    var warnalembaga = document.getElementById("txbwarnalembaga").value;

    $(".open_modal_tambah_user").click(function(e) {

        $.ajax({
            url: "user/open_form_tambahuser",
            type: "GET",
            data : {warnalembaga: warnalembaga,},
            success: function (ajaxData){
                $("#modalTambahUser").modal('show',{backdrop: 'true'});
                $("#formTambahUser").html(ajaxData);
            }
        });

    });

    $(".open_modal_ubah_user").click(function(e) {

        var iduser = $(this).attr('data-id');
        var namauser = $(this).attr('data-nama');
        var emailuser = $(this).attr('data-email');
        var teleponuser = $(this).attr('data-telepon');
        var alamatuser = $(this).attr('data-alamat');
        var leveluser = $(this).attr('data-level');
        var klasifikasi = $(this).attr('data-klasifikasi');
        var statususer = $(this).attr('data-status');

        $.ajax({
            url: "user/open_form_ubahuser",
            type: "GET",
            data : {warnalembaga: warnalembaga,
                    iduser: iduser,
                    namauser: namauser,
                    emailuser: emailuser,
                    teleponuser: teleponuser,
                    alamatuser: alamatuser,
                    statususer: statususer,},
            success: function (ajaxData){
                $("#modalUbahUser").modal('show',{backdrop: 'true'});
                $("#formUbahUser").html(ajaxData);
            }
        });

    });

    //input no telepon
    var txbnotelp = document.getElementById('txbnotelepon');
    var goodKey = '0123456789';
    var checkInputTel = function(e) {
        var key = (typeof e.which == "number") ? e.which : e.keyCode;
        var start = this.selectionStart,
            end = this.selectionEnd;
        var filtered = this.value.split('').filter(filterInput);
        this.value = filtered.join("");
        /* Prevents moving the pointer for a bad character */
        var move = (filterInput(String.fromCharCode(key)) || (key == 0 || key == 8)) ? 0 : 1;
        this.setSelectionRange(start - move, end - move);
    }
    var filterInput = function(val) {
        return (goodKey.indexOf(val) > -1);
    }
    txbnotelp.addEventListener('input', checkInputTel);

});

function hapus_user(button){
    var iduser = $(button).attr('data-id');

    swal({
        title: "Anda Yakin?",
        text: "Anda akan menghapus data user dengan id "+iduser+" !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya!",
        cancelButtonText: "Tidak!",
        closeOnConfirm: false,
        closeOnCancel: false },
        function (isConfirm) {
            if (isConfirm) {
                document.getElementById("formhapususer").action = "user/hapus_user/"+iduser;
                document.getElementById("formhapususer").submit();
            } else {
                swal("Gagal", "Anda tidak menghapus user dengan id "+iduser+" :)", "error");
            }
        }
    );
};

function ubah_user(button) {

        var warnalembaga = document.getElementById('txbwarnalembaga').value;

        var iduser = $(button).attr('data-id');

        $.ajax({
            url: "user/open_form_ubahuser",
            type: "GET",
            data : {warnalembaga: warnalembaga,
                    iduser: iduser,},
            success: function (ajaxData){
                $("#modalUbahUser").modal('show',{backdrop: 'true'});
                $("#formUbahUser").html(ajaxData);
            }
        });
}

function saveUser() {

    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var warnalembaga = document.getElementById('txbwarnalembaga').value;
    var fullname = document.getElementById('txbfullname').value;
    var username = document.getElementById('txbusername').value;
    var password = document.getElementById('txbpassword').value;
    var email = document.getElementById('txbemail').value;
    var notelepon = document.getElementById('txbnotelepon').value;
    var alamat = document.getElementById('txbalamat').value;

    if(email.match(mailformat))
    {

        if(fullname == ''){
            swal({
                title: "WARNING",
                text: "Bidang nama lengkap belum diisi!",
                type: "warning",
                confirmButtonColor: warnalembaga
            });
        }else if(email == ''){
            swal({
                title: "WARNING",
                text: "Bidang email belum diisi!",
                type: "warning",
                confirmButtonColor: warnalembaga
            });
        }else if(notelepon == ''){
            swal({
                title: "WARNING",
                text: "Bidang telepon belum diisi!",
                type: "warning",
                confirmButtonColor: warnalembaga
            });
        }else if(alamat == ''){
            swal({
                title: "WARNING",
                text: "Bidang alamat belum diisi!",
                type: "warning",
                confirmButtonColor: warnalembaga
            });
        }else if(username == ''){
            swal({
                title: "WARNING",
                text: "Bidang username belum diisi!",
                type: "warning",
                confirmButtonColor: warnalembaga
            });
        }else if(password == ''){
            swal({
                title: "WARNING",
                text: "Bidang password belum diisi!",
                type: "warning",
                confirmButtonColor: warnalembaga
            });
        }else{

            $.get('user/cek_user', {username: username, password: password,}, function(data){

                if(data == 1) {
                    swal({
                        title: "WARNING",
                        text: "Username dan password telah digunakan oleh user lain!",
                        type: "warning",
                        confirmButtonColor: warnalembaga
                    });
                }else{
                    swal({
                        title: "Anda Yakin?",
                        text: "Anda akan menambahkan user baru!",
                        showCancelButton: true,
                        confirmButtonColor: warnalembaga,
                        confirmButtonText: "Save",
                        closeOnConfirm: false
                    }, function () {
                        document.getElementById("formsaveuser").action = "user/save_user";
                        document.getElementById("formsaveuser").submit();
                    });

                }

            });

        }

    }
    else
    {
        swal({
            title: "WARNING",
            text: "Maaf format alamat email anda salah!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });

    }

};

function updateUser() {
    var iduser = document.getElementById('txbiduser').value;
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var warnalembaga = document.getElementById('txbwarnalembaga').value;
    var fullname = document.getElementById('txbfullname').value;
    var email = document.getElementById('txbemail').value;
    var notelepon = document.getElementById('txbnotelepon').value;
    var alamat = document.getElementById('txbalamat').value;

    if(email.match(mailformat))
    {

        if(fullname == ''){
            swal({
                title: "WARNING",
                text: "Bidang nama lengkap belum diisi!",
                type: "warning",
                confirmButtonColor: warnalembaga
            });
        }else if(email == ''){
            swal({
                title: "WARNING",
                text: "Bidang email belum diisi!",
                type: "warning",
                confirmButtonColor: warnalembaga
            });
        }else if(notelepon == ''){
            swal({
                title: "WARNING",
                text: "Bidang telepon belum diisi!",
                type: "warning",
                confirmButtonColor: warnalembaga
            });
        }else if(alamat == ''){
            swal({
                title: "WARNING",
                text: "Bidang alamat belum diisi!",
                type: "warning",
                confirmButtonColor: warnalembaga
            });
        }else{

            swal({
                title: "Anda Yakin?",
                text: "Anda akan mengubah user dengan id "+iduser+" !",
                showCancelButton: true,
                confirmButtonColor: warnalembaga,
                confirmButtonText: "Save",
                closeOnConfirm: false
            }, function () {
                document.getElementById("formupdateuser").action = "user/update_user";
                document.getElementById("formupdateuser").submit();
            });

        }

    }
    else
    {
        swal({
            title: "WARNING",
            text: "Maaf format alamat email anda salah!",
            type: "warning",
            confirmButtonColor: warnalembaga
        });

    }

};