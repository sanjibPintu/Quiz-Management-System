@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-9">
      @foreach ($userAnswer as $item)
      {{-- {{$item['user_answer']}} --}}
      @php
          echo print_r($item['user_answer']);
      @endphp
   
    
      {{-- <div class="card text-center">
        <h5 class="card-header">{{$item['user_id']}}</h5>
        <div class="card-body">
          <h5 class="card-title">Special title treatment</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div> --}}
      @endforeach
    </div>
  </div>
</div>
@endsection