<?php


namespace App\Admin\Controllers\User;

use App\Models\User\User;
use SmallRuralDog\Admin\Components\Attrs\SelectOption;
use SmallRuralDog\Admin\Components\Form\Checkbox;
use SmallRuralDog\Admin\Components\Form\CheckboxGroup;
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

class FoodClassController extends AdminController implements AdminResource
{
    //表格定义
    public function grid()
    {
        $grid = new Grid(new User());
        $grid->quickSearch(['name']);
        $grid->column('id', "ID")->sortable();
        $grid->column('name','用户姓名');
        $grid->column('image','用户头像')->align("center")->component(Image::make()->size(50, 50));
        $grid->column('password','密码');
        $grid->column('phone','用户手机号');
        $grid->column('card','用户身份证号');
        $grid->column('carte_card','用户社保卡');
        $grid->column('medical_card','用户就诊卡');
        $grid->column('hospital_id','用户住院号id');
        $grid->column('register_id','登记号');
        $grid->column('sex','status')->align("center")->customValue(function ($row, $value) {
            return $value == 1 ? "男" : "女";
        })->component(Tag::make()->type(["男" => "success", "女" => "danger"]));
        $grid->column('http_method', "请求方式")->component(Tag::make());
        $grid->column('love','爱好')->customValue(function ($row, $value) {
            //此时的value是 roles.name的值的数组
            $re='';
            $value = substr($value, 1, strlen($value) - 1);
            $value = substr($value, 0, strlen($value) - 1);
            $va=explode(",",$value);
            foreach ($va as $k=>$v)
            {
                    $re=$re.',哈哈哈';
            }
            $re=substr($re,1);
            return $re;
        });
        $grid->column('created_at','发布时间')->customValue(function ($row, $value) {
            return $value=date($value);
        });
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
        $form->item('http_method', "请求方式")
            ->help("为空默认为所有方法")
            ->component(function () {
                return Select::make()->multiple()
                    ->block()
                    ->clearable()
                    ->options($this->getHttpMethodsOptions());
            });
        $form->item('love','爱好')->component(CheckboxGroup::make()->options([
            Checkbox::make(1,'哈哈哈'),
            Checkbox::make(2,'嘻嘻嘻'),
            Checkbox::make(3,'56165'),
            Checkbox::make(4,'1654'),
        ])->max(3))->required();
        return $form;
    }
    protected function getHttpMethodsOptions()
    {
        $model = config('admin.database.permissions_model');

        return collect($model::$httpMethods)->map(function ($item) {
            return SelectOption::make($item, $item);
        })->toArray();
    }
}