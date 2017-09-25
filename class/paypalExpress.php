<?php
// Srinivas Tamada
// http://www.9lessons.info


class paypalExpress
{

    function timeFormat($ts)
    {
    $date = new DateTime("@$ts");
    $finalDate=$date->format('M d-Y H:i');
    return $finalDate;
    }

    /* User Login Check */
    public function userLogin($username,$password)
    {
        
        $db = getDB();
        $hash_password= hash('sha256', $password);
        $stmt = $db->prepare("SELECT uid FROM users WHERE  username=:username and password=:hash_password");
        $stmt->bindParam("username", $username,PDO::PARAM_STR) ;
        $stmt->bindParam("hash_password", $hash_password,PDO::PARAM_STR) ;
        $stmt->execute();
        $db = null;
        
        if($stmt->rowCount()==1)
        {
            $data = $stmt->fetch(PDO::FETCH_OBJ);
            $_SESSION['session_uid'] = $data->uid;
            return $data->uid;
        }
        else
        {
            return false;
        }
    }


    public function getAllProducts()
    {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM products");
        $stmt->bindParam("pid", $pid, PDO::PARAM_INT) ;
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db=null;
        return $data;
        
    }

    public function getProduct($pid)
    {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM products WHERE pid=:pid");
        $stmt->bindParam("pid", $pid, PDO::PARAM_INT) ;
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_OBJ);
        $db=null;
        return $data;
        
    }

    public function pyamentCheck($paymentID)
    {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM orders WHERE paymentID=:paymentID");
        $stmt->bindParam("paymentID", $paymentID, PDO::PARAM_STR) ;
        $stmt->execute();
        $count = $stmt->rowcount();
        $db=null;
        return $count;
        
    }

    public function orders()
    {
        $uid = $_SESSION['session_uid'];
        $db = getDB();
        $stmt = $db->prepare("SELECT P.product, P.price, P.product_img, P.currency, O.created, O.oid  FROM orders O, products P WHERE O.uid_fk =:uid AND P.pid = O.pid_fk ORDER BY O.created DESC");
        $stmt->bindParam("uid", $uid, PDO::PARAM_INT) ;
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db=null;
        return $data;
        
    }

    public function updateOrder($pid, $payerID, $paymentID, $token)
    {
        $uid = $_SESSION['session_uid'];
        if($this->pyamentCheck($paymentID) < 1 && $uid > 0){
        $db = getDB();
        
        $stmt = $db->prepare("INSERT INTO orders(uid_fk, pid_fk, payerID, paymentID, token, created ) VALUES (:uid, :pid,:payerID, :paymentID, :token, :created)");
        $stmt->bindParam("paymentID", $paymentID, PDO::PARAM_STR) ;
        $stmt->bindParam("payerID", $payerID, PDO::PARAM_STR) ;
        $stmt->bindParam("token", $token, PDO::PARAM_STR) ;
        $stmt->bindParam("pid", $pid, PDO::PARAM_INT) ;
        $stmt->bindParam("uid", $uid, PDO::PARAM_INT) ;
        $created = time();
        $stmt->bindParam("created", $created, PDO::PARAM_INT) ;
       
        $stmt->execute();
        $db=null;
        return true;
        }
        else{
            return false;
        }
        
    }
    
    public function paypalCheck($paymentID, $pid, $payerID, $paymentToken){
        
        $ch = curl_init();
        $clientId = PayPal_CLIENT_ID;
        $secret = PayPal_SECRET;
        curl_setopt($ch, CURLOPT_URL, PayPal_BASE_URL.'oauth2/token');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $clientId . ":" . $secret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        $result = curl_exec($ch);
        $accessToken = null;
        

        if (empty($result)){
            return false;
        }
        
        else {
            $json = json_decode($result);
            $accessToken = $json->access_token;
            $curl = curl_init(PayPal_BASE_URL.'payments/payment/' . $paymentID);
            curl_setopt($curl, CURLOPT_POST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $accessToken,
            'Accept: application/json',
            'Content-Type: application/xml'
            ));
            $response = curl_exec($curl);
            $result = json_decode($response);
            
            
            $state = $result->state;
            $total = $result->transactions[0]->amount->total;
            $currency = $result->transactions[0]->amount->currency;
            $subtotal = $result->transactions[0]->amount->details->subtotal;
            $recipient_name = $result->transactions[0]->item_list->shipping_address->recipient_name;
            curl_close($ch);
            curl_close($curl);
            
            $product = $this->getProduct($pid);
            
            if($state == 'approved' && $currency == $product->currency && $product->price ==  $subtotal){
                $this->updateOrder($pid, $payerID, $paymentID, $paymentToken);
                return true;
                
            }
            else{
                
                return false;
            }
            
        }
        
    }
    
    
}


?>