<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $todos = Todo::where("user_id", auth()->id())->get();
        return view('todo.index', [
            'todos' => $todos,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $userid = auth()->id();
        Todo::create([
            'user_id' => $userid,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('todo.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        return view('todo.edit', ['todo' => $todo] );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        //
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $todo
        ->where('user_id', auth()->id())
        ->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('todo.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        //
        $todo->where('user_id', auth()->id())->delete();

        return redirect()->route('todo.index');
    }


    public function imgupload(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $file = $request->file('upload');
        $extension = $file->extension();
        
        $path = 'public/images';
        $hankaku = preg_replace('/[^0-9a-zA-Z]/', '', $file->getClientOriginalName());
        $name = $hankaku . "_" . date('Ymd-His') .'_'. Str::random(5) .'.'. $extension;
        $file->storeAs($path, $name);

        return [
            'url' => url("/storage/images/". $name)
        ];
    }
}
