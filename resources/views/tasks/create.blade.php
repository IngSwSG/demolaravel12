<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear Tarea</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="max-w-2xl mx-auto mt-10 px-4">
        <h1 class="text-2xl font-bold mb-6">Crear Tarea</h1>

        <form method="POST" action="{{ route('tasks.store') }}" class="bg-white p-6 rounded-lg shadow">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre de la Tarea</label>
                <input type="text"
                       id="name"
                       name="name"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Usuario Asignado</label>
                <select id="user_id"
                        name="user_id"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" disabled selected>Selecciona un usuario</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between">
                <a href="{{ route('tasks.index') }}"
                   class="text-sm text-gray-600 hover:text-gray-800 transition">
                    ← Regreso al Inicio
                </a>
                <button type="submit"
                        class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
                    Guardar
                </button>
            </div>
        </form>
    </div>

</body>
</html>