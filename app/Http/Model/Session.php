<?php

namespace App\Http\Model;

use DB;
use Validator;
use Illuminate\Database\Eloquent\Model;

class Session extends Model {
    protected $table = 'session';
    protected $primaryKey = 'id';
    protected $dateFormat = 'Y-m-d H:i:s';

    public static function autoGenerate() {
        $sid = md5(uniqid(rand()));

        $sess = new self();
        $sess->id = (string)$sid;

        $sess->save();

        return $sid;
    }
}
