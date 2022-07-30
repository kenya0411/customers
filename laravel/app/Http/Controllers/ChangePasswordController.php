<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{
    public function edit()
    {
        return view('password.form');
    }

    protected function validator(array $data)
    {
        return Validator::make($data,[
            'new_password' => 'required|string|min:6|confirmed',
            ]);
    }

    public function update(Request $request)
    {

        $user = \Auth::user();
        if(!password_verify($request->current_password,$user->password))
        {
            return redirect('/password/change')
                ->with('warning','パスワードが違います');
        }

        //新規パスワードの確認
        $this->validator($request->all())->validate();

        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect ('/')
            ->with('status','パスワードの変更が終了しました');
    }
}