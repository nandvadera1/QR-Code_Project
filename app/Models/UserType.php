<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

<<<<<<< HEAD
=======

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
>>>>>>> 920cae324a7f3bc3a827804499fe95e0e46bdf0c
    protected $fillable = [
        'type'
    ];
    public function users(){
        return $this->hasMany(User::class);
    }

}
