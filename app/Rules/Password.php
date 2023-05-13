<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Password implements ValidationRule
{

    protected $length = 8;
    protected $requireUppercase = false;
    protected $requireNumeric = false;
    protected $requireSpecialCharacter = false;
    protected $message;
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->requireUppercase && !preg_match('/[A-Z]/', $value)) {
            $fail("The $attribute must contain at least one uppercase letter.");
        }

        if ($this->requireNumeric && !preg_match('/[0-9]/', $value)) {
            $fail("The $attribute must contain at least one number.");
        }

        if ($this->requireSpecialCharacter && !preg_match('/[^A-Za-z0-9]/', $value)) {
            $fail("The $attribute must contain at least one special character.");
        }

        if (strlen($value) < $this->length) {
            $fail("The $attribute must be at least {$this->length} characters.");
        }
    }

    public function length(int $length): self
    {
        $this->length = $length;
        return $this;
    }

    public function requireUppercase(): self
    {
        $this->requireUppercase = true;
        return $this;
    }

    public function requireNumeric(): self
    {
        $this->requireNumeric = true;
        return $this;
    }

    public function requireSpecialCharacter(): self
    {
        $this->requireSpecialCharacter = true;
        return $this;
    }
}
