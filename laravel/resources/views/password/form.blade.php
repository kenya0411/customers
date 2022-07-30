





    @extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">パスワード変更</div>

                <div class="card-body">
    @if(session('warning'))
        <div class="alert alert-danger">
            {{ session('warning') }}
        </div>
    @endif

     <div class="row mt-5 mb-5">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route'=>'password.change','method'=>'put']) !!}
                <div class="form-group">
                    {!! Form::label('current_password','以前のパスワード') !!}
                    {!! Form::password('current_password',['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('new_password','新しいパスワード') !!}
                    {!! Form::password('new_password',['class'=>'form-control']) !!}
                ※パスワードは8文字以上
                </div>


                <div class="form-group">
                    {!! Form::label('new_password_confirmation','パスワードの確認') !!}
                    {!! Form::password('new_password_confirmation',['class'=>'form-control']) !!}
                </div>

                {!! Form::submit('パスワードを変更する',['class'=>'btn btn btn-primary mt-2']) !!}
            {!! Form::close() !!}

        </div>
    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
