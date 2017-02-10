<?php

namespace App\Http\Model;

use DB;
use Validator;
use Illuminate\Database\Eloquent\Model;

class Question extends Model {
    protected $table = 'question';
    protected $primaryKey = 'id';
    protected $dateFormat = 'Y-m-d H:i:s';

    public static function findNext($id) {
        $obj = self::where('id', '>', $id)->first();

        return $obj;
    }
}
