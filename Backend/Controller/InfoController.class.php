<?php 
namespace Backend\Controller;
use Think\Controller;

class InfoController extends Controller
{
	public function article_list()
	{
		$this->display();
	}
	public function article_add()
	{
		$model = M('cate');
		$data = $model ->where(array('pid' => 0))->select();
		//dump($data);die;
		$this->assign('data', $data);
		$this->display();
	}
	public function addOk()
	{
		$post = I('post.');
		$post['author'] = session('username');
		dump($post);
		
	}
	public function getSon()
	{
		$id = I('get.id');
		//dump($id);
		$modle = M('cate');
		$data = $modle->where(array('pid' => $id))->select();
		$data = json_encode($data,true);
		echo "$data";
	}
	
}



 ?>
