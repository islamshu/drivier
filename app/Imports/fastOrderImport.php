<?php

namespace App\Imports;

use App\Models\Order;
use App\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

use PhpOffice\PhpSpreadsheet\Shared\Date;
class fastOrderImport implements ToModel,WithStartRow
{

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    public $customer;


    public function  __construct(Customer $customer)
    {
        $this->customer = $customer;
    }
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Order([
            'order_id'              => str_replace('-','', mt_rand(0000000000,99999999999)),
            'vehicle_id'            => 1,
            'customer_id'           => $this->customer->id,
            'company_id'            => $this->customer->company_id,
            'name'                  => $row[1],
            'phone'                 => $row[2],
            'cod_amount'            => $row[3],
            'payment'               => 0,
            'type'                  => 1,
            'upload'                => 1,
            'from_lat'              => $this->customer->branch_lat,
            'from_long'             => $this->customer->branch_long,
            'to_lat'                => $row[4],
            'to_long'               => $row[5],
            'goods_type'            => $row[6],
            'city_id'               => $row[7],
            'delivery_fees'         => $row[8],
            'created_at'            => Date::excelToDateTimeObject($row[9]),
            'security_code'         => str_replace('-','', mt_rand(1000, 9999)), 
            'driver_id'             => 0,
            'status'                => 'unassigned',
        ]);
    }
}
