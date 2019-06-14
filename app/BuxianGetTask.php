<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BuxianGetTask extends Model
{
    public $table =  'buxian_get_task';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'task_id', 'created_at', 'updated_at'
    ];

}
