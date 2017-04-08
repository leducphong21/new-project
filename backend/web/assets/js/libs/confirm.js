/**
 * Created by developer on 5/16/2016.
 */
yii.allowAction = function ($e) {
    var message = $e.data('confirm');
    return message === undefined || yii.confirm(message, $e);
};
yii.confirm = function (message, ok, cancel) {
    bootbox.confirm({
        title: false,
        message: 'Xác nhận xóa?',
        buttons: {
            'cancel': {
                label: 'Hủy',
                className: 'btn-default'
            },
        },
        callback: function (confirmed) {
            if (confirmed) {
                !ok || ok();
            } else {
                !cancel || cancel();
            }
        }
    });
    return false;
}