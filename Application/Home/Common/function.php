<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-3-25
 * Time: ����8:04
 */
function getpage(&$m,$where,$pagesize=10){
    $m1=clone $m;//ǳ����һ��ģ��
    $count = $m->where($where)->count();//���߲�������join�Ȳ�����������
    $m=$m1;//Ϊ������Ϊ�������߲�����ǳ����һ��ģ��
    $p=new Think\Page($count,$pagesize);
    $p->lastSuffix=false;
    $p->setConfig('header','<li class="rows">A Total Of<i> %TOTAL_ROW% </i> Records</li>');
    $p->setConfig('prev',"<span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span>");
    $p->setConfig('next',"<span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span>");
    $p->setConfig('last','%TOTAL_PAGE%');
    $p->setConfig('first','1');
    $p->setConfig('theme','%UP_PAGE% %FIRST% %LINK_PAGE% %END% %DOWN_PAGE% %HEADER%');

    $p->parameter=I('get.');

    $m->limit($p->firstRow,$p->listRows);

    return $p;
}

function substring($str,$length){
    if(strlen($str)>$length)
        return substr($str,0,$length).'...';
    else
        return $str;
}