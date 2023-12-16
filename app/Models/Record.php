<?php

namespace App\Models;

use App\Http\Traits\Models\CanRequestPaginate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory, CanRequestPaginate;
}
