<h1>Tasks</h1>
<hr>
<a href="{{ route('tasks.create') }}" class="btn btn-primary">Create Task</a>
<div>
    <form action="{{ route('tasks.index') }}" method="GET" class="form-inline">
        <label for="user_id">Filter by User:</label>
        <select name="user_id" id="user_id" class="form-control" onchange="this.form.submit()">
             <option value="">All Users</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
        </select>
    </form>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>User</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->name }}</td>
                <td>{{ $task->user->name }}</td>
                <td>
                    <form action="{{ route('tasks.status', $task->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <select name="status" onchange="this.form.submit()">
                            <option value="to do" {{ $task->status === 'to do' ? 'selected' : '' }}>To Do</option>
                            <option value="in progress" {{ $task->status === 'in progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="finished" {{ $task->status === 'finished' ? 'selected' : '' }}>Finished</option>
                        </select>
                    </form>
                </td>
                <td>
                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>