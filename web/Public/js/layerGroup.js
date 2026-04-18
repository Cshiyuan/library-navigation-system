/////////////////////////////////////////////////////////
/////////////封装右边图层控制控件代码----开始/////////////
/////////////////////////////////////////////////////////
var gui = {};
gui.LayerGroup = function() {
    this.allLayer = true;   //控制单层显示还是所有模型展示
    this.change_ = null;
    this.inited = false; //是否已经初始化
};
gui.LayerGroup.prototype = {
    init: function(gs, focusGroupId) {
        var this_ = this;
        $('.layer-list').html('');
        for (i = gs.length - 1; i >= 0; i--) {
            var g = gs[i];
            $('.layer-list').append(
                this.createLayerButton_(g.gid, g.gname.toUpperCase(),
                    focusGroupId == g.gid
                ));
        }
        $('.group-layer .btn-primary').on(
            'click',
            function(event) {
                if (this_.allLayer) {
                    $(this).html("<i class='icon iconfont'>&#xe66c;</i>")
                    this_.allLayer = false;
                } else {
                    $(this).html("<i class='icon iconfont'>&#xe61c;</i>")
                    this_.allLayer = true;
                }
                this_.triggerChange_();
            });
        this.inited = true;
    },
    onChange: function(change) {
        this.change_ = change;
    },
    createLayerButton_: function(gid, lbl, selected) {
        var this_ = this;
        var ele = $('<label>').addClass('btn btn-lg btn-default')
            .append(
                //$('<input type="check">').data('gid',gid).on('change',function() {
                $('<input type="radio" name="gid">').val(gid)
                    .on('change', function() {
                        //console.log('checked', $(this).is(':checked'));
                        this_.triggerChange_();
                    })).append($('<span>').text(lbl));
        if (selected) {
            ele.addClass('active');
            ele.children('input').prop('checked', true);
        }
        return ele;
    },
    triggerChange_: function() {
        if (this.change_ !== null) {
            var groups = [];
            var ele = $('.layer-list input[type="radio"]:checked');

            if (ele.length == 1) {
                groups.push(parseInt(ele.val()));
            }
            this.change_(groups);
            checkBtn();
        }
    }
};

gui.showModelInfo = function(d) {
    console.log(d);
    $('#dlgModelInfo').modal('show');
    $('#dlgModelInfo .modal-title').text('模型名称：'+d.name);
    $('#dlgModelInfo #m-fid').text(d.fid);
    $('#dlgModelInfo #m-gid').text(d.gid);
};

gui.showLabelInfo = function(d) {
    console.log(d);
    $('#dlgLabellInfo').modal('show');
    $('#dlgLabellInfo .modal-title').text('label名称：' +d.name);
    $('#dlgLabellInfo #l-fid').text(d.fid);
    $('#dlgLabellInfo #l-gid').text(d.gid);
    $('#dlgLabellInfo #l-x').text(d.x);
    $('#dlgLabellInfo #l-y').text(d.y);
};

gui.showPOIInfo = function(d) {
    console.log(d);
    $('#dlgPOIInfo').modal('show');
    $('#dlgPOIInfo .modal-title').text('poi名称：' + d.name);
    $('#dlgPOIInfo #p-fid').text(d.fid);
    $('#dlgPOIInfo #p-gid').text(d.gid);
    $('#dlgPOIInfo #p-x').text(d.x);
    $('#dlgPOIInfo #p-y').text(d.y);
};

/////////////////////////////////////////////////////////
/////////////封装右边图层控制控件代码----结束////////////
/////////////////////////////////////////////////////////

var layerGroup = new gui.LayerGroup();  //实例化图层控制控件
//图层控制控件的按钮点击事件，单层和多层模式设置
layerGroup.onChange(function(sg) {
    if (layerGroup.allLayer) {
        map.visibleGroupIDs = map.groupIDs;
        map.focusGroupID = sg[0];
    } else {
        map.visibleGroupIDs = sg;
    }
});

var showBtnCount = 3;

//检测按钮式是否可以使用
function checkBtn() {
    var index = $(".layer-list>label[class*='active']").index();
    var count = $(".layer-list > label").size();
    if (index == count - 1) {
        $("#down").addClass("disabled");
    } else {
        $("#down").removeClass("disabled");
    }

    if (index == 0) {
        $("#top").addClass("disabled");
    } else {
        $("#top").removeClass("disabled");
    }
}

function clearBtnClass() {
    $('#btnHand').removeClass('active');
    $('#btnInfo').removeClass('active');
    $('#btnNavigation').removeClass('active');
}

//重置显示区域大小
function resize() {
    var btnHeight = $(".layer-list > label").outerHeight();
    var layerHeight = btnHeight * showBtnCount;
    $(".layer-list").height(layerHeight - showBtnCount + 1); //设置滚动条高度

    if(!map) return;
    var scrollTop = $(".layer-list").scrollTop();
    var top = btnHeight * (showBtnCount-map.focusGroupID +1);
    if(top > scrollTop)
        $(".layer-list").scrollTop(top);
}
