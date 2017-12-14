/* 以下四个函数为属性选择弹出框的功能函数部分 */
//检测层是否已经存在
function docEle() {
    return document.getElementById(arguments[0]) || false;
}

//生成属性选择层
function openSpeDiv(message, goods_id, parent) {
    var _id = "speDiv";
    var m = "mask";
    if (docEle(_id)) document.removeChild(docEle(_id));
    if (docEle(m)) document.removeChild(docEle(m));
    //计算上卷元素值
    var scrollPos;
    if (typeof window.pageYOffset != 'undefined') {
        scrollPos = window.pageYOffset;
    } else if (typeof document.compatMode != 'undefined' && document.compatMode != 'BackCompat') {
        scrollPos = document.documentElement.scrollTop;
    } else if (typeof document.body != 'undefined') {
        scrollPos = document.body.scrollTop;
    }

    var i = 0;
    var sel_obj = document.getElementsByTagName('select');
    while (sel_obj[i]) {
        sel_obj[i].style.visibility = "hidden";
        i++;
    }

    // 新激活图层
    var newDiv = document.createElement("form");
    newDiv.id = _id;
    newDiv.setAttribute('name', 'HHS_FORMBUY');
    //生成层内内容
    newDiv.innerHTML = '<a href="javascript:cancel_div()" id="sku-quit"></a><div id="sku-head"><img id="sku-image" class="image" src="' + goods_thumb + '"><div id="sku-detail"><div class="sku-name">' + goods_name + '</div><div class="sku-price-depends">￥' + goods_price + '</div><div><span id="sku-msg">' + select_spe + '</span></div></div></div>';

    var specDiv = document.createElement("div");
    specDiv.setAttribute('class', 'sku-info');
    for (var spec = 0; spec < message.length; spec++) {
        specDiv.innerHTML += '<div class="sku-type">' + message[spec]['name'] + '</div>';

        for (var val_arr = 0; val_arr < message[spec]['values'].length; val_arr++) {
            if (val_arr == 0) {
                specDiv.innerHTML += "<input class='goods' type='radio' name='spec_" + message[spec]['attr_id'] + "' value='" + message[spec]['values'][val_arr]['id'] + "' id='spec_value_" + message[spec]['values'][val_arr]['id'] + "' checked /><label for='spec_value_" + message[spec]['values'][val_arr]['id'] + "' data-price='" + message[spec]['values'][val_arr]['price'] + "'>" + message[spec]['values'][val_arr]['label'] + '</label>';
            } else {
                specDiv.innerHTML += "<input class='goods' type='radio' name='spec_" + message[spec]['attr_id'] + "' value='" + message[spec]['values'][val_arr]['id'] + "' id='spec_value_" + message[spec]['values'][val_arr]['id'] + "' /><label for='spec_value_" + message[spec]['values'][val_arr]['id'] + "' data-price='" + message[spec]['values'][val_arr]['price'] + "'>" + message[spec]['values'][val_arr]['label'] + '</label>';
            }
        }
        specDiv.innerHTML += "<input type='hidden' name='spec_list' value='" + val_arr + "' />";
    }
    newDiv.appendChild(specDiv);

    newDiv.innerHTML += '<div class="sku-amount"><div class="sku-text"><a>购买数量</a><span class="attr-stock" id="attr-stock"></span><div class="nbox"><i class="fa fa-minus" onclick="jian();"></i><input id="number" name="number" value="1" class="num" type="text" maxlength="5"><i class="fa fa-plus" onclick="jia();"></i></div></div></div>';

    newDiv.innerHTML += "<div id='sku-decide' class='sku-button'><a href='javascript:submit_div(" + goods_id + "," + parent + ")' id='sku-buy'>" + btn_add_to_cart + "</a></div>";

    document.body.appendChild(newDiv);

    //页面加载时 商品有属性价格,属性名称时 直接显示在speDiv中

    var new_name = '';
    var new_price = 0;
    var arr_attr_stock = [];
    var shop_price = $('.iproduct_' + goods_id).parents('li').find('.shop_price').first().text(); //获取商品的初始价格
    goods_thumb = $('.iproduct_' + goods_id).parents('li').find('img').first().attr('src');

    $('.sku-info').children("input[id^='spec_value_']").each(function() {
        if ($(this).attr('checked')) {
            attr_name = $(this).next('label').text();
            attr_price = $(this).next('label').attr('data-price');
            new_name += attr_name;
            new_price += Number(attr_price); //获取到的是string类型  得转换成number类型
            var attr_stock = $(this).attr('value');
            arr_attr_stock.push(attr_stock);
        }
    });
    new_price = Number(shop_price) + Number(new_price); //这里给属性价格 + 商品的初始价格
    $("#sku-msg").text('已选 ' + new_name);
    $(".sku-price-depends").text('￥' + new_price.toFixed(2)); // toFixed(2) 保留小数点后两位
    $("#sku-image").attr('src' + goods_thumb);
    /*属性库存处理*/
    Ajax.call('flows.php?step=post_attr_pro', 'arr_attr_stock=' + obj2str(arr_attr_stock) + '&goods_id=' + goods_id, addToCartAttrProResponse, 'POST', 'JSON', false);
    //alert(arr_attr_stock);



    //选择属性时显示的最终价格
    $('body').on('change', '.sku-info input', function(event) {
        /* Act on the event */
        var new_price = 0;
        var new_name = '';
        var arr_attr_stock = [];
        var goods_attr_number = $('#attr-stock').html();
        var shop_price = $('.iproduct_' + goods_id).parents('li').find('.shop_price').first().text(); //获取商品的初始价格
        $.each($(".sku-info input:checked"), function(index, val) {
            var attr_price = $(".sku-info input:checked").eq(index).next('label').data('price') || 0;
            var attr_name = $(".sku-info input:checked").eq(index).next('label').text();
            var attr_stock = $(".sku-info input:checked").eq(index).attr('value');
            arr_attr_stock.push(attr_stock);
            new_price += Number(attr_price); //获取到的是string类型  得转换成number类型
            new_name += attr_name;

        });
        /*属性库存处理*/
        Ajax.call('flows.php?step=post_attr_pro', 'arr_attr_stock=' + obj2str(arr_attr_stock) + '&goods_id=' + goods_id, addToCartAttrProResponse, 'POST', 'JSON', false);

        new_price = Number(shop_price) + Number(new_price); //这里给属性价格 + 商品的初始价格
        $('.sku-price-depends').text('￥' + new_price.toFixed(2)); // toFixed(2) 保留小数点后两位
        $('#sku-msg').text('已选 ' + new_name);
    });


    /**
     * 处理添加有属性价格商品到购物车的反馈信息
     */
    function addToCartAttrProResponse(result) {
        var result_message = result.message;
        if (result.error == 2) {
            return true;
        } else {
            layer.open({
                content: result_message,
                btn: ['嗯']
            });
        }
        //alert(result_message);

        //console.log(result_message);
        /*判断商品是否存在属性*/
        if (result.check_pro_attr) {
            if (result.product_number > 0) {
                $('#attr-stock').text('库存:' + Number(result.product_number));
                $('#sku-buy').attr('href', "javascript:submit_div(" + goods_id + "," + parent + ")").css('background-color', '#fd537b');
            } else {
                $('#attr-stock').text('库存:' + Number(0));
                $('#sku-buy').attr('href', "javascript:attrStock('" + result_message + "');");
            }
        } else {
            if (result.goods_number > 0) {
                $('#attr-stock').text('库存:' + Number(result.goods_number));
                $('#sku-buy').attr('href', "javascript:submit_div(" + goods_id + "," + parent + ")").css('background-color', '#fd537b');
            } else {
                $('#attr-stock').text('库存:' + Number(0));
                $('#sku-buy').attr('href', "javascript:attrStock('" + result_message + "');");
            }
        }
    }



    // mask图层
    var newMask = document.createElement("div");
    newMask.id = m;
    newMask.style.position = "absolute";
    newMask.style.zIndex = "9999";
    newMask.style.width = document.body.scrollWidth + "px";
    newMask.style.height = document.body.scrollHeight + "px";
    newMask.style.top = "0px";
    newMask.style.left = "0px";
    newMask.style.right = "0px";
    newMask.style.margin = "0 auto";
    newMask.style.background = "rgba(0,0,0,0.4)";
    document.body.appendChild(newMask);
}

