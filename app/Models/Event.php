<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'start', 'end', 'color'];

    public function getStartAttribute($value)
    {
        $dateStart = Carbon::createFromFormat("Y-m-d H:i:s", $value)->format("Y-m-d");
        $timeStart = Carbon::createFromFormat("Y-m-d H:i:s", $value)->format("H:i:s");

        return $timeStart == '00:00:00' ? $dateStart : $value;
    }

    public function getEndAttribute($value)
    {
        $dateEnd = Carbon::createFromFormat("Y-m-d H:i:s", $value)->format("Y-m-d");
        $timeEnd = Carbon::createFromFormat("Y-m-d H:i:s", $value)->format("H:i:s");

        return $timeEnd == '00:00:00' ? $dateEnd : $value;
    }
}
