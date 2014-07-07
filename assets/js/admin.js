$(document).ready(function() {
    (function(){
        var nav = $('input[name="_"]').val();
        $('.nav a').each(function(){
            if ($(this).attr('href') == nav) {
                $(this).addClass('onclick');
            } else {
                $(this).removeClass('onclick');
            }
        });
    })();

    /* Appraise Assign
    --------------------------*/
    $('#appraise-assign .li .btn').click(function(){
        if ($(this).attr('disabled')) {
            return false;
        }
        var data = {
            'pid': $(this).attr('data-pid'),
            'uid': $(this).attr('data-uid')
        }
        var self = $(this);
        $.post('/admin/appraise/assign/', data, function(resp) {
            if (resp.status == 200) {
                self.text('已经分配').css('background-color', '#DCDCDC').attr('disabled', true);
                alert('分配成功。')
            } else {
                alert('分配失败，请重试。')
            }
        });
        return false;
    });

    $('#appraise-start .li .btn').click(function(){
        if (!confirm('确定取消分配吗?')) {
            return false;
        }

        var data = {
            'pid': $(this).attr('data-pid'),
            'uid': $(this).attr('data-uid')
        }
        var self = $(this);
        $.post('/admin/appraise/start/', data, function(resp) {
            if (resp.status == 200) {
                alert('成功取消。')
                self.parent().parent().remove();
            } else {
                alert('取消失败，请重试。')
            }
        });
        return false;
    });
    
});
