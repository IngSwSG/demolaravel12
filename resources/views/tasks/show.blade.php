<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<div class="centered-form-container">
    <h1 class="form-title">Show Task</h1>
    <div class="form-group">
        <label>Name:</label>
        <div>{{ $task->name }}</div>
    </div>
    <div class="form-group">
        <label>User:</label>
        <div>{{ $task->user->name ?? $task->user_id }}</div>
    </div>
    <div class="form-actions">
        <a href="{{ route('tasks.index') }}" class="btn btn-info">Back to Tasks</a>
    </div>
</div>
