<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package;

class Order extends Model
{
    use HasFactory;

     /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['packages'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'recipient',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function packages(){
        return $this->hasMany(Package::class);
    }
}
