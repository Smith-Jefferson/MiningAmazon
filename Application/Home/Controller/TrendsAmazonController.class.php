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
        $data=array_merge($data,I('get.'));
        $ITEM=M('trendsamazon');
        $this->cate=$ITEM->distinct(true)->getField('icategory',true);
        $where=self::getCondition($data);
        $p=I('get.p');
        if(!$p)
        {
            $_SESSION['where']=$where;
        }

        else{
            $where=$_SESSION['where'];
        }
        $page=getpage($ITEM,$where,self::itemnum);
        $this->items=$ITEM->where($where)->order('rank')->select();
        $this->page=$page->show();
        //将条件在页面再现
        if(count($where['rank'][1])==2){
            $this->beg=$where['rank'][1][0];
            $this->end=$where['rank'][1][1];
        }else{
            $this->beg=$where['rank'][1];
            $this->end=$where['rank'][1];
        }
        $this->icate=$where['Icategory'];
        $this->display();
    }
    public static function getCondition($data){
        $where=[];
        if($data['itemname']){
            $where['Iname']=array('like','%'.$data['itemname'].'%');
        }
        if($data['category']){
            $where['Icategory']=str_replace('+',' ',$data['category']);
        }
        if($data['beg']&& $data['end']){
            $where['rank']=array('between',array($data['beg'],$data['end']));
        }else{
            if($data['beg']){
                $where['rank']=array('egt',$data['beg']);
            }
            if($data['end']){
                $where['rank']=array('elt',$data['end']);
            }
        }

        return $where;
    }
    public static function getSort(){

    }

    public function productDetail(){
        $asin=I('asin');
        $id=I('id');
        $this->product=M('trendsamazon')->where(array('id'=>$id))->find();
        $MODEL=M('trendsdetail');
        $ranks=$MODEL->where(array('asin'=>$asin))->field(array('inserttime','best_sellers_rank','price','sellers_count','review_count','star4','star5'))->limit(30)->order('inserttime')->select();
        $temp=0;
        $time='';$best_sellers_rank='';$price='';$sellers_count='';$review_count='';$star4='';$star5='';
        $count=count($ranks);
        foreach($ranks as $k=> $v){
            if($temp!=$v['inserttime']){
                $time.='\''.date('m-d',substr($v['inserttime'],0,10)).'\'';
                $best_sellers_rank.=$v['best_sellers_rank'];
                $price.=$v['price'];
                $sellers_count.=$v['sellers_count'];
                $review_count.=$v['review_count'];
                $star4.=$v['star4'];
                $star5.=$v['star5'];
                if($k!=$count-1){
                    $time.=',';
                    $best_sellers_rank.=',';
                    $price.=',';
                    $sellers_count.=',';
                    $review_count.=',';
                    $star4.=',';
                    $star5.=',';
                }
            }
        }
        $this->time=$time;
        $this->best_sellers_rank=$best_sellers_rank;
        $this->price=$price;
        $this->sellers_count=$sellers_count;
        $this->review_count=$review_count;
        $this->star4=$star4;
        $this->star5=$star5;
       $this->assign('detail',M('trendsdetail')->where(array('asin'=>$asin))->find())->display() ;
    }
}