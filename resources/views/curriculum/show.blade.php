@extends('template.template')

@section('header')
@endsection

@section('features')
@endsection

@section('content')
<main class="cv-detail">
  <section class="cv-header">
    <div class="cv-avatar">
        <img src="{{$curriculum-> getPath() }}" alt="...">
    </div>
    <div>
      <h1>{{ $curriculum->name }} {{ $curriculum->surname }} {{ $curriculum->surname2 }}</h1>
      <p class="cv-subtitle">{{ $curriculum->formation }}</p>
    </div>
  </section>

  <hr>

  <section class="cv-info">
    <div class="cv-item">
      <i class="bi bi-telephone"></i>
      <span>{{ $curriculum->phone }}</span>
    </div>
    <div class="cv-item">
      <i class="bi bi-envelope"></i>
      <span>{{ $curriculum->email }}</span>
    </div>
    <div class="cv-item">
      <i class="bi bi-calendar"></i>
      <span>{{ $curriculum->born_date }}</span>
    </div>
  </section>

  <section class="cv-section">
    <h2><i class="bi bi-briefcase"></i> Experiencia</h2>
    <p>{{ $curriculum->experience }}</p>
  </section>

  <section class="cv-section">
    <h2><i class="bi bi-mortarboard"></i> Formación</h2>
    <p>{{ $curriculum->formation }}</p>
  </section>

     @if($curriculum->isPdf())
     <p class="lead">
        <a href="{{ $curriculum->getPdf() }}" target="pdf">PDF</a>
    </p>  
     @endif

  <section class="cv-section">
    <h2><i class="bi bi-lightbulb"></i> Habilidades</h2>
    <p>{{ $curriculum->skills }}</p>
  </section>
</main>


@endsection