<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('post')
            ->orderBy('created_at', 'desc')
            ->groupBy('post_id')
            ->get();
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
        $comment->content = $validatedData['comment'];
        $comment->parent_id = $validatedData['comment_parent_id'] ?? null; // Nếu không có, đặt null
        $comment->is_approve = $validatedData['status'] ?? 1; // Mặc định là 1 (hiển thị)
        $comment->created_at = now();
        $comment->save();

        return response()->json(['comment' => $comment, 'message' => 'Thêm bình luận thành công'], 201);
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
        $comment->content = $validatedData['comment'];
        $comment->is_approve = $validatedData['status'] ?? $comment->is_approve;
        $comment->save();

        return response()->json(['comment' => $comment, 'message' => 'Cập nhật bình luận thành công'], 200);
    }

    /**
     * Xóa bình luận.
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json(['message' => 'Xóa bình luận thành công'], 200);
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
