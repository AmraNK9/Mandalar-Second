<?php
$post_controller=new PostController();
$user_controller=new UserController();
$post_list=$post_controller->getFreezeMoney($user_id);
$withdraw_list=$user_controller->get_all_withdraw_list($user_id);
$freeze_money=0;
foreach ($post_list as $post) {
   $freeze_money+=$post['price'];
}
foreach ($withdraw_list as $withdraw){
   $freeze_money+=$withdraw['amount'];
}
$user=$user_controller->UserInfo($user_id);
$user_wallet=$user[0]['wallet'];
$available_money=$user_wallet-$freeze_money;



?>