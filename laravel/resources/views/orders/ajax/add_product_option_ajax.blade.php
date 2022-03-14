{{-- @if($products_options) --}}
@foreach ($products_options as $product_option)
<option value="{{ $product_option->products_options_id}}">{{ $product_option->products_options_name}}</option>
@endforeach
{{-- @else --}}
{{-- <option value=""></option> --}}

{{-- @endif; --}}

