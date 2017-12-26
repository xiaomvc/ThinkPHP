<?php

namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $this->display();

        //打开缓冲区，PHP默认打开了缓冲区，这里不需要再次打开
        //当再次打开ob_start时，会嵌套了两层
        //  ob_start();
        $cont = ob_get_contents();//获取缓冲区的内容
        file_put_contents('./login.html', $cont);//将缓冲区的内容保存到文件中
        //将缓冲区的内容，清空并关闭缓冲区（不输出）
        // ob_end_clean();

        //  ob_end_flush();//清空并关闭缓冲区，将缓冲区的内容发送到server服务器中
    }

    public function head()
    {
        $name = session(user_name);
        if (session(user_name)) {
            $this->assign(username, $name);
        }

        $this->display();


    }

    public function left()
    {
        $this->display();
    }

    public function right()
    {
        $this->display();
    }
}