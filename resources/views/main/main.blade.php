@extends('template.template')

@section('header')
@endsection

@section('features')


<div class="cards-container">
  @foreach($curriculums as $curriculum)
    <div class="card">
      <img src="{{ $curriculum->getPath() }}" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">{{ $curriculum->name }}</h5>
        <p class="card-text">{{ $curriculum->experience }}</p>
        <p class="card-text">{{ $curriculum->formation }}</p>
        <p class="card-text">{{ $curriculum->skills }}</p>
        <a href="{{ route('curriculum.show',$curriculum->id) }}" class="btn btn-primary">See more information</a>
      </div>
    </div>
  @endforeach
</div>
@endsection