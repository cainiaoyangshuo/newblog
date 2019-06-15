$(function(){
    var squareHeight=$(window).height()-$(".labelBox").height()-$(".tabBox").height()-15;
    $(".conBox").css("height", squareHeight + "px");
    var wishHeight = squareHeight - $(".navBox").height();
    $(".wishItem .listBox").css("height", wishHeight + "px");

    var from = getQueryString("form");
    if(from=="detail"){//从详情页返回，wish处于active
        $(".conItem").hide();
        $(".tabBox li").removeClass("active");
        $(".tabBox li.wish").addClass("active");
        $(".wishItem").show();
    } else if (from == "info") { //从资料页返回，me处于active
        $(".conItem").hide();
        $(".tabBox li").removeClass("active");
        $(".tabBox li.me").addClass("active");
        $(".meItem").show();
    }else{
        $(".conItem").hide();
        $(".tabBox li").removeClass("active");
        $(".tabBox li.square").addClass("active");
        $(".squareItem").show();
    }

    $(".tabBox li").click(function(){
        $(this).siblings().removeClass("active");
        $(this).addClass("active");
        var label=$(this).text();
        $(".labelBox .label").text(label);
        $(".conItem").hide();
        var index=$(this).attr("data-index");
        $(".conItem[data-index="+index+"]").show();
        if(index>0){
            $(".addBtn").hide();
        } else {
            $(".addBtn").show();
        }
        if(index==1){
            //获取wish列表数据
            getWish(1);
        }else if(index==3){//个人资料
            $(".conBox").css("height", "100%");
        }else if(index==0){//广场
            location.href="/";
        }
    })

    $(".squareItem .listUl li").each(function () {
        var height = $(this).find(".con h3").height();
        if (height>60){
            $(this).find(".seeMore").show();
            $(this).find(".con").css("height","0.6rem");
        }else{
            $(this).find(".con").css("height", height);
        }
    })

    // 点击查看全文
    $(".seeMore").click(function(){
        $(this).toggleClass("active");
        var height=$(this).parents("li").find(".con h3").height();
        if($(this).hasClass("active")){
            $(this).parents("li").find(".con").css("height", height);
            $(this).text("收起全文");
        }else{
            $(this).parents("li").find(".con").css("height", "0.6rem");
            $(this).text("查看全文");
        }
    })

    // 领走愿望
    $(".getBtn").click(function (e) {
        e.stopPropagation();
        $(".mask").show();
        var taskId=$(this).attr("data-id");
        $(".btnRight").addClass("getSure").attr("taskId", taskId);
        $(".maskCon .tipTop").text("确认认领愿望吗？");
        $(".maskCon .tipBottom").text("认领后将会把你的个人信息告知邀请人！");
    })

    $(".maskCon").click(function(e){
        e.stopPropagation();
    })

    $(".btnRight").click(function(){
        if ($(this).hasClass("getSure")) {// 确认领走愿望
            var taskId = $(this).attr("taskId");
            $(".loading").show();
            $.ajax({
                "url": "/wish/agree/" + taskId,
                "type": "get",
                "dataType": "json",
                "data": {},
                "success": function (response) {
                    $(".loading").hide();
                    if (response.errorCode == 0) {
                        P2PWAP.ui.toast('愿望领取成功,你可以在愿望单中查看详情！');
                        setTimeout(function () {
                            location.href = "/";
                        }, 1);
                    } else {
                        P2PWAP.ui.toast(response.errorMsg);
                    }
                },
                "fail": function (msg) {
                    P2PWAP.ui.toast(msg);
                }
            })
        } else if ($(this).hasClass("delSure")){//删除弹窗点击确认
            var taskId = $(this).attr("taskId");
            $(".loading").show();
            $.ajax({
                "url": "/tasks/delete/" + taskId,
                "type": "get",
                "dataType": "json",
                "data": {},
                "success": function (response) {
                    $(".loading").hide();
                    if (response.errorCode==0){
                        P2PWAP.ui.toast('愿望删除成功！');
                        setTimeout(function () {
                            $(".mask").hide();
                            getWish(1);
                        }, 1);
                    }else{
                        P2PWAP.ui.toast(response.errorMsg);
                    }
                },
                "fail": function (msg) {
                    P2PWAP.ui.toast(msg);
                }
            })
        }
    })

    //获取wish列表数据
    getWish(1);

    //wish列表类型切换
    $(".wishItem .navBox li").click(function(){
        var type=$(this).attr("data-type");
        getWish(type);
    })

    function getWish(type){
        $(".loading").show();
        $(".wishItem .listUl").html('');
            $.ajax({
                "url": "/wish",
                "dataType": "json",
                "type": "get",
                "data": {
                    type: type
                },
                "success": function (response) {
                    $(".loading").hide();
                    if (response.length>0){
                        var list = response;
                        var $lis='';
                        $.each(list,function(index,item){
                            if(item.status=="1"){//待领取
                                $lis += '<li class="waitGet" data-id="'+item.id+'">';
                            } else if (item.status == "2"){//已领取
                                $lis += '<li class="alreadyGet" data-id="' + item.id + '">';
                            }else{//已结束
                                $lis += '<li class="finish" data-id="' + item.id + '">';
                            }
                            item.head_image = item.head_image ? item.head_image : "/images/buxian/avatar.jpg";
                            var $status = item.status == 1 ? '待领取' : item.status == 2 ? '已领取' : '已结束';
                            $lis+='<div class="top">' +
                                        '<img src="'+item.head_image+'" class="avatar">' +
                                        '<span class="name ellipsis">' + item.user_name + '</span>' +
                                        '<span class="time">' + item.time + '</span>' +
                                    '</div>' +
                                    '<div class="con">' +
                                        '<h3>' + item.content + '</h3>' +
                                    '</div>' +
                                    '<p class="status">' + $status + '</p>' ;
                            if(item.status==1){
                                $lis += '<p class="deleteBtn">删除</p>';
                            }else if(item.status==2){
                                $lis += '<p class = "mysteryInfo"> 神秘人信息 </p>';
                            }
                            $lis += '</li>';
                        })
                        $(".wishItem .listUl").html($lis);
                    }
                },
                "fail": function (msg) {
                    P2PWAP.ui.toast(msg);
                }
            })
    }

    $(".mask").click(function(){
        $(this).hide();
    })

    //wish nav切换
    $(".wishItem .navBox li").click(function(){
        $(this).siblings().removeClass("active");
        $(this).addClass("active");
    })

    // wish列表跳详情
    $(".wishItem .listUl").on("click","li",function(){
        var taskId=$(this).attr("data-id");
        location.href = " /wish/detail/" + taskId;
    })
    // wish列表点击删除
    $(".wishItem .listUl").on("click",".deleteBtn", function (e) {
        var taskId = $(this).parents("li").attr("data-id");
        e.stopPropagation();
        $(".mask").show();
        $(".btnRight").addClass("delSure").attr("taskId", taskId);
        $(".maskCon .tipTop").text("确认删除愿望吗？");
        $(".maskCon .tipBottom").text("删除后将不会有神秘人看到此条消息！");
    })

    // 弹窗点击取消
    $(".btnCancel").click(function () {
        $(".mask").hide();
    })
})
