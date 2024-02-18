<?php

namespace App\Http\Livewire;

use App\Models\Account;
use App\Rules\CheckCustomer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Session;
class CustomerCalculation extends Component
{
    // error for displaying some errors
    public $error = [];
    public $CURRENCY = [
        'افغانی',
        'تومن',
        'دالر',
        'درهم',
        'کلدار',
        'ین',
        'یورو',
    ];
    public $customerDeal;
    public $data = [];
    public $showDeleteModal = false;
    public function create() {
        $this->data = [];
        $this->error = [];
        $this->showDeleteModal = false;
        $this->dispatchBrowserEvent('show-form');
    }
    

    public function store() {
        Validator::make($this->data, [
            'name'=> ["required", new CheckCustomer()],
            'date'=> 'required',
            'type'=> 'required',
            'currency'=> 'required',
            'money'=> 'required',
        ])->validate();
 
        //  check if the customer exists
        $customer = \App\Models\Customer::all()->where('name', $this->data['name']);
        if(!empty($customer)) {
            if($customer->count() == 1) {
                $this->calculation($customer->first());
                // $customerOldDeal = DB::select('SELECT * FROM view_customer_deal WHERE customer_id=? AND currency=?', [$this->data['customer_id'], $this->data['currency']]);
                // $customerOldDeal = array_pop($customerOldDeal);
                // if ($this->calculation($customerOldDeal)) {
                //     $this->error = [];
                //     $this->dispatchBrowserEvent('message', ['type'=> 'success', 'text'=> 'جمع و قرض مشتری موفقانه انجام شد!']);
                // } else {
                //     if (empty($this->error)) {
                //         $this->error = ['error' => '
                //         در جمع و قرض مشتری مشکل رخ داد دوباره کوشش نماید!
                //         '];
                //     }
                // }
                $this->data = [];
                $this->dispatchBrowserEvent('hide-form', $this->data);
                $this->dispatchBrowserEvent('message', ['text'=> 'عملیه موفقانه اجراء شد!', 'type'=> 'success']);
            } else {
                $this->error = ['error' => '
                    مشتری مورد نظر پیدا نشد!
                '];
            }
        } else {
            $this->error = ['error' => '
                مشتری مورد نظر پیدا نشد!
            '];
        }
    }

    // calculation of customer deal
    public function calculation($customer) {  
        // for check the final result of all calculatino
        if($this->data['type'] == "قرض") {
            if($this->data['money'] >= 0) {
                $this->data['money'] = -$this->data['money'];
            }
        } 
        $this->data['customer_id'] = $customer->id;
        \App\Models\CustomerCalculation::create($this->data);
    }

    public function destroy() { 
        $this->customerDeal->delete();  
        $this->customerDeal->delete(); 
        $this->dispatchBrowserEvent('message', ['type'=> 'success', 'text'=> 'حساب مورد نظر موفقانه حذف گردید! ']);
    }

    public function confirmDelete(\App\Models\CustomerCalculation $customer) {
        $this->dispatchBrowserEvent('show-form'); 
        $this->showDeleteModal = true;
        $this->customerDeal = $customer;
    }

    public function render()
    {
        $this->dispatchBrowserEvent('init-datatable');
        $customers = \App\Models\Customer::all();
        $customerCalculation = DB::select('SELECT * FROM view_customer_deal order by deal_id desc');
        return view('livewire.customer-calculation', compact('customerCalculation', 'customers'));
    }
    
    function setHijri($value) {   
        $this->data['date'] = $value;
    }
}
