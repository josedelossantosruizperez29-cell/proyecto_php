<?php

namespace App\Http\Controllers;

use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Models\Project;
use View;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $project=Project::findOrFail($request->project);
        return view('tasks.create',compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'nullable',
            'due_date'=>'required',
            'project_id'=>'required'

        ]);
        tasks::Create([
            'title'=>$request->title,
            'description'=>$request->description,
            'status'=>'Pendiente',
            'due_date'=>$request->due_date,
            'project_id'=>$request->project_id

        ]);

        return redirect()->route('projects.show', $request->project_id);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tasks $tasks)
    {
        //funcion para el estado de la tarea tareas
        $tasks->status=$request->status;
        $tasks->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tasks $tasks)
    {
        $tasks->delete();
        return back();
    }

    public function restore($id){
        $tasks=Tasks::onlyTrashed()->findOrFail($id);
        $tasks->restore();
        return back();
    }

}
