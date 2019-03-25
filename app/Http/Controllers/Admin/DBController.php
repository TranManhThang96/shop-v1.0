<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class DBController extends Controller
{
    public function rawIndex()
    {
        $province = DB::select('select * from provinces where id = ?', [1]);
        dd($province);
    }

    public function rawInsert()
    {
        $provinceNew = DB::insert('insert into provinces(id,name) values(?,?)', [999, 'test']);
        dd($provinceNew);
    }

    public function rawUpdate()
    {
        $affected = DB::update("update customers set user_name = 'demo' where 1 > ?", [0]);
        dd($affected);
    }

    public function transaction()
    {
        DB::transaction(function () {
            DB::delete('delete from provinces where id = :id', ['id' => 999]);
            DB::update("update customers set user_name = 'demo' where 1 > ?", [0]);
        });
    }

    public function testQueryBuilder()
    {
       $record = DB::table('customers')
                    ->updateOrInsert(
                        ['id'=>1,'name'=>'thắng'],
                        ['code'=>'test','email'=> 'huyền']
                    );

        dd($record);
    }
}
