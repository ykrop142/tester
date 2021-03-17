<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Admin extends Controller
{
    public function index(){
        return view('admin.reg');
    }

    public function reguser(Request $request){
        $email=$request['email'];
        $permiss=$request['permiss'];
        if(empty($email)){
            echo 'mail empty';
        }else if(empty($permiss)) {
            echo 'permiss empty';
        }else{
            $chek_reg=DB::table('user')
                ->where('email', $email)
                ->first();
            if(!empty($chek_reg)){
                echo 'polzovatel esti';
            }else{
                $chek_perm=DB::table('permiss_user')
                    ->where('name_permis','=',$permiss)
                    ->get();
                if (!empty($chek_perm)){
                     DB::table('user')
                         ->insert(['email' => $email,'permission_id'=>$chek_perm[0]->id]);
                }

            }
        }
    }
}
