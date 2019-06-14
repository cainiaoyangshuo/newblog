$(function(){
    $(".inputArea").keyup(function(){
        var val=$(this).val();
        var num=val.length;
        $(".numBox .num").text(num);
        var restNum=200-num;
        $(".restNum").text(restNum);
    })
})