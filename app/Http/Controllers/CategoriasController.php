<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index()
    {
        $categorias=Category::all();
        return view('categories.index',['categorias'=>$categorias]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:categories|max:255|min:5',
            'color'=>'required|max:7'
        ]);

        $categoria=new Category;

        $categoria->name=$request->name;
        $categoria->color=$request->color;
        $categoria->save();

        if($categoria->name===$request->name){
            return redirect()->route('categories.index')->with('error','la tarea ya existe');
        }else{
            return redirect()->route('categories.index')->with('success','Nueva categoria agregada correctamente');
        }
    }

    public function show($id)
    {
        $categoria=Category::find($id);
        return view('categories.show',['category'=>$categoria]);
    }

    public function update(Request $request, $id)
    {
        $categoria=Category::find($id);
        $categoria->name=$request->name;
        $categoria->color=$request->color;
        $categoria->save();


        return redirect()->route('categories.index')->with('success','Categoria actualizada');
    }
    
    public function destroy($id)
    {
        $categorias=Category::find($id);
        $categorias->todos()->each(function($todo){
            $todo->delete();
        });
        $categorias->delete();

        return redirect()->route('categories.index')->with('success','Categoria eliminada');
    }
}
