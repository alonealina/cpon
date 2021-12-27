<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at'];

    protected $appends = [
        'price_text', 'recommend_flg_str', 'release_flg_str',
    ];

    public function getPriceTextAttribute() {
        return number_format($this->price) . '円';
    }

    public function getReleaseFlgStrAttribute() {
        return $this->release_flg == 1 ? "公開" : "非公開";
    }

    public function getRecommendFlgStrAttribute() {
        return $this->recommend_flg == 1 ? "イチオシ" : "";
    }

    public function outputCsvContent() {
        return [
            $this->name,
            $this->price_text,            
            $this->explain,    
            $this->release_flg_str,         
            $this->recommend_flg_str,       
            $this->created_at,
            $this->updated_at,
        ];
    }

}
