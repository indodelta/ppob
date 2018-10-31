$(document).ready(function(){
    $("#formangskredit").validate({});
})

function pilihproviderkredit(){

    var op = document.getElementById("pilihanproviderkredit");
    var opr_id = op.options[op.selectedIndex].value;

    var prod = document.getElementById("pilihanprodukkredit");
    $('#pilihanprodukkredit').find("option:not(:first)").remove();

    $.get('Kredit/getdatakreditproduk', function(data){
        datax= JSON.parse(data);

        jumlahdataproduk = datax['produk'].length;

        for (i = 0; i < jumlahdataproduk; i++) {
            data_opr_id = datax['produk'][i]['opr_id'];

            var option = document.createElement("option");

            if(data_opr_id == opr_id){
                var value = datax['produk'][i]['kode']+'-'+datax['produk'][i]['nama'];
                option.value = value;
                option.text = datax['produk'][i]['nama'];
                prod.add(option);
            }
        }

    });

}