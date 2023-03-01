<?php

namespace App\View\Components\Frontend;

use Illuminate\View\Component;

class Footer extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $logo;
    public $partner;
    public function __construct($logo,$partner)
    {
        $this->logo=$logo;
        $this->partner=$partner;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.footer');
    }
}
