<div class="container">
    <div class="two">
        <div class="brand-info">
            <h3>
                Tên size:
                <span id="name">{{$size->name}}</span>
            </h3>

            <p>
                <strong>Ngày Tạo:</strong>
                <span id="created_at">{{ \Carbon\Carbon::parse($size->created_at)->format('d/m/Y H:i') }}</span>
            </p>
            <p>
                <strong>Ngày Cập Nhật:</strong>
                <span id="updated_at">{{ \Carbon\Carbon::parse($size->updated_at)->format('d/m/Y H:i') }}</span>
            </p>
        </div>
    </div>
</div>