@extends('common.base'){{-- 継承元 --}}
@section('title','persons_add'){{-- タイトル --}}
@section('heading','person登録画面'){{-- 見出し --}}


@section('content')
    <section class="personFrom maxWid mbPad formSection">   

        <form action="./add" method="post">
            @csrf
            <dl>
                <dt>persons_name:</dt>
                <dd>            
                    <input type="text" name="persons_name" id="persons_name" value="{{ old('persons_name') }} " >
                    @error('persons_name')
                    <div class="errorMessage">
                        {{ $message }}<br>

                    </div>
                    @enderror
                </dd>
                <dt>persons_platform_name</dt>
                <dd>

                    <input type="text" name="persons_platform_name" id="persons_platform_name" value="{{ old('persons_platform_name') }}">
                    @error('persons_platform_name')
                    <div class="errorMessage">
                        {{ $message }}<br>

                    </div>
                    @enderror
                </dd>
                <dt>persons_platform_url</dt>
                <dd>           

                    <input type="text" name="persons_platform_url" id="persons_platform_url" value="{{ old('persons_platform_url') }}">
                     @error('persons_platform_url')
                    <div class="errorMessage">
                        {{ $message }}<br>

                    </div>
                    @enderror
                </dd>
                <dt>persons_platform_fee</dt>
                <dd>     @error('persons_platform_fee')
                  <div class="errorMessage">
                    {{ $message }}<br>
                    
                </div>
                @enderror
                <input type="text" name="persons_platform_fee" id="persons_platform_fee" value="{{ old('persons_platform_fee') }}">
            </dd>
        </dl>
        <div class="btnWrap">
            <input type="submit" class="sendBtn" value="登録する">
            
        </div>

    </form>
</section>
@endsection