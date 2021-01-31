<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use App\Models\QuizQustions;
use Illuminate\Support\Facades\DB;
use App\Models\QuizData;
use App\Models\QuizCatagory;




class AdminDashbord extends Controller
{

    public function addCatagory(Request $request)
    {
     
     $validated = $request->validate([
       'catagory'=>'required' 
    ]);
    $catagoryExist=QuizCatagory::where('catagory','=',$validated['catagory'])->exists();
    // dd($catagoryExist);
    if($catagoryExist)
    {
        return "Category Is  Already exist";
    }
    else
    {
        $quizcatagory= new QuizCatagory;
        $quizcatagory->catagory=$validated['catagory'];
        $quizcatagory->save();
        return "Catagory Saved";
    }

    }



    public function addTheQustion(Request $request)
    {
        // dd($request->input());
        $catagory = DB::table('quiz_catagories')->get();
        $validated = $request->validate([
            'qustion' => 'required|min:5',
            'option1'=>'required',
            'option2'=>'required',
            'option3'=>'required',
            'option4'=>'required',
            'catagory'=>'required',
            'answer'=>'required',
           
        ]);
        
        $quizqustion=new QuizQustions;
       
        $quizqustion->qustion=$validated['qustion'];
        $quizqustion->option1=$validated['option1'];
        $quizqustion->option2=$validated['option2'];
        $quizqustion->option3=$validated['option3'];
        $quizqustion->option4=$validated['option4'];
        $quizqustion->catagory=$validated['catagory'];
        $quizqustion->answer=$validated['answer'];
        $quizqustion->save();
        $request->session()->flash('alert-success', 'Qustion Success Fully Added');

        return redirect('/home');
        // return view('adminHome',['catagorys'=>$catagory]);
    }


    public function ShowingStudentResult(Request $request,$id )
    {
        
        $rightAnswer=0;
        $wrongAnswer=0;
     $user_id=$request->input('user_id');
     $catagory=$request->input('catagory');
     $quizData = QuizData::where('user_id','=',$user_id)->where('catagory','=',$catagory)->first();
        
     if($quizData)
     {
        
        $student_result=json_decode($quizData->qustion_answer,true);
        foreach($student_result as $key => $val)
        {
            if($key=='catagory'){
               continue;
            }
            else{
        
            if(QuizQustions::find($key)->answer===$val)
            {
                $rightAnswer+=1;
            }
            else
            {
                $wrongAnswer +=1;
            }
        }
        }
        return [$wrongAnswer,$rightAnswer];
       
     }
     else
     {
        
         return false;
     }
    }


    // public function showallStudentdetails()
    // {
    //     $quizData = QuizData::all();
    //     $userAnswer=[];
  
    //     foreach($quizData as $key=>$val)
    //     {
    //         // echo "<pre>";
    //         // echo $quizData[$key]->user_id;
    //         // echo "</pre>";
    //         $userDetails=array(
    //             'user_id'=>$quizData[$key]->user_id,
    //             'user_answer'=>json_decode($quizData[$key]->qustion_answer)
    //         );
    //         array_push($userAnswer,$userDetails);
    //     }
    //     // echo "<pre>";
    //     // return print_r($userAnswer);
    //     // echo "</pre>";
    //     return view('userinormation',['userAnswer'=>$userAnswer]);
        
    // }


    public function showallStudentdetails(Request $request)
    {
   
        $catagoryExist=QuizData::where('catagory','=',$request->input('catagory'))->where('user_id','=',$request->input('userId'))->exists();
        if($catagoryExist)
        {
            $remarks=DB::table('quiz_data')->where('catagory','=',$request->input('catagory'))
            ->where('user_id','=',$request->input('userId'))->select('remarks')->get()[0]->remarks;
            // dd($remarks);
            if($remarks==null){
            DB::table('quiz_data')
            ->where('catagory','=',$request->input('catagory'))->where('user_id','=',$request->input('userId'))
            ->update(['remarks' => $request->input('remarks')]);
            return true;
            }
            else
            {
                return false;
                //  return "You alredy update it";
            }
        }

    }

}
