<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'category', 'author', 'no_of_copies', 'in_stocks', 'published_date',
    ];

    public function loan()
    {
        return $this->hasMany('App\Loan');
    }    
}
