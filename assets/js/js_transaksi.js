$(document).ready(function(){

    var user_level = document.getElementById('txbuserlevel').value;
    var datestart = document.getElementById('datestart').value;
    var dateend = document.getElementById('dateend').value;

    var ajaxdt = '';

    if(datestart == '' && dateend == ''){
        ajaxdt = 'get_data_transaksi';
    }else{
        ajaxdt = "get_data_transaksi_where?datestart="+datestart+"&dateend="+dateend;
    }

    // $('.datatransaksi').DataTable({
    //     responsive: true,
    //     aaSorting: [ [2,'desc']],
    //     dom: '<"html5buttons"B>lTfgipt',
    //     buttons: [
    //         {extend: 'excel', title: 'LaporanTransaksi'}
    //     ]
    //
    // });

    if(user_level == 0){

        $('#datatransaksi').DataTable( {
            responsive: true,
            dom: 'lTfgipt',
            destroy: true,
            aaSorting: [ [2,'desc']],
            processing: true,
            serverSide: true,
            ajax: ajaxdt,
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
                    data: 5,
                    class: "text-center"
                },
                {
                    data: 6,
                    class: "text-center"
                },
                {
                    data: 7,
                    class: "text-center"
                },
                {
                    data: 9,
                    class: "text-center"
                },
                {
                    data: 8,
                    class: "text-center"
                }
            ],
        } );

    }else{

        var t = $('#datatransaksi').DataTable( {
                    responsive: true,
                    dom: 'lTfgipt',
                    destroy: true,
                    aaSorting: [ [2,'desc']],
                    processing: true,
                    serverSide: true,
                    ajax: ajaxdt,
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
                        {
                            data: 8,
                            class: "text-center"
                        },
                        {
                            data: 7,
                            class: "text-center"
                        },
                    ],
                } );


    }

    $('#datefilter .input-daterange').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd/mm/yyyy",
    });

});

function caridata(){
    var start = document.getElementById('start').value;
    var end = document.getElementById('end').value;

    var datestart = start.split("/");
    var newdatestart = datestart[2]+'-'+datestart[1]+'-'+datestart[0]+' 00:00:00';

    var dateend = end.split("/");
    var newdateend = dateend[2]+'-'+dateend[1]+'-'+dateend[0]+' 23:59:59';

    alert(newdatestart+' - '+newdateend);

    var table = $('#datatransaksi').DataTable();
    table.destroy();

    $('#datatransaksi').DataTable( {
        responsive: true,
        dom: '<"html5buttons"B>lTfgipt',
        destroy: true,
        aaSorting: [ [1,'desc']],
        processing: true,
        serverSide: true,
        ajax: "get_data_transaksi_where?start="+newdatestart+"&end="+newdateend,
        buttons: [
            {extend: 'excel', title: 'LaporanTransaksi'}
        ],
        columns: [
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
            {
                data: 8,
                class: "text-center"
            },
            {
                data: 7,
                class: "text-center"
            },
        ],
    } );


}

function open_modal_lihat_detail(idtrx) {
    var idtrx= idtrx.getAttribute("data-id");

    $("#modalLihatDetail").modal('show',{backdrop: 'true'});

    $("#txtidtrx").html(idtrx);

    $.get('lihatdetail', {idtrx: idtrx}, function(data){

        var obj = JSON.parse(data);
        var namaproduk = obj[0]['namaproduk'];
        var nopelanggan = obj[0]['nopelanggan'];
        var namapelanggan = obj[0]['namapelanggan'];
        var nominal = obj[0]['nominal'];

        $("#txtnmproduk").html(namaproduk);
        $("#txtnmpelanggan").html(namapelanggan);
        $("#txtnopelanggan").html(nopelanggan);
        $("#txtnominal").html(toNom(nominal));

    });

}