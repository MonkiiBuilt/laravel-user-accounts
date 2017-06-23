<?php
namespace MonkiiBuilt\LaravelUserAccounts\Models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    public function roles()
    {
        return $this->belongsToMany('MonkiiBuilt\LaravelUserAccounts\Models\Role');
    }

    public static function loadByName($name) {
        return self::where('name', $name)->first();
    }

}
