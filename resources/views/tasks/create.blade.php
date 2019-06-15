<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>编辑资料</title>
    <link rel="stylesheet" href="/css/buxian/base.css" type="text/css">
    <link rel="stylesheet" href="/css/buxian/common.css" type="text/css">
    <link rel="stylesheet" href="/css/buxian/select.css" type="text/css">
    <link rel="stylesheet" href="/css/buxian/index.css?v=1545668898444" type="text/css">
    <script type="text/javascript" src="/js/buxian/jquery.min.js"></script>
    <script type="text/javascript" src="/js/buxian/select.js"></script>
    <script type="text/javascript" src="/js/buxian/common.js?v=1545668898444"></script>
    <script type="text/javascript" src="/js/buxian/publish.js?v=1545668898444"></script>
</head>
<body>
<div class="p_container publish">
    <div class="loading">
        <img src="/images/buxian/loading.gif" alt="">
    </div>
    {{ csrf_field() }}
    <div class="labelBox">
        <img src="/images/buxian/arrow.png" class="goBack">
        <span class="label">编辑心愿</span>
        <a class="publishBtn" href="javascript:void(0)">发布</a>
    </div>
    <div class="conBox">
       
            <div class="editItem">
                <span class="label">心愿类型</span>
                <span class="labelCon" id="typeSelect">请选择</span>
                <img src="/images/buxian/arrow.png" class="arrow">
            </div>
            <div class="editItem">
                <span class="label">性别</span>
                <span class="labelCon" id="sexSelect" data-id="0">不限</span>
                <img src="/images/buxian/arrow.png" class="arrow">
            </div>
            <div class="editItem">
                <span class="label">年龄</span>
                <span class="labelCon" id="ageSelect" data-id="0">不限</span>
                <img src="/images/buxian/arrow.png" class="arrow">
            </div>
            <div class="editItem">
                <span class="label">心愿发布有效期</span>
                <span class="labelCon" id="daySelect" data-id="2">7天</span>
                <img src="/images/buxian/arrow.png" class="arrow">
            </div>
            <div class="editAreaBox">
                <span class="label">心愿内容</span>
                <div class="editArea">
                    <textarea maxlength="200" class="inputArea" placeholder="可被实现的，禁止黄暴
有趣的走心的心愿，更容易被领走哦～
例如：
求可以陪我一起去看复仇者联盟的伙伴"></textarea>
                    <div class="numBox">
                        <span class="num">0</span>
                        <span>/</span>
                        <span class="restNum">200</span>
                    </div>
                </div>
            </div>
        
    </div>
</div>
</div>

</body>
</html>