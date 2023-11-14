<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CheckCodeRule implements Rule
{
    private string $email;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $email)
    {
        $this->email = $email;
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
        $temp = DB::table('users_temp')->where([
            ['email', 'LIKE', $this->email],
            ['code', 'LIKE', $value]
        ])->first();
        
        if ($temp) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.not_regex', ['attribute' => __('languages.code')]);
    }
}
