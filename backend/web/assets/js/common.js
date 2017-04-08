/**
 * Created by DungPX on 03/03/2017.
 */
function validateEmail(email) {
    if(email){
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
    return true;
}
//Validate Is number
function numhasInput(num) {
    return num && $.isNumeric(num)
}

function numHasValue(num) {
    return num && $.isNumeric(num) && num > 0
}
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    window.setTimeout(function() {
         $(".ialert").fadeTo(1500, 0).slideUp(500, function(){
            $(this).remove();
         });
    }, 5000);



});