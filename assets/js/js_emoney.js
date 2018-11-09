$(document).ready(function(){

})


function pilihoperatoremoney() {

    var op = document.getElementById("pilihanoperatoremoney");
    var opr_id = op.options[op.selectedIndex].value;
    var opr_name = op.options[op.selectedIndex].text;

    var nom = document.getElementById("pilihanprodukemoney");
    $('#pilihanprodukemoney').find("option:not(:first)").remove();

    $.get('EMoney/getdataemoneyproduk', function(data){
        datax= JSON.parse(data);

        jumlahdataproduk = datax['produk'].length;

        for (i = 0; i < jumlahdataproduk; i++) {
            data_opr_id = datax['produk'][i]['opr_id'];

            var option = document.createElement("option");

            if(data_opr_id == opr_id){
                var value = opr_name+','+datax['produk'][i]['kode']+','+datax['produk'][i]['nama']+','+datax['produk'][i]['harga'];
                option.value = value;
                option.text = datax['produk'][i]['nama'];
                nom.add(option);
            }
        }

    });

}
