@extends('template.template')

@section('header')
@endsection

@section('features')
@endsection

@section('content')
<form action="{{ route('curriculum.update',$curriculum->id)}}" class="form" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')  
    <div class="espacio">
        <label for="name">Name</label>
        <input type="text" minlength="2" maxlength="60" class="form-control" id="name" required name="name" placeholder="Name of the concursant" value="{{ old('name',$curriculum->name)}}">
    </div>

    <div class="espacio">
        <label for="surname">First Surname</label>
        <input type="text" minlength="3" maxlength="100" class="form-control" id="surname" required name="surname" placeholder="First Surname" value="{{ old('surname',$curriculum->surname)}}">
    </div>

    <div class="espacio">
        <label for="surname2">Second Surname</label>
        <input type="text" minlength="3" maxlength="120" class="form-control" id="surname2" required name="surname2" placeholder="Second Surname" value="{{ old('surname2',$curriculum->surname2)}}">
    </div>

    <div class="espacio">
        <label for="phone">Phone</label>
        <input type="text" minlength="9" maxlength="14" class="form-control" id="phone" required name="phone" placeholder="Enter your phone Number" value="{{ old('phone',$curriculum->phone)}}">
    </div>

    <div class="espacio">
        <label for="hair">Email</label>
        <input type="email" minlength="3" maxlength="120" class="form-control" id="email" required name="email" placeholder="Your email" value="{{ old('email',$curriculum->email)}}">
    </div>

    <div class="espacio">
        <label for="hair">Born Date</label>
        <input type="date" class="form-control" id="born_date" name="born_date" required value="{{ old('born_date',$curriculum->born_date) }}">
    </div>

    <div class="espacio">
    <label for="medium_mark">Medium Mark</label>
    <input   type="number" step="0.1" min="1" max="10" class="form-control" id="medium_mark" name="medium_mark"   
     required  placeholder="Enter a score from 1 to 10" value="{{ old('medium_mark',$curriculum->medium_mark) }}">
    </div>

    <div class="espacio">
        <label for="experience">Experience</label>
        <textarea class="form-control" minlength="10" id="experience" name="experience" placeholder="Previous jobs, interviews..." cols=60 rows=8 required>{{ old('experience',$curriculum->experience)}}</textarea>
    </div>
    
    <div class="espacio">
        <label for="formation">Formation</label>
        <textarea class="form-control" minlength="10" id="formation" name="formation" placeholder="Previous Formation" cols=60 rows=8 required>{{ old('formation',$curriculum->formation)}}</textarea>
    </div>

    <div class="espacio">
        <label for="skills">Skills</label>
        <textarea class="form-control" minlength="10" id="skills" name="skills" placeholder="Your best hard/soft skills" cols=60 rows=8 required>{{ old('skills',$curriculum->skills)}}</textarea>
    </div>

    <div class="espacio">
        <label for="Image">Image</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>


    <div class="espacio">
        <input type="submit" class="btn btn-primary" value="Edit your CV">
    </div>
</form>
@endsection