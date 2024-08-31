<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskModel extends Model
{
    use HasFactory;
    public $table ='task';
    public $primaryKey ='task_id';
    public $incrementing =true;
    public $keyType ='int';
    public $timestamps =false;
}
