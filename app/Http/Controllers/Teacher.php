<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Teacher extends Controller
{
    public function index(){
        $group=DB::table('group')
            ->select('name_group')
            ->get();
        return view('teacher.main',compact('group'));
    }

    public function createtestvi(){
        return view('teacher.create_test');
    }

    public function add_quests(Request $request){
        $name_test=$request['name_test'];
        $name_quest=$request['quest'];
        $ask1=$request['ask1'];
        $ask2=$request['ask2'];
        $ask3=$request['ask3'];
        $ask4=$request['ask4'];
        if (empty($ask1) and empty($ask2) and empty($ask3) and empty($ask4) and !empty($request['end'])){
            return redirect('/teacher');
        }else{
            if(empty($name_quest)){
                echo 'vvedite vopros';
            }else if(empty($ask1)){
                echo 'vvedite otvet';
            }else if(empty($ask2)){
                echo 'vvedite otvet';
            }else if(empty($ask3)){
                echo 'vvedite otvet';
            }else if(empty($ask4)) {
                echo 'vvedite otvet';
            }else{
                $id_test=DB::table('test_inf')
                    ->where('name_test','=',$name_test)
                    ->get();
                $checkkol=DB::table('test_quest')
                    ->where('id_test','=',$id_test[0]->id)
                    ->latest('numb_quest')
                    ->first();
                if ($checkkol==null){
                    $kolqest=$checkkol+1;
                }else{
                    $kolqest=$checkkol->numb_quest+1;
                }
               // dd($kolqest);
                DB::table('test_quest')
                    ->insert([
                        ['id_test'=>$id_test[0]->id,'numb_quest'=>$kolqest,'ask'=>$ask1],
                        ['id_test'=>$id_test[0]->id,'numb_quest'=>$kolqest,'ask'=>$ask2],
                        ['id_test'=>$id_test[0]->id,'numb_quest'=>$kolqest,'ask'=>$ask3],
                        ['id_test'=>$id_test[0]->id,'numb_quest'=>$kolqest,'ask'=>$ask4]
                    ]);
                if(!empty($request['end'])){
                    return redirect('/teacher');
                }else{
                    $url1=$id_test[0]->name_test;
                    $url2=$kolqest+1;
                    return redirect('/teacher/create_test?nametest='.$url1.'&numb_quest='.$url2);
                }
            }
        }

    }

    public function creatname(Request $request){
        $nametest=$request['name_test'];
        $namegroup=$request['group'];
        if ((!empty($nametest)) and (!empty($namegroup))){
            $chek_name=DB::table('test_inf')
                ->where('name_test','=',$nametest)
                ->first();
            if (!empty($chek_name)){
                echo ('takoi test est');
            }else{
                DB::table('test_inf')
                    ->insert(['name_test'=>$nametest,'numb_group'=>$namegroup]);
                return redirect('/teacher/create_test?nametest='.$nametest);
            }
        }else{
            echo 'danix net';
        }

    }
}
