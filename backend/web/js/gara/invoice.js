/**
 * Created by DungPhanXuan on 23/03/2017.
 */

function resetTicketProduct() {
    $("tr.tTicket").each(function () {
        $(this).find(".addPType").val(0);
        $(this).hide();
    });
}