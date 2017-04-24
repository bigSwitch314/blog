<?php

function arr_unique($arr2d)
{
    //获取二维数组的键
    foreach($arr2d as $k=>$v){
        foreach($v as $kk=>$vv){
            $key[]=$kk;
        }
        break;
    }

    //将二维数组转换为一维数组
    foreach($arr2d as $k=>$v){
        $v=join('@#', $v);
        $temp[]=$v;
    }

    //过滤重复的值
    $temp = array_unique($temp);

    //将过滤后的一维数组转换为二维数组
    foreach($temp as $k=>$v){
        $temp[$k] = explode('@#', $v);
    }
    //还原键
    foreach ($temp as $k=>$v) {
        foreach($v as $kk=>$vv ){
            $res[$k][$key[$kk]]=$vv;
        }
    }
    return $res;

}
