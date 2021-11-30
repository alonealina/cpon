<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $appends = [
        'open_hm', 'close_hm', 'opening_flg'
    ];

    public function getOpenHmAttribute() {
        $hm = $this->open_time;
        $hour = abs(substr($hm, 0, 2));
        $minute = substr($hm, 3, 2);
        
        return $hour . ':' . $minute;
    }

    public function getCloseHmAttribute() {
        $hm = $this->close_time;
        $hour = abs(substr($hm, 0, 2));
        $minute = substr($hm, 3, 2);
        
        return $hour . ':' . $minute;
    }

    public function getOpeningFlgAttribute() {
        $flg = 0;
        $now_time = new DateTime();
        $open_time = new DateTime($this->open_time);
        $close_time = new DateTime($this->close_time);

        if ($open_time <= $now_time && $close_time >= $now_time) {
            $flg = 1;
        }

        return $flg;
    }

}
