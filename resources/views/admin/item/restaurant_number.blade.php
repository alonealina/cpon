<div class="number_select">
    <select class="number_select" name="sort" id="change_number">
        <option value="{{ route('admin.restaurant_list', [
            'number' => '10',
            'name' => $name,
            'login_id' => $login_id,
            'zip' => $zip,
            'pref' => $pref,
            'address1' => $address1,
            'address2' => $address2,
            'tel' => $tel,
            'open' => $open,
            'close' => $close,
            'fivestar_before' => $fivestar_before_old,
            'fivestar_after' => $fivestar_after_old,
            'status' => $status,
            'created_year_before' => $created_year_before,
            'created_month_before' => $created_month_before,
            'created_day_before' => $created_day_before,
            'created_year_after' => $created_year_after,
            'created_month_after' => $created_month_after,
            'created_day_after' => $created_day_after,
            'updated_year_before' => $updated_year_before,
            'updated_month_before' => $updated_month_before,
            'updated_day_before' => $updated_day_before,
            'updated_year_after' => $updated_year_after,
            'updated_month_after' => $updated_month_after,
            'updated_day_after' => $updated_day_after,
            ]) }}"
        @if($number == "10") selected @endif>10件</option>
        <option value="{{ route('admin.restaurant_list',  [
            'number' => '50',
            'name' => $name,
            'login_id' => $login_id,
            'zip' => $zip,
            'pref' => $pref,
            'address1' => $address1,
            'address2' => $address2,
            'tel' => $tel,
            'open' => $open,
            'close' => $close,
            'fivestar_before' => $fivestar_before_old,
            'fivestar_after' => $fivestar_after_old,
            'status' => $status,
            'created_year_before' => $created_year_before,
            'created_month_before' => $created_month_before,
            'created_day_before' => $created_day_before,
            'created_year_after' => $created_year_after,
            'created_month_after' => $created_month_after,
            'created_day_after' => $created_day_after,
            'updated_year_before' => $updated_year_before,
            'updated_month_before' => $updated_month_before,
            'updated_day_before' => $updated_day_before,
            'updated_year_after' => $updated_year_after,
            'updated_month_after' => $updated_month_after,
            'updated_day_after' => $updated_day_after,
            ]) }}"
        @if($number == "50") selected @endif>50件</option>
        <option value="{{ route('admin.restaurant_list',  [
            'number' => '100',
            'name' => $name,
            'login_id' => $login_id,
            'zip' => $zip,
            'pref' => $pref,
            'address1' => $address1,
            'address2' => $address2,
            'tel' => $tel,
            'open' => $open,
            'close' => $close,
            'fivestar_before' => $fivestar_before_old,
            'fivestar_after' => $fivestar_after_old,
            'status' => $status,
            'created_year_before' => $created_year_before,
            'created_month_before' => $created_month_before,
            'created_day_before' => $created_day_before,
            'created_year_after' => $created_year_after,
            'created_month_after' => $created_month_after,
            'created_day_after' => $created_day_after,
            'updated_year_before' => $updated_year_before,
            'updated_month_before' => $updated_month_before,
            'updated_day_before' => $updated_day_before,
            'updated_year_after' => $updated_year_after,
            'updated_month_after' => $updated_month_after,
            'updated_day_after' => $updated_day_after,
            ]) }}"
        @if($number == "100") selected @endif>100件</option>
    </select>
</div>