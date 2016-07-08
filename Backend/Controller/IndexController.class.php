<?php
namespace Backend\Controller;
use Think\Controller;
use Org\Net\IpLocation;
class IndexController extends Controller {
    public function index(){
       $this->display();
    }
    public function welcome()
    {
    	header('Content-Type:text/html;Charset=utf-8');
    	$model = M('User');
    	//echo session('uid');
    	$data = $model->where(session('uid'))->find();
    	//dump($data);die;
    	//分配到模板
    	/*$this->assign('data',$data);
    	$this->display();*/
    	//echo $data['lastip'];
    	$ipNum = long2ip($data['lastip']);
    	//echo $ipNum;die;
    	//这部是把ip转化为实际地址
    	$class = new IpLocation('qqwry.dat');
        //dump($class);die;
    	$addres = $class ->getlocation('114.249.248.112');
        //dump($addres);
         $addres2 = iconv('gbk', 'utf-8', $addres['country']);
    	 $addres = iconv('gbk', 'utf-8', $addres['area']);
    	 $model->save(array('id' =>$data['id'],'city'=>$addres2));
         //dump($addres);die;
    	 $this->assign('data',$data);
    	 $this->assign('addres',$addres);
    	 $this->assign('addres2',$addres2);
    	 $this->assign('ip',$ipNum);

    	 //$this->display();
         //这步是调用天气借口
         $weather = $this->weather($addres2);
         $weatherDate = $weather->results->result[0];
         $detailWeather = $weatherDate->weather.'&emsp;'.$weatherDate->wind.'&emsp;'.$weatherDate->temperature;
         //dump($detailWeather);
         $this->assign('detailWeather', $detailWeather);
         $this->display();
    	
    }
    public function weather($city)
    {
        $url = 'http://api.map.baidu.com/telematics/v2/weather?location='.$city.'&ak=B8aced94da0b345579f481a1294c9094';
        $content = request($url);
        //dump($content);
        $res = simplexml_load_string($content);
        //dump($res->results->result[0]->weather);
        return $res;
    }
}