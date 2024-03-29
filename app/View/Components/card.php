<?php

namespace App\View\Components;

use Illuminate\View\Component;

class card extends Component
{
    public $cardname;
    public $cardtext;
    public $button;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($cardname, $cardtext, $button)
    {
       $this->cardname = $cardname;
       $this->cardtext = $cardtext;
       $this->button = $button;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.card');
    }
}
