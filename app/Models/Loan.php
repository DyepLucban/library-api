<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{   
	 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'book_id', 'issue_date', 'due_date', 'return_date', 'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function book()
    {
        return $this->belongsTo('App\Models\Book');
    }    
}
