<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Adoptions</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Pet Name</th>
                <th>Pet Kind</th>
                <th>Pet Breed</th>
                <th>User Fullname</th>
                <th>User Email</th>
                <th>User Phone</th>
                <th>Adoption Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($adoptions as $adoption)
            <tr>
                <td>{{ $adoption->id }}</td>
                <td>{{ $adoption->pet->name }}</td>
                <td>{{ ucfirst($adoption->pet->kind) }}</td>
                <td>{{ $adoption->pet->breed }}</td>
                <td>{{ $adoption->user->fullname }}</td>
                <td>{{ $adoption->user->email }}</td>
                <td>{{ $adoption->user->phone }}</td>
                <td>{{ $adoption->created_at->format('Y-m-d H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>