@extends('app')
@section('content')

<div class='container w-25 border p-4 mt-4'>
<form action="{{route('todos')}}"  method="POST">
  @csrf
  @if (session('sucess'))
  <h6 class="alert alert-success">{{session('success')}}</h6>
  @endif
  
  @error('title')
  <h6 class="alert alert-danger">El campo de titulo es requerido</h6>    
  @enderror
  <div class="mb-3">
    <label for="title" class="form-label">Titulo de la tarea</label>
    <input type="text" class="form-control" name='title'>
  </div>

  <label for="title" class="form-label">Categoria de la tarea</label>
  <select name="category_id" class="form-select mb-3">
    @foreach ($categories as $category)
      <option value={{$category->id}}>{{$category->name}}</option>
    @endforeach
  </select>


  <button type="submit" class="btn btn-primary my-4">Crear tarea</button>
</form>

@foreach ($todos as $todo)

<div class="row py-1">
  <div class="col-md-9 d-flex align-items-center">
    <a href="{{route('todos-edit',['id'=>$todo->id])}}">{{$todo->title}}</a>
  </div>

  <div class="class col-md-3  d-flex justify-content-end">
    <form action="{{route('todos-destroy',[$todo->id])}}" method="POST">
    @method('DELETE')
    @csrf
    <button class="btn btn-danger btn-sm">Eliminar</button>
  </form>
  </div>
</div>
  
@endforeach


@endsection
