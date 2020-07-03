<?php


namespace App\Admin\Controllers\User;

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

class UserAddressController extends AdminController implements AdminResource
{
    //表格定义
    public function grid()
    {
        $grid = new Grid(Address::with('user')->getModel());
        $grid->quickSearch(['name']);
        $grid->column('id', "ID")->sortable();
        $grid->column('name','姓名');
        $grid->column('phone','手机号');
        $grid->column('address','地址');
        $grid->column('status','是否默认')->align("center")->customValue(function ($row, $value) {
            return $value == 1 ? "是" : '否';
        })->component(Tag::make()->type(["是" => "success", "否" => "danger"]));
        $grid->column('user.name','用户');
        $grid->column('created_at','发布时间')->customValue(function ($row, $value) {
            return $value=date($value);
        });
        $grid->pageSizes([10, 20, 30]);
        return $grid;
    }

    //表单定义
    public function form($isEdit = false)
    {
        $model=User::class;
        $form = new Form(Address::with('user')->getModel());
        $form->item('name','姓名')->required();
        $form->item('phone','手机号')->required();
        $form->item('address','地址')->required();
        $form->item('user_id','用户')->component(Select::make('请选择')->options(function () use ($model) {
            return $model::query()->get()->map(function ($item) {
                return SelectOption::make($item->id, $item->name);
            });
        }))->required();
        $form->item('status','是否默认')->component(RadioGroup::make(1, [
            Radio::make(0, "否"),
            Radio::make(1, "是"),
        ]))->required();
        return $form;
    }

}