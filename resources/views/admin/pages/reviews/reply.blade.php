@extends('admin.index')
@push('styles')
@endpush
@section('content')

<body>
    <div class="container mt-5">
        <h1 class="text-center">Thêm Mới Thương Hiệu</h1>
        <form action="{{route('admin.reviews.storeReply',$review->review_id)}}" method="POST">
            @csrf
            <div class="form-group">
                <input type="hidden" class="form-control" id="name" name="product_id" value="{{$product_id}}"/>
            </div>
            </div>

            <div class="form-group">
                <label for="slug">Nhập câu trả lời</label>
                <input type="text" class="form-control" id="slug" name="content" placeholder="Nhập câu trả lời" />
            </div>
            <div class="button-container">
                <button type="submit" class="btn btn-primary">
                    Gửi
                </button>
                <a href="{{route('admin.reviews.index')}}" class="btn btn-secondary">Hủy</a>
            </div>

        </form>
    </div>
    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script>

    </script>
    @endpush
</body>
@endsection
