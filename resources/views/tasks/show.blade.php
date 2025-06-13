<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalles</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="max-w-xl mx-auto mt-10 px-4">
        <h1 class="text-2xl font-bold mb-6">Detalles de la Tarea</h1>

        <div class="bg-white p-6 rounded-lg shadow">
            <p class="mb-4"><strong class="text-gray-700">Nombre:</strong> {{ $task->name }}</p>
            <p class="mb-4"><strong class="text-gray-700">Usuario:</strong> {{ $task->user->name }}</p>

            <div class="mt-6 flex justify-between">
                <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-600 hover:underline">Editar</a>
                <a href="{{ route('tasks.index') }}" class="text-sm text-gray-600 hover:text-gray-800">← Regresar</a>
            </div>
        </div>
    </div>

</body>
</html>