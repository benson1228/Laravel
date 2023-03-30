<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dept extends Model
{
    use HasFactory;
    protected $table = "dept";
    protected $primaryKey = ["deptId"];

    protected $fillable = [
        "deptId",
        "dept_name"
    ];
}
