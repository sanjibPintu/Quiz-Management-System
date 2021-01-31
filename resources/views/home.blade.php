@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>
                you are a normal user
            </div>
        </div>
    </div>
    <div class="row" style="border: 1px solid green">
        @foreach ($catagorys as $item)
        {{-- {{$item->catagory}}  --}}
            
        <a href="/participate/quiz/{{$item->catagory}}" class="btn btn-warning btn-lg  my-3 mx-3">{{$item->catagory}}</a>
        @endforeach
        {{-- <a href="{{  route('quizParticipation')  }}" class=" btn btn-warning btn-lg">Participate In Quiz</a> --}}
    </div>
</div>
@endsection
