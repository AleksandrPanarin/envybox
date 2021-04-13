<?php

namespace App\Services\Factory;

use Illuminate\Support\Facades\DB;

class MysqlDatabase implements IStore
{
    public function save(Feedback $feedback): void
    {
        $data = $feedback->toArray();
        $db = DB::connection('mysql');
        $db->table('feedback')->insert($data);
    }
}
