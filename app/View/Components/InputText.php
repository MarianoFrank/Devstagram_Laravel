<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputText extends Component
{


    public function __construct(
        public string $name = "",
        public string $type = "text",
        public string $placeholder = "",
        public string $value = "",
        public string $id = "",
        public bool $old = true, //por defecto se completa el campo con old
    ) {
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.inputs.input-text');
    }
}
