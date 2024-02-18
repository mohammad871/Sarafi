<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function isLogin() {
        $result = false;
        $user = session()->has('user');
        if($user) {
            $user = session()->get('user');
            if($user) {
                if($user->id) {
                    $result = $user->id;
                }
            }
        }
        if($result) {
            if(basename(url()->current()) == "login") {
                return redirect()->to('/dashboard')->send();
            }
        } else {
            if(basename(url()->current()) != "login") {
                return redirect()->to('login')->send();
            }
        }
    }

    public static function instance() {
        return new Controller();
    }

    public function benefit($from, $to, $firstRate, $sellRate, $money) {
        $sub = $sellRate - $firstRate;
        return $this->exchangeMoney([
            'money'=> $money,
            'from'=> $from,
            'to'=> $to,
            'rate'=> $sub
        ]);
    }

    /**
     * @param $num
     * @param int $precision
     * @return string
     */
    function cutNum($num, $precision = 2) {
        return floor($num) . substr(str_replace(floor($num), '', $num), 0, $precision + 1);
    }

    public function exchangeMoney($array) {
        $total = 0;

        if(count($array) >= 4) {
            $rate = (double) $array['rate'];
            $money = (double) $array['money'];
            if(isset($array['buy_currency']) && isset($array['sell_currency'])):
                $buy_currency = $array['buy_currency'];
                $sell_currency = $array['sell_currency'];
                unset($array['buy_currency'], $array['sell_currency']);
            else:
                $buy_currency = $array['to'];
                $sell_currency = $array['from'];
            endif;
            if(
                ($buy_currency != 'دالر' && $buy_currency != $sell_currency) &&
                ($sell_currency == "ین" || $sell_currency == "دالر" || $sell_currency == 'درهم')
            ) {
                $total = $money * $rate;
            } else if(
                ($buy_currency == "ین" || $buy_currency == "دالر" || $buy_currency == 'درهم') &&
                ($buy_currency != $sell_currency)
            ) {
                if($rate > 0) {
                    $total = $money / $rate;
                }
            } else if($buy_currency == "افغانی" && $sell_currency == "کلدار") {
                $total = ($rate / 1000) * $money;
            } else if($buy_currency == "کلدار" && $sell_currency == "افغانی") {
                if($rate > 0) {
                    $total = (1000 / $rate) * $money;
                }
            } else if($buy_currency == $sell_currency) {
                $total = $money;
            }
        }
        return round($total, 2);
    }

    public function isCurrency($arr, $obj) {
        sort($arr);
        foreach ($arr as $value) {
            if(isset($value->currency)) {
                if(!in_array($value->currency, $obj->exists)) {
                    $obj->exists[] = $value->currency;
                }
            }
        }
        sort($obj->exists);
    }

    public function generate($start_date, $end_date, $obj = null) {   
        if(strpos($start_date, "-")) {
            $start_date = str_replace("-","/", $start_date);
            $end_date = str_replace("-","/", $end_date);
        }

        $debt = DB::select("select customer.name as name, tazkira, address, sum(money) as money, currency, customer_deal.date as created_at
                                 from table_customer as customer
                                 left join table_customer_deal as customer_deal ON customer_deal.customer_id = customer.id
                                 where customer_deal.type='قرض' and (customer_deal.date BETWEEN '{$start_date}' and '{$end_date}') group by customer_deal.currency;");
        $this->isCurrency($debt, $obj); 

        $remainCustomer = DB::select("select customer.name as name, tazkira, address, sum(money) as money, currency, customer_deal.date as date
                                 from table_customer as customer
                                 left join table_customer_deal as customer_deal ON customer_deal.customer_id = customer.id
                                 where (customer_deal.date BETWEEN '{$start_date}' and '{$end_date}') AND customer_deal.type='جمع' group by customer_deal.currency;");
        $this->isCurrency($remainCustomer, $obj);
        
        // debt start
        $arr = $update = []; 
        $x = 0;
        foreach ($debt as $d) {
            $arr[$x]['currency'] = $d->currency;
            $arr[$x]['money'] = $d->money;
            $x++;
        }
        $arr = $this->groupBy($arr);

        foreach ($obj->exists as $key=> $value) {
            if(!in_array($value, array_keys($arr))) {
                $arr[$value] = ['currency'=> $value, 'money'=> 0];
            }
        }
        $debt = $arr;

        foreach ($debt as $key => $value) {
            $sum = 0;
            foreach ($value as $k => $val) {
                if(is_array($val)) {
                    $sum += $val['money'];
                }
            }
            $update[$key] = $sum;
        }
        ksort($update);
        $debt = $update;
        $update = $arr = [];
        // debt end


        // remain customer start
        $x = 0;
        foreach ($remainCustomer as $customer) {
            $arr[$x]['currency'] = $customer->currency;
            $arr[$x]['money'] = $customer->money;
            $x++;
        }
        $arr = $this->groupBy($arr);

        foreach ($obj->exists as $key=> $value) {
            if(!in_array($value, array_keys($arr))) {
                $arr[$value] = ['currency'=> $value, 'money'=> 0];
            }
        }
        $remainCustomer = $arr;

        foreach ($remainCustomer as $key => $value) {
            $sum = 0;
            foreach ($value as $k => $val) {
                if(is_array($val)) {
                    $sum += $val['money'];
                }
            }
            $update[$key] = $sum;
        }
        ksort($update);
        $remainCustomer = $update;
        $update = $arr = [];
        // remainCustomer end 

        return [ 
            'debt'=> $debt, 
            'remainCustomer'=> $remainCustomer,   
        ];
    }

    public function is($value) {
        return $value >= 0 ? 'success' : 'danger';
    }

    public function groupBy($array) {
        $arr = [];
        foreach ($array as $element) {
            $arr[$element['currency']][] = $element;
        }
        return $arr;
    }
}
