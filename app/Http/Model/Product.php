<?php

namespace App\Http\Model;

use DB;
use Validator;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $dateFormat = 'Y-m-d H:i:s';

}
