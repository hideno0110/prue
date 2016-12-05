<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class InventoriesCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            //'shop_id'=>'required',
            'asin'=>'required_without_all:jan_code,item_code',
            'jan_code'=>'required_without_all:asin,item_code',
            'item_code'=>'required_without_all:jan_code,asin',
            'condition_id'=>'required',
            'buy_price' => 'integer|min:0',
          ];
    }
    public function attributes() {
        return [
            'asin'    => trans('adminlte_lang::message.asin'),
            'jan_code'    => trans('adminlte_lang::message.jan_code'),
            'item_code'    => trans('adminlte_lang::message.item_code'),
            'condition_id'    => trans('adminlte_lang::message.condition'),
            'buy_price' => trans('adminlte_lang::message.buy_price'),
            'sell_price' => trans('adminlte_lang::message.sell_price'),
          ];
    }
}
