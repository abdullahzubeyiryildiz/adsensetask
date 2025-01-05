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
                    <th>Boyutlar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($adUnits as $adUnit)
                    <tr>
                        <td>{{ $adUnit->getName() }}</td>
                        <td>{{ $adUnit->getDisplayName() }}</td>
                        <td>{{ $adUnit->getContentAdsSettings()->getSize()->getWidth() }} x {{ $adUnit->getContentAdsSettings()->getSize()->getHeight() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</body>
</html>
