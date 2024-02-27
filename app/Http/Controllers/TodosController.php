<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    //metodo index para mostrar todos los elemento
    //store guardar
    //update actualizar
    //destroy eliminar
    //edit para mostrar el formulario de edicion


    public function store(Request $request) {
        $request->validate([
            'title'=>'required|min:3'
        ]);

        $todo=new Todo();
        $todo->title=$request->title;
        $todo->category_id=$request->category_id;
        $todo->save();

        return redirect()->route('todos')->with('success','Tarea creada correctamente');
    }

    public function index(){
        $todos=Todo::all();//traigo todos los elementos de la tabla todo
        $categoria=Category::all();
        return view('todos.index',['todos'=>$todos,'categories'=>$categoria]); 
    }
    
    public function show($id){
        $todo=Todo::find($id);
        return view('todos.show',['todos'=>$todo]);
    }

    public function update(Request $request,$id){
        $todo=Todo::find($id);
        $todo->title=$request->title;
        $todo->save();
        // return view('todos.index',['success'=>'Tarea actualizada']);
        return redirect()->route('todos')->with('success','Tarea actualizada');
    }

    public function destroy($id){
        $todo=Todo::find($id);
        $todo->delete();
        return redirect()->route('todos')->with('success','La tarea a sido eliminada');
    }




    
}
