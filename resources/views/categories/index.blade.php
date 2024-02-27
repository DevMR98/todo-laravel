@extends('app')
@section('content')

<div class="container w-50 border p-4 my-4">
  <div class="row mx-auto">
    <form action="{{route('categories.store')}}" method="POST">
      @csrf
      @if (session('success'))
      <h6 class="alert alert-success">{{session('success')}}</h6>
      @endif

      @error('name')
      <h6 class="alert alert-danger">El campo de categoria es requerido</h6>
      @enderror
      <div class="mb-3">
        <label for="name" class="form-label">Nombre de la categoria</label>
        <input type="text" class="form-control" name='name'>
      </div>

      <div class="mb-3">
        <label for="color" class="form-label">Color de la categoria</label>
        <input type="color" class="form-control" name='color'>
      </div>


      <button type="submit" class="btn btn-primary">Crear nueva categoria</button>
    </form>

    <div class="">
      @foreach ($categorias as $cat)
      <div class="row py-1">
        <div class="col-md-9 d-flex align-items-center">
          <a class="d-flex align-items-center gap-2" href="{{route('categories.show',['category'=>$cat->id])}}">
            <span class="color-container" style="background-color: {{$cat->color}}; width:20px; height:20px; border-radius:20%;"></span>{{$cat->name}}
          </a>
        </div>

        <div class="col-md-3 d-flex justify-content-end">
          <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-{{$cat->id}}">Eliminar</button>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="modal-{{$cat->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Aviso</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <h3>¿Desea eliminar el registro?</h3>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <form action="{{route('categories.destroy',['category'=>$cat->id])}}" method="POST">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="btn btn-primary">Eliminar</button>
                </form>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection