<style>
.container {
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.category-detail {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.brand-info {
    text-align: left;
    margin-top: 20px;
}

.image-container img {
    border-radius: 8px;
    border: 2px solid #ddd;
    margin-bottom: 10px;
}

strong {
    color: #333;
    font-weight: bold;
}

span {
    color: #555;
}
</style>
<div class="container">
    <div class="category-detail">
        <div class="brand-info">
            <div class="image-container">
                <img src="{{$category->image}}" width="150px" height="150px" alt="Ảnh danh mục">
            </div>

            <h3>
                <strong>Tên Danh mục:</strong>
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
</div>