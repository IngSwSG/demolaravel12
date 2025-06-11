<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-6 text-gray-900">

    <div class="max-w-xl mx-auto bg-white p-8 rounded shadow-md">
        <h1 class="text-2xl font-bold mb-4">Edit Task</h1>
        <hr class="mb-6">

        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Nombre de la tarea --}}
            <div>
                <label for="name" class="block font-semibold mb-1">Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $task->name) }}"
                    required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400"
                >
            </div>

            {{-- Usuario --}}
            <div>
                <label for="user_id" class="block font-semibold mb-1">User</label>
                <select
                    id="user_id"
                    name="user_id"
                    required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400"
                >
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $task->user_id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Estado --}}
            <div>
                <label for="status" class="block font-semibold mb-1">Status</label>
                <select
                    id="status"
                    name="status"
                    required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400"
                >
                    <option value="to do" {{ $task->status === 'to do' ? 'selected' : '' }}>To Do</option>
                    <option value="in progress" {{ $task->status === 'in progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="finished" {{ $task->status === 'finished' ? 'selected' : '' }}>Finished</option>
                </select>
            </div>

            {{-- Botón de enviar --}}
            <div class="text-right">
                <button
                    type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                >
                    Update Task
                </button>
            </div>
        </form>
    </div>

</body>
</html>
