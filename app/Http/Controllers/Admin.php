<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Admin extends Controller
{
    public function mainadm(){
        return view('admin.main');
    }

    public function reguser(Request $request){
        $email=$request['email'];
        $permiss=$request['permiss'];
        if(empty($email)){
            echo 'Вернитесь и введите почту';
        }else if(empty($permiss)) {
            echo 'Вернитесь и укажите доступ';
        }else{
            $chek_reg=DB::table('user')
                ->where('email', $email)
                ->first();
            if(!empty($chek_reg)){
                echo 'Пользователь с такой почтой уже существует';
            }else{
                $chek_perm=DB::table('permiss_user')
                    ->where('name_permis','=',$permiss)
                    ->get();
                if (!empty($chek_perm[0])){
                     DB::table('user')
                         ->insert(['email' => $email,'permission_id'=>$chek_perm[0]->id]);
                    return redirect('/admin');
                }else{
                    echo 'Такого доступа не существует';
                }
            }
        }
    }

    public function addgroup(Request $request){
        $group = $request['group'];
        if (empty($group)){
            echo 'Вернитесь и введите номер группы';
        }else{
            $chek_group=DB::table('group')
                ->where('name_group','=',$group)
                ->first();
            if (empty($chek_group)){
                DB::table('group')
                    ->insert(['name_group'=>$group]);
                return redirect('/admin');
            }else{
                echo 'Данная группа уже добавлена ранее';
            }
        }
    }

}
