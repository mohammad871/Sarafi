<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Controller;
use Livewire\Component;
use Morilog\Jalali\Jalalian;

class Report extends Component
{
    public $start_date, $end_date;
    public $exists = [];
    public $array  = [];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->start_date = $this->end_date = Jalalian::now()->format("Y/m/d");
    }

    public function report()
    {
        $this->array = Controller::instance()->generate($this->start_date, $this->end_date, $this);
    }

    public function updatedStartDate($start)
    {
        $this->start_date = $start;
    }
    public function updatedEndDate($end)
    {
        $this->end_date = $end;
    }

    public function render()
    {
        if (!$this->array)
            $this->array = Controller::instance()->generate($this->start_date, $this->end_date, $this);

        return view('livewire.report', $this->array);
    }
   
    function setHijri($type, $value) {   
        if($type == "start") 
            $this->start_date = $value;
        else
            $this->end_date = $value;
    }
}
