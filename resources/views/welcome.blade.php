<!DOCTYPE html>
<html>
<head>
    <title>API Documentation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>API Documentation</h1>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Method</th>
            <th>URI</th>
            <th>Name</th>
            <th>Action</th>
            <th>Middleware</th>
        </tr>
        </thead>
        <tbody>
        @foreach($routes as $route)
            @if(strpos($route->uri(), 'api/') === 0) {{-- Lọc routes API --}}
            <tr>
                <td>{{ implode(' | ', array_diff($route->methods(), ['HEAD'])) }}</td>
                <td><code>{{ $route->uri() }}</code></td>
                <td>{{ $route->getName() }}</td>
                <td>{{ $route->getActionName() }}</td>
                <td>
                    @foreach($route->middleware() as $middleware)
                        <span class="badge bg-secondary">{{ $middleware }}</span>
                    @endforeach
                </td>
            </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
