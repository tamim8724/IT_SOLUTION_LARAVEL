<?php

namespace App\Models;

// Same switch as BaseModel, for the admin login user.
if (config('database.default') === 'mongodb' && class_exists(\MongoDB\Laravel\Auth\User::class)) {
    abstract class BaseUser extends \MongoDB\Laravel\Auth\User
    {
    }
} else {
    abstract class BaseUser extends \Illuminate\Foundation\Auth\User
    {
    }
}
