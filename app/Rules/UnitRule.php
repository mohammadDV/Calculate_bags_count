<?php

namespace App\Rules;

use App\Services\BagCalculatorService;
use Illuminate\Contracts\Validation\Rule;

class UnitRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    protected $units = [];

    public function __construct()
    {
        $this->units = BagCalculatorService::METERS;
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
        return in_array(ucfirst($value),array_keys($this->units));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The unit is not exist ' . json_encode(array_keys($this->units),true);
    }
}
