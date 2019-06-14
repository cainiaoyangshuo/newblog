$(function(){
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
        console.log(data); //返回选中的json数据
        $("#typeSelect").attr("data-id", data[0].id);
        $("#typeSelect").parents(".editItem").find("input").val(data[0].id)
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
        console.log(data); //返回选中的json数据
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
        console.log(data); //返回选中的json数据
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
        console.log(data); //返回选中的json数据
        $("#daySelect").attr("data-id", data[0].id);
      }
    });

    var url = $("#url").val();
    console.log(url)
    console.log($("#url"))
    // 发布
    $(".publishBtn").click(function(){
        var sex = $("#sexSelect").attr("data-id");
        var category = $("#typeSelect").attr("data-id");
        var age = $("#ageSelect").attr("data-id");
        var valid_at = $("#daySelect").attr("data-id");
        var content = $(".inputArea").val();
        var token=$("input[name=_token]").val();

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

            },
            "fail": function (msg) {
                P2PWAP.ui.toast(msg);
            }
        })
    })
})