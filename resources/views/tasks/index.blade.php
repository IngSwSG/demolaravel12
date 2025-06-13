<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tasks List</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        thead {
            background-color: #2c3e50;
            color: #fff;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .completed {
            color: green;
            font-weight: bold;
        }

        .pending {
            color: #e67e22;
            font-weight: bold;
        }

        .btn {
            padding: 6px 12px;
            margin: 0 2px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-success {
            background-color: #27ae60;
            color: white;
        }

        .btn-warning {
            background-color: #f39c12;
            color: white;
        }

        .btn-primary {
            background-color: #2980b9;
            color: white;
        }

        .btn-danger {
            background-color: #c0392b;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }

        form {
            display: inline;
        }
    </style>
</head>
<body>

    <h1>Tasks List</h1>
    <hr>

    <table>
        <thead>
            <tr>
                <th>Task</th>
                <th>User</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <td>{{ $task->name }}</td>
                <td>{{ $task->user->name }}</td>
                <td>
                    @if($task->completed)
                        <span class="completed">Completed</span>
                    @else
                        <span class="pending">Pending</span>
                    @endif
                </td>
                <td>
                    <form action="{{ route('tasks.toggle-complete', $task->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn {{ $task->completed ? 'btn-success' : 'btn-warning' }}">
                            {{ $task->completed ? 'Mark Pending' : 'Mark Complete' }}
                        </button>
                    </form>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
