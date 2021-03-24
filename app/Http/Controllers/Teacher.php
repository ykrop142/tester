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
        $tests=DB::table('test_inf')
            ->select('*')
            ->get();
        return view('teacher.main',compact('group','tests'));
    }

    public function createtestvi(){
        return view('teacher.create_test');
    }

    public function ajaxe(Request $request){
        $data = $request->all();
        $tests=DB::table('test_ask_students')
            ->where('id_test','=',$data['ids'])
            ->distinct()
            ->get('id_student');
        $checkkol=count($tests);

        for ($i=0;$i<$checkkol;$i++) {
            $users = DB::table('user')
                ->where('id', '=', $tests[$i]->id_student)
                ->get();
            $students[$i] = $users[0]->id;
            $groupid[$i]=$users[0]->group_id;

            $groupdate=DB::table('group')
                ->where('id','=', $groupid[$i])
                ->get();
            $group[$i]=$groupdate[0];

            $datastud=DB::table('user_data')
                ->where('id_user','=',$students[$i])
                ->get();
            $datastudents[$i]=$datastud[0];

            $checkbal=DB::table('result_test_students')
                ->where('id_students','=',$students[$i])
                ->where('id_tests','=',$data['ids'])
                ->get();
            $bal[$i]=$checkbal[0];
        }
       return response()->json(["students"=>$datastudents,"col"=>$checkkol,"group"=>$group,"bal"=>$bal,"idu"=>$students]);
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
                DB::table('test_quest')
                    ->insert(['id_test'=>$id_test[0]->id,'numb_quest'=>$kolqest,'ask1'=>$ask1,'ask2'=>$ask2,'ask3'=>$ask3,'ask4'=>$ask4]);
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

    public function viewstudentres(Request $request){
        $test=$request->id; //id stud
        $test1=$request->iq; //id test
        echo $test;
        echo $test1;
    }
}
