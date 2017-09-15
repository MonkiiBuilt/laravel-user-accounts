<?php

namespace MonkiiBuilt\LaravelUserAccounts\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    public function permissions()
    {
        return $this->belongsToMany('MonkiiBuilt\LaravelUserAccounts\Models\Permission');
    }
}
