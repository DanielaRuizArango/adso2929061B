<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>All Users</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; font-size: 10px; }
        th { background: #eee; }
        img { border-radius: 5px; }
    </style>
</head>
<body>
    <h1>All Pets</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Kind</th>
                <th>Weight</th>
                <th>Age</th>
                <th>Breed</th>
                <th>Location</th>
                <th>Description</th>
                <th>Active</th>
                <th>Adopted</th>
                <th>Photo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->document }}</td>
                <td>{{ $user->fullname }}</td>
                <td>{{ $user->gender }}</td>
                <td>{{ $user->birthdate }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <img src="{{ public_path($user->photo) }}" width="50">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>