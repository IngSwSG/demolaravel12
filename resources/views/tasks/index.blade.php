<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900 p-6">

    <h1 class="text-3xl font-bold mb-4">Tasks</h1>
    <hr class="mb-4">

    <a href="{{ route('tasks.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Create Task
    </a>

    {{-- Filtro por usuario --}}
    <div class="bg-white p-4 mt-6 rounded shadow">
        <form action="{{ route('tasks.index') }}" method="GET" class="flex items-center gap-4">
            <label for="user_id" class="font-semibold">Filter by User:</label>
            <select name="user_id" id="user_id" class="border rounded px-2 py-1" onchange="this.form.submit()">
                <option value="">All Users</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    {{-- Tabla de tareas --}}
    <table class="min-w-full bg-white shadow-md mt-6 rounded overflow-hidden">
        <thead class="bg-gray-200">
            <tr>
                <th class="py-2 px-4 text-left">ID</th>
                <th class="py-2 px-4 text-left">Name</th>
                <th class="py-2 px-4 text-left">User</th>
                <th class="py-2 px-4 text-left">Status</th>
                <th class="py-2 px-4 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr class="border-b">
                    <td class="py-2 px-4">{{ $task->id }}</td>
                    <td class="py-2 px-4">{{ $task->name }}</td>
                    <td class="py-2 px-4">{{ $task->user->name }}</td>
                    <td class="py-2 px-4">
                        <form action="{{ route('tasks.status', $task->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="border px-2 py-1 rounded">
                                <option value="to do" {{ $task->status === 'to do' ? 'selected' : '' }}>To Do</option>
                                <option value="in progress" {{ $task->status === 'in progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="finished" {{ $task->status === 'finished' ? 'selected' : '' }}>Finished</option>
                            </select>
                        </form>
                    </td>
                    <td class="py-2 px-4 space-x-2">
                        <a href="{{ route('tasks.show', $task->id) }}" class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">View</a>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
