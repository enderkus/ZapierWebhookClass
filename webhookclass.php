<?php

class ZapierWebhook {
    
    public $hookUrl;
    public $hookUrlDefined;
    
    const URL_NOT_DEFINED = 'Webhook url not defined !';
    const DATA_NOT_ARRAY = 'Data is not array !';
    const DATA_IS_EMPTY = 'Data is empty !';
    
    function webhookCheck() {
        if (!empty($this->hookUrl)) {
            return $this->hookUrlDefined = true;
        } else {
            return $this->hookUrlDefined = false;
        }
    }
    
    function webhookInit($data){
        if (is_array($data) == true) {
            if (self::webhookCheck() == true) {
                $curl = curl_init();
                $jsonEncodedData = json_encode($data);
                $opts = array(
                CURLOPT_URL => $this->hookUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $jsonEncodedData,
                CURLOPT_HTTPHEADER => array('Content-Type: application/json','Content-Length: ' . strlen($jsonEncodedData))
                );
               curl_setopt_array($curl, $opts);
               $result = curl_exec($curl);
               curl_close($curl);
               return $result;
            } else {
                return self::URL_NOT_DEFINED;
            }
        } else {
            return self::DATA_NOT_ARRAY;
        }
    }
    
    function webhookInitPlainText($data) {
        if (self::webhookCheck() == true) {
                $curl = curl_init();
                $opts = array(
                CURLOPT_URL => $this->hookUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => array('Content-Type: text/plain','Content-Length: ' . strlen($data))
                );
               curl_setopt_array($curl, $opts);
               $result = curl_exec($curl);
               curl_close($curl);
               return $result;
            } else {
                return self::URL_NOT_DEFINED;
            }
    }
}
