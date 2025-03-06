<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route as RouteFacade;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\BufferedOutput;

class RouteListController extends Controller
{
    public function index()
    {
        $output = new BufferedOutput();
        Artisan::call('route:list', ['--json' => true], $output);
        $routesJson = $output->fetch();
        $routesArray = json_decode($routesJson, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Failed to decode route list JSON.'], 500);
        }

        return response()->json($routesArray);
    }

    public function postmanCollection()
    {
        $routes = RouteFacade::getRoutes(); // Lấy danh sách routes từ Route Facade
        $postmanCollection = $this->generatePostmanCollection($routes);

        try {
            return response()->json($postmanCollection, 200, [], JSON_PRETTY_PRINT) // Trả về JSON đẹp
            ->header('Content-Type', 'application/json')
                ->header('Content-Disposition', 'attachment; filename="api-collection.postman_collection.json"'); // Tải file
        }catch (e) {
            return response()->json(['error' => 'Failed to decode postman collection JSON. ==>'], 500);
        }


    }

    protected function generatePostmanCollection($routes)
    {
        $collection = [
            'info' => [
                'name' => config('app.name') . ' API Collection', // Tên collection từ config app.name
                'description' => 'API Collection generated from Laravel routes.',
                'schema' => 'https://schema.getpostman.com/json/collection/v2.1.0/collection.json'
            ],
            'item' => [],
        ];

        foreach ($routes as $route) {
            if (str_starts_with($route->uri(), 'api/')) { // Chỉ lấy routes bắt đầu bằng 'api/' (tùy chỉnh)
                $item = $this->createPostmanItemFromRoute($route);
                if ($item) {
                    $collection['item'][] = $item;
                }
            }
        }

        return $collection;
    }

    protected function createPostmanItemFromRoute($route)
    {
        $methods = array_diff($route->methods(), ['HEAD']); // Loại bỏ method HEAD
        if (empty($methods)) {
            return null; // Bỏ qua nếu không có method hợp lệ (ví dụ: chỉ có HEAD)
        }
        $method = reset($methods); // Lấy method đầu tiên (thường chỉ có 1)
        $uri = $route->uri();
        $routeName = $route->getName();
        $action = $route->getActionName();
        $middleware = $route->middleware();

        $request = [
            'method' => $method,
            'header' => [], // Có thể thêm headers mặc định nếu cần
            'url' => [
                'raw' => '{{baseURL}}/' . $uri, // Sử dụng biến môi trường Postman baseURL
                'host' => ['{{baseURL}}'],
                'path' => explode('/', $uri),
                'variable' => [], // Có thể thêm variables cho path parameters nếu cần
            ],
            'description' => "Route URI: `{$uri}`\n" .
                "Route Name: `{$routeName}`\n" .
                "Action: `{$action}`\n" .
                "Middleware: `" . implode(', ', $middleware) . "`", // Mô tả route
        ];

        return [
            'name' => $routeName ?: $uri, // Tên item là route name hoặc URI
            'request' => $request,
            'response' => [] // Có thể thêm example responses nếu cần
        ];
    }
}
