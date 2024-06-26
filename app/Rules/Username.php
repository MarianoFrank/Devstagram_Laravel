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
        if (isset(auth()->user()->username) && $slug === auth()->user()->username) {
            return;
        }
        if (User::where('username', $slug)->exists()) {
            $fail('validation.unique')->translate();
        }
    }
}
