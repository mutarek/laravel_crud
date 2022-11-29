<?php

namespace App\Http\Controllers;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::orderBy('id','desc')->paginate(5);
        return view('todos.index', compact('todos'));
    }
    public function create()
    {
        return view('todos.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'desc'=>'required',
            'is_completed'=>'required',
        ]);

        return redirect()->route('todos.index')->with('success','Todo has been created successfully.');
    }
    public function show()
    {
        return view('todos.show',compact('todos'));
    }
    public function edit(Todo $todo)
    {
        return view('todos.edit',compact('todo'));
    }
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title'=>'required',
            'desc'=>'required',
            'is_completed'=>'required',
        ]);
        
        $todo->fill($request->post())->save();

        return redirect()->route('todos.index')->with('success','Company Has Been updated successfully');
    }
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index')->with('success','Company has been deleted successfully');
    }
}
