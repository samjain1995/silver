<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';

    //protected $appends = ['stay_time'];

    public function user()
    {
        return $this->belongsTo(User::class, 'sales_person');
    }

    public function getStayTimeAttribute($checkin_date_time, $checkout_date_time)
    {
        $stay_time = $this->time_elapsed_string($checkin_date_time, $this->attributes['checkout_date_time'], true);
        return $stay_time;
    }

    public function time_elapsed_string($checkin, $checkout, $full = false)
    {
        $now = new \DateTime($checkout);
        $ago = new \DateTime($checkin);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) {
            $string = array_slice($string, 0, 1);
        }

        return $string ? implode(', ', $string) : '0 minutes';
    }
}
