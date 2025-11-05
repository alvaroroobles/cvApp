@extends('template.template')

@section('header')
@endsection

@section('features')
@endsection

@section('content')
<!-- ventanas modales principio -->

<div class="modal fade" id="destroyModal" tabindex="-1" aria-labelledby="destroyModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="destroyModalLabel">Confirm delete CV?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="destroyModalContent"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button form="form-delete" type="submit" class="btn btn-primary">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- ventanas modales fin -->

<hr>
<div class="cv-section">
  <div class="table-container">
    <div class="table-responsive-wrapper">
      <table class="table table-hover cv-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Nota Media</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($curriculums as $curriculum)
            <tr>
              <td>{{ $curriculum->id }}</td>
              <td>{{ $curriculum->name }}</td>
              <td>{{ $curriculum->medium_mark }}</td>
              <td> 
                <a href="{{ route('curriculum.show',$curriculum->id)}}"><button class="btn btn-success" >Show</button></a>
                <a href="{{ route('curriculum.edit',$curriculum->id)}}"><button class="btn btn-warning" >Edit</button></a>
                <a class=" link-destroy btn btn-danger"
                        data-bs-target="#destroyModal"
                        data-bs-toggle="modal"
                        data-href="{{ route('curriculum.destroy', $curriculum->id) }}"
                        data-curriculum="{{ $curriculum->name }}">Delete</a>
            </td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th colspan="4">Número de CV:</th>
            <th>{{ count($curriculums) }}</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>  

<form action="" method="post" id="form-delete">
    @csrf
    @method('delete')
</form>
@endsection