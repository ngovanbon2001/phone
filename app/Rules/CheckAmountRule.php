<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CheckAmountRule implements Rule
{
    private string $name;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {

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
        $status = true;

        foreach ($value as $item) {
            $color = DB::table('product_color')->find((int)$item['color'] ?? 0);
            if (isset($color->amount_color) && $color->amount_color < (int)$item['product_quantity']) {
                $status = false;
                $product = DB::table('products')->find($color->product_id ?? 0);
                $this->name = $product->name ?? '';
                break;
            }
        }

        return $status;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->name. ' '. __('languages.sufficient');
    }
}
