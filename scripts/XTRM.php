<?php
    /**
     * Name: Andre Burte
     * Date: 5/24/21
     * 
     * Scripts for testing XTRM API Calls.
     */
/*
    function getAuthToken()
    {
      $credentials = ['grant_type' => 'password','client_id' => '1930815_API_User', 'client_secret' => "TrXSmMCkrGTq2UVsOYMloiPmpwdvIkVrE56DJAkOBkg="];
    
      $otherThing = [
        'email' => "isaaclmelton@gmail.com",
        'password' => "SecurePass12!!"
      ];
    
      $curl = curl_init();
    
      $jsonThing = json_encode($credentials);
    
      curl_setopt_array($curl, array(
        CURLOPT_URL => "http://xapisandbox.xtrm.com/oAuth/token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $jsonThing,
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded"
        ),
      ));
    
      $response = curl_exec($curl);
      $err = curl_error($curl);
    
      curl_close($curl);
    
      $token = json_decode($response, true);
    
      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
        print_r($token);
      }
    }

    getAuthToken();
    */

    