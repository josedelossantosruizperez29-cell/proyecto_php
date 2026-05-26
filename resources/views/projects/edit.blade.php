<x-layouts::app>

<div class="relative top-20 max-w-lg mx-auto p-6 bg-white rounded-lg shadow-md border border-gray-200">
<form action="{{ route('projects.update', $project) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-5">
        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Título de la terea
        </label>

        <input
            value="{{ $project->title }}"            
            name="title"
            type="text"
            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
        >
    </div>

    <div class="mb-6">
        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Descripción de la terea
        </label>

        <textarea
            name="description"
            rows="4"
            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 resize-y"
        >{{ $project->description }}</textarea>
    </div>
             <div class="mb-5">


        <input
            name="project_id"
            type="hidden"
            value="{{ $project->id }}"
            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
        >
    </div>

    <button
        type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 shadow-sm hover:shadow"
    >
        Guardar Proyecto
    </button>
</form>
</div>

</x-layouts::app>