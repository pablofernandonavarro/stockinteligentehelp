<?php
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class accordion extends Component
{
    public $title;
    public $number;
    public $accordionId;
    public $id;
    public $expanded;
    public $show;

    public function __construct($title = '', $number = '', $accordionId = '', $id = '', $expanded = '', $show = '')
    {
        $this->title = $title;
        $this->number = $number;
        $this->accordionId = $accordionId;
        $this->id = $id;
        $this->expanded = $expanded;
        $this->show = $show;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.accordion');
    }
}
