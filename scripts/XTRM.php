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

     function getAuthToken()
    {
      $credentials = ['grant_type' => 'password','client_id' => '1930815_API_User', 'client_secret' => "TrXSmMCkrGTq2UVsOYMloiPmpwdvIkVrE56DJAkOBkg="];
    
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
    

/*
    $curl = curl_init();
    
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://free-nba.p.rapidapi.com/players?per_page=25&page=0",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: free-nba.p.rapidapi.com",
            "x-rapidapi-key: 4f11486c4emshd10f9888549fceep138d5ejsn082ca18ccc1b"
        ],
    ]);
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);

    $response = json_decode($response,true);
    
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        foreach($response as $players){
            foreach($players as $player){
                foreach($player as $key => $val){
                    if(!empty($key)){
                        echo $key ."=". $val ."<br>";
                    }
                }
                echo "<br>";
            }
        }
    }
    */