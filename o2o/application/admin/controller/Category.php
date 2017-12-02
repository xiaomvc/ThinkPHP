<?php

namespace app\admin\controller;


use think\Request;

class Category extends Base
{
    private $obj;

    /**
     * 初始化
     */
    function _initialize()
    {
        $this->obj = model('category');
    }

    /**
     * 分类信息的展示
     * @return mixed
     */
    function show()
    {
        $parentId = input('parentId', 0, 'intval');
        $data = ['parent_id' => $parentId];
        //验证字段是否符合规范(返回的是数组或null)
        $controller = $this->request->controller();
        $validate = $this->obj->validateInfo($controller, 'show', $data);
        if (!empty($validate)) {
            $this->error($validate);
            exit;
        }

        $category = $this->obj->getCategory($parentId);//获取栏目信息

        return $this->fetch("", ['category' => $category]);
    }

    /**
     * 分类信息的修改
     * @return mixed
     */
    function edit()
    {
        //修改分类信息
        if (input("post.")) {
            $id = input('id');
            $name = input('name');
            $parentId = input('parent_id');
            //若是同一级别的，就把父级改为0（顶级）
            if ($id === $parentId) {
                $parentId = 0;
            }
            //整理数据
            $data = [
                'id' => $id,
                'parent_id' => $parentId,
                'name' => $name
            ];

            //验证信息是否规范

            //验证字段是否符合规范(返回的是数组或null)
            $controller = $this->request->controller();
            $validate = $this->obj->validateInfo($controller, 'edit', $data);
            if (!empty($validate)) {
                $this->error($validate);
                exit;
            }
            //更改的数据中不能有ID值，把数组中的ID值删除
            unset($data['id']);


            $result = $this->obj->save($data, ['id' => $id]);
            if ($result) {
                $this->success("更新成功", "show", "", 2);
            } else {
                $this->error('修改失败', 'show', "", 2);
            }
            exit();
        }

        //获取修改栏目的信息
        $id = input('id', 0, 'intval');
        $data = ['id' => $id];
        //验证字段是否符合规范(返回的是数组或null)
        $controller = $this->request->controller();
        $validate = $this->obj->validateInfo($controller, 'editInfo', $data);
        if (!empty($validate)) {
            $this->error($validate);
            exit;
        }

        $dateInfo = $this->obj->find($id);
        //获取栏目分类信息
        $type = $this->obj->getCategory();

        return $this->fetch("", ['category' => $dateInfo, 'type' => $type]);
    }

    /**
     * 添加分类信息
     * @return mixed
     */
    function add()
    {
        if (input('post.')) {
            $parentId = input('parent_id');
            $name = input("name");
            $data = [
                'parent_id' => $parentId,
                'name' => $name,
                'status' => -1//待审状态
            ];
            //添加前对数据进行验证
            //验证字段是否符合规范(返回的是数组或null)
            $controller = $this->request->controller();
            $validate = $this->obj->validateInfo($controller, 'add', $data);
            if (!empty($validate)) {
                $this->error($validate);
                exit;
            }
            //判断是否添加成功
            $result = $this->obj->save($data);
            if ($result) {
                $this->success("添加成功", "add", "", 2);
            } else {
                $this->error('添加失败', 'add', "", 2);
            }
            exit;
        }
        //获取顶级栏目列表
        $category = $this->obj->getCategory();

        return $this->fetch("", ['category' => $category]);
    }

    /**
     * 信息的逻辑删除
     */
    function del()
    {
        if (input("post.")) {
            $id = input('id');

            //删除前(修改状态前)，对字段进行验证
            $data = [
                'id' => $id,
                'status' => 0
            ];

            //验证字段是否符合规范(返回的是数组或null)
            $controller = $this->request->controller();
            $validate = $this->obj->validateInfo($controller, 'del', $data);
            if (!empty($validate)) {
                $this->error($validate);
                exit;
            }
            //获取控制器
            $controller = Request()->controller();
            $result = $this->obj->status($data, $controller);
            //判断是否成功
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * 更改状态信息
     */
    function status()
    {
        $data = [
            'id' => input('id'),
            'status' => input('status')
        ];
        //验证字段是否符合规范(返回的是数组或null)
        $controller = $this->request->controller();
        $validate = $this->obj->validateInfo($controller, 'status', $data);
        if (!empty($validate)) {
            $this->error($validate);
            exit;
        }
        //ID值为主键
        //获取不同的控制器
        $controller = request()->controller();
        $result = $this->obj->status($data, $controller);

        if ($result == 1) {
            $this->success("状态更新成功", "show", "", 2);
        } else {
            $this->error("状态更新失败", "show", "", 2);
        }
    }

}