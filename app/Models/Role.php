<?php

namespace App\Models;

use http\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory;

    private static $member;
    private static $admin;

    protected $fillable = [
        'name',
    ];

    public static function member() {
        if(is_null(self::$member)) {
            self::$member = Role::all()->where('name', 'like', 'member')->first();
        }
        return self::$member;
    }

    public static function admin() {
        if(is_null(self::$admin)) {
            self::$admin = Role::all()->where('name', 'like', 'admin')->first();
        }
        return self::$admin;
    }

//    static public function __callStatic($method, $args)
//    {
//        var_dump($method);
//        if (preg_match('/^([gs]et)([A-Z])(.*)$/', $method, $match)) {
//            $reflector = new \ReflectionClass(__CLASS__);
//            $property = strtolower($match[2]) . $match[3];
//            if ($reflector->hasProperty($property)) {
//                $property = $reflector->getProperty($property);
//                var_dump($property);
//                switch ($match[1]) {
//                    case 'get':
//                    {
//                        if (is_null($property->getValue())) {
//                            switch ($property->name) {
//                                case 'member':
//                                {
//                                    $member = Role::all()->where('name', 'like', 'member')->first();
//                                    var_dump($member);
//                                    if (is_null($member)) throw new ModelNotFoundException();
//
//                                    $property->setValue($member);
//                                    break;
//                                }
//                                case 'admin':
//                                {
//                                    $admin = Role::all()->where('name', 'like', 'admin')->first();
//                                    var_dump($admin);
//                                    if (is_null($admin)) throw new ModelNotFoundException();
//
//                                    $property->setValue($admin);
//                                    break;
//                                }
//                            }
//                        }
//                        return $property->getValue();
//                    }
//                    case 'set':
//                    {
//                        break;
//                    }
//                }
//            }
//        }
//        return parent::__callStatic($method, $args);
//    }

    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }
}
