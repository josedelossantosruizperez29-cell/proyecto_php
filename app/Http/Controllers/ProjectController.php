<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Tasks;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */



    // funcion para mostrar todos los projects quer pertenen al usuario logueado
    public function index()
    {

        $projects=Project::where(
            'user_id',
            auth()->id()
        )->get();
        return view('projects.index',compact('projects'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //returna ala vcistta para crear un project
        return view('projects.create');
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      //funcion para guarrdar el proyecto
        $request->validate([
            'title'=>'required',
            'description'=>'nullable'
        ]);
        project::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'user_id'=>auth()->id()
        ]);
        return redirect()->route('projects.index');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,Project $project)
    {

    if($project->user_id !== auth()->id()){
        return abort(403);
    }else{
       $status = $request->query('status');
           $tasks = $project->tasks()
        ->when($status, function ($query, $status) {
            return $query->where('status', $status);
        })
        ->get();


        $deletedTasks =
        Tasks::onlyTrashed()->where(
            'project_id',
            $project->id
        )->get();

    return view('projects.show', compact('project', 'tasks','deletedTasks'));

    }
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //funcion para retornar la vista para editar un project
        $project=Project::findOrFail($id);
        return view('projects.edit',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Project $project)
    {
        // funcion para actualizar un project
        $project->update([
            'title'=>$request->title,
            'description'=>$request->description
        ]);
        return redirect()->route('projects.index', $project->id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(project $project)
    {
        //fucion para eliminar un project
        $project->delete();
        return redirect()->route('projects.index');
    }
    

    public function trash(){
        $projects=Project::onlyTrashed()->where(
            'user_id',
            auth()->id()
        )->get();
        return view('projects.trash',compact('projects'));
    }

    public function restore($id){
        $project=Project::onlyTrashed()->findOrFail($id);
        $project->restore();
        return redirect()->route('projects.index')->with('success','el proyecto ha sido restaurado '.$project->title);
        //mensaje de confirmacion

    }

    
}
