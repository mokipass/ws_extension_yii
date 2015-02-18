<?php 

/**
 * Mokipass class file.
 *
 * @author Mokipass <support@mokipass.com>
 * @url http://www.mokipass.com/page/8
 * @link https://github.com/mokipass/ws_extension_yii/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @version 1.0
 */
 
 
 /**
  * Call Mokipass Web Service example
  * 
  * 
    Yii::app()->Mokipass->POS_ID='POS ID'; 
    $a=Yii::app()->Mokipass->get_sso_id(1);
    
    echo $a[0].'<br/>'; 
    echo $a[1].'<br/>'; 
    
    $b=Yii::app()->Mokipass->checkCard($a[1],'number of card','1','2',1);
    echo $b[0].'<br/>'; 
    echo $b[1].'<br/>'; 
    echo $b[2].'<br/>'; 
    echo $b[3].'<br/>'; 
    echo $b[4].'<br/>'; 
    
    $c=Yii::app()->Mokipass->addCard($a[1],1, 6, null, 'number of card', 'new number of card or null if card is virtual',1);
    echo $c[0].'<br/>'; 
    echo $c[1].'<br/>'; 
    echo $c[2].'<br/>'; 
    echo $c[3].'<br/>'; 
    
    
  * 
  */
 

        class Mokipass extends CApplicationComponent
        {
           
           public $URL = 'https://www.mokipass.com/';
           public $POS_ID = null;
           public $username = null;
           public $password = null;
           
           
           function get_error($num) {
            
            if($num==100)
            { $r = 'No user or no TOKEN';}
            
            if($num==101)
            { $r = 'No attribute';}
            
            if($num==102)
            { $r = 'error username or password';}
            
            if($num==103)
            { $r = 'the mobile is not registered';}
            
            if($num==104)
            { $r = 'No methods name';}
            
            if($num==200)
            { $r = 'OK';}
            
            if($num==201)
            { $r = 'Card is successfully activated';}
            
            if($num==202)
            { $r = 'Card was successfully added';}
            
            if($num==203)
            { $r = 'Customer got reward successfully';}
            
            if($num==302)
            { $r = 'SSO ID was not found';}
            
            if($num==303)
            { $r = 'Card number is not number';}
            
            if($num==304)
            { $r = 'The action was not registered';}
            
            if($num==305)
            { $r = 'The card was not found';}
            
            if($num==306)
            { $r = 'The card is not activated';}
            
            if($num==307)
            { $r = 'Card exists';}
            
            if($num==308)
            { $r = 'Initial part of card number is incorrect';}
            
            if($num==309)
            { $r = 'Card number length is incorrect';}
            
            if($num==310)
            { $r = 'The card was checked out';}
            
            if($num==311)
            { $r = 'Reward is not valid';}
            
            if($num==401)
            { $r = 'POS is not administrated by user';}
            
            if($num==402)
            { $r = 'Wrong user ID';}
            
            if($num==403)
            { $r = 'USER or POS does not exist';}
            
            if($num==405)
            { $r = 'Type must be 1,2 or 3';}
            
            if($num==500)
            { $r = 'Error';}
            
            if($num==700)
            { $r = 'POS is not administrated by user';}
            
            if($num==701)
            { $r = 'Username does not exist';}
            
            if($num==702)
            { $r = 'User is disabled';}
            
            if($num==703)
            { $r = 'The username, password or ID is incorrect';}
            
            if($num==704)
            { $r = 'Device is suspended';}
            
            if($num==705)
            { $r = 'Wrong user role';}
            
            if($num==900)
            { $r = 'The card was not found';}
            
            if($num==1002)
            { $r = 'The Mobile Phone is used by other User';}
            
            if($num==1003)
            { $r = 'The Mobile Phone is already Registered';}
            
            if($num==1004)
            { $r = 'You can not register more mobile phones';}

            return $r;
            }
            
    /**
     * @param int 1 - show error description; null - show error number
     * @return string[] the error, SSO_ID 
     */       
           
    function get_sso_id ($error=0) {
            
           $result = array(); 
           $client=new SoapClient($this->URL.'user/wsHttps/info');
           $rez = $client->getSSOID($this->username,$this->password,$this->POS_ID);
           for($i=0;$i<count($rez);$i++) {
            
                if($i==0) {
                    if($error==0) {
                        $result[$i] = $rez[$i];
                    } else if ($error==1) {
                       $result[$i] = $this->get_error($rez[$i]); 
                    }
                } else {
                   $result[$i] = $rez[$i]; 
                } 
           }
           return $result;
    }
    
    
   /**
     * @param int SSO ID
     * @param string the card number  
     * @param int request type (1-mobile,2-stacionar)
     * @param int card type (1- traditional plastic card; 2-virtual card;)
     * @param int 1 - show error description; null - show error number     
     * @return string[] the error, Card Number, Card identificator (CARD ID), action identificator ID, date 
     * @soap
     */      
           
    function checkCard ($sso_id, $cardnum, $source, $card_type, $error=0) {
            
           $result = array(); 
           $client=new SoapClient($this->URL.'user/wsHttps/info');
           $rez = $client->checkCard($sso_id, $cardnum, $source, $card_type);
           for($i=0;$i<count($rez);$i++) {
            
                if($i==0) {
                    if($error==0) {
                        $result[$i] = $rez[$i];
                    } else if ($error==1) {
                       $result[$i] = $this->get_error($rez[$i]); 
                    }
                } else {
                   $result[$i] = $rez[$i]; 
                } 
           }
           return $result;
    }
    
    
    
    /**
     * @param int SSO ID 
     * @param int the POS ID
     * @param string the CARD number 
     * @param int 1 - show error description; null - show error number        
     * @return string[] the status, if 5 - card activated, action ID, date 
     */      
           
    function activateCard ($sso_id, $pos_id, $card_number, $error=0) {
            
           $result = array(); 
           $client=new SoapClient($this->URL.'user/wsHttps/info');
           $rez = $client->activateCard($sso_id, $pos_id, $card_number);
           for($i=0;$i<count($rez);$i++) {
            
                if($i==0) {
                    if($error==0) {
                        $result[$i] = $rez[$i];
                    } else if ($error==1) {
                       $result[$i] = $this->get_error($rez[$i]); 
                    }
                } else {
                   $result[$i] = $rez[$i]; 
                } 
           }
           return $result;
    }
    
    
    
    /**
     * @param int SSO ID 
     * @param int new card CARD TYPE (1 - plastic card; 2 - virtual card)
     * @param int new card CARD ID
     * @param string new card CARD_VALID date
     * @param string the registered in MOKIPASS old CARD number (Merchant‘s card number or MOKIPASS virtual card number)
     * @param string the new CARD number 
     * @param int 1 - show error description; null - show error number        
     * @return string[] the status, Card Number, action ID, date 
     * @soap
     */
           
    function addCard ($sso_id, $card_type, $card_id, $card_valid, $registered_card_number, $new_card_number, $error=0) {
            
           $result = array(); 
           $client=new SoapClient($this->URL.'user/wsHttps/info');
           $rez = $client->addCard($sso_id, $card_type, $card_id, $card_valid, $registered_card_number, $new_card_number);
           for($i=0;$i<count($rez);$i++) {
            
                if($i==0) {
                    if($error==0) {
                        $result[$i] = $rez[$i];
                    } else if ($error==1) {
                       $result[$i] = $this->get_error($rez[$i]); 
                    }
                } else {
                   $result[$i] = $rez[$i]; 
                } 
           }
           return $result;
    }
    
    
    
    /**
     * @param int SSO ID
     * @param string the CARD ID (C_ID)) 
     * @param string the reward ID  
     * @param string the number of coupons
     * @param int 1 - show error description; null - show error number     
     * @return string[] the status, Offer ID, GET ALL VALUE, action type (1-start; 2-updated; 3-close) action ID, date 
     * @soap
     */
     
     
         function registerReward ($sso_id, $card_id, $reward_id, $value, $error=0) {
            
           $result = array(); 
           $client=new SoapClient($this->URL.'user/wsHttps/info');
           $rez = $client->registerReward($sso_id, $card_id, $reward_id, $value);
           for($i=0;$i<count($rez);$i++) {
            
                if($i==0) {
                    if($error==0) {
                        $result[$i] = $rez[$i];
                    } else if ($error==1) {
                       $result[$i] = $this->get_error($rez[$i]); 
                    }
                } else {
                   $result[$i] = $rez[$i]; 
                } 
           }
           return $result;
    }
            
}
