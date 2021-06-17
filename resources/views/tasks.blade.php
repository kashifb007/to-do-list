<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MLP To-Do</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
          integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="{{ asset('style.css') }}" type="text/css" rel="stylesheet">
</head>
<body>
<div class="container-lg">
    <div class="row">
        <div class="col-4"><img src="/assets/logo.png" alt="logo"></div>
    </div>
    <div class="row">
        <div class="col-4">
            <form method="post" action="{{ route('tasks.store') }}" id="task_form" name="task_form">
                @csrf
                <input type="text" class="form-control" placeholder="{{ __('Task') }}" aria-label="{{ __('Task') }}"
                       id="task" name="task">
                @error('title')
                <div class="errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @enderror
                <button type="submit" class="btn btn-primary" type="button"
                        id="button-addon1">{{ __('Add Task') }}</button>
            </form>
        </div>
        <div class="col-8 tasks">
            <?php if(isset($tasks)) { ?>
            <table>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Task</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        @if($task->completed)
                            <td colspan="3">
                                <del>{{ $task->task }}</del>
                            </td>
                        @else
                            <td>
                                {{ $task->task }}
                            </td>
                            <td>
                                <form method="POST" action="{{route('tasks.update', $task->id) }}" name="updateForm">
                                    @method('PATCH')
                                    @csrf
                                    <button id="complete" name="complete"
                                            type="submit"><i class="fas fa-check-square"></i></button>
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="{{route('tasks.destroy', $task->id) }}" name="deleteForm">
                                    @method('DELETE')
                                    @csrf
                                    <button id="delete" name="delete" type="submit"><i class="fas fa-times-circle"></i>
                                    </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
            <?php } ?>
        </div>
    </div>
</div>
</body>
</html>
