<?php
    /**
     * Name: Andre Burte
     * Date: 5/24/21
     * 
     * Scripts for testing XTRM API Calls.
     */
/*
     $name = filter_input(INPUT_POST,'username');
     $email = filter_input(INPUT_POST,'useremail');
     $pass = filter_input(INPUT_POST,'userpass'); 

     echo $name."<br>".$email."<br>".$pass."<br><br>";
*/

    $auth_str = 'grant_type=password&client_id=1930815_API_User&client_secret=TrXSmMCkrGTq2UVsOYMloiPmpwdvIkVrE56DJAkOBkg=';
    $refresh_str = 'grant_type=password&client_id=1930815_API_User&client_secret=TrXSmMCkrGTq2UVsOYMloiPmpwdvIkVrE56DJAkOBkg=&refresh_token=ad7e1b4cfe904d88abbcc2fe70828fb9';

    function getAuthToken()
    {    
        $curl = curl_init();
    
        global $auth_str;
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://xapisandbox.xtrm.com/oAuth/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $auth_str,
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
            foreach($token as $key=>$val){
                echo $key.": ".$val."<br><br>";
            }
        }
    }

    //getAuthToken();
    
    function refreshAuthToken()
    {
        $curl = curl_init();

        global $refresh_str;
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://xapisandbox.xtrm.com/oAuth/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $refresh_str,
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
            foreach($token as $key=>$val){
                echo $key.": ".$val."<br><br>";
            }
        }
    }

    refreshAuthToken();