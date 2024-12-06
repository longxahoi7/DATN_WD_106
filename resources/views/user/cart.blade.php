@extends('user.index')

@section('content')
<div class="cart-table-container">
    <table class="cart-table" border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Chọn</th>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng cộng</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
            <tr>
                <td>
                    <input type="checkbox" />
                </td>
                <td class="pro-thumbnail">
                    <a href="#">
                        <img src="{{ $item->product->main_image_url }}" alt="{{ $item->product->name }}" width="100">
                    </a>
                </td>
                <td class="pro-title">
                    <a href="#">{{ $item->product->name }}</a>
                    @foreach($item->product->attributeProducts as $attribute)
                    <div class="attribute">
                        <span>Color: {{ $attribute->color->name }}</span>
                        <span>Size: {{ $attribute->size->name }}</span>
                        <span>Price: {{ number_format($attribute->price, 2) }} VND</span>
                    </div>
                    @endforeach
                </td>
                <td class="pro-price">
                    @php
                    $attributeProduct = $item->product->attributeProducts->first();
                    @endphp
                    <span>
                        {{ number_format($attributeProduct ? $attributeProduct->price : 0, 0, ',', '.') }} VND
                    </span>
                </td>
                <td class="pro-quantity">
                    <div class="quantity-control">
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <input type="number" name="qty" value="{{ $item->qty }}" min="1" />
                            <button type="submit" class="btn-update-quantity">Cập nhật</button>
                        </form>
                    </div>
                </td>
                <td class="pro-subtotal">
                    <span>
                        {{ number_format($item->qty * ($attributeProduct ? $attributeProduct->price : 0), 0, ',', '.') }} VND
                    </span>
                </td>
                <td class="pro-remove">
                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn">
                            <i class="fa fa-trash-o">Xóa</i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="cart-summary">
        <table>
            <tr>
                <th>Tổng tiền:</th>
                <td>{{ number_format($total, 0, ',', '.') }} VND</td>
            </tr>
            <tr>
                <th>Giảm giá:</th>
                <td>{{ number_format($discount, 0, ',', '.') }} VND</td>
            </tr>
            <tr>
                <th>Phí vận chuyển:</th>
                <td>{{ number_format($shippingFee, 0, ',', '.') }} VND</td>
            </tr>
            <tr>
                <th>Tổng cộng:</th>
                <td>{{ number_format($finalTotal, 0, ',', '.') }} VND</td>
            </tr>
        </table>
    </div>
</div>
@endsection
