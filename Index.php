<?php
namespace app\index\controller;

use think\Controller;

use think\facade\Request;

class Index extends controller
{
    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5.1<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }

    public function home()
    {
        //判断是否登录
        //判断sessionid是否一致
        //不一致就清空session
        $session_id = db('user')->where('username', session('username'))->value('last_session_id');
        // dump($session_id);die();
        if(cookie('PHPSESSID') !== $session_id){
            echo '账号在别处登录,被迫下线';
            session('username',null);
        }
        //如果没有登录跳转到登录页面
        if(session('?username'))
        {
           $this->assign('username',session('username'));
           return $this->fetch();
        }
        $this->error('未登录,请登录','login');
    }

    public function login()
    {
        if (request()->isGet())
        {
               return $this->fetch();
        }
        //接收表单参数
        $data = Request::post();
        // dump($data);
        $rs = db('user')->where('username',$data['username'])->where('password',$data['password'])->find();
        //验证用户信息
        if($rs)
        {
            session('username', $data['username']);
            db('user')->where('username',$data['username'])->setField('last_session_id',session_id());
            $this->success('登录成功', 'home');
        }
        $this->error('登录失败');

    }

    public function logout()
    {
        session('username',null);
        cookie('PHPSESSID',null);
    }
}
