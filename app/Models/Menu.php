<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'tabel_menu';
    protected $primaryKey = 'id';
    protected $guarded = [
        'id'
    ];
    public function getRouteKeyName()
    {
        return 'kode_menu';
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
