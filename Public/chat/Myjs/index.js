/**
 * Created by PCAUTOSERVE on 2016/4/8 0008.
 */


var i = 1;

$(function () {
    var totalpage = 5; //总页数，防止超过总页数继续滚动
    var winH = $(window).height(); //页面可视区域高度

    $(window).scroll(function () {
        console.log(i);
        if (i < totalpage) { // 当滚动的页数小于总页数的时候，继续加载
            var pageH = $(document.body).height();
            var scrollT = $(window).scrollTop(); //滚动条top
            var rate = (pageH - winH - scrollT) / winH;
            if (rate < 0.01) {
                getJson(i)
            }
        } else { //否则显示无数据
            showEmpty();
        }
    });
    getJson(1); //加载第一页
});

function getJson(page) {
    $(".nodata").show().html("<img src='http://www.sucaihuo.com/Public/images/loading.gif'/>");
    $.getJSON('ScrollAjax/scrollAjax', {page: page}, function (json) {
        if (json) {
            var str = "";
            $.each(json,
                function (index, array) {
                    str = "<div class='per'>";
                    str = str + "<div class='title'>" + array['id'] + "、" + array['thimenu'] + "</div></div>";
                    $("#lists").append(str);
                });
            $(".nodata").hide()
        } else {
            showEmpty(); //数据为空的时候
        }
    });
    i++;
}

function showEmpty() {
    $(".nodata").show().html("别滚动了，已经到底了。。。");
}
