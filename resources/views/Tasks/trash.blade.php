<x-layouts::app>

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
            <form method="POST" action="{{ route('tasks.forcedelete', $task) }}" >
                    @csrf
                    @method('PUT')
                    <button class="relative top-[-26px] left-40 bg-red-600 text-white px-3 py-1 rounded" type="submit">Eliminar</button>
            </form>
        </div>
    @empty
        <div class="text-center py-12 border-2 border-dashed border-gray-200 rounded-xl">
            <p class="text-gray-400 font-medium">No hay tareas en la papelera.</p>
        </div>
    @endforelse
</div>
</x-layouts::app>