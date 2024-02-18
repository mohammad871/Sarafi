<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CustomerAccount extends Component
{
    public $filterBy = "";
    public $CURRENCY = [
        'افغانی',
        'تومن',
        'دالر',
        'درهم',
        'کلدار',
        'ین',
        'یورو',
    ];

    public function setFilter($value) {   
        $this->filterBy = $value; 
    }

    public function render()
    {
        $this->dispatchBrowserEvent('init-datatable');
        $addFilter = "";
        if($this->filterBy) {
            $addFilter = " and name='". $this->filterBy . "'";
        }

        $customerAccount = DB::select("
            select name, sum(money) as money, currency from table_customer tbl_customer inner join  table_customer_deal tbl_calc 
            where tbl_customer.id = tbl_calc.customer_id $addFilter group by name,currency
        ");

        if($this->filterBy) {
            $customer = DB::select("
                select name, currency, description, money, type, date from table_customer_deal tbl_calc inner join  table_customer tbl_customer
                where tbl_customer.id = tbl_calc.customer_id and name = '{$this->filterBy}'
            ");
    
            $filterByCustomer = [];
            foreach ($customer as $key => $value) {
                $filterByCustomer[$key] = [];
                foreach($this->CURRENCY as $currency) {
                    if($currency == $value->currency) {
                        $filterByCustomer[$key][] = [
                            "currency"=> $value->currency,
                            "money"=> $value->money,
                            "description"=> $value->description,
                            "date"=> $value->date,
                            "type"=> $value->type,
                        ];
                    } else {
                        $filterByCustomer[$key][] = [
                            "currency"=> $currency,
                            "money"=> 0,
                            "description"=> $value->description,
                            "date"=> $value->date,
                            "type"=> $value->type,
                        ];
                    }
                }
            }
        }
        

        $filtered = [];
        foreach ($customerAccount as $key => $value) {
            $filtered[$value->name][] = [
                "currency"=> $value->currency,
                "money"=> $value->money
            ];
        }

        $newFilter = [];
        foreach($filtered as $key=>$filter) {
            $newFilter[$key] = [];
            foreach($this->CURRENCY as $currency) {
                foreach($filter as $val) {
                    if($val['currency'] == $currency) {
                        $newFilter[$key][$currency] = $val['money'];
                    } else {
                        if(!isset($newFilter[$key][$currency])) {
                            $newFilter[$key][$currency] = 0;
                        }
                    }
                    
                }
            } 
        } 

        $result = [];
        foreach($newFilter as $sum) { 
            foreach($sum as $key => $val) {
                if(!isset($result[$key])) {
                    $result[$key] = 0;
                    $result[$key] = $val;
                } else {
                    $result[$key] += $val;
                }
            }
        }

        $filtered = $this->filterBy ? $filterByCustomer : $newFilter;

        return view('livewire.customer-account', compact("filtered", "result"));
    }
}
