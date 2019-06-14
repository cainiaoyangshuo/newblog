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
    })

    $(".squareItem .listUl li").each(function () {
        console.log($(this).find(".con h3").height())
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
        $(".btnRight").addClass("getSure");
        $(".maskCon .tipTop").text("确认认领愿望吗？");
        $(".maskCon .tipBottom").text("认领后将会把你的个人信息告知邀请人！");
    })

    $(".mask").click(function(){
        $(this).hide();
    })

    //wish nav切换
    $(".wishItem .navBox li").click(function(){
        $(this).siblings().removeClass("active");
        $(this).addClass("active");
    })

    // 返回
    $(".goBack").click(function(){
        history.go(-1);
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
