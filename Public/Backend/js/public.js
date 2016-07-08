	// 1.简介式
	function createxhr  () {

		try{
			// 尝试创建ajax对象
			return new XMLHttpRequest();
		}catch (e){}

		try {
			// 如果创建标准模式不成功，使用ie低版本创建方式
			return new ActiveXObject('Mircosoft.XMLHTTP');
		}catch (e) {}

		alert("请升级浏览器");

	}