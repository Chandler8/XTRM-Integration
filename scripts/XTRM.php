<?php
    /**
     * Name: Andre Burte
     * Date: 5/24/21
     * 
     * Scripts for testing XTRM API Calls.
     */

    //GLOBAL VARIABLES
    $auth_str = 'grant_type=password&client_id=1930815_API_User&client_secret=TrXSmMCkrGTq2UVsOYMloiPmpwdvIkVrE56DJAkOBkg=';
    $refresh_str = 'grant_type=password&client_id=1930815_API_User&client_secret=TrXSmMCkrGTq2UVsOYMloiPmpwdvIkVrE56DJAkOBkg=&refresh_token=ad7e1b4cfe904d88abbcc2fe70828fb9';
    $endpoint = "https://xapisandbox.xtrm.com";
    $I_A_N = "SPN19135579";
    $A_A_N = "";
    $R_A_N = "";

    $user_name = filter_input(INPUT_POST,'user_name');
    $user_email = filter_input(INPUT_POST,'user_email');
    $u_id = filter_input(INPUT_POST,'user_id');



    function getAuthToken()
    {    
        $curl = curl_init();
    
        global $endpoint;
        global $auth_str;
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/oAuth/token',
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


    
    function refreshAuthToken()
    {
        $curl = curl_init();

        global $endpoint;
        global $refresh_str;
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/oAuth/token',
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
            $access_token = "";

            foreach($token as $key=>$val){
                if($key == "access_token"){
                    $access_token = $val;
                }
            }
            return $access_token;
        }
    }


    
    //Use this function to create an ultimate remitter wallet
    function createCompanyWallet()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $A_A_N;
        global $endpoint;

        $company_wallet_name = filter_input(INPUT_POST,'company_wallet_name');
        $company_wallet_currency = filter_input(INPUT_POST,'company_wallet_currency');
        $company_wallet_type = filter_input(INPUT_POST,'company_wallet_type');
        
        $curl = curl_init();

        $request_fields = [
            "CreateCompanyWallet"=>[
                "request"=>[
                    "IssuerAccountNumber"=>$I_A_N,
                    "WalletName"=>$company_wallet_name,
                    "WalletCurrency"=>$company_wallet_currency,
                    "WalletType"=>$company_wallet_type,
                    "AllowAccessAccountNumber"=>$A_A_N
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/V4/Wallet/CreateCompanyWallet',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $json_typed,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$token
            )
        ));
    
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $resp = json_decode($response, true);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //print_r($resp);
            
            foreach($resp as $resps){
                foreach($resps as $wallet){
                    echo $wallet." = ".$part."<br>";
                }
            }
        }
    }



    //Use this function to retrieve ultimate remitter wallets
    function getCompanyWallets()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $endpoint;
        
        $curl = curl_init();

        $request_fields = [
            "GetCompanyWallets"=>[
                "request"=>[
                    "IssuerAccountNumber"=>$I_A_N
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/v4/Wallet/GetCompanyWallets',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $json_typed,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$token
            )
        ));
    
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $resp = json_decode($response, true);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //print_r($resp);
            
            foreach($resp as $resps){
                foreach($resps as $resp){
                    foreach($resp as $results){
                        foreach($results as $wallets){
                            foreach($wallets as $walletDetails){
                                foreach($walletDetails as $detail=>$part){
                                    echo $detail." = ".$part."<br>";
                                }
                                echo "<br>";
                            }
                        }
                    }
                }
            }
        }
    }



    //Use this function to update an ultimate remitter wallet
    function upateCompanyWallet()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $endpoint;

        $company_wallet_id = filter_input(INPUT_POST,'company_wallet_id');
        $company_wallet_name = filter_input(INPUT_POST,'company_wallet_name');
        
        $curl = curl_init();

        $request_fields = [
            "UpdateCompanyWallet"=>[
                "Request"=>[
                    "IssuerAccountNumber"=>$I_A_N,
                    "WalletID"=>$company_wallet_id,
                    "WalletName"=>$company_wallet_name
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/V4/Wallet/UpdateCompanyWallet',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $json_typed,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$token
            )
        ));
    
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $resp = json_decode($response, true);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //print_r($resp);
            
            foreach($resp as $resps){
                foreach($resps as $results){
                    foreach($results as $wallet=>$part){
                        echo $wallet." = ".$part."<br>";
                    }
                }
            }
        }
    }



    //Use this function to register a user on XTRM
    function createUser()
    {
        $token = refreshAuthToken();
        
        global $endpoint;
        global $I_A_N;
        
        $name = filter_input(INPUT_POST,'name');
        $names = split(' ',$name);
        $name_length = $names.length();
        $fname = $names[0];
        $lname = $names[$name_length - 1];
        
        $email = filter_input(INPUT_POST,'email');
        $email_notification = filter_input(INPUT_POST,'email_notification');
        $mobile_number = filter_input(INPUT_POST,'mobile_number');
        $taxID = filter_input(INPUT_POST,'$tax_id');
        $day = "";
        $month = "";
        $year = "";
        $address1 = filter_input(INPUT_POST,'address_1');
        $address2 = filter_input(INPUT_POST,'address_2');
        $apt_number = filter_input(INPUT_POST,'apartment');
        $city = filter_input(INPUT_POST,'city');
        $country = filter_input(INPUT_POST,'country');
        $currency_code = filter_input(INPUT_POST,'currency_type');
        $postal_code = filter_input(INPUT_POST,'postal_code');
        $region = filter_input(INPUT_POST,'region');

        $curl = curl_init();

        $request_fields = [
            "CreateUser"=> [
                "request"=> [
                    "IssuerAccountNumber"=>$I_A_N,                           
                    "LegalFirstName"=>$fname,
                    "LegalLastName"=>$lname,
                    "EmailAddress"=>$email,
                    "EmailNotification"=>$email_notification,
                    "MobilePhone"=>$mobile_number,
                    "TaxId"=>$taxID,
                    "DateOfBirth"=>[
                        "Day"=>$day,
                        "Month"=>$month,
                        "Year"=>$year
                    ],
                    "Address"=>[
                        "AddressLine1"=>$address1,
                        "AddressLine2"=>$address2,
                        "AptSuitNum"=>$apt_number,
                        "City"=>$city,
                        "Country"=>$country,
                        "CountryISO2"=>$currency_code,
                        "PostalCode"=>$postal_code,
                        "Region"=>$region
                    ]
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/v4/Register/CreateUser',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $json_typed,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$token
            )
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $resp = json_decode($response, true);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //print_r($resp);
            
            foreach($resp as $resps){
                foreach($resps as $resp){
                    foreach($resp as $result){
                        foreach($result as $user=>$part){
                            echo $user." = ".$part."<br>";
                        }
                    }
                }
            }
        }
    }



    //Use this function to check if a user has an XTRM account by their email address
    function checkUserExist()
    {
        $token = refreshAuthToken();
        
        global $endpoint;
        global $I_A_N;
        global $user_email;
        
        $curl = curl_init();

        $request_fields = [
            "CheckUserExist"=>[
                "request"=>[
                    "IssuerAccountNumber"=>$I_A_N,
                    "Email"=>$user_email
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/V4/Beneficiary/CheckUserExist',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $json_typed,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$token
            )
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $resp = json_decode($response, true);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //print_r($resp);
            
            foreach($resp as $resps){
                foreach($resps as $resp){
                    foreach($resp as $results){
                        foreach($results as $beneficiaries){
                            foreach($beneficiaries as $user=>$part){
                                echo $user." = ".$part."<br>";
                            }
                            echo "<br>";
                        }
                    }
                }
            }
        }
    }



    //Use this function to get info about a user's wallets
    function getUserWallets()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $u_id;
        global $endpoint;
        
        $curl = curl_init();

        $request_fields = [
            "GetUserWallets"=>[
                "request"=>[
                    "IssuerAccountNumber"=>$I_A_N,
                    "UserID"=>$u_id
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/V4/Wallet/GetUserWallets',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $json_typed,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$token
            )
        ));
    
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $resp = json_decode($response, true);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //print_r($resp);
            
            foreach($resp as $resps){
                foreach($resps as $resp){
                    foreach($resp as $results){
                        foreach($results as $wallets){
                            foreach($wallets as $wallet=>$part){
                                echo $wallet." = ".$part."<br>";
                            }
                            echo "<br>";
                        }
                    }
                }
            }
        }
    }



    //Use this function to create another wallet for a user
    function createUserWallet()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $u_id;
        global $endpoint;

        $user_wallet_name = filter_input(INPUT_POST,'user_wallet_name');
        $user_wallet_currency = filter_input(INPUT_POST,'user_wallet_currency');
        
        $curl = curl_init();

        $request_fields = [
            "CreateUserWallet"=>[
                "request"=>[
                    "IssuerAccountNumber"=>$I_A_N,
                    "UserID"=>$u_id,
                    "WalletName"=>$user_wallet_name,
                    "WalletCurrency"=>$user_wallet_currency
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/v4/Wallet/CreateUserWallet',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $json_typed,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$token
            )
        ));
    
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $resp = json_decode($response, true);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //print_r($resp);
            
            foreach($resp as $resps){
                foreach($resps as $resp){
                    foreach($resp as $result){
                        foreach($result as $wallet){
                            foreach($wallet as $wallet=>$part){
                                echo $wallet." = ".$part."<br>";
                            }
                            echo "<br>";
                        }
                    }
                }
            }
        }
    }



    //Use this function to get available remitter payment methods from XTRM
    function getPaymentMethods()
    {
        $token = refreshAuthToken();
        global $endpoint;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/v4/Payment/GetPaymentMethods',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '',
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$token
            )
        ));
    
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $resp = json_decode($response, true);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //print_r($resp);
            
            foreach($resp as $resps){
                foreach($resps as $resp){
                    foreach($resp as $results){
                        foreach($results as $methods){
                            foreach($methods as $details){
                                foreach($details as $detail=>$part){
                                    echo $detail." = ".$part."<br>";
                                }
                                echo "<br>";
                            }
                        }
                    }
                }
            }
        }
    }



    //Use this function to get available beneficiary payment methods from XTRM
    function getUserPaymentMethods()
    {
        $token = refreshAuthToken();
        global $endpoint;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/v4/Payment/GetUserPaymentMethods',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '',
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$token
            )
        ));
    
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $resp = json_decode($response, true);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //print_r($resp);
            
            foreach($resp as $resps){
                foreach($resps as $resp){
                    foreach($resp as $results){
                        foreach($results as $methods){
                            foreach($methods as $details){
                                foreach($details as $detail=>$part){
                                    echo $detail." = ".$part."<br>";
                                }
                                echo "<br>";
                            }
                        }
                    }
                }
            }
        }
    }



    //Use this function to retrieve company wallet transactions
    function getCompanyWalletTransactions()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $endpoint;

        $company_wallet_id = filter_input(INPUT_POST,'company_wallet_id');
        
        $curl = curl_init();

        $request_fields = [
            "GetCompanyWalletTransactions"=>[
                "Request"=>[
                    "IssuerAccountNumber"=>$I_A_N,
                    "WalletID"=>$company_wallet_id,
                    "Pagination"=>[
                        "RecordsToSkip"=>"1",
                        "RecordsToTake"=>"10"
                    ]
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/V4/Wallet/GetCompanyWalletTransactions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $json_typed,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$token
            )
        ));
    
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $resp = json_decode($response, true);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //print_r($resp);
            
            foreach($resp as $resps){
                foreach($resps as $results){
                    foreach($results as $transaction=>$part){
                        echo $transaction." = ".$part."<br>";
                    }
                }
            }
        }
    }



    //Use this function to retrieve details of a company wallet transaction
    function getCompanyWalletTransactionDetails()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $endpoint;

        $company_wallet_transaction_id = filter_input(INPUT_POST,'company_wallet_id');
        
        $curl = curl_init();

        $request_fields = [
            "GetCompanyWalletTransactionDetails"=>[
                "Request"=>[
                    "IssuerAccountNumber"=>$I_A_N,
                    "TransactionID"=>$company_wallet_transaction_id
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/V4/Wallet/GetCompanyWalletTransactionDetails',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $json_typed,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$token
            )
        ));
    
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $resp = json_decode($response, true);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //print_r($resp);
            
            foreach($resp as $resps){
                foreach($resps as $results){
                    foreach($results as $fields=>$field){
                        echo $fields." = ".$field."<br>";
                    }
                }
            }
        }
    }



    //Use this function to retrieve details of a user's wallet transactions by a specific remitter
    function getUserWalletTransactionsByRemitter()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $u_id;
        global $R_A_N;
        global $endpoint;
        
        $user_wallet_currency = filter_input(INPUT_POST,'user_wallet_currency');
        
        $curl = curl_init();

        $request_fields = [
            "GetUserWalletTransactionsByRemitter"=>[
                "Request"=>[
                    "IssuerAccountNumber"=>"SPN17126699",
                    "UserID"=>"PAT18128745",
                    "RemitterAccountNo"=>"SPN17126699",
                    "WalletCurrency"=>"USD",
                    "Pagination"=>[
                        "RecordsToSkip"=>"1",
                        "RecordsToTake"=>"10"
                    ]
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/V4/Wallet/GetUserWalletTransactionsByRemitter',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $json_typed,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$token
            )
        ));
    
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $resp = json_decode($response, true);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //print_r($resp);
            
            foreach($resp as $resps){
                foreach($resps as $results){
                    foreach($results as $transaction=>$part){
                        echo $transaction." = ".$part."<br>";
                    }
                }
            }
        }
    }
    
    
    
    getCompanyWalletTransactionDetails();