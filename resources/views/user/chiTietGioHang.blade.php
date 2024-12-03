@extends("user.index")
@push('styles')
    <link rel="stylesheet" href="{{asset('css/chiTietGioHang.css')}}">
@endpush
@section("content")
<div class="cart-main-wrapper section-padding">
    <div class="container">
        <div class="section-bg-color">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Cart Table Area -->
                    <div class="cart-table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" />
                                    </th>
                                    <th class="pro-thumbnail">Hình ảnh sản phẩm</th>
                                    <th class="pro-title">Sản Phẩm</th>
                                    <th class="pro-price">Giá</th>
                                    <th class="pro-quantity">Số lượng</th>
                                    <th class="pro-subtotal">Tổng</th>
                                    <th class="pro-remove">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Thay thế phần này bằng các dòng sản phẩm -->
                                <tr>
                                    <td>
                                        <input type="checkbox" />
                                    </td>
                                    <td class="pro-thumbnail">
                                        <a href="#">
                                            <img class="img-fluid" src="image-path" alt="Product" />
                                        </a>
                                    </td>
                                    <td class="pro-title">
                                        <a href="#">Tên sản phẩm</a>
                                    </td>
                                    <td class="pro-price">
                                        <span>$00.00</span>
                                    </td>
                                    <td class="pro-quantity">
                                        <div class="quantity-control">
                                            <button>-</button>
                                            <input type="text" value="1" readonly />
                                            <button>+</button>
                                        </div>
                                    </td>
                                    <td class="pro-subtotal">
                                        <span>$00.00</span>
                                    </td>
                                    <td class="pro-remove">
                                        <button>
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Lặp lại các dòng sản phẩm -->
                            </tbody>
                        </table>
                    </div>
                    <!-- Cart Update Option -->
                    <div class="cart-update-option d-block d-md-flex justify-content-between">
                        <div class="apply-coupon-wrapper">
                            <form action="#" method="post" class="d-block d-md-flex">
                                <input type="text" placeholder="Vui lòng nhập mã giảm giá" required />
                                <button class="btn btn-sqr">Áp dụng mã giảm giá</button>
                            </form>
                        </div>
                        <div class="cart-update">
                            <a href="#" class="btn btn-sqr">Cập nhật giỏ hàng</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 ml-auto">
                    <!-- Cart Calculation Area -->
                    <div class="cart-calculator-wrapper">
                        <div class="cart-calculate-items">
                            <h6>Tổng đơn hàng</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Tổng giá sản phẩm</td>
                                            <td>$00.00</td>
                                        </tr>
                                        <tr>
                                            <td>Phí vận chuyển</td>
                                            <td>$70</td>
                                        </tr>
                                        <tr class="total">
                                            <td>Tổng chi phí</td>
                                            <td class="total-amount">$00.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <a href="checkout.html" class="btn btn-sqr d-block">Thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection