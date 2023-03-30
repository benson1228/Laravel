<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $table = "about";
    protected $primaryKey = ["id"];

    protected $fillable = [
        "id",
        "title",
        "content",
        "createDate"
    ];
}
