$(function(){
        var winW = document.documentElement.clientWidth;
        var fontSize = winW / 375 * 100;
        document.documentElement.style.fontSize = fontSize + "px";

        var winHeight = $(window).height();
        $(".p_container").css("height", winHeight);

        var backFrom = getQueryString('back_from');
        if (backFrom == 'register'){
            P2PWAP.ui.toast('注册成功');
        }

        $(".registerBtn").attr("href", 'https://m.ncfwx.com/user/register?back_url=' +
        encodeURIComponent(location.href+'&back_from=register'));

        $('#codeImg').on('click', refresh);

        function refresh() {
        var srcStr = "/verify?w=91&h=36&rb=0&rand=" + new Date().getTime();
            $('#codeImg').attr('src', srcStr);
        }

        // 手机号校验
        $("#phoneInput").keyup(function (e) {
            e.stopPropagation();
            $(this).val($(this).val().replace(/\D/g, ''));
        })

         // 软键盘收起时页面回归原位
        if (p2pBrowser.ios) { //ios
            function scrollWatch() {
                if (document.activeElement.nodeName != 'INPUT') {
                    window.scroll(0, 0);
                }
            }
            setInterval(function () {
                scrollWatch();
            }, 500);
        } else { //android
            var winHeight = $(window).height(); //获取当前页面高度
            $(window).resize(function () {
                var thisHeight = $(this).height();
                if (winHeight - thisHeight > 50) {
                    //当软键盘弹出，在这里面操作
                    $(".p_container").css("height", winHeight);
                } else {
                    //当软键盘收起，在此处操作
                }
            });
        }

        var tokenKey,token;
        // 获取token tokenKey
        $(".loading").show();
        $.ajax({
            "url": "/login",
            "dataType": "json",
            "data": {},
            "success": function (response) {
                $(".loading").hide();
                if (response.code == 0) {
                    tokenKey=response.data.tokenKey;
                    token=response.data.token;
                } else {
                    if (response.data.showVerify == 1) {
                        $(".verifyItem").show().addClass("show").find("#codeInput").val('');
                        refresh();
                    }
                    P2PWAP.ui.toast(response.msg);
                }
            },
            "fail": function (msg) {
                P2PWAP.ui.toast(msg);
            }
        })

        // 点击立即登录
        $(".loginBtn").click(function(){
            var phone = $("#phoneInput").val(),
                psd = $("#psdInput").val(),
                code = $("#codeInput").val();
            if (phone.length == 0) {
                P2PWAP.ui.toast("请输入您的手机号");
                return
            }
            if (psd.length == 0) {
                P2PWAP.ui.toast("请输入您的密码");
                return
            }
            if ($(".verifyItem").hasClass("show")&&code.length == 0) {
                P2PWAP.ui.toast("请输入验证码");
                return
            }
            $(".loading").show();
            var parasFrom= getQueryString('from');
            var parasCode= getQueryString('code');
            var args={
                from: parasFrom,
                code: parasCode,
                mobile: phone,
                password: psd,
                verify: code
            }
            args[tokenKey]= token;
            $.ajax({
                "url": "/login",
                "dataType": "json",
                "type": "post",
                "data": args,
                "success": function (response) {
                    $(".loading").hide();
                    tokenKey = response.data.tokenKey;
                    token = response.data.token;
                    if (response.code == 0) {
                        // 跳回活动页面
                        var callbackUrl = getQueryString('callbackUrl');
                        location.replace(callbackUrl);
                    } else {
                        if (response.data.showVerify == 1) {
                            $(".verifyItem").show().addClass("show").find("#codeInput").val('');
                            refresh();
                        }
                        P2PWAP.ui.toast(response.msg);
                    }
                },
                "fail": function (msg) {
                    P2PWAP.ui.toast(msg);
                }
            })

        })
    })