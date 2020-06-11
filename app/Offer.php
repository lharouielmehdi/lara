<?php

namespace App;
namespace App;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{

    use HasApiTokens;
    use Notifiable;
    use SoftDeletes;
    protected $date = [
        'deleted_at'
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   protected $fillable = [
    'name', 'date', 'ville','description','place','owner','owner_phone'
];
}
