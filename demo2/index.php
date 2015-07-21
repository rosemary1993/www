<!DOCTYPE html>
<html>
<head>
    <meta chartset='gbk'/>
	<title></title>
	<script type="text/javascript">
	function $(id)
	{
		var object = document.getElementById(id);
		return object;
	}
	var str='';
	
	function addParams()
	{
		var i=1;
		str+= "参数名： <input type='text' name=key />"+"参数值：<input type='text' name='value'>"+"<br/>";
		$('paramter').innerHTML = str;
		i++;
	}
	function sub(id)
	{
		var url = $("interface").value;
		if(id=='post')
		{		  
		$('form1').setAttribute("method","post");
		$('form1').setAttribute("action",url);
         // document.myform.submit();
		}
		else
		{
        $('form1').setAttribute("method","get");
		$('form1').setAttribute("action",url);
        document.myform.submit();
		}

	}
</script>
</head>

<body>
测试接口：<input type='text' id='interface' style="width: 300px"/>
<form id='form1' name='myform' action=''>
<input type='button' id='add' value="添加参数" onclick="addParams()" />
<div id="paramter">
</div>

<input type='button' id='post' value="post" onclick="sub(this.id)" />
<input type='button' id='get' value="get" onclick="sub(this.id)" />
</form>
</body>

</html>