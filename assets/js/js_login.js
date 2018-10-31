$(document).ready(function(){

    $('.i-checks-password').iCheck({
        checkboxClass: 'icheckbox_square-red',
    });

    $('.showpassword').on('ifChecked', function(event){
        var p = document.getElementById('password');
        p.setAttribute('type', 'text');
    });

    $('.showpassword').on('ifUnchecked', function(event){
        var p = document.getElementById('password');
        p.setAttribute('type', 'password')
    });

});


