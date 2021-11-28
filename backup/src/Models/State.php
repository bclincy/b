<?php
/**
 * Created by PhpStorm.
 * User: bclincy
 * Date: 9/17/18
 * Time: 10:58 AM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class State extends Model
{

    protected $table = 'states';
    protected $primaryKey = 'stateID';

    protected $fillable = [
        'state',
        'abbreviation'
    ];

}
