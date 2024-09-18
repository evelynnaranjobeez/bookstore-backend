<!DOCTYPE html>
<html>
<head>
    <title>List of Users</title>
</head>
<body>
<h1>List of Users</h1>

@if($users->isEmpty())
    <p>No users available</p>
@else
    <table border="1" cellpadding="10">
        <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <a href="{{ route('users.show', $user->id) }}">View</a> |
                    <a href="{{ route('users.edit', $user->id) }}">Edit</a> |
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

</body>
</html>
