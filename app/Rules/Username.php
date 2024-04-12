<?php

namespace App\Rules;

use Closure;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Lang;
use Illuminate\Contracts\Validation\ValidationRule;

class Username implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Verifica si username convertido a slug ya existe
        $slug = Str::slug($value);
        if (User::where('username', $slug)->exists()) {
            $fail(Lang::get('validation.unique', ['attribute' => $attribute]));
        }
    }
}
