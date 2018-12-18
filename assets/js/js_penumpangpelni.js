$(document).ready(function(){

    var noteleponkontak = document.getElementById('noteleponkontak');
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

    noteleponkontak.addEventListener('input', checkInputTel);

    $('#tgllahirdewasa .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd/mm/yyyy"
    });

    $('#tgllahirbayi .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd/mm/yyyy"
    });

    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-red',
    });

    $("#formbookingpelni").validate({});

});