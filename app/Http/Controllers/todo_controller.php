<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class todo_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $todos = DB::table('todos')
         ->select('*') 
         ->where('user_id', Auth::id())
         ->get();
        return view('todos.index')->with('todos',$todos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $validation=$request->validate([

            'title'=>'required|unique:todos',
            'content'=>'required',
            'deadline'=>'required',
             
        ]);

        $todo=new Todo();
        $todo->title=$request->title;
        $todo->content=$request->content;
        $todo->deadline=$request->deadline;
        $todo->user_id=Auth::id();
        $todo->save();

        session()->flash('success_store', 'todo added successfully');
        return redirect( route('todos.index'));
    }
    public function make_it_done($id)
    {
        $todo=Todo::find($id);
        $todo->done=1;
        $todo->save();
        session()->flash('success_done', 'todo is done ');

        return redirect( route('todos.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo=Todo::find($id);

         return view('todos.create')->with('todo',$todo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $todo=Todo::find($id);
        $todo->title=$request->title;
        $todo->content=$request->content;
        $todo->deadline=$request->deadline;
        $todo->save();
        session()->flash('success_update', 'todo updated successfully');

        return redirect( route('todos.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo=Todo::find($id);
        $todo->delete();
        session()->flash('destroy', 'todo deleted');

        return redirect( route('todos.index'));
    }
}
