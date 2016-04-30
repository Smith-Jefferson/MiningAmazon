<?php
/**
 * Created by PhpStorm.
 * User: hello world
 * Date: 2016/4/30
 * Time: 20:23
 */
namespace Home\Controller;
use Think\Controller;
header("Content-Type:text/html;charset=utf-8");
class TrendsAmazonController extends BaseController {
    public function index(){
        $data=I('post.');
        $ITEM=M('trendsamazon');
        $where=self::getCondition($data);
        $page=getpage($ITEM,$where,self::itemnum);
        $this->items=$ITEM->where($where)->select();
        $this->page=$page->show();
        $this->display();
    }
    public static function getCondition($data){
        $where=[];
        if($data['itemname']){
            $where['Iname']=array('like','%'.$data['itemname'].'%');
        }
        if($data['category']){
            $where['Icategory']=$data['category'];
        }
        return $where;
    }
    public static function getSort(){

    }
}