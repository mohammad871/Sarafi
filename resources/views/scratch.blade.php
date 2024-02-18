// all about item
select *, sum(buy_money) as money from table_items  group by buy_currency ;

// all commissions
select sum(commission_money) as money, commission_currency as currency from table_transfer where commission_currency is not null and commission_money is not null group by commission_money;

// all exchanged money
select buy_currency as currency,
(select sum(exchanged) from table_exchange where buy_currency=exchange.buy_currency) as money
from table_exchange as exchange group by buy_currency;

// all cash money
select currency, account from table_account

// all expense of company
select currency, sum(money) as money from table_expense group by currency;

// remain transfer of customers
select to_currency as currency, sum(received_money) from table_transfer where status = 0 group by to_currency;

// add customers money
select customer.name as name, tazkira, address, sum(money) as money, currency
from table_customer as customer left join table_customer_deal as customer_deal ON customer_deal.customer_id = customer.id
where customer_deal.type='جمع' group by currency;

// debt customers money
select customer.name as name, tazkira, address, sum(money) as money, currency
from table_customer as customer left join table_customer_deal as customer_deal ON customer_deal.customer_id = customer.id
where customer_deal.type='قرض' group by currency;

// benefit/income
select
(select if(table_exchange.rate > table_transfer.rate, table_exchange.rate - table_transfer.rate,  table_transfer.rate - table_exchange.rate ) from table_exchange where table_exchange.buy_currency = exchange.buy_currency AND table_transfer.exchange_id = table_exchange.id) as new_rate,
exchange.sell_currency as from_currency, exchange.buy_currency as to_currency, exchange.money as money from table_exchange as exchange
right join table_transfer on table_transfer.exchange_id = exchange.id group by buy_currency;

// another method for benefit
select  exchange.id as exchange_id, buy_currency as exchange_currency, exchange.rate as exchange_rate, transfer.id as transfer_id, transfer.currency as transfer_from_currency, transfer.to_currency as transfer_to_currency, transfer.rate as transfer_rate, commission_currency, commission_money
from table_transfer as transfer
left join table_exchange as exchange on transfer.exchange_id = exchange.id
where status = 1

