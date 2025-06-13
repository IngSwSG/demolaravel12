<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<h1 class="text-2xl font-bold mb-4">Create Task</h1>

<form method="POST" action="{{ route('tasks.store') }}" class="bg-white p-6 rounded shadow-md max-w-xl space-y-5">
    @csrf

    {{-- Nombre --}}
    <div>
        <label for="name" class="block font-semibold mb-1">Name</label>
        <input
            type="text"
            id="name"
            name="name"
            required
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
    </div>

    {{-- Usuario --}}
    <div>
        <label for="user_id" class="block font-semibold mb-1">User</label>
        <select
            id="user_id"
            name="user_id"
            required
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- Botones --}}
    <div class="flex justify-between items-center">
        <a href="{{ route('tasks.index') }}" class="text-blue-600 hover:underline">← Back to Tasks</a>
        <button
            type="submit"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700"
        >
            Create Task
        </button>
    </div>
</form>
</body>
