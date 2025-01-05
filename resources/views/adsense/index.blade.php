<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdSense Reklam Listesi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>AdSense Reklam Listesi</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ad Unit Name</th>
                    <th>Ad Unit ID</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($adUnits as $index => $adUnit)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $adUnit->getName() }}</td>
                        <td>{{ $adUnit->getId() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
