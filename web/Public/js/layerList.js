//图层控制楼层列表
$(function() {
    $(".layer-list").niceScroll({
        styler: "fb",
        cursorcolor: "",
        cursorwidth: '3',
        cursorborderradius: '0px',
        background: '',
        spacebarenabled: false,
        cursorborder: '0'
    });

    /*重置浏览器大小*/
    $(window).resize(function() {
        resize();
    });

    //滚动条事件
    $('.layer-list').scroll(function() {
        var scrollTop = $(this).scrollTop();

        //当滚动条是最顶端
        if (scrollTop == 0) {
            $('#top').css({
                color: '#BBB',
                backgroundColor: '#E6E5E5'
            });
        } else {
            $('#top').css({
                color: "#888",
                backgroundColor: '#FFF'
            });
        }

        //当滚动条是最底端
        var btnHeight = $(".layer-list > label").outerHeight();
        var count = $(".layer-list > label").size();
        var hideBtnCount = count - showBtnCount;
        var scrollDown = hideBtnCount * btnHeight - hideBtnCount;

        if (scrollTop == scrollDown) {
            $('#down').css({
                color: '#BBB',
                backgroundColor: '#E6E5E5'
            });
        } else {
            $('#down').css({
                color: "#888",
                backgroundColor: '#FFF'
            });
        }
    });

    //图层控制控件上移
    $("#top").on('click', function() {
        var index = $(".layer-list>label[class*='active']").index();
        var btnHeight = $(".layer-list > label").outerHeight();
        var count = $(".layer-list > label").size();
        if (index != 0) {
            var nextIndex = index - 1;
            $(".layer-list>label[class*='active']").removeClass('active');
            $(".layer-list > label").eq(nextIndex).addClass('active');
            var groups = [];
            var groupID = $(".layer-list > label").eq(nextIndex).find(':radio').val();
            groups.push(parseInt(groupID));
            if (layerGroup.allLayer) {
                map.visibleGroupIDs = map.groupIDs;
                map.focusGroupID = groups[0];
            } else {
                map.visibleGroupIDs = groups;
            }

            if (count - showBtnCount > nextIndex) {
                var top = nextIndex * btnHeight;
                var scrollTop = $(".layer-list").scrollTop();
                if (top < scrollTop) {
                    $(".layer-list").scrollTop(top);
                }
            }
        }

        checkBtn();
    });

    //图层控制控件下滑
    $("#down").on('click', function() {
        var index = $(".layer-list>label[class*='active']").index();
        var btnHeight = $(".layer-list > label").outerHeight();
        var count = $(".layer-list > label").size();
        if (index + 1 != count) {
            var nextIndex = index + 1;
            $(".layer-list>label[class*='active']").removeClass('active');
            $(".layer-list > label").eq(nextIndex).addClass('active');
            var groups = [];
            var groupID = $(".layer-list > label").eq(nextIndex).find(':radio').val();
            groups.push(parseInt(groupID));
            if (layerGroup.allLayer) {
                map.visibleGroupIDs = map.groupIDs;
                map.focusGroupID = groups[0];
            } else {
                map.visibleGroupIDs = groups;
            }

            if (showBtnCount <= nextIndex) {
                var top = (nextIndex - showBtnCount + 1) * btnHeight;
                var scrollTop = $(".layer-list").scrollTop();
                if (top > scrollTop) {
                    $(".layer-list").scrollTop(top);
                }
            }
        }
        checkBtn();
    });
});
