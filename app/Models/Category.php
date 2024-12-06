<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes ;
    protected $table='categories';
    protected $primaryKey='category_id';
    protected $fillable=['name','description','image','slug','is_active','parent_id'];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public static function callTreeCategory($parent_id = 0, $levels = "")
    {
        // Lấy các danh mục con dựa trên parent_id
        $categories = Category::where('parent_id', '=', $parent_id)->get();

        // Mảng kết quả
        $result = [];

        foreach ($categories as $category) {
            // Thêm vào danh mục vào mảng kết quả với id, name và levels
            $result[] = [
                'category_id' => $category->category_id,
                'name' => $levels . $category->name
            ];

            // Đệ quy để lấy các danh mục con của danh mục này
            $result = array_merge($result, self::callTreeCategory($category->category_id, $levels . "-"));
        }

        return $result;
    }
}
