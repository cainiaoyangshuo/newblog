$(function(){
    var squareHeight=$(window).height()-$(".labelBox").height()-$(".tabBox").height()-15;
    $(".conBox").css("height", squareHeight + "px");
    var wishHeight = squareHeight - $(".navBox").height()-25;
    $(".wishItem .listBox").css("height", wishHeight + "px");

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
        }
    })

    $(".squareItem .listUl li").each(function () {
        var height = $(this).find(".con h3").height();
        if (height>51){
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
        }else{
            $(this).parents("li").find(".con").css("height", "0.6rem");
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
                "data": {},
                "success": function (response) {
                    $(".loading").hide();
                    if(response.errorCode==0){
                        P2PWAP.ui.toast('愿望领取成功,你可以在愿望单中查看详情！');
                        setTimeout(function () {
                            location.href = "/";
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
    // getWish(1);

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
                            if(item.status=="0"){//待领取
                                $lis += '<li class="waitGet">';
                            } else if (item.status == "1"){//已领取
                                $lis += '<li class="alreadyGet">';
                            }else{//已结束
                                $lis += '<li class="finish">';
                            }
                            item.head_image = item.head_image ? item.head_image : "/images/buxian/avatar.jpg";
                            var $status = item.status == 0 ? '待领取' : item.status == 1 ? '已领取' : '已结束';
                            $lis+='<div class="top">' +
                                        '<img src="'+item.head_image+'" class="avatar">' +
                                        '<span class="name ellipsis">' + item.user_name + '</span>' +
                                        '<span class="time">' + item.time + '</span>' +
                                    '</div>' +
                                    '<div class="con">' +
                                        '<h3>' + item.content + '</h3>' +
                                    '</div>' +
                                    '<p class="status">' + $status + '</p>' ;
                            if(item.status==0){
                                $lis += '<p class="deleteBtn">删除</p>';
                            }else if(item.status==1){
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
    $(".wishItem .listUl li").click(function(){
        location.href="detail.html";
    })
    // wish列表点击删除
    $(".deleteBtn").click(function(e){
        e.stopPropagation();
        $(".mask").show();
        $(".btnRight").addClass("delSure");
        $(".maskCon .tipTop").text("确认删除愿望吗？");
        $(".maskCon .tipBottom").text("删除后将不会有神秘人看到此条消息！");
    })

    // 删除弹窗点击取消
    $(".btnCancel").click(function () {
        $(".mask").hide();
    })
    // 删除弹窗点击确认
    $(".delSure").click(function () {
        
    })
})
