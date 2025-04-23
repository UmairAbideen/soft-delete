<!-- resources/views/users/index.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>


    <div class="container mt-5">

        <h4>Add New User</h4>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('users.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="row mb-2">
                <div class="col">
                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                </div>
                <div class="col">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="col">
                    <input type="number" name="age" class="form-control" placeholder="Age" required>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-success">Add User</button>
                </div>
            </div>
        </form>

        <h2>All Users</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->age }}</td>
                        <td>
                            <form action="{{ route('users.softDelete', $user->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger">Soft Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('users.trashed') }}" class="btn btn-primary">View Trashed Users</a>
    </div>
</body>

</html>
