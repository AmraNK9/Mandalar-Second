<?php
include_once __DIR__."/../model/kpay.php";

class kpayController extends Kpay
{
    public function getAllTrans()
    {
        return $this->getTrans();
    }

    public function UpdateStatus($checking_id)
    {
        return $this->UpdateKpayStatus($checking_id);
    }
    
    public function deleteKpay($checking_id)
    {
        return $this->reject_money($checking_id);
    }

    public function getTransfarhistory($user_id)
    {
        return $this->gethistory($user_id);
    }

    public function getAllWithdraw(){
        return $this->get_all_withdraw();
    }

    public function UpdateWithdrawStatus($withdraw_id,$status){
        return $this->update_withdraw_status($withdraw_id,$status);
    }

    public function getNotToday($user_id)
    {
        return $this->getNottodayhistory($user_id);
    }

    public function today_withdraw($user_id){
        return $this->todayWithdraw($user_id);
    }

    public function not_today_withdraw($user_id){
        return $this->notTodayWithdraw($user_id);
    }
}


?>