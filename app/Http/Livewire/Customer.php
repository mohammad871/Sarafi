<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Session;

class Customer extends Component
{
    public $customer;
    public $data = [];
    public $showEditModal   = false;
    public $confirmDelete   = false;
    public $showDeleteModal = false;


    public function create() {
        $this->data = [];
        $this->showEditModal = $this->showDeleteModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function store() {
        Validator::make($this->data, [
            'name'=> 'required|unique:table_customer',
            'phone'=> 'required|unique:table_customer',
            'address'=> 'required',
            'tazkira'=> 'unique:table_customer'
        ])->validate();

        \App\Models\Customer::create($this->data);
        $this->dispatchBrowserEvent('message', ['text'=> 'مشتری موفقانه اضافه گردید!', 'type'=> 'success']);
        $this->data = [];
        $this->dispatchBrowserEvent('hide-form', $this->data);
    }

    public function edit(\App\Models\Customer $customer) {
        $this->showEditModal = true;
        $this->showDeleteModal = false;
        $this->customer = $customer;
        $this->dispatchBrowserEvent('show-form');
        $this->data = $customer->toArray();
    }

    public function update() {
        Validator::make($this->data, [
            'name'=> 'required',
            'phone'=> 'required|unique:table_customer,phone,'.$this->customer->id,
            'address'=> 'required',
            'tazkira'=> 'required|unique:table_customer,tazkira,'.$this->customer->id
        ])->validate();

        $this->customer->update($this->data);
        $this->dispatchBrowserEvent('message', ['text'=> 'معلومات مشتری موفقانه تغیر یافت!', 'type'=> 'success']);
        $this->dispatchBrowserEvent('hide-form');
    }

    public function destroy() {
        $this->customer->delete();
        $this->dispatchBrowserEvent('message', ['text'=> " مشتری {$this->customer->name} موفقانه حذف گردید! ", 'type'=> 'success']);
    }

    public function confirmDelete(\App\Models\Customer $customer) {
        $this->dispatchBrowserEvent('show-form');
        $this->showDeleteModal = true;
        $this->customer = $customer;
    }

    public function render()
    {
        $this->dispatchBrowserEvent('init-datatable');
        $customers = \App\Models\Customer::all();
        return view('livewire.customer', compact('customers'));
    }
}
