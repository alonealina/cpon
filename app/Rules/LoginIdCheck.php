<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Restaurant;
class LoginIdCheck implements Rule
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $restaurant_id = $this->id;

        $count = Restaurant::where('login_id', $value)->where('id', '<>', $restaurant_id)->count();
        if ($count > 0) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '店舗IDが重複しています';
    }
}
