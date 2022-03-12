<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller
{
/*--------------------------------------------------- */
/* 一覧を表示
/*--------------------------------------------------- */
    public function index(Request $request)
    {
        $param = ['is_delete' => 0];

        $items = DB::select('select * from persons where is_delete=:is_delete', $param);
        return view('persons.index', ['items' => $items]);
    }


    public function post(Request $request)
    {
        $items = DB::select('select * from persons');
        return view('persons.index', ['items' => $items]);
    }

/*--------------------------------------------------- */
/* 削除
/*--------------------------------------------------- */
    public function delete(Request $request)
    {
        $validator = Validator::make($request->query(), ['persons_id' => 'required'], ['persons_id' => 'IDを指定してください。']);
        if ($validator->fails()) {
            return redirect('persons')->withErrors($validator);
        }
        $param = ['persons_id' => $request->persons_id];
        $item = DB::select('select * from persons where persons_id=:persons_id', $param);
        return view('persons.delete', ['form' => $item[0]]);
    }

    public function remove(Request $request)
    {
        $param = [
            'persons_id' => $request->persons_id,
            'is_delete' => 1,
        ];
        // DB::delete('delete from persons where persons_id=:persons_id', $param);
        DB::update('update persons set is_delete=:is_delete where persons_id=:persons_id', $param);
        return redirect('persons');
    }



/*--------------------------------------------------- */
/* 編集
/*--------------------------------------------------- */
    public function update(Request $request)
    {
        $param = [
            'persons_id' => $request->persons_id,
            'persons_name' => $request->persons_name,
            'persons_platform_name' => $request->persons_platform_name,
            'persons_platform_url' => $request->persons_platform_url,
            'persons_platform_fee' => $request->persons_platform_fee,
        ];
        DB::update('update persons set persons_name=:persons_name, persons_platform_name=:persons_platform_name, persons_platform_url=:persons_platform_url, persons_platform_fee=:persons_platform_fee where persons_id=:persons_id', $param);            
        return redirect('persons');
    }



/*--------------------------------------------------- */
/* 追加
/*--------------------------------------------------- */
    public function add(Request $request)
    {
        return view('persons.add');
    }

    public function create(personRequest $request)
    // public function create(Request $request)
    {
        $param = [
            'persons_name' => $request->persons_name,
            'persons_platform_name' => $request->persons_platform_name,
            'persons_platform_url' => $request->persons_platform_url,
            'persons_platform_fee' => $request->persons_platform_fee,
        ];
        DB::insert('insert into persons (persons_name, persons_platform_name, persons_platform_url,persons_platform_fee) values (:persons_name, :persons_platform_name, :persons_platform_url,:persons_platform_fee)', $param);
        return redirect('persons');
    }
}