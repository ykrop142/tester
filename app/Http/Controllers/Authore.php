<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Authore extends Controller
{
    public function index(){
        return view('author');
    }

    public function login(request $request){
        $email=$request['email'];
        $password=$request['password'];
        if(empty($email)){
            echo 'Введите почту';
        }else if(empty($password)) {
            echo 'Введите пароль';
        }else{
            $users = DB::table('user')
                ->where('email', $email)
                ->where('password',$password)
                ->first();
            if($users==Null){
                echo 'Пользователя с такой почтой нет';
            }else if ($users->permission_id==3){
                return redirect('/admin');
            }else if (($users->permission_id==2)){
                return redirect('/teacher');
            }else {
                return redirect('/student');
            }
        }
    }

}
