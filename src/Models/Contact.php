<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 9/17/18
 * Time: 11:37 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    const CREATED_AT = 'recievedOn';
    const UPDATED_AT = 'modifiedOn';
    protected $table = 'contact';

//    public $timestamps = false;

    protected $fillable = [
        'fname',
        'lname',
        'email',
        'subject',
        'message',
        'isReturned',
        'recievedOn'
    ];

    public function setUpdatedAtAttribute()
    {
        return (new \DateTime('now')) ->format('Y-M-D G:i:s');
    }

    public function setCreatedAt()
    {
        return (new \DateTime('now')) ->format('Y-M-D G:i:s');
    }
}