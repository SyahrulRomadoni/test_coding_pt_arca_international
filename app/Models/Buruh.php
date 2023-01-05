<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Buruh extends Model
{
    protected $table = 'buruh';

    protected $primaryKey = 'id';

    protected $fillable = [
        'buruh',
        'persentase',
        'hasil',
    ];

    protected $hidden = [
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
