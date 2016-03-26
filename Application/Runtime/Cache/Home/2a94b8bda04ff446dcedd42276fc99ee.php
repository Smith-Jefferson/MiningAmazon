<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<!--<link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">-->
<script src="https://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
<!--<script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>-->
<link rel="stylesheet" href="/miningamazon/Application/Home/Public/css/bootstrap.css">
<script src="/miningamazon/Application/Home/Public/js/bootstrap.js"></script>
<script src="/miningamazon/Application/Home/Public/js/umd/boot3-tp.js"></script>
<link rel="stylesheet" href="/miningamazon/Application/Home/Public/css/rateit.css">
<script src="/miningamazon/Application/Home/Public/js/jquery.rateit.min.js"></script>
<link rel="Bookmark" href="/miningamazon/Application/Home/Public/img/bitbug_favicon.ico">
<link rel="Shortcut Icon" href="">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <style>
        .pagination > li > b{
            position: relative;
            float: left;
            padding: .5rem .75rem;
            margin-left: -1px;
            line-height: 1.5;
            color: #ccc;
            text-decoration: none;
        }
        .pagination .rows{
            margin-top: 53px;
            display: block;
        }
        .a-text-strike{
            text-decoration: line-through!important;
        }
        .popover {
            position: absolute;
            top: 115;
            left: 0;
            z-index: 1060;
            display: none;
            max-width: 2000px;
            padding: 1px;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: 1.42857143;
            text-decoration: none;
            text-shadow: none;
            text-transform: none;
             }
    </style>
</head>

<body>
<div class="collapse" id="exCollapsingNavbar">
    <div class="bg-inverse p-a ">
        <h4>挖掘技术哪家强，中国山东找蓝翔</h4>
        <span class="text-muted">深度挖掘亚马逊产品销售趋势</span>
    </div>
</div>
<nav class="navbar navbar-light bg-faded">
    <ul class="nav navbar-nav">
        <a class="navbar-toggler navbar-brand" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar" href="jacascript:void(0)">
            &#9776;
        </a>
        <li class="nav-item active">
            <a class="nav-link" href="<?php echo U('Index/index');?>">首页<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="www.google.com">分类报告</a>
        </li>
    </ul>
    <form class="form-inline navbar-form pull-right" method="post" action="<?php echo U('Index/index');?>">
        <input class="form-control" type="text" placeholder="product name" name="itemname">
        <input value="1" type="hidden" name="searchtag">
        <button class="btn btn-success-outline" type="button">Search</button>
    </form>
