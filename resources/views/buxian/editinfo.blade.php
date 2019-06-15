<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>编辑资料</title>
    <link rel="stylesheet" href="/css/buxian/base.css" type="text/css">
    <link rel="stylesheet" href="/css/buxian/common.css" type="text/css">
    <link rel="stylesheet" href="/css/buxian/index.css?v=1545668898444" type="text/css">
    <script type="text/javascript" src="/js/buxian/jquery.min.js"></script>
    <script type="text/javascript" src="/js/buxian/common.js?v=1545668898444"></script>
    <script type="text/javascript" src="/js/buxian/index.js?v=1545668898444"></script>
</head>
<body>
<div class="p_container editInfo">
    <div class="loading">
        <img src="/images/buxian/loading.gif" alt="">
    </div>
    <div class="labelBox">
        <img src="/images/buxian/arrow.png" class="goBack">
        <span class="label">编辑资料</span>
    </div>
    <div class="conBox">
        <div class="editItem">
            <span class="label">头像</span>
            @if(!empty($list['imageUrl']))
                <img src="{{ $list['imageUrl'] }}" class="avatar">
            @else
                <img src="/images/buxian/avatar.jpg" class="avatar">
            @endif
            <img src="/images/buxian/arrow.png" class="arrow">
        </div>
        <div class="editItem">
            <span class="label">ID</span>
            <span class="labelCon">{{ $list['id'] }}</span>
        </div>
        <div class="editItem">
            <span class="label">昵称</span>
            <span class="labelCon">{{ $list['userName'] }}</span>
            <img src="/images/buxian/arrow.png" class="arrow">
        </div>
        <div class="editItem">
            <span class="label">年龄</span>
            <span class="labelCon">{{ $list['age'] }}</span>
            <img src="/images/buxian/arrow.png" class="arrow">
        </div>
        <div class="editItem">
            <span class="label">星座</span>
            <span class="labelCon">{{ $list['constellation'] }}</span>
            <img src="/images/buxian/arrow.png" class="arrow">
        </div>
        <div class="editItem">
            <span class="label">常出没地</span>
            <span class="labelCon">{{ $list['oftenAppear'] }}</span>
            <img src="/images/buxian/arrow.png" class="arrow">
        </div>
        <div class="editItem">
            <span class="label">微信号</span>
            <span class="labelCon">{{ $list['WeChat'] }}</span>
            <img src="/images/buxian/arrow.png" class="arrow">
        </div>

    </div>

</div>

</body>
</html>