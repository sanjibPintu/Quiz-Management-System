@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-6 mx-auto">
        <h1>You alredy respond the quiz And Your Answer</h1>
        @foreach ($student_result as  $items)
        @foreach ($items as  $key => $item)
        
            <h4>{{$key}}</h4>
            <p>Answer : {{$item}}</p>
        @endforeach
        @endforeach
        @if ($remarks==null)
            <h1>Your Result will add in sort period of time</h1>
        @else
            <h1>{{$remarks}}</h1>
        @endif
        </div>
    </div>

</div>
@endsection