</nav>
<div class="container">
    <div style="text-align: right;padding-top: 20px">
        <form method="post" action="<?php echo U('Index/index');?>" class="form-inline" style="font-size: 17px">
            <input value="1" type="hidden" name="searchtag">
            <div style="display: inline-block">
                <label>Product Sort By:</label><span><input type="checkbox" name="reviews" value="reviews" class="checkbox">Reviews</span>
                <span><input type="checkbox" name="rate" value="rate" class="checkbox">Rate</span>
                <span><input type="checkbox" name="answered" value="answered" class="checkbox">Answered</span>
            </div>
            <div style="display: inline-block">
                <label> Cate:</label>
                <select name="Ifirst_cat" id="cate1" class="form-control form-control-sm">
                    <option value=""></option>
                    <?php if(is_array($cate)): foreach($cate as $key=>$name): ?><option value="<?php echo ($name); ?>"><?php echo ($name); ?></option><?php endforeach; endif; ?>
                </select>
                <select name="Isecond_cat" id="cate2" class="form-control form-control-sm" style="width: 140px"></select>
                <select name="Ithird_cat" id="cate3" class="form-control form-control-sm" style="width: 140px"></select>
            </div>
            <div style="display: inline-block">
                <!--<button type="button" class="btn btn-sm btn-success-outline" data-container="body" id="brandbtn" data-toggle="popover">-->
                    <!--Brand</button>-->
                <button type="submit" class="btn btn-sm btn-info" data-container="body">
                    Go</button>
            </div>
            <div style="display: none" id="brandsection">
               <?php if(is_array($brands)): foreach($brands as $key=>$brand): ?><span><?php echo ($brand); ?></span><?php endforeach; endif; ?>
            </div>
        </form>
    </div>
    <hr/>
    <div class="card-columns">
        <?php if(is_array($items)): foreach($items as $key=>$item): if($item['iimg_url']): ?><div class="card">
                    <img class="card-img-top" data-src="holder.js/100%x160/" alt="Card image cap" src="<?php echo ($item["iimg_url"]); ?>">
                    <div class="card-block">
                        <h5 class="card-title">
                            <a href="<?php echo ($item["iurl"]); ?>" target="_blank"><?php echo ($item["iname"]); ?></a> </h5>
                        <p class="card-text">
                            <small>
                                <div class="rateit" data-rateit-value="<?php echo ($item["star"]); ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                                <span><?php echo ($item["reviews"]); ?>&nbsp;custormer reviews</span>
                                <?php if($item['answered'] != 'null'): ?><span><?php echo ($item["answered"]); ?>&nbsp;answered questions</span><?php endif; ?>
                                <span style="display: block">
                                    <?php if($item['save']): ?>Price:<span class="a-text-strike"><?php echo ($item["iprice"]); ?></span>
                                        Sale:<?php echo ($item["sale"]); ?>
                                       You save:<?php echo ($item["save"]); ?>
                                        <?php else: ?>
                                        Price:<?php echo ($item["iprice"]); endif; ?>
                                </span>
                            </small>
                        </p>
                        <p class="card-text">
                            <?php if($item['idescription']): ?>｛$item['idescription']|substring=###,1000｝
                                <?php else: ?>
                                <?php echo (substring($item['detail'],1000)); endif; ?>
                        </p>
                        <p class="card-text">
                            <small>
                                <span>Soled by:<?php echo ($item["seller"]); ?></span>
                                <span><i style="color:orangered;">|</i> Shipped by:<?php echo ($item["shipper"]); ?>
                                &nbsp;<?php echo ($item["shipping"]); ?>
                                </span>
                                <?php if($item['stock']): ?><span style="display: block"><?php echo ($item["stock"]); ?>&nbsp; left in stock
                                    <i style="color:orangered;">|</i>
                                    Brand:<span class="label label-default"><?php echo ($item["ibrand"]); ?></span></span><?php endif; ?>
                                <span style="display: block;">
                                    Cate:<?php echo ($item["ifirst_cat"]); ?>><?php echo ($item["isecond_cat"]); ?>><?php echo ($item["ithird_cat"]); ?>
                                </span>
                            </small>
                        </p>
                    </div>
                </div>
                <?php else: ?>
                <div class="card card-block card-inverse card-info  text-center">
                    <blockquote class="card-blockquote">
                        <p>
                            <?php if($item['idescription']): ?>｛$item['idescription']|substring=###,1000｝
                                <?php else: ?>
                                <?php echo (substring($item['detail'],1000)); endif; ?>
                        </p>
                        <footer>
                            <small>

                                <cite title="Source Title">{item.iname}</cite>
                            </small>
                        </footer>
                    </blockquote>
                </div><?php endif; endforeach; endif; ?>





    </div>
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: right">
            <nav>
                <?php echo ($page); ?>
            </nav>

        </div>
    </div>

</div>
</body>
<script>
    $(function(){
        $('#brandbtn').popover({
            trigger: 'manual',
            placement:'bottom',
            container: 'body',
            title:'You can Choose The Brand Name As Follows',
            content:showBrand(),
            html:'true'
        }).on("mouseenter", function () {
            var _this = this;
            $(this).popover("show");
            $(this).siblings(".popover").on("mouseleave", function () {
                $(_this).popover('hide');
            });
        }).on("mouseleave", function (){
            var _this = this;
            setTimeout(function () {
                if (!$(".popover:hover").length) {
                    $(_this).popover("hide")
                }
            }, 100);
        });
    });

    function showBrand(){
        debugger;
        var brandTable=$("#brandsection").html();
        return brandTable;
    }
    $("#cate1,#cate2,#cate3").change(function(){
        debugger;
        var select=$(this).next();
        if(!select)
            return false;
        var cate1value=$(this).val();
        var cate1name=$(this).attr('name');
        var name=select.attr('name');
        var preselect=$(this).prev();
        var pcate1value=preselect.val();
        var pname=preselect.attr('name');
        $.ajax({
            url:"<?php echo U('Index/getCate');?>",
            type:"post",
            data:{cate1value:cate1value,cate1name:cate1name,name:name,pcate1value:pcate1value,pname:pname},
            success:function(data){
                debugger;
                var str='<option value></option>';
                $.each(data,function(i,n){
                    str+="<option value='"+ n.name+"'>"+n.name+"</option>";
                });
                select.html(str);
            }
        });
    })
</script>
</html>