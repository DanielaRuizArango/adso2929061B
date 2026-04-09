<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>All Pets</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            font-size: 10px;
        }

        th {
            background: #eee;
        }

        img {
            border-radius: 5px;
        }
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
            @foreach($pets as $pet)
                <tr>
                    <td>{{ $pet->id }}</td>
                    <td>{{ $pet->name }}</td>
                    <td>{{ $pet->kind }}</td>
                    <td>{{ $pet->weight }}</td>
                    <td>{{ $pet->age }}</td>
                    <td>{{ $pet->breed }}</td>
                    <td>{{ $pet->location }}</td>
                    <td>{{ $pet->description }}</td>
                    <td>{{ $pet->active == 1 ? 'Yes' : 'No' }}</td>
                    <td>{{ $pet->adopted == 1 ? 'Yes' : 'No' }}</td>
                    <td>
                        <img src="{{ public_path($pet->image == 'no-image.png' ? 'images/pets/no-image.png' : $pet->image) }}"
                            width="50">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>