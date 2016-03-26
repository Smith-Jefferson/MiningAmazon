<?php
namespace Home\Controller;
    use Think\Controller;
    header("Content-Type:text/html;charset=utf-8");
class IndexController extends BaseController {
    public function index(){
        $ITEM=M('items');
        $searchdata=I('post.');
        if($searchdata['searchtag']){
            $where=$this->getSearchCondition($searchdata);
        }
        $sort=$this->getSort($searchdata);
        $p=I('get.p');
        if(!$p)
        {$_SESSION['where']=$where;}
        else{
            $where=$_SESSION['where'];
        }
       $page=getpage($ITEM,$where,self::itemnum);
        $this->items=$ITEM->where($where)->order($sort)->select();
       $this->page=$page->show();
      //  $this->brands=$ITEM->distinct('Ibrand')->order('Ibrand')->getField('ibrand',true) ;
        $this->cate=$ITEM->distinct('Ifirst_cat')->order('Ifirst_cat')->getField('ifirst_cat',true) ;
        $this->display();
    }
    private function getSort($data){
        if(!($data['reviews']||$data['rate']||$data['answered'])){
            return array('reviews desc,star desc,answered desc');
        }else{
            $sort='';
            if($data['reviews']){
                $sort.=$data['reviews'].' desc';
            }
            if($data['rate']){
                if($sort)
                    $sort.=', '.$data['rate'].' desc';
                else
                    $sort.=$data['rate'].' desc';
            }
            if($data['answered']){
                if($sort)
                    $sort.=', '.$data['answered'].' desc';
                else
                    $sort.=$data['answered'].' desc';
            }
            return array($sort);
        }
    }

    private function getSearchCondition($data){
        //根据商品名搜索
        $where=[];
        if($data['itemname']){
            $where['Iname']=array('like','%'.$data['itemname'].'%');
        }
        if($data['Ifirst_cat']){
            $where['Ifirst_cat']=$data['Ifirst_cat'];
        }
        if($data['Isecond_cat']){
            $where['Isecond_cat']=$data['Isecond_cat'];
        }
        if($data['Ithird_cat']){
            $where['Ithird_cat']=$data['Ithird_cat'];
        }
        return $where;
    }
    public function getCate(){
        $condition=I('post.');
        $condition=array_filter($condition);
        $where=array(
            $condition['cate1name']=>$condition['cate1value']
        );
        if($condition['pname']){
            $where[$condition['pname']] =$condition['pcate1value'];
        }
        $name=$condition['name'];
       $cate= M('items')->where($where)->distinct($name)->order($name)->field("$name as name")->select();
        $this->ajaxReturn($cate);
    }
}