<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Http\Resources\RestaurantResource;
use App\Http\Requests\RestaurantStoreRequest;
use App\Http\Requests\RestaurantUpdateRequest;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::paginate(10);
        return RestaurantResource::collection($restaurants);
    }

    public function show(Restaurant $restaurant)
    {
        return new RestaurantResource($restaurant);
    }

    public function store(RestaurantStoreRequest $request)
    {
        $restaurant = Restaurant::create($request->validated());
        return new RestaurantResource($restaurant);
    }

    public function update(RestaurantUpdateRequest $request, Restaurant $restaurant)
    {
        $restaurant->update($request->validated());
        return new RestaurantResource($restaurant);
    }

    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return response()->json(['message' => 'Restaurant deleted']);
    }

    public function dishes(Restaurant $restaurant)
    {
        $dishes = $restaurant->dishes()->paginate(10);
        // Giả sử có DishResource, cần tạo DishResource tương tự RestaurantResource
        // return DishResource::collection(DishResource::collection($dishes);
        return response()->json($dishes); // Tạm thời trả về JSON đơn giản để test
    }
}
