<?php

namespace App\Models;

use App\Http\Enums\TamanhoEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;

    protected $casts = [
        'size' => TamanhoEnum::class
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'size',
        'format',
        'price',
    ];

}
