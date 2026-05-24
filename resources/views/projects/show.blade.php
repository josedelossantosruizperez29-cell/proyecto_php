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
            
            <a href="{{ route('projects.create') }}" 
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
        @foreach ($tasks as $task)
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-md transition-all duration-200 hover:border-gray-300">
                <h4 class="text-lg font-semibold text-gray-900 mb-3">{{ $task->title }}</h4>
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <p class="text-sm text-gray-700 flex items-center">
                        <span class="font-medium text-gray-500">Estado:</span>
                        
                        @if ($task->status == "En proceso")
                        <span class="ml-2 inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 border border-yellow-200">
                            {{ $task->status }}
                        </span>
                        @endif
                        
                        @if ($task->status == "Pendiente")
                        <span class="ml-2 inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800 border border-red-200">
                            {{ $task->status }}
                        </span>
                        @endif
                        
                        @if ($task->status == "Completada")
                        <span class="ml-2 inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200">
                            {{ $task->status }}
                        </span>
                        @endif
                    </p>
                    <p class="text-sm text-gray-500 flex items-center gap-1">
                        <span class="font-medium text-gray-400">Fecha límite:</span> 
                        <span class="font-medium text-gray-700">{{ $task->due_date }}</span>
                    </p>
                </div>
            </div>
        @endforeach
    </div>

</div>
</x-layouts::app>