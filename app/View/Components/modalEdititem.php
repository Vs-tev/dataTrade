<?php

namespace App\View\Components;

use Illuminate\View\Component;

class modalEdititem extends Component
{

    public $message;
    public $item;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($message, $item)
    {
        $this->message = $message;
        $this->item = $item;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.modal-edit-item');
    }
}
