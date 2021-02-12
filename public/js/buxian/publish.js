$(function(){
    // 返回
    $(".goBack").click(function () {
      location.href = "/?form=publish";
    })

    $(".inputArea").keyup(function(){
        var val=$(this).val();
        var num=val.length;
        $(".numBox .num").text(num);
        var restNum=200-num;
        $(".restNum").text(restNum);
    })

    var typeSelect = new MobileSelect({
      trigger: '#typeSelect',
      title: '',
      wheels: [{
            data: [{
                id: '1',
                value: '烧脑桌游'
              },
              {
                id: '2',
                value: '景点打卡'
              },
              {
                id: '3',
                value: '逛吃逛吃'
              },
              {
                id: '4',
                value: '游戏组队'
              },
              {
                id: '5',
                value: '电影'
              }
            ]
          }],
      position: [2], //初始化定位
      callback: function (indexArr, data) {
        $("#typeSelect").attr("data-id", data[0].id);
      }
    });
    var sexSelect = new MobileSelect({
      trigger: '#sexSelect',
      title: '',
      wheels: [{
        data: [{
            id: '0',
            value: '不限'
          },
          {
            id: '1',
            value: '男'
          },
          {
            id: '2',
            value: '女'
          }
        ]
      }],
      position: [2], //初始化定位
      callback: function (indexArr, data) {
        $("#sexSelect").attr("data-id", data[0].id);
      }
    });
    var ageSelect = new MobileSelect({
      trigger: '#ageSelect',
      title: '',
      wheels: [{
        data: [{
            id: '0',
            value: '不限'
          },
          {
            id: '1',
            value: '20-25岁'
          },
          {
            id: '2',
            value: '26-30岁'
          }
        ]
      }],
      position: [2], //初始化定位
      callback: function (indexArr, data) {
        $("#ageSelect").attr("data-id", data[0].id);
      }
    });
    var daySelect = new MobileSelect({
      trigger: '#daySelect',
      title: '',
      wheels: [{
        data: [{
            id: '0',
            value: '3天'
          },
          {
            id: '1',
            value: '5天'
          },
          {
            id: '2',
            value: '7天'
          }
        ]
      }],
      position: [2], //初始化定位
      callback: function (indexArr, data) {
        $("#daySelect").attr("data-id", data[0].id);
      }
    });

    // 发布
    $(".publishBtn").click(function(){
        var sex = $("#sexSelect").attr("data-id");
        var category = $("#typeSelect").attr("data-id");
        var age = $("#ageSelect").attr("data-id");
        var valid_at = $("#daySelect").attr("data-id");
        var content = $(".inputArea").val();
        var token=$("input[name=_token]").val();
        $(".loading").show();
        $.ajax({
            "url": "/tasks/store",
            "dataType": "json",
            "type": "post",
            "data": {
                sex: sex,
                category: category,
                age: age,
                valid_at: valid_at,
                content: content,
                _token: token
            },
            "success": function (response) {
              $(".loading").hide();
              if (response.errorCode == 0) {
                  P2PWAP.ui.toast('愿望发布成功');
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
    })
})