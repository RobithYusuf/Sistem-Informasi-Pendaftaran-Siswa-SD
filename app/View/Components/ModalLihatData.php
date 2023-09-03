<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalLihatData extends Component
{
    public $title;
    public function __construct($title = null)
    {
        $this->title = $title ?? "Aplikasi PPDB";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-lihat-data');
    }
}
