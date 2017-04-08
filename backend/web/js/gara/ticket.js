/**
 * Created by DungPX on 01/03/2017.
 */

function setTicketCar(val) {
    $("#t_car_id").val(val);
}

function setTicketCarOwner(val) {
    $("#t_car_owner_id").val(val);
}

function getTicketCarOwner(val) {
    return $("#t_car_owner_id").val();
}

function setTicketCustomer(val) {
    $("#t_car_customer_id").val(val);
}
function getTicketCustomer(val) {
    return $("#t_car_customer_id").val();
}
function setCusSelect(val) {
    $("#cselectID").val(val);
}
function setContacterSelect(val) {
    $("#ctselectID").val(val);
}
function emptyCarOwner() {
    $("#ocarID").val('');
    $("#ocarMobile").val('');
    $("#ocarAddress").val('');
    $("#ocarEmail").val('');
    $("#ocarTax").val('');
}

