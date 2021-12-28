<div class="number_select">
    <select class="" name="sort" id="change_number">
        <option value="{{ route('admin.menu_list', [
            'id' => $restaurant_id,
            'number' => '10',
            'name' => $name,
            'price_before' => $price_before,
            'price_after' => $price_after,
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
        <option value="{{ route('admin.menu_list',  [
            'id' => $restaurant_id,
            'number' => '50',
            'name' => $name,
            'price_before' => $price_before,
            'price_after' => $price_after,
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
        <option value="{{ route('admin.menu_list',  [
            'id' => $restaurant_id,
            'number' => '100',
            'name' => $name,
            'price_before' => $price_before,
            'price_after' => $price_after,
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