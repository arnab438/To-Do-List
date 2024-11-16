<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
    // <uniquifier>: Use a unique and descriptive class name
// <weight>: Use a value from 100 to 900

.roboto-condensed-<body> {
  font-family: "Roboto Condensed", sans-serif;
  font-optical-sizing: auto;
  font-weight: <weight>;
  font-style: normal;
}
</style>
</head>

<body>
    {{-- <nav class="navbar navbar-expand-lg bg-success-subtle"> --}}
        {{-- <div class="container-fluid">
            <a class="navbar-brand" href="#">Todo App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                {{-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('tasks') }}">Tasks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('task.create')}}">Create</a>
                    </li>
                </ul> --}
                {{-- <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form> --}
            </div>
        </div> --}}
    {{-- </nav> --}}
    
    <div class="container-fluid">
        <div class="row bg-danger py-3 text-white" >
            <div class="col-md">
                <div class="text-center h1" style="font-family: 'Roboto Condensed', sans-serif;">
                    ToDo List
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        
        
        <div class="row p-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Create a Task
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('task.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label required">Task</label>
                                <input required name="title" type="text" class="form-control" id="title" placeholder="Task title">
                            </div>
                            <div class="mb-3">
                                <label for="expires_at" class="form-label">Expiration Time</label>
                                <input name="expires_at" type="datetime-local" class="form-control" id="expires_at">
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                        
                    </div>
                    <div class="card-footer ">
                        <div class="small">
                            * Required field
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 ">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Task Title</th>
                        
                        <th scope="col">Expiring at</th>
                        <th scope="col">Status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        @if (isset($tasks))
                            @php
                                $counter = 1; // Initialize a counter variable
                            @endphp
                            @foreach ($tasks as $task)
                            <tr>
                                <th scope="row">{{ $counter }}</th> <!-- Display the counter instead of task->id -->
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->expires_at ? \Carbon\Carbon::parse($task->expires_at)->diffForHumans() : 'No expiration' }} 
                                   <span class="text-secondary small"> ({{ \Carbon\Carbon::parse($task->expires_at)->format('jS M Y \a\t h:i A') }})</span>
                                </td>
                                <td>
                                    @if($task->completed)
                                        <i class="bi bi-check-circle text-success"></i>
                                       <span class="text-primary fw-medium ms-1 small">Completed</span>  <!-- Completed -->
                                    @else
                                        @if($task->expires_at && \Carbon\Carbon::parse($task->expires_at)->isPast())
                                            <i class="bi bi-x-circle text-danger"></i>
                                            <span class="text-danger fw-medium ms-1 small">Expired</span> <!-- Expired -->
                                        @else
                                            <form action="{{ route('task.complete', $task->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-primary py-1">Mark as Complete</button>
                                            </form>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('task.delete', ['id' => $task->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $task->id }}">
                                        <button type="submit" class="btn btn-outline-danger py-1">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @php
                                $counter++; // Increment the counter
                            @endphp
                            @endforeach
                        @endif
                    </tbody>
                    
                  </table>
                
            </div>
        </div>
    </div>
    
    
    <div class="container-fluid">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-muted">© 2021 Arnab's Todo App</p>
        
            <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
              <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            </a>
        
            {{-- <ul class="nav col-md-4 justify-content-end">
              <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Country</a></li>
              <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">State</a></li>
              <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">City</a></li>
            </ul> --}}
          </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
