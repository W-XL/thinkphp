// $(document).ready(function(){
//     $("#sidebar-menu li.list-unstyled a ").click(function(){
//         main_data_load($(this).attr("data-url"));return false;});
// });
function frameSet(){
    if($.browser.msie){
        w = document.body.clientWidth-206;
    }else{
        w = document.body.clientWidth-206;
    }
    h = document.documentElement.clientHeight;
    $("#content-main").css("height",(h-65)+"px");
}
function main_data_load(url) {
    //$("#main_data").load(url,function(){ $("#main_data").fadeIn(100);});
    $.ajax( {
        url: url,// 跳转到 action
        data:{},
        type:'get',
        cache:false,
        dataType:'html',
        beforeSend:function () {
            $.Notification.autoHideNotify('info','top left', "正在加载", "请稍等哟......");
        },
        success:function(data) {
            $('.J_iframe[data-id="' + url.split('?page')[0] + '"]').remove();
            $('.J_mainContent').find('.J_iframe').hide().parents('.J_mainContent');
            $("#content-main").append(data);
            $("#main_data_url").val(url);
        },
        error: function(req, status, error) {
            $.Notification.notify('error','top left', "发生错误,HTTP代码:"+req.status, req.statusText);
        }
    });
    return false;
}

function post_main_data_load(url, formdata) {
    //$("#main_data").load(url,function(){ $("#main_data").fadeIn(100);});
    $.ajax({
        url: url,// 跳转到 action
        data: formdata,
        type: 'post',
        cache: false,
        dataType: 'html',

        beforeSend: function () {
            $.Notification.autoHideNotify('info', 'top left', "正在加载", "请稍等哟......");
        },
        success: function (data) {
            $("#content-main").html(data);
            $("#main_data_url").val(url);
        },
        error: function (req, status, error) {
            $.Notification.notify('error', 'top left', "发生错误,HTTP代码:" + req.status, req.statusText);
        }
    });
    return false;
}

$(function() {
    $(document).on("submit","form", function() {
        if($(this).attr("data-toggle")=='ajaxform'){
            $(this).ajaxSubmit({
                beforeSubmit:function (formData, jqForm, options) {
                    $.Notification.notify('info','top left', "稍等片刻", "您的操作紧张进行中.....");
                },
                success: function (responseText,statusText) {
                    var result = jQuery.parseJSON(responseText);
                    if(result.statusCode==200){
                        $.Notification.autoHideNotify('success','top center','成功', result.message);
                        //关闭模态窗口
                        if(target = $(arguments[3]).attr("data-animation")){
                            $('#'+target).modal('hide');
                        }
                        url = $("#main_data_url").val();
                        // window.location.reload();
                        // $("#modal").find('.modal-content').html("内容加载中......")
                        //     .load(url,function(){})
                        main_data_load(url);
                    }else{
                        $.Notification.autoHideNotify('error','top center', '失败', result.message);
                    }
                },
                error:function (result) {
                    $.Notification.notify('error','top center', "发生错误,HTTP代码:"+result.status, result.responseText);
                }
            });
            return false;
        }
    });

    $(document).on("click","#page li>a", function() {
        main_data_load($(this).attr("href"));
        return false;
    });

    $(document).on("click","button[data-action='modal'],a[data-action='modal']", function() {
        if (href = $(this).attr("href")) {
            $("#modal").find('.modal-content').html("内容加载中......")
                .load(href,function(){});
        }
        $("#modal").modal("show");
        return false;
    });
});