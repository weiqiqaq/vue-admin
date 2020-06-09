<?php


namespace App\Admin\Controllers\User;

use App\Models\User\User;
use SmallRuralDog\Admin\Components\Form\Checkbox;
use SmallRuralDog\Admin\Components\Form\CheckboxGroup;
use SmallRuralDog\Admin\Components\Form\Radio;
use SmallRuralDog\Admin\Components\Form\RadioGroup;
use SmallRuralDog\Admin\Components\Form\Upload;
use SmallRuralDog\Admin\Components\Form\WangEditor;
use SmallRuralDog\Admin\Components\Grid\Image;
use SmallRuralDog\Admin\Components\Grid\Tag;
use SmallRuralDog\Admin\Components\Widgets\Divider;
use SmallRuralDog\Admin\Controllers\AdminController;
use SmallRuralDog\Admin\Controllers\AdminResource;
use SmallRuralDog\Admin\Form;
use SmallRuralDog\Admin\Grid;

class UserInfoController extends AdminController implements AdminResource
{
    //表格定义
    public function grid()
    {
        $grid = new Grid(new User());
        $grid->quickSearch(['name']);
        $grid->column('id', "ID")->sortable();
        $grid->column('name','名称');
        $grid->column('image','图片')->align("center")->component(Image::make()->size(50, 50));
        $grid->column('body','简介');
        $grid->column('sex','年龄')->align("center")->customValue(function ($row, $value) {
            return $value == 1 ? "男" : "女";
        })->component(Tag::make()->type(["男" => "success", "女" => "danger"]));
//        $grid->column('love','爱好')->customValue(function ($row, $value) {
//            //此时的value是 roles.name的值的数组
//            $row='';
//            strstr($value,'1') && $row=$row.',哈哈哈';
//            strstr($value,'2') && $row=$row.',嘻嘻嘻';
//            $row=substr($row,1);
//            return $row;
//        });
        $grid->column('created_at','发布时间');
        $grid->pageSizes([10, 20, 30]);
        return $grid;
    }

    //表单定义
    public function form($isEdit = false)
    {
        $form = new Form(new User());
        $form->item('name','名称')->inputWidth(400)->topComponent(Divider::make("用户信息"))->required();
        $form->item('image','图片')->displayComponent(Upload::make()->path('avatar')->uniqueName());
        $form->item('body','简介')->component(WangEditor::make()->style("height:200px;"))->required();
        $form->item('sex','年龄')->component(RadioGroup::make(1, [
            Radio::make(1, "男"),
            Radio::make(2, "女"),
        ]))->required();

        return $form;
    }
}