// 关闭mask和新图层
function cancel_div() {
    document.body.removeChild(docEle('speDiv'));
    document.body.removeChild(docEle('mask'));

    var i = 0;
    var sel_obj = document.getElementsByTagName('select');
    while (sel_obj[i]) {
        sel_obj[i].style.visibility = "";
        i++;
    }
}

function jia() {
    var inum = $("#number").val();
    ++inum;
    $("#number").val(inum);
}

function jian() {
    var inum = $("#number").val();
    if (inum <= 1)
        return;
    --inum;
    $("#number").val(inum);

}
var goods_name = '';
var goods_thumb = '';
var goods_price = 0;

function getGoodsMeta(goods_id) {
    var box = $('.iproduct_' + goods_id).closest('li');
    goods_name = box.find('.tit').text();
    goods_thumb = box.find('img').eq(0).data('original');
    goods_price = box.find('.price b').text();
}


function showhide(id){
    fuck_team = true;
    if (id == undefined) {id = '';fuck_team=false}
    if ($('#speDiv').hasClass('show'))
    {
        $('#btn-pre-buy'+id).show();
        $('#speDiv').slideUp().css("overflow","visible");
        $('#btn-buy'+id).hide();
        $('#btn-pre-buy1').show();
        $('#btn-buy1').hide();
        $('#speBg').hide();
        if(id == 1){
            $("#btn-buy1").css("width","36%");
            $("#btn-pre-buy").css("display","block");
            $("#number").val(parseInt(1)); //商品为团购商品时 点击关闭团按钮，初始化id=number的value为 1 以防止number的值互通;
        }
        if(id == 2){
            $(".specification-box").css("display","block").siblings(".specification").css("display","none");
            $("#btn-pre-buy").css("display","block");
            $("#btn-buy").css({"width":"26.5%","display":"none"});
            $("#btn-buy1").css("display","none");
            $("#btn-buy2").css("display","none");
            $("#number").val(parseInt(1)); //商品为团购商品时 点击关闭加购按钮，初始化id=number的value为 1 以防止number的值互通;
        }
        if(id == 3){
            $("#btn-pre-buy-tuan").hide();
            $("#btn-buy").css({"display":"none","width": "30%"});
            $("#btn-pre-buy").show();
            $(".specification").hide();
            $(".specification-box").css("display","block");
            $("#number").val(parseInt(1)); //商品为单独购商品时 点击关闭立即购买按钮，初始化id=number的value为 1 以防止number的值互通;
        }
        if(id == 4){
            $(".carts-buy").width("32.5%");
            $("#btn-pre-buy").css("display","block");
            $("#btn-buy").css("display","block");
            $(".mai-5").css({"display":"none","width": "100%"});
            $(".specification-box").show();
            $("#number").val(parseInt(1)); //商品为单独购商品时 点击关闭加购按钮，初始化id=number的value为 1 以防止number的值互通;
        }
    }
    else
    {
        $('#btn-pre-buy'+id).hide();
        $('#speDiv').slideDown().css("overflow","visible");
        $('#btn-buy'+id).show();
        $('#speBg').show();
        if(id == 1){
            $("#btn-buy1").css({"width":"100%",});
            $("#btn-pre-buy").css("display","none");
        }
        if(id == 2){
            fuck_team = false; // id = 2时 这里fuck_team = false 是团购商品加购按钮激活时调用本店售价
            $(".specification-box").css("display","none").siblings(".specification").css("display","block");
            $("#btn-pre-buy").css("display","none");
            $("#btn-buy").css({"width":"26.5%","display":"block","float":"left"});
            $("#btn-pre-buy1").css("display","none");
            $("#btn-pre-buy-tuan").css("display","none");
            $("#btn-buy1").css("display","none");
            $("#btn-buy2").css("display","block").find(".ftbuy_btn").text("立即购买");
        }
        if(id == 3){
            fuck_team = false; // id = 3时 这里fuck_team = false 是立即购买按钮激活时调用本店售价
            $("#btn-pre-buy").css("display","none");
            $("#btn-buy").css({"display":"block","width": "62.5%"});
            $(".specification").css("display","none");
            $(".specification-box").css("display","none");
        }
        if(id == 4){
            fuck_team = false; // id = 4时 这里fuck_team = false 是单独购商品加购按钮激活时调用本店售价
            $(".carts-buy").width("62.5%");
            $(".specification-box").css("display","none").siblings(".specification").css("display","block");
            $("#btn-pre-buy").css("display","none");
            $("#btn-buy").css("display","none");
            $(".mai-5").css({"display":"block","width": "100%"});
            $(".specification-box").css("display","none");
        }
    }
    $("#speDiv").find('a').eq(0).attr('href', 'javascript:showhide('+id+');');
    $('#speDiv').toggleClass('show');
}