@foreach ($listProduct as $product)
    <a href="#">Tên:{{ $product->name }}</a>
    <p>Mô tả:{{$product->description}}</p>
    <p>3:{{$product->sku}}</p>
    <p>4:{{$product->subtitle}}</p>
    <p>5:{{$product->slug}}</p>
    <hr>
@endforeach