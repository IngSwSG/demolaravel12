<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<h1 class="text-2xl font-bold mb-4">Show Task</h1>

<div class="bg-white p-6 rounded shadow-md max-w-xl space-y-3">
    <p><strong class="text-gray-700">Name:</strong> {{ $task->name }}</p>
    <p><strong class="text-gray-700">User ID:</strong> {{ $task->user_id }}</p>
    <p><strong class="text-gray-700">Status:</strong> {{ $task->status ?? 'No status set' }}</p>
    <p><strong class="text-gray-700">Task ID:</strong> {{ $task->id }}</p>
    <p><strong class="text-gray-700">Created at:</strong> {{ $task->created_at }}</p>
    <p><strong class="text-gray-700">Updated at:</strong> {{ $task->updated_at }}</p>

    <div class="pt-4">
        <a href="{{ route('tasks.index') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            ← Back to Tasks
        </a>
    </div>
</div>

</body>
</html>