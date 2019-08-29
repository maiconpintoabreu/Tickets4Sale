<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ShowByDay extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var int
     */
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $table = 'show_by_day';
    protected $fillable = ['title','price','tickets_available','status'];
    protected $hidden = ['show','capacity','discount_percentage','show_date','id','show_id'];
    public function show()
    {
        return $this->belongsTo(Show::class);
    }
    public function getTitleAttribute()
    {
        return "{$this->show->title}";
    }
    protected $appends = ['title'];
    protected $with = ['show'];
}
