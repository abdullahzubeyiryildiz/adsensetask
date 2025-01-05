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
                    <th>Reklam ID</th>
                    <th>Reklam Adı</th>
                    <th>Konum</th>
                    <th>Durum</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ads as $ad)
                    <tr>
                        <td>{{ $ad->ad_unit_id }}</td>
                        <td>{{ $ad->name }}</td>
                        <td>{{ $ad->location }}</td>
                        <td>{{ $ad->is_active ? 'Aktif' : 'Pasif' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</body>
</html>
