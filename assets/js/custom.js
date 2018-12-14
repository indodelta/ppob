$(document).ready(function(){
    if($( window ).width() < 910){
        document.getElementById("divmenuresponsiveatas").style.display= 'none';
        document.getElementById("divmenuresponsivebawah").style.display= 'block';
    }else{
        document.getElementById("divmenuresponsiveatas").style.display= 'block';
        document.getElementById("divmenuresponsivebawah").style.display= 'none';
    }
})

$( window ).resize(function() {
    if($( window ).width() < 910){
        document.getElementById("divmenuresponsiveatas").style.display= 'none';
        document.getElementById("divmenuresponsivebawah").style.display= 'block';
    }else{
        document.getElementById("divmenuresponsiveatas").style.display= 'block';
        document.getElementById("divmenuresponsivebawah").style.display= 'none';
    }
});

function toRp(angka){
    var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
    var rev2    = '';
    for(var i = 0; i < rev.length; i++){
        rev2  += rev[i];
        if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
            rev2 += '.';
        }
    }
    return 'Rp ' + rev2.split('').reverse().join('');
}

function toNom(angka){
    var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
    var rev2    = '';
    for(var i = 0; i < rev.length; i++){
        rev2  += rev[i];
        if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
            rev2 += '.';
        }
    }
    return rev2.split('').reverse().join('');
}

function dateindo(date){
    var bulan = ['Januari', 'Februari', 'Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

    var splitdate = date.split('-');
    var _bulan = splitdate[1];
    var _tanggal = splitdate[2];

    bulan = bulan[_bulan - 1];

    return _tanggal+' '+bulan;

}

function dateindowithyear(date){
    var bulan = ['Januari', 'Februari', 'Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

    var splitdate = date.split('-');
    var _tahun = splitdate[0];
    var _bulan = splitdate[1];
    var _tanggal = splitdate[2];

    bulan = bulan[_bulan - 1];

    return _tanggal+' '+bulan+' '+_tahun;

}

function dateindowithslash(date){
    var splitdate = date.split('-');
    var _tahun = splitdate[0];
    var _bulan = splitdate[1];
    var _tanggal = splitdate[2];

    return _tanggal+'/'+_bulan+'/'+_tahun;

}

function getDayName(dateStr, locale)
{
    var date = new Date(dateStr);
    return date.toLocaleDateString(locale, { weekday: 'long' });
}