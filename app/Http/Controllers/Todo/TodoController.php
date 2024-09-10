<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{

    public function index()
    {

        if (request('search')) {
            $data = Todo::where('task', 'like', '%' . request('search') . '%')->get();
        } else {
            $data = Todo::orderBy('task', 'asc')->get();
        }
        return view('todo.app', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|min:4|max:20'
        ], [
            'task.required' => 'Nama task wajib diisi',
            'task.min' => 'Min. Task 4 Karakter',
            'task.max' => 'Max. Task 20 Karakter',
        ]);
        $data = [
            'task' => $request->task
        ];

        Todo::create($data);
        return redirect()->route('todo')->with('success', 'Berhasil menambahkan Task');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'task' => 'required|min:4|max:20'
        ], [
            'task.required' => 'Nama task wajib diisi',
            'task.min' => 'Min. Task 4 Karakter',
            'task.max' => 'Max. Task 20 Karakter',
        ]);
        $data = [
            'task' => $request->task,
            'is_done' => $request->is_done
        ];

        Todo::where('id', $id)->update($data);
        return redirect()->route('todo')->with('success', 'Berhasil Mengupdate Task');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Todo::where('id', $id)->delete();
        return redirect()->route('todo')->with('success', 'Berhasil Menghapus Task');
    }
}
