<?php

namespace packages\Infrastructure\Eloquent\User;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserEloquent
 */
class UserEloquent extends Model
{
    protected $table = 'users';
    public $incrementing = false;

    protected $fillable = ['id', 'account_id', 'token', 'state'];
}
