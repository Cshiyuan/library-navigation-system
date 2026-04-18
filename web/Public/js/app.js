(function ($) {
    'use strict';

    $(function () {
        var $fullText = $('.admin-fullText');
        $('#admin-fullscreen').on('click', function () {
            $.AMUI.fullscreen.toggle();
        });

        $(document).on($.AMUI.fullscreen.raw.fullscreenchange, function () {
            $fullText.text($.AMUI.fullscreen.isFullscreen ? '退出全屏' : '开启全屏');
        });
    });


})(jQuery);

function edit_ajax(id) {
    var get_url = $("#get_url").attr("title");
    var $modal = $('#my-modal-edit-book');
    var $modal_loading = $('#my-modal-loading');
    // alert(id);
    $.ajax({
        url: get_url + id,  //设置ajax的url请求路径,
        type: "post",
        dataType: "json",
        beforeSend: function () {   // pre-submit callback
            //$('#search_result').html("");  //清除上次搜索结果
            $modal_loading.modal();  //打开loading 窗口

        },
        success: function (data) {
            $modal_loading.modal('close');  //关闭loading窗口
            //var i = 0;
            if (data.status == 1) {  //返回成功
                document.getElementById("edit_book_name").value = data.book_name;
				document.getElementById("edit_category").value = data.category;
                document.getElementById("edit_author").value = data.author;
                document.getElementById("edit_pub_house").value = data.pub_house;
                document.getElementById("edit_slf_name").value = data.slf_name;
                document.getElementById("edit_is_onslf").value = data.is_onslf;
                document.getElementById("edit_form").action = "save/id/" + id;
                $modal.modal();
            } else {
                alert('返回失败');
            }
        },
        cache: false,
        timeout: 10000,
        error: function () {
            alert("超时");
        }
    });	
}


function edit_user(id) {
    var get_url = $("#get_url").attr("title");
    var $modal = $('#my-modal-edit-user');
    var $modal_loading = $('#my-modal-loading');
    //alert(id);
    $.ajax({
        url: get_url + id,  //设置ajax的url请求路径,
        type: "post",
        dataType: "json",
        beforeSend: function () {   // pre-submit callback
            //$('#search_result').html("");  //清除上次搜索结果
            $modal_loading.modal();  //打开loading 窗口

        },
        success: function (data) {
            $modal_loading.modal('close');  //关闭loading窗口
            //var i = 0;
            if (data.status == 1) {  //返回成功
                document.getElementById("edit_admin_name").value = data.admin_name;
                document.getElementById("edit_email").value = data.email;
                document.getElementById("edit_telephone").value = data.telephone;
				document.getElementById("edit_form").action = "save2/id/" + id;
                $modal.modal();
            } else {
                alert('返回失败');
            }
        },
        cache: false,
        timeout: 10000,
        error: function () {
            alert("已超时");
        }
    });	
}

