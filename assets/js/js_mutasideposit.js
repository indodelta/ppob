$(document).ready(function(){

    var user_level = document.getElementById('txbuserlevel').value;
    if(user_level == 0){

        $('#datamutasideposit').DataTable( {
            responsive: true,
            destroy: true,
            aaSorting: [ [2,'desc']],
            processing: true,
            serverSide: true,
            ajax: 'get_data_mutasi_deposit',
            columns: [
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    class: "text-center"
                },
                {
                    data: 0,
                    class: "text-center"
                },
                {
                    data: 1,
                    class: "text-center"
                },
                {
                    data: 2,
                    class: "text-center"
                },
                {
                    data: 3,
                    class: "text-center"
                },
                {
                    data: 4,
                    class: "text-center"
                },
                {
                    data: 6,
                    class: "text-center"
                },
                {
                    data: 5,
                    class: "text-center"
                },
                {
                    data: 7,
                    class: "text-center"
                },
            ],
        } );

    }else{

        $('#datamutasideposit').DataTable( {
            responsive: true,
            destroy: true,
            aaSorting: [ [2,'desc']],
            processing: true,
            serverSide: true,
            ajax: 'get_data_mutasi_deposit',
            columns: [
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    class: "text-center"
                },
                {
                    data: 0,
                    class: "text-center"
                },
                {
                    data: 1,
                    class: "text-center"
                },
                {
                    data: 2,
                    class: "text-center",
                },
                {
                    data: 3,
                    class: "text-center"
                },
                {
                    data: 4,
                    class: "text-center"
                },
                {
                    data: 5,
                    class: "text-center"
                },
                {
                    data: 6,
                    class: "text-center"
                },
            ],
        } );


    }

    // $('.datamutasideposit').DataTable({
    //     responsive: true,
    //     aaSorting: [ [1,'desc']],
    //
    // });

});

function lihatSaldouser(button) {

    var iduser= $(button).attr('data-iduser');

    $("#modalSaldoUser").modal('show',{backdrop: 'true'});

    $("#txtiduser").html(iduser);

    $.get('../Deposit/lihatsaldo', {id: iduser}, function(data){

        var obj = JSON.parse(data);
        var nama = obj[0]['nama'];
        var alamat = obj[0]['alamat'];
        var email = obj[0]['email'];
        var telepon = obj[0]['telepon'];
        var saldo = obj[0]['saldo'];

        $("#txtnamauser").html(nama);
        $("#txtnotelpuser").html(telepon);
        $("#txtemailuser").html(email);
        $("#txtalamatuser").html(alamat);
        $("#txtsaldouser").html(toRp(saldo));

    });
}