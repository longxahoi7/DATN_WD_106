<?php

namespace App\Http\Controllers\Admin;
use App\Models\Reviews;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReviewsReply;
class ReviewController extends Controller
{
    //
    public function listReview()
{
    $reviews = Reviews::with(['product:product_id,name', 'user:user_id,email,name'])->get(); // Lấy tất cả bình luận với sản phẩm và người dùng liên quan
    return view('admin.pages.reviews.list', compact('reviews'));
}
public function toggle($id)
{
    $review = Reviews::findOrFail($id);

    // Thay đổi trạng thái is_active
    $review->is_active = !$review->is_active;
    $review->save();

    return redirect()->back()->with('success', 'Trạng thái bình luận đã được thay đổi!');
}
public function reply($id)
{
    $review = Reviews::with('product:product_id,name')->findOrFail($id);

    // Lấy product_id từ review
    $product_id = $review->product->product_id; // Truy xuất trực tiếp từ mối quan hệ `product`
    return view('admin.pages.reviews.reply', compact('review', 'product_id'));
}


// * Xử lý trả lời bình luận.
// */
public function storeReply(Request $request, $id)
{
   $review = Reviews::findOrFail($id);

   // Kiểm tra quyền admin
   if (auth()->user()->role== 1) {
       $reply = new ReviewsReply([
           'review_id' => $review->review_id,
           'user_id' => auth()->id(),
           'content' => $request->input('content'),
           'product_id' => $review->product_id, // Lưu product_id của review
       ]);
       $reply->save();
   }
   return redirect()->route('admin.reviews.index')->with('success', 'Đã trả lời bình luận.');
}


public function editReview($id)
{
    $review = Reviews::findOrFail($id); // Tìm bình luận theo ID
    return view('reviews.edit', compact('review'));
}
public function updateReview(Request $request, $id)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string',
    ]);

    $review = Reviews::findOrFail($id);
    $review->rating = $request->input('rating');
    $review->comment = $request->input('comment');
    $review->save();

    return redirect()->route('reviews.index')->with('success', 'Cập nhật bình luận thành công.');
}
public function destroyReview($reviewId)
{
    $review = Reviews::findOrFail($reviewId);
    $review->delete();

    return redirect()->route('admin.reviews.index')->with('success', 'Bình luận đã được xóa.');
}




}
