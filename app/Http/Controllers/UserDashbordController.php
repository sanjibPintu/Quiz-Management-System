<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\QuizQustions;
use App\Models\QuizData;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\type;

class UserDashbordController extends Controller
{
    
    public function __construct(Request $request) 
    {
        $this->middleware('auth');    
    }
    public function qustion($catagory)
    {
        
        $user = Auth::user()->id;
   
        $quizdata=QuizData::where('user_id',$user)->where('catagory','=',$catagory)->exists();
        


        if($quizdata)
        {
            $userData=QuizData::where('user_id',$user)->where('catagory','=',$catagory)->first();
            // dd($userData->remarks);
            $student_result=json_decode($userData->qustion_answer,true);
            $studenQustionAnswer=[];
            foreach($student_result as $key => $val) {
                
                if($key=='catagory' )
                {
                    continue;
                }
                else
                {
                   $quizQustion= QuizQustions::find($key)->qustion;
                
                    $qustionAnswer=array($quizQustion=>$val);
                    array_push($studenQustionAnswer,$qustionAnswer);
                }
              }

            return view('studentResult',['student_result'=>$studenQustionAnswer,'remarks'=>$userData->remarks]);
        }
        else{
        
        $quiz_qustion = DB::table('quiz_qustions')->where('catagory','=',$catagory)->get();
       
        
        return view('showing_quiz',['quiz_qustion'=>$quiz_qustion]);
        }
    }
    
    public function answeredSave(Request $request)
    { 
       

        $qustionId=$request->input('qustionId');
        
        $user_answer=$request->input('option');
       
        $answer_byadmin=QuizQustions::find($qustionId)->answer;
            // if( $user_answer===$answer_byadmin)
            // { 
                $allAnswer=[];
                $ar=array(
                    // 'userId'=>$request->input('userid'),
                    'Qustionid'=>QuizQustions::find($qustionId)->qustion,
                    'answer_given_user'=>$user_answer,
                    'anwswer_by_admin'=>$answer_byadmin

                );
               array_push($allAnswer,$ar);
            // }
            // else
            // {
            //     return  false;
            // }
           return json_encode($allAnswer) ;
    }
    public function getingdata(Request $request)
    {
        $data = $request->except('_token');
        unset($data['userId']);
        $json_formtat_qustion_answer=json_encode($data);
        $user_id=$request->input('userId');
        $user_catagory=$request->input('catagory');
        
        
        $quizdata_obj= new QuizData;
        $quizdata_obj->user_id=$user_id;
        $quizdata_obj->catagory=$user_catagory;
        $quizdata_obj->qustion_answer=$json_formtat_qustion_answer;
        $quizdata_obj->save();
        return "Success fully saved";

    }
}
