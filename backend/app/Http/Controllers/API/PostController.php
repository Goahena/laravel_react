<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with('categories', 'author')->get();
        if($posts -> isEmpty()) {
            return response()->json([
                'message' => 'Không có bài viết nào',
            ],);
        }
        $groupedPosts = $posts->groupBy(fn($post) => $post->categories->first()->id ?? null);

        $result = $groupedPosts->map(fn($postsInCategory, $categoryId) => [
            'category_id' => $categoryId,
            'category_name' => $postsInCategory->first()->categories->first()->name ?? 'Không xác định',
            'category_slug' => $postsInCategory->first()->categories->first()->slug ?? 'Không xác định',
            'posts' => $postsInCategory->map(fn($post) => [
                'slug' => $post->slug,
                'title' => $post->title,
                'description' => $post->description,
                'image' => $post->image,
                'created_at' => $post->created_at,
                'author_name' => $post->author->username
            ])->values()
        ])->values();
    
        return response()->json($result);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'slug' => 'required|unique:posts,slug|max:255',
            'title' => 'required|max:255',
            'description' => 'nullable|max:255',
            'tag' => 'nullable|max:255',
            'author_id' => 'required|exists:users,id',
            'is_active' => 'boolean',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $imagePath = $request->file('image')->store('images', 'public');
                $validated['image'] = basename($imagePath);
            } else {
                return response()->json(['error' => 'Tệp hình ảnh không hợp lệ'], 400);
            }
        } else {
            return response()->json(['error' => 'Không có hình ảnh được tải lên'], 400);
        }
        $post = Post::create($validated);

        if ($request->has('categories')) {
            $post->categories()->sync($request->categories);
        }

        return response()->json($post, 201);
    }


    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)->with('categories', 'author')->first();

        if (!$post) {
            return response()->json(['message' => 'Không tìm thấy bài viết'], 404);
        }
        $result = [
            'slug' => $post->slug,
            'title' => $post->title,
            'description' => $post->description,
            'image' => $post->image,
            'created_at' => $post->created_at,
            'updated_at' => $post->updated_at,
            'author_name' => $post->author->username ?? 'Không rõ tác giả',
            'categories' => $post->categories->map(fn($category) => [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
            ])->values(),
        ];

        return response()->json($result);
    }


    public function update(Request $request, string $slug)
    {
        $post = Post::where('slug', $slug)->first();

        if (!$post) {
            return response()->json(['message' => 'Không tìm thấy bài viết'], 404);
        }

        $validated = $request->validate([
            'slug' => 'required|unique:posts,slug,' . $post->id . ',id|max:255',
            'title' => 'required|max:255',
            'description' => 'nullable|max:255',
            'tag' => 'nullable|max:255',
            'author_id' => 'required|exists:users,id',
            'is_active' => 'boolean',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::delete('public/images/' . $post->image);
            }

            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = basename($imagePath);
        }

        $post->update($validated);

        if ($request->has('categories')) {
            $post->categories()->sync($request->categories);
        }

        return response()->json($post);
    }

    public function destroy(string $slug)
    {
        $post = Post::where('slug', $slug)->first();

        if (!$post) {
            return response()->json(['message' => 'Không tìm thấy bài viết'], 404);
        }

        $post->categories()->detach();
        $post->delete();

        return response()->json(['message' => 'Xóa bài viết thành công']);
    }
}