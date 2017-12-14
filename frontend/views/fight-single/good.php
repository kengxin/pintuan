<!DOCTYPE html>
<html lang="zh-CN"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="Generator" content="ZXYP V1.0.0">

    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="Keywords" content="">
    <meta name="Description" content="">
    <meta name="format-detection" content="telephone=no">
    <title><?= $model->name?> - 拼多多</title>
    <link href="/css/fight-single/style.css" rel="stylesheet">
    <link href="/css/fight-single/font-awesome.min.css" rel="stylesheet">
    <link href="/css/fight-single/flexslider.css" rel="stylesheet">
    <link href="/css/fight-single/layer.css" type="text/css" rel="styleSheet" id="layermcss">
    <link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css">
</head>
<body>
<div class="container">
    <div class="flexslider">
        <ul class="slides">
            <li><img src="<?= $model->thumb?>"></li>
        </ul>
    </div>
    <div class="tuan_info">
        <form action="javascript:addToCart(11)" method="post" name="HHS_FORMBUY" id="HHS_FORMBUY">
            <div class="g_name"><?= $model->name?></div>
            <div class="g_brief"></div>
            <div class="blank"></div>
            <div class="g_price"><font>¥<?= $model->discount / 100?></font> <del>¥<?= $model->price / 100?></del> <span>已售：<?= substr(time(), 4, 5)?>件</span></div>
            <div class="blank"></div>
            <div class="line"></div>
            <div class="blank"></div>
            <div class="td2_info">
            </div>

            <div id="speBg" style="display:none; z-index: 1000;"></div>
            <div id="speDiv" class="speDiv" style="bottom:50px; display:none;">
                <div id="sku-head"> <img id="sku-image" class="image" src="/images/fight-single/11_thumb_G_1508896375138.jpg">
                    <div id="sku-detail">
                        <div class="sku-name"><?= $model->name?></div>
                        <div class="sku-price2-depends" id="HHS_GOODS_AMOUNT">￥<?= $model->discount / 100?></div>

                        <div>
                            <span id="sku-msg"></span>
                        </div>
                    </div>
                    <a href="javascript:showhide();" id="sku-quit"></a>
                </div>
                <div class="sku-amount">
                    <div class="sku-text"> <a>限购一件</a>
                    </div>
                    <div class="sku-text" style="display: none"> <a>购买数量</a>
                        <div class="nbox">
                            <i class="fa fa-minus hui"></i>
                            <input name="number" type="text" id="number" class="num" value="1" size="4">
                            <i class="fa fa-plus"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ftbuy">
                <a href="javascript:showhide(1);" id="btn-pre-buy1" class="ftbuy_item out" style="width: 100%">
                    <div class="ftbuy_price"><b id="tuan_more_price">¥&nbsp;<?= $model->discount / 100?></b><i>/</i>件</div>
                    <div class="ftbuy_btn"><b id="tuan_more_number"><?= $model->member_count?>人团</b></div>
                </a> <a id="btn-buy1" class="ftbuy_item out" style="display:none;width: 85%">
                    <div class="ftbuy_btn" id="tuan_one_number" style="height:50px;top: 0;line-height:50px; font-size:16px;">确定</div>
                </a>


            </div>
        </form>
    </div>

    <div class="g_tip">申请开团并邀请好友参团，拼团成功后工作人员将会联系您! <a href="/fight-single/rule">开团介绍</a></div>

    <div class="blank"></div>
    <div class="pro_detial">
        <div class="pro_con">
            <?= $model->content?>
        </div>
    </div>
    <div class="recommend_grid_wrap">
        <div id="recommend" class="grid">
            <div class="recommend_head">你可能还喜欢</div>
            <div class="bd">
                <ul>
                    <?php
                        if (!empty($goodsList)) {
                            foreach ($goodsList as $good) {
                                ?>
                                <li>
                                    <div class="recommend_img"><a href="<?= $good->getUrl();?>"><img src="<?= $good->thumb?>"></a></div>
                                    <div class="recommend_title"><a href="<?= $good->getUrl();?>"><?= $good->name?></a></div>
                                    <div class="recommend_price">￥<span><?= $good->discount / 100 ?></span></div>
                                    <div class="like_click" data-id="12"> <img src="/images/fight-single/no_liked2.png" data-isliked="0"></div>
                                </li>
                    <?php
                            }
                        }
                    ?>
                </ul>
            </div>
        </div>
        <div class="recommend_bottom">
            <div class="line"></div>
            <p>已经到底部了</p>
        </div>
    </div>
    <div class="blank"></div>
</div>

<script type="text/javascript" src="/js/fight-single/haohaios.js?v=3"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>
<script type="text/javascript">
    var goods_id = <?= $model->id?>;
    $('#btn-pre-buy1').click(function (){
        $('#speDiv').show();
        $('#speBg').show();
        $('#btn-buy1').css({'width': '100%'}).show();


        $('#btn-pre-buy1').hide();
    });

    $('#tuan_one_number').click(function () {
        alertTwoInput('记录您的信息保存您的拼团信息', '提示', '姓名', '手机号码', function () {
            console.log('error');
        }, function () {
            var reg = /^[\u4E00-\u9FA5]{2,4}$/;
            if(!reg.test($('.user-name').val())){
                $.alert('姓名填写有误');
            }
            console.log($('.tel').val());
            if(!(/^1[34578]\d{9}$/.test($('.tel').val()))){
                $.alert("手机号码有误,请重填");
                return false;
            }

            $.ajax({
                'type': 'post',
                'url': '/fight-single/save-order',
                'data': {
                    'good_id': goods_id,
                    'username': $('.user-name').val(),
                    'tel': $('.tel').val(),
                    '_csrf': '<?= Yii::$app->request->csrfToken?>'
                },
                'dataType': 'json',
                'success': function (data) {
                    if (data.code == 0) {
                        setCookie(data.order_id);
                    } else {
                        $.alert(data.err);
                    }
                }
            });
        });
    });

    function setCookie(order_id) {
        $.ajax({
            'url': 'http://xx.weixin.com/fight-single/set-cookie',
            'type': 'post',
            'data': {
                'order_id': order_id
            },
            'xhrFields': {
                'withCredentials': true
            },
            'dataType': 'json',
            'success': function (data) {
                window.location.href = "/fight-single/processing?order_id=" + order_id;
            }
        });
    }

    function alertTwoInput(text, title, input1, input2, onCancel, onOK) {
        var config;
        if (typeof text === 'object') {
            config = text;
        } else {
            config = {
                text: text,
                title: title,
                input1: input1,
                input2: input2,
                onOK: onOK,
                onCancel: onCancel,
                empty: false  //allow empty
            };
        }
        $.modal({
            text: '<p class="weui-prompt-text">' + (config.text || '') + '</p><input type="text" class="weui-input user-name weui-prompt-input" id="weui-prompt-input" value="' + (config.input1 || '') + '" />' + '<input type="text" class="weui-input tel weui-prompt-input" id="weui-prompt-input" value="' + (config.input2 || '') + '" />',
            title: title,
            buttons: [{
                text: '取消',
                    className: "primary",
                    onClick: function () {
                        onCancel();
                        $.closeModal();
                    }
                },
                {
                    text: '确认',
                    className: "primary",
                    onClick: function () {
                        onOK();
                    }
                }
            ]
        });

        $('.user-name').click(function () {
            $(this).val('');
        });

        $('.tel').click(function () {
            $(this).val('');
        })
    }
</script>
</body></html>