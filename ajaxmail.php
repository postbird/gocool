<?php
/**
 * Author: Postbird
 * Date  : 2017/3/30
 * time  : 0:20
 * Site  : www.ptbird.cn
 * There I am , in the world more exciting!
 */

require_once './sendmail.php';

$name=trim($_POST['inputName']);
$content=trim($_POST['inputContent']);
$type=trim($_POST['inputType']);
$contact=trim($_POST['inputContact']);
if(strlen($name)==0 || strlen($content)==0 || strlen($type)==0 || strlen($contact)==0){
    $data=[
        'code'=>400,
        'status'=>'error',
        'msg'=>'内容必须填写完整!'
    ];
    echo json_encode($data);
    return;
}else{
    $title=$name." 在xxx网站留言啦!";
    $body="姓名: ".$name."<br><br>"."联系方式：".$type." --- ".$contact."<br><br>";
    $body=$body."留言内容: ".$content."<br><br>";

    $body=$body."<hr>邮件来自系统自动发送,请勿回复!—— Powered by Postbird";
    $url='xxx65104@qq.com';
//    $url='xxxxxx@yeah.net';
    $flag = sendMail($url,$title,$body);
    if($flag){
        $data=[
            'code'=>200,
            'status'=>'ok',
            'msg'=>'留言成功,我们会尽快联系您!'
        ];
        echo json_encode($data);
    }else{
        $data=[
            'code'=>400,
            'status'=>'error',
            'msg'=>'留言失败,请重试!'
        ];
        echo json_encode($data);
    }
}
