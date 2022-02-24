    
@extends('common.base'){{-- 継承元 --}}
@section('title','add'){{-- タイトル --}}
@section('heading','product登録画面'){{-- 見出し --}}


@section('content')
    <section class="productFrom maxWid mbPad formSection">   

        <form action="./add" method="post">
            @csrf

            <dl>
                <dt>date:</dt>
                <dd>      

                    <select name="date_year" id="">
                        @php
                        $d = now();
                        $year = $d->format('Y');
                        $year_add = $d->addYears(1)->format('Y');
                        @endphp
                        <option value="{{ $year }}">{{ $year }}年</option>
                        <option value="{{ $year_add }}">{{ $year_add }}年</option>

                    </select>
                    <select name="date_month" id="">
                        @php
                        $month = $d->format('n');
                        $month_add = $d->addMonths(1)->format('n');
                        @endphp
                        <option value="{{ $month }}">{{ $month }}月</option>
                        <option value="{{ $month_add }}">{{ $month_add }}月</option>

                    </select>
                </dd>
 
                <dt>persons_name</dt>
                <dd>
                    <select name="persons_id" id="">

                        @foreach ($persons as $person)
                        <option value="{{ $person->persons_id}}">{{ $person->persons_name}}</option>
                        @endforeach
                    </select>
                </dd>
     

                   <dt> products_name:</dt>
                <dd>            
                    <input type="text" name="products_name" value="{{ old('products_name') }} " >
                    @error('products_name')
                    <div class="errorMessage">
                        {{ $message }}<br>

                    </div>
                    @enderror
                </dd>
            <dt> products_price:</dt>
                <dd>            
                    <input type="number" name="products_price" inputmode="numeric" value="{{ old('products_price') }} " >
                    @error('products_price')
                    <div class="errorMessage">
                        {{ $message }}<br>
                    </div>
                    @enderror
                </dd>

            <dt> products_method:</dt>
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

            <dt> products_detail:</dt>
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
</section>






@endsection
