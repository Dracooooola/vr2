<?php
/**
 * Created by PhpStorm.
 * User: vladislavklimov
 * Date: 18/08/2019
 * Time: 16:12
 */
namespace Base\Eloquent;
use Base\DBConnection;

class User extends \Illuminate\Database\Eloquent\Model
{
    public $table = 'users';
    protected $primaryKey = 'email';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['email', 'password', 'name', 'surname', 'birthday', 'avatar'];


    public function userdata()
    {
        return $this->hasMany(File::class, 'user_email', 'email');
    }
}
