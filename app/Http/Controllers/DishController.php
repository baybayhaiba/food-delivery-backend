<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Http\Resources\DishResource; // Giả sử bạn tạo DishResource
use App\Http\Requests\DishStoreRequest;
use App\Http\Requests\DishUpdateRequest;
use Illuminate\Http\Request;

class DishController extends Controller
{
    public function index()
    {
        $dishes = Dish::paginate(10);
        // return DishResource::collection($dishes); // Nếu có DishResource
        return response()->json($dishes); // Tạm thời trả về JSON đơn giản
    }

    public function store(DishStoreRequest $request)
    {
        $dish = Dish::create($request->validated());
        // return new DishResource($dish); // Nếu có DishResource
        return response()->json($dish, 201); // Tạm thời trả về JSON đơn giản
    }

    public function show(Dish $dish)
    {
        // return new DishResource($dish); // Nếu có DishResource
        return response()->json($dish); // Tạm thời trả về JSON đơn giản
    }

    public function update(DishUpdateRequest $request, Dish $dish)
    {
        $dish->update($request->validated());
        // return new DishResource($dish); // Nếu có DishResource
        return response()->json($dish); // Tạm thời trả về JSON đơn giản
    }

    public function destroy(Dish $dish)
    {
        $dish->delete();
        return response()->json(['message' => 'Dish deleted']);
    }
}
