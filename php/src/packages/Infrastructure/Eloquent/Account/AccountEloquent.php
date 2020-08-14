<?php

namespace packages\Infrastructure\Eloquent\Account;

use Illuminate\Database\Eloquent\Model;

class AccountEloquent extends Model
{
    protected $table = 'accounts';
    public $incrementing = false;

    protected $fillable = ['id', 'balance'];
}
