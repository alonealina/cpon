<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\Comment;
use App\Models\RestaurantHoliday;
use App\Models\RestaurantCard;
use App\Models\RestaurantScene;
use App\Models\RestaurantCommitment;


class Restaurant extends Model
{
    use HasFactory;

    protected $guarded = ['id']; 

    protected $dates = ['created_at', 'updated_at'];

    protected $appends = [
        'open_hm', 'close_hm', 'open_hm_old', 'close_hm_old', 'opening_flg', 'profile_text', 'category_name', 'avg_star',
        'address_remarks_text', 'time_remarks_text', 'recommend_flg_str', 'release_flg_str', 'access_text', 
        'parking_text', 'e_money_text', 'seats_text', 'smoking_text', 'other_text', 
        'holidays', 'cards', 'scenes', 'commitments', 
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

    public function getOpenHmOldAttribute() {
        return substr($this->open_time, 0, 5);
    }

    public function getCloseHmOldAttribute() {
        return substr($this->close_time, 0, 5);
    }

    public function getOpeningFlgAttribute() {
        $flg = 0;
        $now_time = new DateTime();
        $open_time = new DateTime($this->open_time);
        $close_time = new DateTime($this->close_time);

        if ($open_time <= $now_time && $close_time >= $now_time
            || $open_time > $close_time && ($open_time <= $now_time || $close_time >= $now_time)) {
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

    public function getAddressRemarksTextAttribute() {
        return str_replace(array("\r\n","\r","\n"), "", $this->address_remarks);
    }

    public function getTimeRemarksTextAttribute() {
        return str_replace(array("\r\n","\r","\n"), "", $this->time_remarks);
    }

    public function getRecommendFlgStrAttribute() {
        return $this->recommend_flg == 1 ? "??????????????????" : "";
    }

    public function getReleaseFlgStrAttribute() {
        return $this->release_flg == 1 ? "??????" : "?????????";
    }

    public function getAccessTextAttribute() {
        return str_replace(array("\r\n","\r","\n"), "", $this->access);
    }

    public function getParkingTextAttribute() {
        return str_replace(array("\r\n","\r","\n"), "", $this->parking);
    }

    public function getEMoneyTextAttribute() {
        return str_replace(array("\r\n","\r","\n"), "", $this->e_money);
    }

    public function getSeatsTextAttribute() {
        return str_replace(array("\r\n","\r","\n"), "", $this->seats);
    }

    public function getSmokingTextAttribute() {
        return str_replace(array("\r\n","\r","\n"), "", $this->smoking);
    }

    public function getOtherTextAttribute() {
        return str_replace(array("\r\n","\r","\n"), "", $this->other);
    }

    public function getHolidaysAttribute() {
        $holidays = RestaurantHoliday::where('restaurant_id', $this->id)->first();
        if (is_null($holidays)) {
            return;
        } else {
            return $this->output_holiday_array($holidays->toArray());
        }
    }

    public function getCardsAttribute() {
        $cards = RestaurantCard::where('restaurant_id', $this->id)->first();
        if (is_null($cards)) {
            return;
        } else {
            return $this->output_card_array($cards->toArray());
        }
    }

    public function getScenesAttribute() {
        $scenes = RestaurantScene::join('scenes', 'scene_id', '=', 'scenes.id')->where('restaurant_id', $this->id)->get();

        if ($scenes->count() == 0) {
            return;
        } else {
            return $this->output_settings_array($scenes->toArray());
        }
    }

    public function getCommitmentsAttribute() {
        $commitments = RestaurantCommitment::join('commitments', 'commitment_id', '=', 'commitments.id')->where('restaurant_id', $this->id)->get();
        
        if ($commitments->count() == 0) {
            return;
        } else {
            return $this->output_settings_array($commitments->toArray());
        }
    }

    public function outputCsvContent() {
        return [
            $this->login_id,
            $this->password,
            $this->name1,
            $this->name2,
            $this->name3,
            $this->profile_text,            // ????????????
            $this->pref,    
            $this->zip, 
            $this->address, 
            $this->address_remarks_text,    // ???????????? 10
            $this->open_hm,                 // ??????     
            $this->close_hm,                // ??????
            $this->category_name,           // ??????
            $this->url,
            $this->tel,
            $this->time_remarks_text,       // ????????????
            $this->recommend_flg_str,       // ??????
            $this->release_flg_str,         // ??????
            $this->cpon_mall_url,
            $this->budget_lunch,            // 20
            $this->budget_dinner,
            $this->station1,
            $this->route1,
            $this->station2,
            $this->route2,
            $this->station3,
            $this->route3,
            $this->station4,
            $this->route4,
            $this->station5,                 // 30
            $this->route5,
            $this->access_text,              // ????????????
            $this->parking_text,             // ????????????
            $this->e_money_text,             // ????????????
            $this->seats_text,               // ????????????
            $this->smoking_text,             // ????????????
            $this->other_text,               // ????????????
            $this->created_at,
            $this->updated_at,
            $this->holidays,                 // ??????????????????40
            $this->cards,                    // ???????????????
            $this->scenes,                   // ???????????????
            $this->commitments,              // ???????????????
        ];
    }

    private function output_holiday_array($array)
    {
        $tmp_array = [];
        if ($array['monday'] == 1) {
            $tmp_array[] = '?????????';
        }
        if ($array['tuesday'] == 1) {
            $tmp_array[] = '?????????';
        }
        if ($array['wednesday'] == 1) {
            $tmp_array[] = '?????????';
        }
        if ($array['thursday'] == 1) {
            $tmp_array[] = '?????????';
        }
        if ($array['friday'] == 1) {
            $tmp_array[] = '?????????';
        }
        if ($array['saturday'] == 1) {
            $tmp_array[] = '?????????';
        }
        if ($array['sunday'] == 1) {
            $tmp_array[] = '?????????';
        }
        if ($array['none'] == 1) {
            $tmp_array[] = '???????????????';
        }

        return implode("???", $tmp_array);
    }

    private function output_card_array($array)
    {
        $tmp_array = [];
        if ($array['visa'] == 1) {
            $tmp_array[] = 'VISA';
        }
        if ($array['mastercard'] == 1) {
            $tmp_array[] = 'MasterCard';
        }
        if ($array['jcb'] == 1) {
            $tmp_array[] = 'JCB';
        }
        if ($array['diners'] == 1) {
            $tmp_array[] = 'Diners';
        }
        if ($array['amex'] == 1) {
            $tmp_array[] = 'AMEX';
        }
        if ($array['other'] == 1) {
            $tmp_array[] = '?????????';
        }

        return implode("???", $tmp_array);
    }

    private function output_settings_array($settings)
    {
        $tmp_array = [];
        foreach ($settings as $setting) {
            $tmp_array[] = $setting['name'];
        }

        return implode("???", $tmp_array);
    }

}
