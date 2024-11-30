<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('children')->get();
        return response()->json($categories);
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->with('children')->first();

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($category);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if (isset($data['parentId']) && !Category::where('id', $data['parentId'])->exists()) {
            $data['parentId'] = null;
        }
    
        $validator = Validator::make($data, [
            'slug' => 'required|unique:categories,slug|max:255',
            'name' => 'required|max:255',
            'parentId' => 'nullable|exists:categories,id',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $validator->errors()
            ], 422);
        }
    
        $category = Category::create($data);
    
        return response()->json($category, 201);
    }
    

    public function update(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->first();
    
        if (!$category) {
            return response()->json(['message' => 'Không tìm thấy danh mục'], 404);
        }
        $data = $request->all();

        if (isset($data['parentId']) && !Category::where('id', $data['parentId'])->exists()) {
            $data['parentId'] = null;
        }
        
        $validated = Validator::make($data, [
            'slug' => 'required|unique:categories,slug,' . $category->id . '|max:255',
            'name' => 'required|max:255',
            'parentId' => 'nullable|exists:categories,id',
        ])->validate();
        if (isset($validated['parentId']) && $validated['parentId'] == $category->id) {
            return response()->json(['message' => 'parentId không thể trùng với id của chính danh mục'], 400);
        }
    
        $category->update($validated);
    
        return response()->json([
            'message' => 'Cập nhật danh mục thành công',
            'data' => $category
        ], 200);
    }
    
    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            return response()->json(['message' => 'Không tìm thấy danh mục'], 404);
        }

        $category->delete();
        return response()->json(['message' => 'Cập nhật danh mục thành công ']);
    }
}
