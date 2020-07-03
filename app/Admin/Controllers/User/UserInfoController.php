<?php


namespace App\Admin\Controllers\User;

use App\Models\User\User;
use SmallRuralDog\Admin\Components\Attrs\SelectOption;
use SmallRuralDog\Admin\Components\Form\Checkbox;
use SmallRuralDog\Admin\Components\Form\CheckboxGroup;
use SmallRuralDog\Admin\Components\Form\DateTimePicker;
use SmallRuralDog\Admin\Components\Form\Radio;
use SmallRuralDog\Admin\Components\Form\RadioGroup;
use SmallRuralDog\Admin\Components\Form\Select;
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
        $grid->column('name','用户姓名');
        $grid->column('image','用户头像')->align("center")->component(Image::make()->preview()->size(100, 100));
        $grid->column('password','密码');
        $grid->column('phone','用户手机号');
        $grid->column('card','用户身份证号');
        $grid->column('carte_card','用户社保卡');
        $grid->column('medical_card','用户就诊卡');
        $grid->column('hospital_id','用户住院号id');
        $grid->column('register_id','登记号');
        $grid->column('fee','用户余额');
        $grid->column('status','状态')->align("center")->customValue(function ($row, $value) {
            return $value == 1 ? "入院" : ($value == 2 ? '出院':'退院');
        });
        $grid->column('hospitalization_date','住院时间')->customValue(function ($row, $value) {
            return $value=date($value);
        });
        $grid->column('unhospitalization_date','出院时间')->customValue(function ($row, $value) {
            return $value=date($value);
        });
        $grid->pageSizes([10, 20, 30]);
        return $grid;
    }

    //表单定义
    public function form($isEdit = false)
    {
        $form = new Form(new User());
        $form->item('name','用户姓名')->required();
        $form->item('image','用户头像')->displayComponent(Upload::make()->uniqueName());
        $form->item('password','密码')->required();
        $form->item('phone','用户手机号')->required();
        $form->item('card','用户身份证号')->required();
        $form->item('carte_card','用户社保卡')->required();
        $form->item('medical_card','用户就诊卡')->required();
        $form->item('hospital_id','用户住院号id')->required();
        $form->item('register_id','登记号')->required();
        $form->item('fee','用户余额')->required();
        $form->item('status','状态')->component(RadioGroup::make(1, [
            Radio::make(1, "入院"),
            Radio::make(2, "出院"),
            Radio::make(3, "退院"),
        ]))->required();
        $form->item('hospitalization_date','住院时间')->component(DateTimePicker::make())->required();
        $form->item('unhospitalization_date','出院时间')->component(DateTimePicker::make())->required();
        return $form;
    }

}