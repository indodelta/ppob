$(document).ready(function(){

    Ladda.bind( '.ladda-button');

    $("#formtopup").validate({});

});

function formatangka() {
    var a = formtopup.txbnominaltopup.value.replace(/[^\d]/g, "");

    var a = +a;

    formtopup.txbnominaltopup.value = formatNum(a);
    formtopup.txbnominal.value = a;
}

function formatNum(rawNum) {
    rawNum = "" + rawNum; // converts the given number back to a string
    var retNum = "";
    var j = 0;
    for (var i = rawNum.length; i > 0; i--) {
        j++;
        if (((j % 3) == 1) && (j != 1))
            retNum = rawNum.substr(i - 1, 1) + "." + retNum;
        else
            retNum = rawNum.substr(i - 1, 1) + retNum;
    }
    return retNum;
}