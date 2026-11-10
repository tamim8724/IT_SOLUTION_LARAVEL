<?php

namespace App\Models;

/*
 | Database switch.
 | Live site: DB_CONNECTION=mongodb (MongoDB Atlas) uses the MongoDB model.
 | Without MongoDB (e.g. a quick local test with SQLite) the normal Laravel model is used,
 | so the same code works with both.
 */
if (config('database.default') === 'mongodb' && class_exists(\MongoDB\Laravel\Eloquent\Model::class)) {
    abstract class BaseModel extends \MongoDB\Laravel\Eloquent\Model
    {
    }
} else {
    abstract class BaseModel extends \Illuminate\Database\Eloquent\Model
    {
    }
}
