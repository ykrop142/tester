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
            echo 'mail empty';
        }else if(empty($password)) {
            echo 'pass empty';
        }else{
            //$users=DB::select('select * from user where email=$email',[1]);
            $users = DB::table('user')
                ->where('email', $email)
                ->where('password',$password)
                ->first();
            if($users==Null){
                echo 'dont search user';
            }else{
                dd($users);
                // return view('author',['users'=>$users]);
            }
        }
    }
}
