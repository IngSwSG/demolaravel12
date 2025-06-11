<h1>Edit task</h1>
<hr>
<form action="{{ route('tasks.update', $task->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ $task->name }}" required>
    </div>
     <div>
        <label for="user_id">User ID</label>
        <select id="user_id" name="user_id" required>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $user->id == $task->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="status">Status</label>
        <select id="status" name="status" required>
            <option value="to do" {{ $task->status === 'to do' ? 'selected' : '' }}>To Do</option>
            <option value="in progress" {{ $task->status === 'in progress' ? 'selected' : '' }}>In Progress</option>
            <option value="finished" {{ $task->status === 'finished' ? 'selected' : '' }}>Finished</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update Task</button>
</form>