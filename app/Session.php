<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Session extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'token';
    protected $fillable = ['token'];
    protected $table = 'session';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($session){
            $session->token = base64_encode(random_bytes(30));
        });
    }
}
