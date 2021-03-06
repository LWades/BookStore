<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<script type="text/javascript" src="/bookstore/Public/jquery.js"></script>
<body>
<div align="center">
    <h1>搜索结果</h1>
    <a href="<?php echo U('Home/HomePage/homePage');?>">回到主页</a>
    <div id="book_details" hidden="hidden">
        <table>
            <tr>
                <td>ISBN</td>
                <td>书名</td>
                <td>价格</td>
                <td>库存</td>
                <td>状态</td>
                <td>作者</td>
                <td>简介</td>
                <td>印刷时间</td>
                <td>页数</td>
                <td>出版社</td>
            </tr>
            <tr>
                <td><span id="book_isbn"></span></td>
                <td><span id="book_name"></span></td>
                <td><span id="price"></span></td>
                <td><span id="remain_num"></span></td>
                <td><span id="book_state"></span></td>
                <td><span id="book_author"></span></td>
                <td><span id="book_intro"></span></td>
                <td><span id="book_printing_time"></span></td>
                <td><span id="book_page_num"></span></td>
                <td><span id="book_publisher"></span></td>
                <td><a href="javascript:void(0);" onclick="shopping()">加入购物车</a></td>
                <td><a href="javascript:void(0);" onclick="buy()">购买</a></td>
            </tr>
        </table>
        <a href="javascript:void(0);" onclick="back()">返回</a>
    </div>
    <div id="search_results" >
        <table>
            <tr>
                <td>ISBN</td>
                <td>书名</td>
                <td>价格</td>
                <td>库存</td>
                <td>状态台</td>
            </tr>
            <?php if(is_array($search_result)): $i = 0; $__LIST__ = $search_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sr): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($sr["book_isbn"]); ?></td>
                    <td><?php echo ($sr["book_name"]); ?></td>
                    <td><?php echo ($sr["price"]); ?></td>
                    <td><?php echo ($sr["remain_num"]); ?></td>
                    <td><?php echo ($sr["book_state"]); ?></td>
                    <td><a href="javascript:void(0);" onclick="detail('<?php echo ($sr["book_isbn"]); ?>')">查看详情</a></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
    </div>
</div>
<span id="isLogin" data-vid = "<?php echo ($user_name); ?>"></span>
</body>
<script>
    var book_id;

    function quit() {
        $.ajax({
            type : "post",
//            url : "index.php/Home/HomePage/homePageLogin",
            url : "http://localhost/bookstore/index.php/Home/HomePage/homePage",
            async : false,
            dataType : "json",
            data : {
                "info" : "quit_Login"
            },

            success:function (data) {
//                alert("ajax成功");
//                alert(data);
            },

            error:function (data) {
                alert("ajax操作失败");
            }
        })
    }

    function detail(isbn) {
//        alert(isbn);
        var result;
        $.ajax({
            type : "post",
            url : "http://localhost/bookstore/index.php/Home/HomePage/bookDetail",
            async : false,
            dataType : "json",
            data : {
                "info" : isbn
            },

            success:function (data) {
                result = eval(data);
//                alert(result["book_isbn"]);
//                alert(result["book_intro"]);
                book_id = result["book_isbn"];
            },

            error:function (data) {
                alert("ajax操作失败");
            }
        })

        document.getElementById("book_isbn").innerHTML = result["book_isbn"];
        document.getElementById("book_name").innerHTML = result["book_name"];
        document.getElementById("price").innerHTML = result["price"];
        document.getElementById("remain_num").innerHTML = result["remain_num"];
        document.getElementById("book_author").innerHTML = result["book_author"];
        document.getElementById("book_state").innerHTML = result["book_state"];
        document.getElementById("book_intro").innerHTML = result["book_intro"];
        document.getElementById("book_printing_time").innerHTML = result["book_printing_time"];
        document.getElementById("book_page_num").innerHTML = result["book_page_num"];
        document.getElementById("book_publisher").innerHTML = result["book_publisher"];

        $('#book_details').show();
        $('#search_results').hide();
    }

    function buy() {
        var vid = $('#isLogin').attr("data-vid");
        if(vid){
            var ifBuy = confirm("确认购买这本书吗？");
            var result;
            if(ifBuy){
                $.ajax({
                    type : "post",
                    url : "http://localhost/bookstore/index.php/Home/HomePage/buyBook",
                    async : false,
                    dataType : "json",
                    data : {
                        "info" : book_id
                    },

                    success:function (data) {
                        result = eval(data);
                        if(result['r'] == "success")
                            alert("购买成功");
                        else
                            alert("购买失败");
                    },

                    error:function (data) {
                        alert("ajax操作失败");
                    }
                })
            }
        }else{
            alert("请先登录");
        }
    }

    function back() {
        $('#book_details').hide();
        $('#search_results').show();
    }

    function shopping() {
        window.location.href="http://localhost/bookstore/index.php/Home/HomePage/shopping?id=" + book_id;
    }

</script>
</html>