<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Activity extends Component
{

    public $color;
    public $title;
    public $description;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($color, $title, $description)
    {
        $this->color = $color;
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.activity');
    }
}
