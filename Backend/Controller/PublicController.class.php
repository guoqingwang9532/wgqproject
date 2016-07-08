<?php 
namespace Backend\Controller;
use Think\Controller;

/*登录界面
 *
 *2016年7月8日12:26:12
 * 
 */
class publicController extends Controller
{
	public function login()
	{
		$this->display();
	}
	public function verify()
	{
		$config = array(
			'fontSize' => 15,
			'useCurve' => false,
			'useNoise' => false,
			'imageH'   => 41,
			'imageW'   => 100,
			'length'   => 4,
			'fontttf'  => '4.ttf'
			);
		$verify = new \Think\Verify($config);
		$verify -> entry();
	}
	//检验登录
	public function index()
	{
		$post = I('post.');
		/*dump(session());
		dump($post);die;*/
		//dump($post);die;
		//检验验证码是否正确
		$verify = new \Think\Verify();
		$rs = $verify->check($post['capache']);
		if ($rs !=true) {
			$this->error('验证码错误，请重新登录',U('login'),2);
			exit();
		} 
		//验证是否有这位用户。
		$model = M('User');
		$res = $model->where(array('username'=>$post['username'],'password'=>$post['password']))->find();
		//dump($res);
		if ($res) {
			session('uid',$res['id']);
			session('username',$res['username']);
			$arr = array(
				'id' => $res['id'],
				'lasttime' => time(),
				'count' => $res['count']+1,
				);
			$model->save($arr);
			$this->success('登录成功',U('Index/index'),2);
		} else {
			$this->error('登录失败，请检查用户名或者密码是否正确',U('login'),2);
		}
	}
	//利用ajax检测用户名
	public function search()
	{

		$name = I('get.name');
		//echo "$name";
		$model = M('User');
		//dump($model);
		$result = $model->where(array('username' => $name))->find();
		//dump($result);
		if ($result) {
			echo 1;
		} else {
			echo 0;
		}
	}
	//退出登录的
	public function logout()
	{
		session(null);
		$this->success('成功退出',U('login'),2);
	}
	public function changeUser()
	{
		session(null);
		$this->success('请等待',U('login'),2);
	}
}




 ?>