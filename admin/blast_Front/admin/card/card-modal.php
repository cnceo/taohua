<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<input type="hidden" value="<?=$this->user['username']?>" />
<link rel="stylesheet" type="text/css" href="/skin/admin/layout.css" media="all" />
<link type="text/css" rel="stylesheet" href="/skin/js/jqueryui/skin/smoothness/jquery-ui-1.8.23.custom.css" />
<script src="/skin/js/jquery-1.7.2.min.js"></script>
<script src="/skin/js/jqueryui/jquery.ui.core.js"></script>
<script src="/skin/js/jqueryui/jquery.ui.datepicker.js"></script>
<script src="/skin/js/jqueryui/i18n/jquery.ui.datepicker-zh-CN.js"></script>
</head>
<body>
<form name="addCards" action="/index.php/Card/updateCards" enctype="multipart/form-data" method="POST">
    <table class="tablesorter left" cellspacing="0" width="100%">
    <thead> 
        <tr> 
            <td>项目</td> 
            <td>值</td> 
        </tr> 
    </thead>
    <tbody>
        <tr> 
            <td>面值（元）</td> 
            <td><input type="text" name="price"  value=""/></td>
        </tr>
        <tr> 
            <td>数量</td> 
            <td><input type="text" name="num"  value=""/></td>
        </tr>
    </tbody> 
    </table>
</form>
</body>
</html>