<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CommentController extends Controller
{
    // Lấy tất cả comment
    public function index()
    {
        $comments = Comment::with('replies')
            ->orderBy('post_id', 'asc') // Sắp xếp theo post_id tăng dần
            ->get();
        return response()->json($comments, 200);
    }

    // Lấy comment của 1 post cụ thể
    public function getCommentsByPost($postId)
    {
        $comments = Comment::where('post_id', $postId)
            ->with('replies')
            ->orderBy('created_at', 'desc') // Sắp xếp theo thời gian mới nhất
            ->get();
        return response()->json($comments, 200);
    }

    // Tạo mới 1 comment
    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|integer',
            'is_approve' => 'required|boolean',
            'level' => 'required|integer',
            'post_id' => 'required|integer|exists:posts,id',
            'content' => 'required|max:150',
        ]);

        $validated['created_at'] = Carbon::now();

        $comment = Comment::create($validated);
        return response()->json($comment, 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|integer',
            'is_approve' => 'required|boolean',
            'level' => 'required|integer',
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string|max:150',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update($validated);
        return response()->json($comment);
    }

    // Xóa 1 comment
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return response()->json(['message' => 'Comment deleted successfully'], 200);
    }
}
