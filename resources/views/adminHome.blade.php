@extends('layouts.app')

@section('content')

<div class="container-fluid">
    {{-- <a href="showallstudentdetails/" class="btn btn-primary">Go To Student Details</a> --}}

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="text-center">
                        <h1>Dashbord</h1>
                        
                        <input type="text" name="catagory" id="catagory" placeholder="Enter the Catagory for Quiz">
                        
                        <button class="btn btn-outline-primary btn-sm" onclick="addCatagory()">Add Catagory</button>
                        <div class="d-flex flex-row-reverse bd-highlight">
                            <div class="p-2 bd-highlight">
                                <select class="my-1 form-select form-control" aria-label="Default select example" name="catagory" id="catagorys">
                                    <option selected></option>
                                    @foreach ($catagorys as $item)
                                    <option name="catagory" value="{{$item->catagory}} ">{{$item->catagory}} </option>
                                    @endforeach 
                                  </select>
                             <input type="number" name="user_id" class="form-control" id="">
                        
                             <button onclick="showStudentData()" class="my-2 btn btn-warning">Surch Student Result</button>
                        
                            </form>
                            </div>
                          </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-5  border border-primary">
                                    @if ($errors->any())
                                     <div class="alert alert-danger">
                                        <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                        </ul>
                                     </div>
                                     @endif 
                                     {{-- success msg --}}
                                     <div class="flash-message">
                                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                          @if(Session::has('alert-' . $msg))
                                    
                                          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                          @endif
                                        @endforeach
                                     </div>
                                     {{-- success msg --}}

                                    <form action="{{route('addQustion')}}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="qustion" class="form-label">Enter The Qustion</label>
                                            <input type="text" class="form-control" name="qustion" id="qustion"
                                                placeholder="Enter the Qustion">
                                        </div>
                                        <div class="mb-3">
                                            <label for="option1" class="form-label">Option1 </label>
                                            <input type="text" class="form-control" name="option1" id="option1"
                                                placeholder="Enter the Option1">
                                        </div>

                                        <div class="mb-3">
                                            <label for="option2" class="form-label">Option2 </label>
                                            <input type="text" class="form-control" name="option2" id="option2"
                                                placeholder="Enter the Option2">
                                        </div>

                                        <div class="mb-3">
                                            <label for="option3" class="form-label">Option3</label>
                                            <input type="text" class="form-control" name="option3" id="option3"
                                                placeholder="Enter the Option3">
                                        </div>
                                        <div class="mb-3">
                                            <label for="option2" class="form-label">Option4 </label>
                                            <input type="text" class="form-control" name="option4" id="option4"
                                                placeholder="Enter the Option4">
                                        </div>

                                        <div class="mb-3">
                                            <label for="catagorys" class="form-label">Catagory </label>
                                            <select class="form-select form-control" aria-label="Default select example" name="catagory" id="catagorys">
                                                <option selected></option>

                                                @foreach ($catagorys as $item)
                                                <option name="catagory" value="{{$item->catagory}} ">{{$item->catagory}} </option>
                                                    
    
                                                @endforeach
                                                
                                                
                                              </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="answer" class="form-label">Answer</label>
                                            <input type="text" class="form-control" name="answer" id="answer"
                                                placeholder="Enter the Awnser">
                                        </div>
                                        <button class="btn btn-outline-warning">Add The Qustion</button>
                                    </form>

                                </div>

                                <div class="offset-1 col-sm-6" id="studentresultData" style="border: 1px solid red">
                                  {{-- <h4 class="display-3" id="result"></h4> --}}
                                  <h6 class="display-5 mt-3" id="result"></h6><br>

                                </div>

                                

                            </div>
                        </div>
                    </div>

                </div>


            </div>

        </div>
    </div>
</div>

</div>

@endsection
@section('customJs')
<script>
function addCatagory()
{
    // $('#catagory').val()
    let catagory=$("input[name='catagory']").val();
   
    if(catagory)
    {
       $.ajax({
           type: "post",
           url: "home/add_catagory",
           data: {
            catagory:catagory ,
            "_token": "{{ csrf_token() }}",
           },
          
           success: function (response) {
               alert(response);
           }
       });
    }
    else
    {
        alert("Please Enter something");
    }
    
}




function showStudentData()
{
    let userId=$("input[name='user_id']").val();
    let catagory= $('#catagorys').val();
   
   $.ajax({
       type: "GET",
       url: 'studentresult'+'/'+userId,
       data: {
        user_id:userId,
        catagory:catagory
       },
       
       success: function (response) {
        //    console.log(typeof(response));
        html="";
        if (response)
        {
            for (const property in response)
            {   
        
                if(property==0)
                {
           
                    wa= html.concat(`Wrong answer : ${response[property]} \n<br>`);
                }
                else if(property==1)
                {
            
               ra= `<br>Right answer : ${response[property]} \n<br>`
                   
                }

            }
            result=html.concat(wa,ra);
            $('#result').append(`${result} <button value="pass" class="remarks">Pass</button> <button value="fail" class="remarks">Fail</button><hr>`);
            // console.log(result);

            
            
        }
       
        else
        {
            $('#result').append("Till now user user not perticipate in the quiz or user is not exist <br>\n <hr>");
           
        }   
          
       },
       error: function (response) {
       console.log('error is running')
      }
   });
  
}

$(document).on("click", "button.remarks" , function() {
           let remarks= $(this).val();
           let userId=$("input[name='user_id']").val();
            let catagory= $('#catagorys').val();
           $.ajax({
               type: "post",
               url: "showallstudentdetails",
               data: {
                remarks:remarks,
                userId:userId,
                catagory:catagory,
                "_token": "{{ csrf_token() }}",
               },
              
               success: function (response) {
                   if(response==1)
                   {
                    alert('Updated Successfully');
                    $('button.remarks').remove();
                   }
                   else
                   {
                    alert('Alredy updated it');
                    $('button.remarks').remove();
                   }
               }
           });
           $('button.remarks').hide();
});

</script>

@endsection 