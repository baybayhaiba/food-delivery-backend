<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Resources\CategoryResource; // Giả sử bạn tạo CategoryResource
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        // return CategoryResource::collection($categories); // Nếu có CategoryResource
        return response()->json($categories); // Tạm thời trả về JSON đơn giản
    }

    public function store(CategoryStoreRequest $request)
    {
        $category = Category::create($request->validated());
        // return new CategoryResource($category); // Nếu có CategoryResource
        return response()->json($category, 201); // Tạm thời trả về JSON đơn giản
    }

    public function show(Category $category)
    {
        // return new CategoryResource($category); // Nếu có CategoryResource
        return response()->json($category); // Tạm thời trả về JSON đơn giản
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update($request->validated());
        // return new CategoryResource($category); // Nếu có CategoryResource
        return response()->json($category); // Tạm thời trả về JSON đơn giản
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'Category deleted']);
    }

    public function dishes(Category $category)
    {
        $dishes = $category->dishes()->paginate(10);
        // return DishResource::collection($dishes); // Nếu có DishResource
        return response()->json($dishes); // Tạm thời trả về JSON đơn giản
    }
}
