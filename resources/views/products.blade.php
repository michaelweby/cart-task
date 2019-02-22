@foreach($products as $product)
    <div class="col-md-2">
        {{ $product['id'] }}
    </div>
    <div class="col-md-5">
        {{ $product['name'] }}
    </div>
    <div class="col-md-5">
        {{ $product['quantity'] }}
    </div>
@endforeach
