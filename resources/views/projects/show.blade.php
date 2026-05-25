<x-layouts::app>

<div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow-sm border border-gray-200">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $project->title }}</h1>
    
    <p class="text-gray-600 mb-6 leading-relaxed">
       {{ $project->description }}
    </p>
    
    <hr class="border-gray-200 mb-6">
    
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
            <h3 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
                Tareas 
                <span class="bg-gray-100 text-gray-700 text-xs font-bold px-2.5 py-1 rounded-full border border-gray-200">
                    {{ $project->tasks->count() }}
                </span>
            </h3>
            
            <a href="{{ route('tasks.create') }}?project={{ $project->id }}" 
               class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 transition-all duration-300 text-white px-5 py-2.5 rounded-xl font-medium shadow-lg shadow-blue-500/20 text-sm target:scale-95">
                <span class="text-lg font-bold">+</span>
                Nueva Tarea
            </a>
        </div>

        <div class="flex flex-wrap items-center gap-2 bg-gray-50 p-2 rounded-xl border border-gray-100">
            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-2">Filtrar:</span>
            
            <a href="?status=" 
               class="text-xs font-medium px-3 py-1.5 rounded-lg transition-colors {{ request('status') == '' ? 'bg-white text-gray-900 shadow-sm border border-gray-200' : 'text-gray-600 hover:bg-gray-100' }}">
                Todos
            </a>
            
            <a href="?status=Pendiente" 
               class="text-xs font-medium px-3 py-1.5 rounded-lg transition-colors {{ request('status') == 'Pendiente' ? 'bg-red-50 text-red-700 border border-red-200 shadow-sm' : 'text-gray-600 hover:bg-gray-100' }}">
                Pendientes
            </a>
            
            <a href="?status=En proceso" 
               class="text-xs font-medium px-3 py-1.5 rounded-lg transition-colors {{ request('status') == 'En proceso' ? 'bg-yellow-50 text-yellow-700 border border-yellow-200 shadow-sm' : 'text-gray-600 hover:bg-gray-100' }}">
                En proceso
            </a>
            
            <a href="?status=Completada" 
               class="text-xs font-medium px-3 py-1.5 rounded-lg transition-colors {{ request('status') == 'Completada' ? 'bg-green-50 text-green-700 border border-green-200 shadow-sm' : 'text-gray-600 hover:bg-gray-100' }}">
                Completadas
            </a>
        </div>
    </div>
   <div class="space-y-4">
    @forelse ($tasks as $task)
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-md transition-all duration-200 hover:border-gray-300">
            <h4 class="text-lg font-semibold text-gray-900 mb-4">{{ $task->title }}</h4>
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                
                <div class="flex items-center gap-2">
                    <span class="text-sm font-medium text-gray-500">Estado:</span>
                    
                    <form method="POST" action="{{ route('tasks.update', $task) }}" class="flex items-center gap-2 m-0">
                        @csrf
                        @method('PUT')
                        
                        <select name="status" 
                                class="text-xs font-semibold bg-white border border-gray-300 rounded-xl px-3 py-1.5 text-gray-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all shadow-sm cursor-pointer">
                                <option @selected($task->status === 'Pendiente')>Pendiente</option>
                                <option @selected($task->status === 'En Proceso')>En Proceso</option>
                                <option @selected($task->status === 'Completada')>Completada</option>
                        </select>
                        
                        <button type="submit" 
                                class="bg-gray-900 hover:bg-gray-800 text-white text-xs font-medium px-3 py-1.5 rounded-xl transition-all duration-200 shadow-sm active:scale-95 border border-transparent">
                            Actualizar
                        </button>
                    </form>
                    
                </div>
                <form  method="POST" action="{{ route('tasks.destroy',$task) }}">
                    @csrf
                    @method('DELETE')

                    <button class="bg-red-600 text-white px-3 py-1 rounded" type="submit">Eliminar</button>
                </form>
                <p class="text-sm text-gray-500 flex items-center gap-1">
                    <span class="font-medium text-gray-400">Fecha límite:</span> 
                    <span class="font-medium text-gray-700">{{ $task->due_date }}</span>
                </p>
            </div>
        </div>
    @empty
        <div class="text-center py-12 border-2 border-dashed border-gray-200 rounded-xl">
            <p class="text-gray-400 font-medium">No hay tareas en este estado actualmente.</p>
        </div>
    @endforelse
</div>
<h3>Papelera</h3>
<div>
    @forelse($deletedTasks as $task)
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-md transition-all duration-200 hover:border-gray-300">
            <h4 class="text-lg font-semibold text-gray-900 mb-4">{{ $task->title }}</h4>
            <p class="text-sm text-gray-500 flex items-center gap-1">
                <span class="font-medium text-gray-400">Fecha límite:</span> 
                <span class="font-medium text-gray-700">{{ $task->due_date }}</span>
                <form method="POST" action="{{ route('tasks.restore', $task) }}" >
                    @csrf
                    <button class="relative top-1 bg-green-600 text-white px-3 py-1 rounded" type="submit">Restaurar</button>
                </form>
            </p>
        </div>
    @empty
        <div class="text-center py-12 border-2 border-dashed border-gray-200 rounded-xl">
            <p class="text-gray-400 font-medium">No hay tareas en la papelera.</p>
        </div>
    @endforelse
</div>
</div>
</x-layouts::app>