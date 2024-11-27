<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Lấy tất cả bình luận.
     */
    public function index()
    {
        $comments = Comment::with('post')->get();
        return response()->json(['comments' => $comments], 200);
    }

    /**
     * Tạo một bình luận mới.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comment' => 'required|string',
            'comment_parent_id' => 'nullable|exists:comments,id',
            'status' => 'boolean',
        ]);

        $comment = new Comment();
        $comment->post_id = $validatedData['post_id'];
        $comment->comment = $validatedData['comment'];
        $comment->comment_parent_id = $validatedData['comment_parent_id'] ?? null; // Nếu không có, đặt null
        $comment->status = $validatedData['status'] ?? 1; // Mặc định là 1 (hiển thị)
        $comment->save();

        return response()->json(['comment' => $comment, 'message' => 'Comment created successfully'], 201);
    }

    /**
     * Cập nhật bình luận.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'comment' => 'required|string',
            'status' => 'boolean',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->comment = $validatedData['comment'];
        $comment->status = $validatedData['status'] ?? $comment->status;
        $comment->save();

        return response()->json(['comment' => $comment, 'message' => 'Comment updated successfully'], 200);
    }

    /**
     * Xóa bình luận.
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully'], 200);
    }

    /**
     * Lấy một bình luận theo ID.
     */
    public function show($id)
    {
        $comment = Comment::with('post')->findOrFail($id);
        return response()->json(['comment' => $comment], 200);
    }
}
