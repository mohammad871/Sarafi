<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckCustomer implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return $this->customerDetect($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'ّمشتری مورد نظر پیدا نشد!';
    }

    private function customerDetect($name) {
        return $name;
    }
}
