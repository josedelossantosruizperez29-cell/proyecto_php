<x-layouts::app>
<div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow-sm border border-gray-200 flex flex-col gap-4">
<h3>Papelera</h3>
<div class="flex flex-col gap-4">
    @forelse($projects as $project)
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-md transition-all duration-200 hover:border-gray-300">
            <h4 class="text-lg font-semibold text-gray-900 mb-4">{{ $project->title }}</h4>
            <p class="text-sm text-gray-500 flex items-center gap-1">
                <span class="font-medium text-gray-400">Fecha límite:</span> 
                <span class="font-medium text-gray-700">{{ $project->created_at }}</span>
                <form method="POST" action="{{ route('projects.restore', $project) }}" >
                    @csrf
                    <button class="relative top-1 bg-green-600 text-white px-3 py-1 rounded" type="submit">Restaurar</button>
                </form>
            </p>
        </div>
    @empty
        <div class="text-center py-12 border-2 border-dashed border-gray-200 rounded-xl">
            <p class="text-gray-400 font-medium">No hay proyectos en la papelera.</p>
        </div>
    @endforelse
</div>
</div>
</x-layouts::app>