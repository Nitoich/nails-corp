<?php

namespace App\Models;

use App\Services\JWTService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'token',
        'expire_date'
    ];

    public function access_token(): string
    {
        return app()->make(JWTService::class)->generate([
            'ur_id' => $this->user_id,
            'ss_id' => $this->id
        ]);
    }
}
