<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 9/17/18
 * Time: 11:37 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    const CREATED_AT = 'created_on';
    const UPDATED_AT = 'update_on';

//    public_html $timestamps = false;

    protected $fillable = [
        'name',
        'message',
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