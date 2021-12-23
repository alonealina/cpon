<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\Comment;


class Restaurant extends Model
{
    use HasFactory;

    protected $guarded = ['id']; 

    protected $dates = ['created_at', 'updated_at'];

    protected $appends = [
        'open_hm', 'close_hm', 'opening_flg', 'profile_text', 'category_name', 'avg_star'
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

    public function getProfileTextAttribute() {
        return str_replace(array("\r\n","\r","\n"), "", $this->profile);
    }

    public function getCategoryNameAttribute() {
        return Category::find($this->category_id)->name;
    }

    public function getAvgStarAttribute() {
        $tmp = Comment::where('restaurant_id', $this->id)
        ->selectRaw('CAST(AVG(fivestar) AS DECIMAL(2,1)) AS star_avg')->first()->star_avg;
        if (is_null($tmp)) {
            $tmp = 0;
        }
        return $tmp;
    }

    public function outputCsvHeader() {
        return ['ID', '名前1', '名前2', '名前3', '店舗プロフィール', '都道府県', '郵便番号', '住所', '開店時間', '閉店時間', 'カテゴリー', 'URL', 'TEL',
            '備考（住所）', '備考（営業時間）', 'メイン画像', 'サブ画像1', 'サブ画像2', 'サブ画像3', 'サブ画像4', '作成日時', '更新日時', 
        ];
    }

    public function outputCsvContent() {
        return [
            $this->id,
            $this->name1,
            $this->name2,
            $this->name3,
            $this->profile_text,
            $this->pref,
            $this->zip,
            $this->address,
            $this->open_hm,
            $this->close_hm,
            $this->category_name,
            $this->url,
            $this->tel,
            $this->address_remarks,
            $this->time_remarks,
            $this->main_img,
            $this->sub_img1,
            $this->sub_img2,
            $this->sub_img3,
            $this->sub_img4,
            $this->created_at,
            $this->updated_at,
        ];
    }

}
