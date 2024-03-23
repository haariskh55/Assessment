<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
</head>
<body>
    <div class="container text-center">
        <h1>Dashboard</h1>
        <div class="row">
            <!-- Unique Visitors Card -->
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card card-visit">
                    <div class="card-body">
                        <i class="icon fas fa-users"></i>
                        <div class="stat">{{ $visitors }}</div>
                        <div class="description">Total Unique Visitors</div>
                    </div>
                </div>
            </div>

            <!-- Dynamically create a card for each stage -->
            @foreach ($stages as $stage)
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card card-general">
                    <div class="card-body">
                        <!-- Placeholder icon, replace with appropriate one -->
                        <i class="icon fas fa-chart-bar"></i>
                        <div class="stat">{{ $stage->stage }}: {{ $stage->count }}</div>
                        <div class="description">Visitors by {{ $stage->stage }} Stage</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Font Awesome for icons (you can use your own choice of icons) -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
