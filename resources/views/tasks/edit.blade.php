@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-offset-2 col-md-8">
    <div class="row">
      <h1>Todo List</h1>
    </div>

    {{-- display success message --}}
    @if (Session::has('success'))
      <div class="alert alert-success">
        <strong>Success:</strong> {{ Session::get('success') }}
      </div>
    @endif

    {{-- display error message --}}
    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Error:</strong>
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="row">
      <form action="{{ route('tasks.update', [$taskUnderEdit->id]) }}" method='POST'>
      {{ csrf_field() }}
      <input type="hidden" name='_method' value='PUT'>

        <div class="form-group">
          <input type="text" name='updatedTaskName' class='form-control input-lg' value='{{ $taskUnderEdit->name }}'>
        </div>

        <div class="form-group">
          <input type="submit" value='Save Changes' class='btn btn-success btn-lg'>
          <a href="" class='btn btn-danger btn-lg pull-right'>Go Back</a>
        </div>
      </form>
    </div>

 
  </div>
</div>
@endsection