<?php


namespace App\Admin\Controllers\Business;

use App\Models\Business\BusinessClassificationThird;
use App\Models\User\Address;
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

class BusinessClassController extends AdminController implements AdminResource
{
    //表格定义
    public function grid()
    {
        $grid = new Grid(new BusinessClassificationThird());
        $grid->quickSearch(['name']);
        $grid->column('id', "ID")->sortable();
        $grid->column('name','名称');
        $grid->column('created_at','创建时间')->customValue(function ($row, $value) {
            return $value=date($value);
        });
        $grid->pageSizes([10, 20, 30]);
        return $grid;
    }

    //表单定义
    public function form($isEdit = false)
    {
        $form = new Form(new BusinessClassificationThird());
        $form->item('name','名称')->required();
        return $form;
    }

}