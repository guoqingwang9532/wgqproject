<?php 
function request($url, $https=true,$method='get',$data=null) {
//初始化
$ch = curl_init($url);
//字符串不直接输出，进行一个变量的存储
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
if ($https === true) {
  	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
}
//判断是否为post
if($method == 'post') {
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  }
//发送请求
$str = curl_exec($ch);
curl_close($ch);
return $str;
}

 ?>
