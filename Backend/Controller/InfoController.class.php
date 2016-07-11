<?php 
namespace Backend\Controller;
use Think\Controller;

class InfoController extends Controller
{
	public function article_list()
	{
		$model = M();
		$data = $model->field('t1.*,t2.name as cateName')->table('tp_article as t1,tp_cate as t2')->where('t1.a_cate=t2.id')->select();
	   //dump($data);die;
		$this->assign('data', $data);
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
		$post['author'] = session('uid');
		//$post['']
		$post['update_time'] = time();
		$model = M('Article');
		//dump($_FILES);die;
		if ($_FILES['file']['size']>0) {
			$config = array(
				'rootPath' => WORKING_PATH.UPLOAD_ROOT_PATH
				);
			$upload = new \Think\Upload($config);
			$res = $upload->uploadOne($_FILES['file']) ;
			//echo $upload ->getError();
			//dump($res);
			$post['picturePath'] = UPLOAD_ROOT_PATH. $res['savepath']. $res['savename'];
		    $post['picturePath'];
		}
		//dump($post);die;
		$result = $model->add($post);
		if ($result) {
			$this->success('成功了，恭喜',U('article_list'),2);
		} else {
			$this->error('失败了，梦比了吧',U('article_add'),2);
		}
	
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

	public function delAll()
	{
		$id = I('get.ids');
		$model = M('Article');
		$rs = $model->delete($id);
		if ($rs) {
			$this->success('成功删除',U('article_list'),2);
		} else {
			$this->error('删除失败',U('article_list'),2);
		}
	}
	//单个删除
	public function delOne()
	{
		$id = I('get.id');
		//dump($id);
		$model = M('Article');
		$rs = $model->delete($id);
		if ($rs) {
			$this->success('成功删除或者下架',U('article_list'),2);
		} else {
			$this->error('失败',U('article_list'),2);
		}
	}
	public function haha()
	{

		$id = I('get.id');
		//echo "$id";die;
		$model = M('Article');
		$nu = $model->find($id);
		//dump($nu);
		$num = $nu['isold'];
		//echo $num;die;
		if ($num == 0) {
			$model ->save(array('id' => $id,'Isold' =>1));
			$this ->success('下架成功',U('article_list'),1);
		} else {
			$model ->save(array('id' => $id,'Isold' =>0));
			$this ->success('上架成功',U('article_list'),1);
		}

	}
}



 ?>
