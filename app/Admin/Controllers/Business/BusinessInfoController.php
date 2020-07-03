<?php


namespace App\Admin\Controllers\Business;

use App\Models\Business\Business;
use App\Models\Business\BusinessClassificationThird;
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

class BusinessInfoController extends AdminController implements AdminResource
{
    //表格定义
    public function grid()
    {
        $grid = new Grid(new Business());
        $grid->quickSearch(['name','user_title']);
        $grid->column('id', "ID")->sortable();
        $grid->column('user_title','商家名称');
        $grid->column('user_name','账户');
   //     $grid->column('password','密码');
        $grid->column('name','商家联系人');
        $grid->column('phone','商家手机号');
//        $grid->column('business_phone','店铺手机号');
//        $grid->column('address','商家地址');
//        $grid->column('consumption','人均消费');
//        $grid->column('cost','配送费用');
//        $grid->column('body','店铺介绍');
        $grid->column('class', "商家分类")->customValue(function ($row, $value) {
//            foreach ($value as $k=>$v)
//            {
//                $va=BusinessClassificationThird::find($v);
//                $value[$k]=$va->name;
//            }
            return $value;
        })->component(function () {
            return Tag::make();
        });

        $grid->column('fee','线上余额');
        $grid->column('to_fee','线下余额');
        $grid->column('area','区域')->align("center")->customValue(function ($row, $value) {
            return $value == 1 ? "院外" : '院内';
        });
        $grid->column('bonus_status','优惠券设置')->align("center")->customValue(function ($row, $value) {
            return $value == 1 ? "启用" : '禁用';
        });
        $grid->column('sales','月销量');
        $grid->column('shop_image','店铺形象图')->align("center")->component(Image::make()->preview()->size(50, 50));
        $grid->column('Business_license','营业执照图')->align("center")->component(Image::make()->preview()->size(50, 50));
        $grid->column('user_status','账户状态')->align("center")->customValue(function ($row, $value) {
            return $value == 1 ? "启用" : '禁用';
        });
        $grid->column('status','商家状态')->align("center")->customValue(function ($row, $value) {
            return $value == 0 ? "审核中" : ($value == 1 ? '审核成功':'审核失败');
        });
        $grid->column('created_at','创建时间')->customValue(function ($row, $value) {
            return $value=date($value);
        });
        $grid->pageSizes([10, 20, 30]);
        return $grid;
    }

    //表单定义
    public function form($isEdit = false)
    {
        $form = new Form(new Business());
        $form->item('user_title','商家名称');
        $form->item('user_name','账户');
        $form->item('password','密码');
        $form->item('user_status','账户状态')->component(RadioGroup::make(1, [
            Radio::make(0, "禁用"),
            Radio::make(1, "启用"),
        ]));
        $form->item('name','商家联系人');
        $form->item('phone','商家手机号');
        $form->item('business_phone','店铺手机号');
        $form->item('address','商家地址');
        $form->item('consumption','人均消费');
        $form->item('cost','配送费用');
        $form->item('body','店铺介绍');
        $form->item('status','商家状态')->component(RadioGroup::make(1, [
            Radio::make(0, "禁用"),
            Radio::make(1, "启用"),
        ]))->required();
        $form->item('class', "商家分类")
            ->component(function () {
                return Select::make()->multiple()
                    ->block()
                    ->clearable()
                    ->options($this->getClass());
            });
        $form->item('fee','线上余额');
        $form->item('to_fee','线下余额');
        $form->item('area','区域')->component(RadioGroup::make(1, [
            Radio::make(0, "院内"),
            Radio::make(1, "院外"),
        ]));
        $form->item('bonus_status','优惠券设置')->component(RadioGroup::make(1, [
            Radio::make(0, "禁用"),
            Radio::make(1, "启用"),
        ]));
        $form->item('sales','月销量');
        $form->item('shop_image','店铺形象图')->displayComponent(Upload::make()->image()->uniqueName()->drag());
        $form->item('Business_license','营业执照图')->displayComponent(Upload::make()->image()->uniqueName()->multiple()->limit(3)->drag());
        return $form;
    }
    public function getClass(){
        return collect(BusinessClassificationThird::get())->map(function ($item) {
            return SelectOption::make($item->id, $item->name);
        })->toArray();
    }

}