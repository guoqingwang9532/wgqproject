<?php 
//放置所有的方法
require 'wechat.cfg.php';

//总的类文件
class Wachat {
	private $appId;
	private $appSecret;
//给属性赋值，值是常量在配置那定义的
	public function __construct()
	{
		$this->appId = APPID;
		$this->appSecret = APPSECRET;
	}
	//curl 函数
	public function request($url,$https=true,$method='get',$data=null)
	{
	    //1.初始化url
	    $ch = curl_init($url);
	    //2.设置相关的参数
	    //字符串不直接输出,进行一个变量的存储
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    //判断是否为https请求
	    if($https === true){
	      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	    }
	    //判断是否为post请求
	    if($method == 'post'){
	      curl_setopt($ch, CURLOPT_POST, true);
	      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	    }
	    //3.发送请求
	    $str = curl_exec($ch);
	    //4.关闭连接
	    curl_close($ch);
	    //返回请求到的结果
	    return $str;
  	}
	/*获取access_token
	 *时间：2016年7月9日22:30:13
	 *author：wgq
	 */
	public function getAccessToken()
	{
		$memcache = new Memcache();
		$memcache->connect('localhost',11211);
		$data = $memcache->get('data');
		if(empty($data)){
		$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appId.'&secret='.$this->appSecret;
		$content = $this->request($url);
		$content = json_decode($content);
		$data = $content->access_token;
		//var_dump($content);
		//echo $content->access_token;
		$memcache ->set('data',$data,0,7180);
	   }
	   return "$data";
	}
	/*获得票据
	 *时间：2016年7月9日23:00:56
	 *author;wgq
	 */
	public function getTicket($tmp=0,$id=null,$id1=null)
	{
		//获得url
		$access_token = $this->getAccessToken();
		//echo $access_token;die;
		//
		 $url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$access_token;
		 /*echo "$url";die;*/
		//获得post数据
		if($tmp == 0) {
			$post = '{"expire_seconds": 604800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": '.$id.'}}}';
		} else {
			$post = '{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id":'.$id1.'}}}';
		}
		//request
		$content = $this->request($url, true, 'post',$post);
		$content = json_decode($content);
		$ticket = $content -> ticket;
		return $ticket;
	}

	/*通过票据获取二维码
	 *时间：2016年7月9日23:21:10
	 * author：wgq
	 */
	public function getQrCode()
	{
		$ticket = $this->getTicket();
		//url
		$url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$ticket;
		$content = $this->request($url);
		//生成的是个图像文件格式时.jpg，所以要保存
		//var_dump($content);
		file_put_contents('./Qr.jpg', $content);
	}

	/*自定义接口的创建
	 *时间：2016年7月9日23:31:15
	 * author：wgq
	 */
	public function createMenu()
	{
		$access_token = $this->getAccessToken();
		//url
		$url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$access_token;
		//post数据拼凑
		$data = ' {
		     "button":[
		     {	
		          "type":"click",
		          "name":"新闻",
		          "key":"news"
		      },
		      {	
		          "type":"click",
		          "name":"歌曲",
		          "key":"V1001_TODAY_MUSIC"
		      },
		      {
		           "name":"菜单",
		           "sub_button":[
		           {	
		               "type":"view",
		               "name":"搜索",
		               "url":"http://www.soso.com/"
		            },
		            {
		               "type":"view",
		               "name":"视频",
		               "url":"http://v.qq.com/"
		            },
		            {
                    "type": "pic_sysphoto", 
                    "name": "系统拍照发图", 
                    "key": "rselfmenu_1_0", 
                 	}, 
		            {
		               "type":"location_select",
		               "name":"发送位置",
		               "key":"rselfmenu_2_0"
		            }]
		       }]
		 }';
		$content = $this->request($url, true, 'post',$data);
		$content = json_decode($content);
		//var_dump($content);
		if ($content->errmsg) {
			echo "创建成功";
		} else {
			echo "创建失败，检查下吧".$content->errmsg;
		}
	}

	/*删除自定义
	 *时间：2016年7月9日23:54:46
	 * author:wgq
	 */
	public function delMenu()
	{
		$access_token = $this->getAccessToken();
		//url
		$url = 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token='.$access_token;
		$content = $this->request($url);
		$content = json_decode($content);
		if ($content->errmsg) {
			echo "删除成功";
		} else {
			echo "删除失败，错误代码是：".$content->errcode;
		}
	}

	/*接口查询
	 *时间：2016年7月10日00:02:07
	 * author：wgq
	 */
	public function showMenu()
	{
		$access_token = $this->getAccessToken();
		//url
		$url = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token='.$access_token;
		$content = $this->request($url);
		var_dump($content);
	}
}


 ?>