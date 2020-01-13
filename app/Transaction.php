<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author_id',
        'article_id',
        'house_id',
        'points',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    /**
     * Get the transactions article.
     */
    public function article()
    {
        return $this->hasOne('App\Article', 'article_id');
    }
    /**
     * Get the transaction's author.
     */
    public function user()
    {
        return $this->hasOne('App\User', 'author_id');
    }
    /**
     * Get the transaction's house.
     */
    public function house()
    {
        return $this->hasOne('App\House', 'house_id');
    }
}
