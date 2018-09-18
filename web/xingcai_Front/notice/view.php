
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>桃花彩-官方网站</title>
    <script type="text/javascript" src="/js/nsc/jquery-1.7.min.js?v=1.16.11.8"></script>
	<style>
	body {margin:0; padding:0; font-family:"Microsoft YaHei",Helvetica, Arial, "5b8b4f53", "Microsoft YaHei", sans-serif;}
    #subContent_bet_re {padding:0;}
    #newsDetail .title {font-size:20px; line-height:26px; min-height: 35px; background: url("/images/nsc/notice_title-line.png") no-repeat center bottom; color:#694d85; padding:25px 30px 10px; margin: 0; text-align: center;}
	#newsDetail .detail {line-height:24px; color:#694d85; font-size:14px; padding:2px 15px 2px 0; margin: 10px 20px 0 30px; height: 400px; overflow-y: auto;}
    #newsDetail .detail p {margin: 0;}
    #newsDetail .detail::-webkit-scrollbar{width:8px;background:#e3ddec;border-radius:9px;-webkit-border-radius:9px;-moz-border-radius:9px;}
    #newsDetail .detail::-webkit-scrollbar-thumb{background:#a59dbc;border-radius:9px;-webkit-border-radius:9px;-moz-border-radius:9px;}
    </style>
</head>
<body>
<div class="mask_list"></div>
    <div id="newsDetail">
        <h3 class="title"><?= $args[0]['title'] ?></h3>
            <div class="detail">
			 <p> <?= nl2br($args[0]['content']) ?></p>            </div>
        </div>
        <script type="text/javascript">
        $(function(){
            if(!fnCheckIe()){
                var _scale = $(".layer",parent.parent.parent.document).attr("zoom");
                $("body").css("zoom",_scale);
            }
        });
      //判断ie
      function fnCheckIe(){
        var broswer = navigator.userAgent;
        if(broswer.indexOf("MSIE") != -1){
          return true;
        }else{
          return false;
        }
      }
    </script>
</body>
</html>
