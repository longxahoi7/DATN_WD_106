<div class="two">
    <div class="brand-info">
        <p>
            <strong>Ảnh:</strong>
            <img src="{{$category->image}}" width="100px" height="100px" alt="">
        </p>
        <h3>
            Tên Danh mục:
            <span id="name">{{$category->name}}</span>
        </h3>
        <p>
            <strong>Mô Tả:</strong>
            <span id="description">{{$category->description}}</span>
        </p>
        <p>
            <strong>Tên Đường Dẫn:</strong>
            <span id="slug">{{$category->slug}}</span>
        </p>
        <p>
            <strong>Ngày Tạo:</strong>
            <span id="created_at">{{ \Carbon\Carbon::parse($category->created_at)->format('d/m/Y H:i') }}</span>
        </p>
        <p>
            <strong>Ngày Cập Nhật:</strong>
            <span id="updated_at">{{ \Carbon\Carbon::parse($category->updated_at)->format('d/m/Y H:i') }}</span>
        </p>
    </div>
</div>
<div class="text-center">
    <a href="{{ route('admin.categories.index') }}" class="btn btn-success baby-huong">Quay lại danh sách thương
        hiệu</a>
</div>