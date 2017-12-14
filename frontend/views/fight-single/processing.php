<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />
    <meta name="format-detection" content="telephone=no">
    <title>拼多多 - 两亿人都在拼的拼多多</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <link href="/css/fight-single/style.css" rel="stylesheet" />
    <link href="/css/fight-single/share.css" rel="stylesheet" />
    <link href="/css/fight-single/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.bootcss.com/weui/1.1.2/style/weui.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/jquery-weui/1.2.0/css/jquery-weui.min.css">
</head>
<body>
    <div class="tips">
        <i class="tips_succ"></i>
            <span id="header_title" onclick="document.getElementById('share_img').style.display='';">参团成功快去邀请好友加入吧</span>
    </div>
    <div id="group_detail" class="tm ">
        <div class="td tuanDetailWrap">
            <div class="td_img">    
                <a href="<?= $goodInfo->getUrl()?>"><img src="<?= $goodInfo->thumb?>"></a>
            </div>
            <div class="td_info">
                <p class="td_name">
                   <a href="<?= $goodInfo->getUrl()?>"><?= $goodInfo->name?></a>
                </p>
                <p class="td_mprice"><span><?= $goodInfo->member_count?>人团</span><i>¥</i><b><?= $goodInfo->discount / 100?></b></p>
            </div>
        </div>
        <a class="explain_tuan" id="share_button" href="javascript:void(0);" onclick="document.getElementById('share_tuan').style.display='';"></a>
        <div id="share_tuan" style="display:none;" onclick="document.getElementById('share_tuan').style.display='none';"><img src="/images/fight-single/share-tuan.png" ></div>
    </div>
    <div class="spec">
        <form action="javascript:addToCart(14,0,0,5,327,0);" method="post" name="HHS_FORMBUY" id="HHS_FORMBUY"></form>
    </div>
    <div class="pp">
        <div class="pp_users" id="pp_users">
            <?php
                for($i=0;$i<$goodInfo->member_count;$i++) {
                    if (isset($childrenInfo[$i])) {
                        ?>
                        <p class="pp_users_item pp_users_normal"><img src="<?= $childrenInfo[$i]->getAvatar()?>"></p>
                        <?php
                    } else {
                        ?>
                        <p class="pp_users_item pp_users_blank"><img src="/images/fight-single/avatar_4_64.png"></p>
                        <?php
                    }
                }
            ?>
        </div>
    </div>
    <div class="pp_box">
        <div class="pp_tips" id="flag_1_a" >优质商品，大家一起玩吧</div>
        <?php
        if ($lastCount == 0) {
            ?>
            <div class="pp_tips" id="flag_0_a"><b>当前拼团已满,快去创建一个拼团吧!</b></div>
            <?php
        } else {
            ?>
            <div class="pp_tips" id="flag_0_a" >还差<b><?= $lastCount?></b>人，盼你如南方人盼暖气~</div>
            <?php
        }
        ?>
        <div class="pp_state" id="flag_0_b" >
            <div class="pp_time"> 剩余<font id="time"></font>结束 </div>
        </div>
    </div>
    <div class="pp_list">
        <div id="showYaoheList">
            <?php
                foreach ($childrenInfo as $v) {
                    ?>
                    <div class="pp_list_item"> <img class="pp_list_avatar" alt="" src="<?= $v->getAvatar()?>">
                        <div class="pp_list_info" id="pp_list_info"> <span class="pp_list_name"><?= $v['is_chief'] == 1 ? '团长' : ''?><b><?= $v['username']?></b></span> <span class="pp_list_time"><?= date('Y-m-d H:i:s', $v['created_at'])?><?= $v['is_chief'] == 1 ? '开团' : '参团'?> </span> </div>
                    </div>
            <?php
                }
            ?>
        </div>
        <div id="chamemeber" class="pp_list_blank" >
            <?php
                if ($lastCount == 0) {
                    ?>
                    当前拼团已满,快去创建一个拼团吧!
            <?php
                } else {
                    ?>
                    还差<span><?= $lastCount?></span>人，让小伙伴们都来组团吧！
            <?php
                }
            ?>
        </div>
    </div>
    <div class="step">
        <div class="step_hd"> 拼团玩法<a class="step_more" href="/fight-single/rules">查看详情</a> </div>
        <div id="footItem" class="step_list">
            <div class="step_item">
                <div class="step_num">1</div>
                <div class="step_detail">
                    <p class="step_tit">选择 <br>
                        心仪商品</p>
                </div>
            </div>
            <div class="step_item  step_item_on">
                <div class="step_num">2</div>
                <div class="step_detail">
                    <p class="step_tit">开团或参团 <br>
                        到达人数</p>
                </div>
            </div>
            <div class="step_item " >
                <div class="step_num">3</div>
                <div class="step_detail">
                    <p class="step_tit">即可 <br>
                        团购成功</p>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="recommend_grid_wrap" style="padding-bottom:60px;">
        <div id="recommend" class="grid">
            <div class="recommend_head">你可能还喜欢</div>
            <div class="bd">
                <ul>
                    <?php
                        if (!empty($goodsList)) {
                            foreach ($goodsList as $good) {
                                ?>
                                <li>
                                    <div class="recommend_img"><a href="<?= $goodInfo->getUrl()?>"><img src="<?= $good->thumb?>"></a></div>
                                    <div class="recommend_title"><a href="<?= $goodInfo->getUrl()?>"><?= $good->name?></a></div>
                                    <div class="recommend_price">￥<span><?= $good->discount / 100?></span></div>
                                    <div class="like_click"> <a href="javascript:collect(21)" class="recommend_like"></a> </div>
                                </li>
                    <?php
                            }
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="fixopt">  
        <div class="fixopt_item">
            <?php
            if ($lastCount == 0) {
                ?>
                <a class="fixopt_btn" id="share_button" href="javascript:void(0);" onclick="document.getElementById('share_img').style.display='';">当前拼团已满,快去创建一个拼团吧!</a>
                <?php
            } else {
                ?>
                <a class="fixopt_btn" id="share_button" href="javascript:void(0);" onclick="document.getElementById('share_img').style.display='';">还差<?= $lastCount?>人组团成功</a>
                <?php
            }
            ?>
        </div>
    </div>

    <div id="share_img" class="share_img" style="display: none" onclick="document.getElementById('share_img').style.display='none';">
        <p><img class="arrow" src="/images/fight-single/share.png" ></p>
        <p style="margin-top:20px; margin-right:50px;">点击右上角，</p>
        <p style="margin-right:50px;">将它分享给好友</p>
        <p style=" text-align:center; font-size:30px; line-height:80px;">参团人数+1</p>
        <p align="center">还差<?= $lastCount?>人就能组团成功</p>
        <p align="center">快邀请小伙伴参团吧</p>
    </div>
</body>

<script type="text/javascript" src="/js/fight-single/haohaios.js"></script>
<script src="https://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>
<script type="text/javascript">
if (<?= $lastCount?> == 0) {
    $.alert('当前拼团已满,快去创建一个拼团吧!', function () {
        window.location.href="/fight-single/good?id=<?= $goodInfo->id?>";
    });
} else {
    getCookie();
}
var daysms = 24 * 60 * 60 * 1000;
var hoursms = 60 * 60 * 1000;
var Secondms = 60 * 1000;
var microsecond = 1000;
var DifferHour = 0;
var DifferMinute = 0;
var DifferSecond = 0;
var systime=1513105754;
var team_start=1512742583*1000;
var team_end=1512742583*1000+30*24*3600*1000;
setInterval("systime_clock()",1000);
function systime_clock(){
	systime++;
}
function clock()
{	
  var time = new Date();
  time.setTime(systime*1000);
  var Diffms = team_end - time.getTime();
  var Diffms1=Diffms;
  var a='';
  var b='';
  var c='';
  var d='';
  DifferHour = Math.floor(Diffms / daysms);
  Diffms -= DifferHour * daysms;
  DifferMinute = Math.floor(Diffms / hoursms);
  Diffms -= DifferMinute * hoursms;
  DifferSecond = Math.floor(Diffms / Secondms);
  Diffms -= DifferSecond * Secondms;
  var dShhs = Math.floor(Diffms / microsecond);
  if(Diffms1>=0){
	   a="还剩<strong class='tcd-h'>"+DifferHour+"</strong>天";
	   b="<span >"+DifferMinute+"</span>时";
	   c="<span >"+DifferSecond+"</span>分";
	   d="<span>"+dShhs+"</span>秒";
	  document.getElementById('time').innerHTML =a+b+c+d;
  }else{
	  window.location.reload();
  }
}
window.setInterval("clock()", 1000); 

function getCookie() {
    $.ajax({
        'type': 'get',
        'url': 'http://xx.weixin.com/fight-single/get-cookie?order_id=' + <?= $order_id?>,
        'xhrFields': {
            'withCredentials': true
        },
        'dataType': 'json',
        'success': function (data) {
            if (data.code == 0) {
                if (data.is_join == 0) {
                    $('#header_title').html('快来入团吧就差你了!');
                    $('.fixopt_btn').html('我也要参团');
                    $('.fixopt_btn').attr('onclick', null);

                    $('.fixopt_btn').click(function () {
                        alertTwoInput('记录您的信息保存您的拼团信息', '提示', '姓名', '手机号码', function () {
                            console.log('error');
                        }, function () {
                            var reg = /^[\u4E00-\u9FA5]{2,4}$/;
                            if(!reg.test($('.user-name').val())){
                                $.alert('姓名填写有误');
                            }
                            if(!(/^1[34578]\d{9}$/.test($('.tel').val()))){
                                $.alert("手机号码有误,请重填");
                                return false;
                            }

                            $.ajax({
                                'type': 'post',
                                'url': '/fight-single/save-order',
                                'data': {
                                    'good_id': <?= $goodInfo->id?>,
                                    'username': $('.user-name').val(),
                                    'tel': $('.tel').val(),
                                    'pid': <?= $order_id?>,
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
                    })
                }
            }
        }
    });
}

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
            $.alert('参团成功,工作人员会在稍后联系您哦!', function () {
                window.location.href = "/fight-single/processing?order_id=" + order_id;
            });
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
</html>