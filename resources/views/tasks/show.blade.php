<h1>Show task</h1>
<hr>
<p><strong>Name:</strong> {{ $task->name }}</p>
<p><strong>User ID:</strong> {{ $task->user_id }}</p>
<p><strong>Status:</strong> {{ $task->status ?? 'No status set' }}</p>
<p><strong>Task ID:</strong> {{ $task->id }}</p>
<p><strong>Created at:</strong> {{ $task->created_at }}</p>
<p><strong>Updated at:</strong> {{ $task->updated_at }}</p>

<a href="{{ route('tasks.index') }}" class="btn btn-primary">Back to Tasks</a>   