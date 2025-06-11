<h1 class="tasks-title">Tasks</h1>
<hr>
<a href="{{ route('tasks.create') }}" class="btn btn-primary">Crear Tarea</a>
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<div>
    <form action="{{ route('tasks.index') }}" method="GET" class="form-inline">
        <label for="user_id">Filtrar por usuario:</label>
        <select name="user_id" id="user_id" class="form-control" onchange="this.form.submit()">
            <option value="">Todos</option>
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
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tasks as $task)
            <tr class="{{ $task->completed == 2 ? 'completed-row' : '' }}">
                <td>{{ $task->id }}</td>
                <td>{{ $task->name }}</td>
                <td>{{ $task->user->name }}</td>
                <td>
                    @if ($task->completed == 0)
                        <span class="badge bg-secondary">Pendiente</span>
                    @elseif ($task->completed == 1)
                        <span class="badge bg-warning">En Proceso</span>
                    @elseif ($task->completed == 2)
                        <span class="badge bg-success-light">Completada</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Editar</a>
                    
                    {{-- Lógica de botones según estado --}}
                    @if ($task->completed == 0)
                        <form action="{{ route('tasks.complete', ['id' => $task->id, 'state' => 1]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-warning">En Proceso</button>
                        </form>
                    @elseif ($task->completed == 1)
                        <form action="{{ route('tasks.complete', ['id' => $task->id, 'state' => 2]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">Completar</button>
                        </form>
                    @endif

                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
