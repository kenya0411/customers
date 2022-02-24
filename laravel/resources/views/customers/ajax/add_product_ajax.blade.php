@foreach ($products as $product)

<option value="{{ $product->products_id}}" data-value="{{ $product->products_number}}">{{ $product->products_name}}</option>
@endforeach
