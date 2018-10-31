$(document).ready(function(){

    $.get('Bus/getdataorigin', function(data){
        console.log(data);
        // $(".st_from").typeahead({
        //     source:data.name
        // });
        //
        // $(".st_to").typeahead({ source:data.name });

    },'json');

})