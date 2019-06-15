<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="format-detection" content="telephone=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>咸鱼不闲</title>
    <link rel="stylesheet" href="/css/buxian/base.css" type="text/css">
    <link rel="stylesheet" href="/css/buxian/common.css" type="text/css">
    <link rel="stylesheet" href="/css/buxian/index.css?v=1545668898444" type="text/css">
    <script type="text/javascript" src="/js/buxian/jquery.min.js"></script>
    <script type="text/javascript" src="/js/buxian/common.js?v=1545668898444"></script>
    <script type="text/javascript" src="/js/buxian/index.js?v=1545668898444"></script>
</head>
<body style="visibility:hidden;">
<div class="p_container">
    <div class="mask">
        <div class="maskCon">
            <span class="tip tipTop">确认删除愿望吗？</span>
            <span class="tip tipBottom">删除后将不会有神秘人看到此条消息！</span>
            <div class="btnBox">
                <p class="btnLeft btnCancel">取消</p>
                <p class="btnRight">确认</p>
            </div>
        </div>
    </div>
    <div class="loading">
        <img src="/images/buxian/loading.gif" alt="">
    </div>
    <div class="labelBox">
        <span class="label">广场</span>
        <a href="/tasks/create">
            <img src="/images/buxian/add.png" class="addBtn">
        </a>
    </div>
    <div class="conBox">
        <div class="conItem squareItem" data-index="0">
            <ul class="listUl">
                @foreach($list as $value)
                <li>
                    <!-- <img src="/images/buxian/buxian/more.png" class="moreBtn"> -->
                    <p class="getBtn" data-id="{{ $value['id'] }}">
                        领走心愿
                    </p>
                    <div class="top">
                        @if(!empty($value['head_image']))
                            <img src="{{ $value['head_image'] }}" class="avatar">
                        @else
                            <img src="/images/buxian/avatar.jpg" class="avatar">
                        @endif
                        <span class="name ellipsis">{{ $value['user_name'] }}</span>
                        <span class="time">2分钟前</span>
                    </div>
                    <p class="type">#{{ $value['category'] }}#</p>
                    <div class="con">
                        <h3> {{ $value['content'] }}
                        </h3>
                    </div>
                    <div class="seeMore">查看全文</div>
                    <div class="seeNum"><img src="/images/buxian/eye.png"><span class="num">123</span></div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="conItem wishItem" data-index="1">
            <ul class="navBox">
                <li class="active" data-type="1">已发布</li>
                <li data-type="2">已领取</li>
            </ul>
            <div class="listBox">
                <ul class="listUl">
                    
                </ul>
            </div>
        </div>
        <div class="conItem" data-index="2"></div>
        <div class="conItem meItem" data-index="3">
            <div class="divItem avatarItem">
                <img src="/images/buxian/avatar.jpg" class="avatar">
                <span class="name">咸鱼不闲</span>
            </div>
            <a class="divItem infoItem" href="/buser">
                <span>个人资料</span>
                <img src="/images/buxian/info.png" alt="">
            </a>
            <a class="divItem setItem" href="javascript:void(0)">
                <span>设置</span>
                <img src="/images/buxian/set.png" alt="">
            </a>
            <a class="divItem ideaItem" href="javascript:void(0)">
                <span>建议反馈</span>
                <img src="/images/buxian/idea.png" alt="">
            </a>
        </div>
    </div>
    <ul class="tabBox">
        <li class="square active" data-index="0">广场</li>
        <li class="wish" data-index="1">心愿单</li>
        <!-- <li class="msg" data-index="2">Message</li> -->
        <li class="me" data-index="3">我的</li>
    </ul>
</div>
</body>
<script>
    (function (doc, win) {
        var docE1 = doc.documentElement,
            bodys = document.getElementsByTagName('body')[0],
            resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
            recalc = function () {
                var clientWidth = docE1.clientWidth;
                if (!clientWidth) return;
                docE1.style.fontSize = 100 * (clientWidth / 375) + 'px';
                bodys.style.visibility = 'visible'
            };

        if (!doc.addEventListener) return;
        win.addEventListener(resizeEvt, recalc, false);
        doc.addEventListener('DOMContentLoaded', recalc, false);
    })(document, window);
</script>
</html>