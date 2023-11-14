<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UserConnectRule implements ValidationRule
{
    protected string $userType;

    public function __construct(string $userType)
    {
        $this->userType = $userType;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $flag = false;

        switch ($this->userType){
            case 'merchant':
                $flag = true;
                break;
            case 'seller':
                $flag = false;
                break;
        }
    }
}
