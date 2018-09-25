<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 9/17/18
 * Time: 11:37 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Joblead extends Model
{
    const CREATED_AT = 'create_at';

    protected $fillable = [
        'name',
        'email',
        'agency',
        'DevType',
        'note',
        'linkedIn',
    ];

}