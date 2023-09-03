<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


class AppLayout extends Component
{
    public $title;
    public function __construct($title = null)
    {
        $this->title = $title ?? "Aplikasi PPDB";
    }

    public function render(): View|Closure|string
    {
        return view('layouts.master');
    }
}
