<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>心愿详情</title>
    <link rel="stylesheet" href="/css/buxian/base.css" type="text/css">
    <link rel="stylesheet" href="/css/buxian/common.css" type="text/css">
    <link rel="stylesheet" href="/css/buxian/index.css?v=1545668898444" type="text/css">
    <script type="text/javascript" src="/js/buxian/jquery.min.js"></script>
    <script type="text/javascript" src="/js/buxian/common.js?v=1545668898444"></script>
</head>
<body>
<div class="p_container detail">
    <div class="loading">
        <img src="/images/buxian/loading.gif" alt="">
    </div>
    <div class="labelBox">
        <img src="/images/buxian/arrow.png" class="goBack">
        <span class="label">心愿详情</span>
    </div>
    <div class="conBox">
        <div class="conItem wishItem">
            <div class="listBox">
                <ul class="listUl">
                    <li class="waitGet">
                        <div class="top">
                            @if(!empty($result['publishUser']['avatar']))
                                <img src="{{ $result['publishUser']['avatar'] }}" class="avatar">
                            @else
                                <img src="/images/buxian/avatar.jpg" class="avatar">
                            @endif
                            <span class="name ellipsis">{{$result['publishUser']['name']}}</span>
                            <span class="time">{{$result['task']['valid_at']}}</span>
                        </div>
                        <div class="con">
                            <h3>{{$result['task']['content']}}</h3>
                        </div>
                        @if($result['task']['status']==1)
                            <p class="status">待领取</p>
                        @elseif($result['task']['status']==2)
                            <p class="status">已领取</p>
                        @else   
                            <p class="status">已结束</p>
                        @endif
                        
                    </li>
                </ul>
                <div class="mysteryItem">
                    <img src="/images/buxian/avatar.jpg" class="avatar">
                    <span class="tip">以下是关于你的神秘人信息哦~</span>
                    <div class="nameBox divItem">
                        <span class="name">{{$result['agreeUser']['name']}}</span>
                        <img src="/images/buxian/man.png" class="sexImg">
                    </div>
                    <div class="divItem labelItem">
                        <p>{{$result['agreeUser']['age']}}岁</p>
                        <p>{{$result['agreeUser']['constellation']}}</p>
                    </div>
                    @if($result['role']==1)
                    <span class="tip"><span style="font-weight:bold;">Wechat:</span>{{$result['agreeUser']['WeChat']}}</span>
                    @endif
                    <span class="tip">请保存好信息不要告诉别人哦~期待你们的相遇</span>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        // 返回
        $(".goBack").click(function () {
            location.href="/?form=detail";
        })
    })
</script>
</body>
</html>