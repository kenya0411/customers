    
@extends('common.base'){{-- 継承元 --}}
@section('title','商品登録画面'){{-- タイトル --}}
@section('heading','商品登録画面'){{-- 見出し --}}


@section('content')
    <div class="backBtn">
        <a href="/products">戻る</a>
    </div> 
    <div class="productFrom  formSection">   

        <form action="./add" method="post">
            @csrf

            <dl>
 
 
                <dt>鑑定士名</dt>
                <dd>
                    <select name="persons_id" id="">

                        @foreach ($persons as $person)
                        <option value="{{ $person->persons_id}}">{{ $person->persons_name}}</option>
                        @endforeach
                    </select>
                </dd>
     

                   <dt>商品名</dt>
                <dd>            
                    <input type="text" name="products_name" value="{{ old('products_name') }} " >
                    @error('products_name')
                    <div class="errorMessage">
                        {{ $message }}<br>

                    </div>
                    @enderror
                </dd>
            <dt>料金</dt>
                <dd>            
                    <input type="number" name="products_price" inputmode="numeric" value="{{ old('products_price') }} " >
                    @error('products_price')
                    <div class="errorMessage">
                        {{ $message }}<br>
                    </div>
                    @enderror
                </dd>

            <dt>鑑定方法</dt>
                <dd>            
                    <select name="products_method" id="">
                        <option value="霊感タロット">霊感タロット</option>
                        <option value="霊感・霊視">霊感・霊視</option>
                        <option value="その他">その他</option>

                    </select>
                    @error('products_method')
                    <div class="errorMessage">
                        {{ $message }}<br>
                    </div>
                    @enderror
                </dd>

            <dt> 鑑定内容</dt>
                <dd>            
                    <textarea name="products_detail" id="" cols="30" rows="10"></textarea>
                    @error('products_detail')
                    <div class="errorMessage">
                        {{ $message }}<br>
                    </div>
                    @enderror
                </dd>
    
    
        </dl>
        <div class="btnWrap">
            <input type="submit" class="sendBtn" value="登録する">
            
        </div>

    </form>
</div>






@endsection
