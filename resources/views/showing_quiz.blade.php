@extends('layouts.app')
@if (Auth::user()->id==1)
    <h1>You are a admin You Can not attend the quiz</h1>
@else
    
@section('content')
<div class="container">
  {{-- {{ Auth::user()->id}} --}}
  <form action="/ansersaved" method="POST" name="my_form" class="my_form">
    <input type="hidden" name="userId" value="{{Auth::user()->id}}">
  <div class="col-sm-8 mx-auto">
    @if (count($quiz_qustion) >0)
    {{-- $quiz_qustion[0]->catagory --}}
    <div class="text-center">
    <input type="disable" class="alert alert-primary" name="catagory" id="" value="{{ $quiz_qustion[0]->catagory }}" readonly>
    </div>
    @foreach ($quiz_qustion as $item)

 
   <div class="card my-1" >
    <div class="card-body">
      
      @csrf
      <p><span class="font-italic">{{$loop->iteration}}</span> <b>:</b> <span class="font-weight-bold">{{$item->qustion}}</span> </p>
      
      
      <div class="form-check">
        <input class="form-check-input" type="radio" name="{{$item->id}}" value="{{$item->option1}}" id="option1">
        <label class="form-check-label" for="option1">
          {{$item->option1}}
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="{{$item->id}}" value="{{$item->option2}}" id="option2" >
        <label class="form-check-label" for="option2">
          {{$item->option2}}
        </label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="radio" name="{{$item->id}}" value="{{$item->option3}}" id="option3" >
        <label class="form-check-label" for="option3">
          {{$item->option3}}
        </label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="radio" name="{{$item->id}}" value="{{$item->option4}}" id="option4" >
        <label class="form-check-label" for="option4">
          {{$item->option4}}
        </label>
      </div>    
    </div>
    
  </div>

  @endforeach 

  </div>
  

  
  <input type="submit" class="btn btn-primary btn-sm" value="Submit">
  </form>
  @else
  <h1>No Qustion Addes</h1>
@endif
</div>


@endsection
@endif

@section('customJs')


<script>
$('form.my_form').submit(function (e) { 
  e.preventDefault();

  var form=$(this);
  
  $.ajax({
    type: form.attr('method'),
    url: form.attr('action'),
    
    data: form.serialize()
  }).done(function(data){
    alert('data saved');
  }).fail(function(data){
    // optionally alert error
  })
  $(this).hide();
});

</script>

    
@endsection
