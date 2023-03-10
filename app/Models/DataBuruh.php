<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DataBuruh extends Model
{
    protected $table = 'data_buruh';

    protected $primaryKey = 'id';

    protected $fillable = [
        'pembayaran',
    ];

    protected $hidden = [
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
