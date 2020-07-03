<?php


namespace App\Admin\Controllers;

use App\Models\User\Address;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SmallRuralDog\Admin\Auth\Database\Administrator;
use SmallRuralDog\Admin\Components\Antv\Area;
use SmallRuralDog\Admin\Components\Antv\Column;
use SmallRuralDog\Admin\Components\Antv\Line;
use SmallRuralDog\Admin\Components\Antv\StepLine;
use SmallRuralDog\Admin\Components\Attrs\SelectOption;
use SmallRuralDog\Admin\Components\Form\Checkbox;
use SmallRuralDog\Admin\Components\Form\CheckboxGroup;
use SmallRuralDog\Admin\Components\Form\DateTimePicker;
use SmallRuralDog\Admin\Components\Form\Input;
use SmallRuralDog\Admin\Components\Form\Radio;
use SmallRuralDog\Admin\Components\Form\RadioGroup;
use SmallRuralDog\Admin\Components\Form\Select;
use SmallRuralDog\Admin\Components\Form\Upload;
use SmallRuralDog\Admin\Components\Form\WangEditor;
use SmallRuralDog\Admin\Components\Grid\Image;
use SmallRuralDog\Admin\Components\Grid\Tag;
use SmallRuralDog\Admin\Components\Widgets\Alert;
use SmallRuralDog\Admin\Components\Widgets\Card;
use SmallRuralDog\Admin\Components\Widgets\Divider;
use SmallRuralDog\Admin\Controllers\AdminController;
use SmallRuralDog\Admin\Controllers\AdminResource;
use SmallRuralDog\Admin\Form;
use SmallRuralDog\Admin\Grid;
use SmallRuralDog\Admin\Layout\Content;
use SmallRuralDog\Admin\Layout\Row;
use Illuminate\Support\Facades\URL;

class UserController extends AdminController
{
    //表格定义
    public function index($isEdit=false)
    {
        $user = Auth::guard('admin')->user();
     //   $userModel = Administrator::find($user->id);
     //   return header('location:'.URL::current().'admin/auth/users/'.$user->id.'/edit/');
        return redirect('admin-api/auth/users/'.$user->id.'/edit/');
//        $permissionModel = config('admin.database.permissions_model');
//        $roleModel = config('admin.database.roles_model');
//        $form = new Form($userModel->getModel());
//        $userTable = config('admin.database.users_table');
//        $connection = config('admin.database.connection');
//        $form->item('username', '用户名')
//            ->serveCreationRules(['required', "unique:{$connection}.{$userTable}"])
//            ->serveUpdateRules(['required', "unique:{$connection}.{$userTable},username,{{id}}"])
//            ->component(Input::make())->defaultValue($userModel->username);
//        $form->item('name', '名称')->component(Input::make()->showWordLimit()->maxlength(20))->defaultValue($userModel->name);
//        $form->item('avatar', '头像')->component(Upload::make()->avatar()->path('avatar')->uniqueName())->defaultValue($userModel->avatar);
//        $form->item('password', '密码')->serveCreationRules(['required', 'string', 'confirmed'])->serveUpdateRules(['confirmed'])->ignoreEmpty()
//            ->component(function () {
//                return Input::make()->password()->showPassword();
//            })->defaultValue($userModel->password);
//        $form->item('password_confirmation', '确认密码')
//            ->copyValue('password')->ignoreEmpty()
//            ->component(function () {
//                return Input::make()->password()->showPassword();
//            });
//        $form->item('roles', '角色')->component(Select::make()->block()->multiple()->options($roleModel::all()->map(function ($role) {
//            return SelectOption::make($role->id, $role->name);
//        })->toArray()))->defaultValue($userModel->roles);
//        $form->item('permissions', '权限')->component(Select::make()->clearable()->block()->multiple()->options($permissionModel::all()->map(function ($role) {
//            return SelectOption::make($role->id, $role->name);
//        })->toArray()))->defaultValue($userModel->permissions);
//        $form->saving(function (Form $form) {
//            if ($form->password) {
//                $form->password = bcrypt($form->password);
//            }
//        });
//        $form->createButtonName("更新");
//        return $form;

    }


}