/**
 * Created by DungPhanXuan on 24/03/2017.
 */

function resetCostingCommand() {
    $("tr.cCommand").each(function () {
        $(this).find(".addPType").val(0);
        $(this).hide();
    });
}