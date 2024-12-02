<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BannedWord;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    //
    public function store(Request $request)
    {
        $bannedWords = BannedWord::pluck('word')->toArray();
        $content=$request->input('content');
        // Kiểm tra người dùng có bị cấm không
        $user = Auth::user();
        if ($user->is_banned) {
            return response()->json(['message' => 'Bạn bị cấm bình luận.'], 403);
        }
        // Thay thế từ ngữ bậy bạ bằng dấu "*"
        foreach ($bannedWords as $bannedWord) {
            if (stripos($content, $bannedWord) !== false) {
                $content = str_ireplace($bannedWord, str_repeat('*', strlen($bannedWord)), $content);
            }
        }

        // Validate dữ liệu
        $request->validate([
            'commentable_id' => 'required|exists:products,id', // Thêm validate cho đối tượng (ở đây là sản phẩm)
            'content' => 'required|string|max:1000',
        ]);

        // Tạo bình luận mới
        $comment = Comment::create([
            'user_id' => $user->id,
            'commentable_id' => $request->input('commentable_id'),
            'commentable_type' => Product::class,  // Lấy class của đối tượng
            'content' => $content,
        ]);

        return response()->json(['message' => 'Bình luận thành công', 'comment' => $comment], 201);
    }
    public function index($commentable_id)
    {
        // Lấy tất cả bình luận cho một đối tượng cụ thể (ví dụ: sản phẩm)
        $comments = Comment::where('commentable_id', $commentable_id)
            ->where('commentable_type', Product::class)
            ->with('user') // Đưa thông tin người dùng vào nếu cần
            ->get();

        return response()->json($comments);
    }
    public function update(Request $request, Comment $comment)
    {
        $user = Auth::user();

        // Kiểm tra người dùng có phải là người tạo bình luận không
        if ($user->id !== $comment->user_id) {
            return response()->json(['message' => 'Bạn không có quyền sửa bình luận này.'], 403);
        }

        // Validate dữ liệu
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // Cập nhật bình luận
        $comment->update([
            'content' => $request->input('content'),
        ]);

        return response()->json(['message' => 'Cập nhật bình luận thành công', 'comment' => $comment], 200);
    }
    public function destroy(Comment $comment)
    {
        // Bạn có thể sử dụng đối tượng $comment mà không cần phải query lại
        // Ví dụ: Xóa bình luận
        $comment->delete();

        return response()->json(['message' => 'Bình luận đã được xóa'], 200);
    }

}
