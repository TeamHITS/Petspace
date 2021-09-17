<?php

namespace App\Repositories\Admin;

use App\Models\Transaction;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TransactionRepository
 * @package App\Repositories\Admin
 * @version June 28, 2021, 10:16 pm UTC
 *
 * @method Transaction findWithoutFail($id, $columns = ['*'])
 * @method Transaction find($id, $columns = ['*'])
 * @method Transaction first($columns = ['*'])
*/
class TransactionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'user_id',
        'order_id',
        'transaction_id',
        'payment_status',
        'amount'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Transaction::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        if(is_array($request)){
            $input = $request;
        }else{
            $input = $request->all();
        }
        $transaction = $this->create($input);
        return $transaction;
    }

    /**
     * @param $request
     * @param $transaction
     * @return mixed
     */
    public function updateRecord($request, $transaction)
    {
        if(is_array($request)){
            $input = $request;
        }else{
            $input = $request->all();
        }
        $transaction = $this->update($input, $transaction->id);
        return $transaction;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteWhere($array)
    {
        $transaction = $this->where($array)->delete();
        return $transaction;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $transaction = $this->delete($id);
        return $transaction;
    }

    public function getTransactionByOrderId($id,$code)
    {
        $where = array('order_id' => $id);
        if($code!=null){
            $where = array('order_id' => $id,'status_code' => $code);    
        }
        $order_transaction = $this->findWhere($where)->first();
       return $order_transaction;
    }
}
