<?php
include('includeConstants.php');
if(isset($_POST['notificationType']) && $_POST['notificationType'] == 'transaction'){
    $email = '';
    $token = '';

    $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/'. $_POST['notificationCode'] . '?email=' . $email . '&token=' . $token;
    
    $curl = $curl_init($url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $transaction = curl_exec($curl);
    curl_close($curl);
    if($transaction == 'Unauthorized'){
        die('Um erro ocorreu!');
    }
    $transaction = simplexml_load_string($transaction);
    $transactionStatus = $transaction->status;
    if($transactionStatus == 1){
        $transactionStatus = 'Aguardando Pagamento';
    }elseif($transactionStatus == 2){
        $transactionStatus = 'Em análise';
    }elseif($transactionStatus == 3){
        $transactionStatus = 'Paga';
        $reference_id = $transaction->reference;
        \MySql::conectar()->exec("UPDATE `tb_admin.pedidos` SET status = 'pago' WHERE reference_id = '$reference_id'");
    }elseif($transactionStatus == 4){
        $transactionStatus = 'Dísponivel';
    }elseif($transactionStatus == 5){
        $transactionStatus = 'Em disputa';
    }elseif($transactionStatus == 6){
        $transactionStatus = 'Devolvida';
    }elseif($transactionStatus == 7){
        $transactionStatus = 'Cancelada';
    }
}

?>