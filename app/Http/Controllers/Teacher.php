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
            if (empty($checkbal[0])){
                $bal[$i]=1;
            }else{
                $bal[$i]=$checkbal[0];
            }

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
        $idu=$request->id; //id stud
        $idt=$request->iq; //id test
        $stud=DB::table('user_data')
            ->where('id_user','=',$idu)
            ->get();

        $testn=DB::table('test_inf')
            ->where('id','=',$idt)
            ->get();

        $testq=DB::table('test_quest')
            ->where('id_test','=',$idt)
            ->get();

        $asks=DB::table('test_ask_students')
            ->where('id_student','=',$idu)
            ->where('id_test','=',$idt)
            ->get();

        $ocenk=DB::table('result_test_students')
            ->where('id_students','=',$idu)
            ->where('id_tests','=',$idt)
            ->get();
        $colask=count($asks)+1; //+5

        $j=0;

        $res[0]= array(
            'name'=>'',
            'fam'=>'',
            'phon_numb'=>'',
            'name_test'=>'',
            'numb_group'=>'',
            'name_quest'=>'',
            'numb_quest'=>'',
            'ask'=>'',
            'ocenka'=>'',
            'color'=>''
        );

        $res[0]['name']=$stud[0]->name;
        $res[0]['fam']=$stud[0]->fam;
        $res[0]['phon_numb']=$stud[0]->phon_numb;
        $res[0]['name_test']=$testn[0]->name_test;
        $res[0]['numb_group']=$testn[0]->numb_group;
        $res[0]['ocenka']=$ocenk[0]->ball;

        for ($i=1;$i<$colask;$i++){
            $res[$i]['name']='';
            $res[$i]['fam']='';
            $res[$i]['phon_numb']='';
            $res[$i]['name_test']='';
            $res[$i]['numb_group']='';
            $res[$i]['ocenka']='';
            $res[$i]['name_quest']=$testq[$j]->name_quest;
            $res[$i]['numb_quest']=$asks[$j]->numb_quest;
            $res[$i]['ask']=$asks[$j]->ask;
            if ($asks[$j]->ask==$testq[$j]->ask1){
                $res[$i]['color']='green';
            }else{
                $res[$i]['color']='red';
            }
            $j++;
        }
       return view('teacher.view',compact('res'));
    }
}
