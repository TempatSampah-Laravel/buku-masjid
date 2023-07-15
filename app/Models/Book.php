<?php

namespace App\Models;

use App\Traits\Models\ConstantsGetter;
use App\Traits\Models\ForUser;
use App\Transaction;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use ForUser, ConstantsGetter;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    protected $fillable = ['name', 'description', 'status_id', 'creator_id'];

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getNameLabelAttribute()
    {
        return '<span class="badge badge-pill badge-secondary">'.$this->name.'</span>';
    }

    public function getStatusAttribute()
    {
        return $this->status_id == static::STATUS_INACTIVE ? __('app.inactive') : __('app.active');
    }
}
