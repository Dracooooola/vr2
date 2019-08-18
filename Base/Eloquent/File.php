<?php
/**
 * Created by PhpStorm.
 * User: vladislavklimov
 * Date: 18/08/2019
 * Time: 16:13
 */
namespace Base\Eloquent;
use Base\DBConnection;

class File extends \Illuminate\Database\Eloquent\Model
{
    public $table = 'files';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id', 'user_email', 'path'];

    public function userdata()
    {
        return $this->belongsTo(User::class, 'user_email', 'email');
    }
}
