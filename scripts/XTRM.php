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
    $P_A_N = "SPN18130652";

    //$go_home = "http://localhost/XTRM/XTRM-Integration/andre.php";

    //User info
    $u_id = filter_input(INPUT_POST,'user_id');
    $first_name = filter_input(INPUT_POST,'first_name');
    $last_name = filter_input(INPUT_POST,'last_name');
    $user_email = filter_input(INPUT_POST,'user_email');
    $email_notification = filter_input(INPUT_POST,'email_notification');
    $mobile_number = filter_input(INPUT_POST,'mobile_number');
    $taxID = filter_input(INPUT_POST,'$tax_id');
    $dob = filter_input(INPUT_POST,'user_dob');
    $day = "";
    $month = "";
    $year = "";
    $address1 = filter_input(INPUT_POST,'address_1');
    $address2 = filter_input(INPUT_POST,'address_2');
    $apt_number = filter_input(INPUT_POST,'apartment');
    $city = filter_input(INPUT_POST,'city');
    $country_code = filter_input(INPUT_POST,'country_code');
    $postal_code = filter_input(INPUT_POST,'postal_code');
    $region = filter_input(INPUT_POST,'region');

    //Wallet info
    $wallet_id = filter_input(INPUT_POST,'wallet_id');
    $wallet_name = filter_input(INPUT_POST,'wallet_name');
    $wallet_currency = filter_input(INPUT_POST,'wallet_currency');
    $wallet_type = filter_input(INPUT_POST,'wallet_type');
    $currency_code = filter_input(INPUT_POST,'currency_code');
    $transaction_id = filter_input(INPUT_POST,'transaction_id');

    //Use these for bank testing/
    $bank_name = "Wells Fargo"; //filter_input(INPUT_POST,'bank_name');
    $bank_account_number = filter_input(INPUT_POST,'$ba_number');
    $bank_routing_number = "143906"; //filter_input(INPUT_POST,'routing_number');



    /**
     * From Nathan at XTRM:
     * Use the information below for testing bank calls.
     * 
     * Bank name: Wells Fargo
     * Routing number: 143906
     * Any account number
     */

     /**
     * From Nathan at XTRM:
     * Use the information below for testing with an Ultimate Remitter.
     * 
     * Company name: Acme 2
     * Account Number:	SPN18130652
     * API End Point:	http://sandbox.xapi.xtrm.com/API/V4/
     * Client ID:	2030930_API_User
     * Secret Key:	7U3Es2JE/RXPuQCh118Lru9hpFutz/cYWe1H7RQka4c=
     */



/***************************************************************************************************************************************************************************************************/

/**
 * Name: Andre Burte
 * Section: Authentication calls
 */

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
//*****************************************************************************************************************************************************************************

/**
 * Name: Andre Burte
 * Section: Company calls
 */

    //Use this function to create an ultimate remitter wallet
    function createCompanyWallet()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $A_A_N;
        global $endpoint;
        global $wallet_name;
        global $wallet_currency;
        global $wallet_type;

        $company_wallet_name = $wallet_name;
        $company_wallet_currency = $wallet_currency;
        $company_wallet_type = $wallet_type;
        
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
        
        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>Created company wallet</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
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

        //global $go_home;

        $call_result = [];

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>Company Wallets</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
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
    function updateCompanyWallet()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $endpoint;
        global $wallet_id;
        global $wallet_name;

        $company_wallet_id = $wallet_id;
        $company_wallet_name = $wallet_name;
        
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

        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>Updated company wallet</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
            foreach($resp as $resps){
                foreach($resps as $results){
                    foreach($results as $wallet=>$part){
                        echo $wallet." = ".$part."<br>";
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

        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>Payment Methods</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
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
        global $wallet_id;
        global $endpoint;

        $company_wallet_id = $wallet_id;
        
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

        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>Company Wallet Transactions</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
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
        global $transaction_id;
        
        $curl = curl_init();

        $request_fields = [
            "GetCompanyWalletTransactionDetails"=>[
                "Request"=>[
                    "IssuerAccountNumber"=>$I_A_N,
                    "TransactionID"=>$transaction_id
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

        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>Company Wallet Transaction Details</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
            foreach($resp as $resps){
                foreach($resps as $results){
                    foreach($results as $fields=>$field){
                        echo $fields." = ".$field."<br>";
                    }
                }
            }
        }
    }
    


    //Use this function to fund a company wallet by credit card
    //NOT CURRENTLY USED
    function fundCompanyWalletUsingCreditCard()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $first_name;
        global $last_name;
        global $currency_code;
        global $wallet_id;
        global $endpoint;
        
        //Payment details
        $amount = filter_input(INPUT_POST,'amount');
        
        //Payer Info
        $address = filter_input(INPUT_POST,'address');
        $city = filter_input(INPUT_POST,'city');
        $state = filter_input(INPUT_POST,'state');
        $country_code = filter_input(INPUT_POST,'country_code');
        $postal_code = filter_input(INPUT_POST,'postal_code');

        //Card details
        $exp_month = filter_input(INPUT_POST,'exp_month');
        $exp_year = filter_input(INPUT_POST,'exp_year');
        $card_number = filter_input(INPUT_POST,'card_number');
        $card_type = filter_input(INPUT_POST,'card_type');
        $cvv = filter_input(INPUT_POST,'cvv');
        
        $curl = curl_init();

        $request_fields = [
            "FundCompanyWalletUsingCreditCardRequest"=>[
                "Request"=>[
                    "PaymentDetails"=>[
                        "IssuerAccountNumber"=>$I_A_N,
                        "Amount"=>$amount,
                        "CurrencyCode"=>$currency_code,
                        "WalletID"=>$wallet_id
                    ],
                    "PayerInformation"=>[
                        "FirstName"=>$first_name,
                        "LastName"=>$last_name
                    ],
                    "PayerBillingAddress"=>[
                        "Address1"=>$address,
                        "City"=>$city,
                        "State"=>$state,
                        "CountryISO2"=>$country_code,
                        "PostalCode"=>$postal_code
                    ],
                    "CreditCardDetails"=>[
                        "ExpireMonth"=>$exp_month,
                        "ExpireYear"=>$exp_year,
                        "CreditCardNumber"=>$card_number,
                        "CreditCardType"=>$card_type,
                        "CVV"=>$cvv
                    ]
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/V4/Wallet/fundCompanyWalletUsingCreditCard',
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
            echo "<h1>Funded company wallet using credit card</h1>";
            foreach($resp as $resps){
                foreach($resps as $results){
                    foreach($results as $details=>$part){
                        echo $details." = ".$part."<br>";
                    }
                }
            }
        }
    }



    //Use this function to fund a company wallet by linked bank ACH debit
    function fundWalletUsingACHDebit()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $endpoint;
        
        //Payment details
        $amount = filter_input(INPUT_POST,'amount');
        $currency_code = filter_input(INPUT_POST,'currency_code');
        $wallet_id = filter_input(INPUT_POST,'wallet_id');
        $linked_bank = filter_input(INPUT_POST,'linked_bank');
        
        $curl = curl_init();

        $request_fields = [
            "FundWalletUsingACHDebitRequest"=>[
                "Request"=>[
                    "IssuerAccountNumber"=>$I_A_N,
                    "Amount"=>$amount,
                    "CurrencyCode"=>$currency_code,
                    "WalletID"=>$wallet_id,
                    "LinkedBankID"=>$linked_bank
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/V4/Wallet/FundWalletUsingACHDebit',
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

        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>Funded wallet using ACH debit</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
            foreach($resp as $resps){
                foreach($resps as $results){
                    foreach($results as $details=>$part){
                        echo $details." = ".$part."<br>";
                    }
                }
            }
        }
    }



    //Use this function to retrieve a list of a company's beneficiaries with details
    function getBeneficiaries()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $endpoint;
        
        $curl = curl_init();

        $request_fields = [
            "GetBeneficiaries"=>[
                "request"=>[
                    "IssuerAccountNumber"=>$I_A_N,
                    "Pagination"=>[
                        "RecordsToSkip"=>"1",
                        "RecordsToTake"=>"10"
                    ]
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/v4/Beneficiary/GetBeneficiaries',
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

        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>Beneficiaries</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
            foreach($resp as $resps){
                foreach($resps as $resp){
                    foreach($resp as $results){
                        foreach($results as $beneficiaries){
                            foreach($beneficiaries as $beneficiaryDetails){
                                foreach($beneficiaryDetails as $detail=>$part){
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



    //Use this function to transfer funds from a company wallet to a beneficiary wallet.
    //A beneficary wallet will be created, if one does not exist for that currency.
    function transferFund()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $P_A_N;
        global $wallet_id;
        global $currency_code;
        global $endpoint;

        $payment_method_id = filter_input(INPUT_POST,'payment_method_id');
        $amount = filter_input(INPUT_POST,'amount');
        $company_wallet_id = $wallet_id;
        $email_notification = filter_input(INPUT_POST,'email_notification');
        $linked_bank = filter_input(INPUT_POST,'bank_id');
        $payment_description = filter_input(INPUT_POST,'payment_description');
        
        $curl = curl_init();

        $request_fields = [
            "TransferFund"=>[
                "request"=>[
                    "Transaction"=>[
                        "IssuerAccountNumber"=>$I_A_N,
                        "PaymentType"=>"Personal",
                        "PaymentMethodId"=>$payment_method_id,
                        "ProgramId"=>"Use 'GetPrograms' to get Program ID",
                        "WalletID"=>$company_wallet_id,
                        "PaymentDescription"=>$payment_description,
                        "PaymentCurrency"=>$currency_code,
                        "EmailNotification"=>$email_notification,        
                        "TransactionDetails"=>[
                            "IssuerTransactionId"=>"Unique ID",
                            "PaymentAmount"=>$amount,
                            "PartnerAccountNumber"=>$P_A_N,
                            "RecipientUserId"=>$u_id,
                            "UserLinkedBankID"=>$linked_bank,
                            "UserPayPalEmailID"=>"User PayPal Email ID",
                            "UserPrepaidVisaEmailID"=>"User Prepaid Virtual Visa Email ID",
                            "UserGiftCardEmailID"=>"User Digital Gift Card Email ID",
                            "sku"=>"Use 'GetGiftCards' to get sku",
                            "DealRegId"=>"Deal_Reg_ID",
                            "Comment"=>"Comment"
                        ]
                    ]
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/v4/Fund/TransferFund',
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

        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>Funds transferred</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
            foreach($resp as $resps){
                foreach($resps as $resp){
                    foreach($resp as $results){
                        foreach($results as $transactions){
                            foreach($transactions as $details=>$detail){
                                echo $details." = ".$detail."<br>";
                            }
                        }
                    }
                }
            }
        }
    }



    //Use this function to transfer funds from a company wallet to a beneficiary wallet,
    //dynamically creating a beneficiary user if the email is not already in XTRM's system.
    function transferFundDynamicAccountCreateUser()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $P_A_N;
        global $wallet_id;
        global $currency_code;
        global $first_name;
        global $last_name;
        global $endpoint;

        $amount = filter_input(INPUT_POST,'amount');
        $recipient_email = filter_input(INPUT_POST,'recipient_email');
        $description = filter_input(INPUT_POST,'description');
        
        $curl = curl_init();

        $request_fields = [
            "TransferFundToDynamicAccountUser"=>[
                "Request"=>[
                    "IssuerAccountNumber"=>$I_A_N,
                    "FromAccountNumber"=>$P_A_N,
                    "FromWalletID"=>$wallet_id,
                    "RecipientFirstName"=>$first_name, 
                    "RecipientLastName"=>$last_name,
                    "RecipientEmail"=>$recipient_email,
                    "Currency"=>$currency_code,
                    "Amount"=>$amount,
                    "Description"=>$description
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/v4/Fund/TransferFundDynamicAccountCreateUser',
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

        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>User created after dynamic transfer</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
            foreach($resp as $resps){
                foreach($resps as $resp){
                    foreach($resp as $result){
                        foreach($result as $transaction){
                            foreach($transaction as $details=>$detail){
                                echo $details." = ".$detail."<br>";
                            }
                        }
                    }
                }
            }
        }
    }
    


    //Use this function to view a list of a company's beneficiaries
    function checkBeneficiaryExist()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $endpoint;
        
        $company_name = filter_input(INPUT_POST,'company_name');

        $curl = curl_init();

        $request_fields = [
            "CheckBeneficiaryExist"=>[
                "request"=>[
                    "IssuerAccountNumber"=>$I_A_N,
                    "CompanyName"=>$company_name
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/v4/Beneficiary/CheckBeneficiaryExist',
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

        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>Beneficiary exists</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
            foreach($resp as $resps){
                foreach($resps as $resp){
                    foreach($resp as $results){
                        foreach($results as $beneficiary){
                            foreach($beneficiary as $detail=>$part){
                                echo $detail." = ".$part."<br>";
                            }
                            echo "<br>";
                        }
                    }
                }
            }
        }
    }

/********************************************************************************************************************************************************************************************/

/**
 * Name: Andre Burte
 * Section: Beneficiary user calls
 */

    //Use this function to register a user on XTRM
    function createUser()
    {
        $token = refreshAuthToken();
        
        global $endpoint;
        global $I_A_N;
        global $first_name;
        global $last_name;
        global $user_email;
        
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
                    "LegalFirstName"=>$first_name,
                    "LegalLastName"=>$last_name,
                    "EmailAddress"=>$user_email,
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

        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>User created</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
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

        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>User exists</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
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



    //Use this function to create another wallet for a user
    function createUserWallet()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $u_id;
        global $endpoint;
        global $wallet_name;
        global $wallet_currency;

        $user_wallet_name = $wallet_name;
        $user_wallet_currency = $wallet_currency;
        
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
            echo "<h1>User wallet created</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
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

        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>User Wallets</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
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

        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>User Payment Methods</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
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



    //Use this function to retrieve details of a beneficiary user's wallet transactions
    function getUserWalletTransactions()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $u_id;
        global $endpoint;
        global $wallet_currency;
        
        $user_wallet_currency = $wallet_currency;
        
        $curl = curl_init();

        $request_fields = [
            "GetUserWalletTransactions"=>[
                "Request"=>[
                    "IssuerAccountNumber"=>$I_A_N,
                    "UserID"=>$u_id,
                    "WalletCurrency"=>$user_wallet_currency,
                    "Pagination"=>[
                        "RecordsToSkip"=>"1",
                        "RecordsToTake"=>"10"
                    ]
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/V4/Wallet/GetUserWalletTransactions',
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

        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>User Wallet Transactions</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
            foreach($resp as $resps){
                foreach($resps as $results){
                    foreach($results as $transaction=>$part){
                        echo $transaction." = ".$part."<br>";
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
        global $wallet_currency;
        global $endpoint;
        
        $user_wallet_currency = $wallet_currency;
        
        $curl = curl_init();

        $request_fields = [
            "GetUserWalletTransactionsByRemitter"=>[
                "Request"=>[
                    "IssuerAccountNumber"=>$I_A_N,
                    "UserID"=>$u_id,
                    "RemitterAccountNo"=>$R_A_N,
                    "WalletCurrency"=>$user_wallet_currency,
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

        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>User Wallet Transactions By Remitter</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
            foreach($resp as $resps){
                foreach($resps as $results){
                    foreach($results as $transaction=>$part){
                        echo $transaction." = ".$part."<br>";
                    }
                }
            }
        }
    }



    //Use this function to retrieve details of a beneficiary user's wallet transaction
    function getUserWalletTransactionDetails()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $endpoint;
        global $u_id;
        global $transaction_id;

        $curl = curl_init();

        $request_fields = [
            "GetUserWalletTransactionDetails"=>[
                "Request"=>[
                    "IssuerAccountNumber"=>$I_A_N,
                    "UserID"=>$u_id,
                    "TransactionID"=>$transaction_id
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/V4/Wallet/GetUserWalletTransactionDetails',
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

        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>User Wallet Transaction Details</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
            foreach($resp as $resps){
                foreach($resps as $results){
                    foreach($results as $fields=>$field){
                        echo $fields." = ".$field."<br>";
                    }
                }
            }
        }
    }



    //Use this function to retrieve a list of beneficiary linked bank accounts
    function getLinkedBankAccounts()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $endpoint;
        global $u_id;
        
        $curl = curl_init();

        $request_fields = [
            "GetLinkedBankAccounts"=>[
                "request"=>[
                    "IssuerAccountNumber"=>$I_A_N,
                    "RecipientUserId"=>$u_id
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/v4/Bank/GetLinkedBankAccounts',
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

        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>Linked Bank Accounts</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
            foreach($resp as $resps){
                foreach($resps as $results){
                    foreach($results as $beneficiaries){
                        foreach($beneficiaries as $details=>$detail){
                            echo $details." = ".$detail."<br>";
                        }
                    }
                }
            }
        }
    }



    //Use this function to delete a beneficiary's linked bank account
    function deleteBankBeneficiary()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $endpoint;
        global $u_id;

        $bank_id = filter_input(INPUT_POST,'bank_id');
        
        $curl = curl_init();

        $request_fields = [
            "DeleteBankBeneficiary"=>[
                "request"=>[
                    "IssuerAccountNumber"=>$I_A_N,
                    "RecipientAccountNumber"=>$u_id,
                    "BeneficiaryBankID"=>$bank_id
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/v4/Bank/DeleteBankBeneficiary',
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

        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>Beneficiary Bank Deleted</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
            foreach($resp as $resps){
                foreach($resps as $results){
                    foreach($results as $result=>$part){
                        echo $result." = ".$part."<br>";
                    }
                }
            }
        }
    }



    //Use this function to get a list of beneficiary ACH debit linked bank accounts
    //NOT CURRENTLY USED
    function getBeneficiaryACHDebitLinkedBankAccounts()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $endpoint;
        global $u_id;
        
        $curl = curl_init();

        $request_fields = [
            "GetACHDebitLinkedBankAccounts"=>[
                "request"=>[
                    "IssuerAccountNumber"=>$I_A_N,
                    "RecipientUserId"=>$u_id
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/v4/Bank/GetACHDebitLinkedBankAccounts',
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
            foreach($resp as $resps){
                foreach($resps as $results){
                    foreach($results as $details=>$part){
                        echo $details." = ".$part."<br>";
                    }
                }
            }
        }
    }



    //Use this function to update a beneficiary user account
    function updateUser()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $endpoint;
        global $u_id;
        global $first_name;
        global $last_name;
        global $user_email;
        global $email_notification;
        global $mobile_number;
        global $taxID;
        global $day;
        global $month;
        global $year;
        global $currency_code;
        
        $address1 = filter_input(INPUT_POST,'address_1');
        $address2 = filter_input(INPUT_POST,'address_2');
        $apt_number = filter_input(INPUT_POST,'apartment');
        $city = filter_input(INPUT_POST,'city');
        $country = filter_input(INPUT_POST,'country');
        $postal_code = filter_input(INPUT_POST,'postal_code');
        $region = filter_input(INPUT_POST,'region');

        $curl = curl_init();

        $request_fields = [
            "UpdateUser"=> [
                "request"=> [
                    "IssuerAccountNumber"=>$I_A_N,
                    "UserId"=>$u_id,                         
                    "LegalFirstName"=>$first_name,
                    "LegalLastName"=>$last_name,
                    "EmailAddress"=>$user_email,
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
            CURLOPT_URL => $endpoint.'/API/v4/Register/UpdateUser',
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

        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>User updated</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
            foreach($resp as $resps){
                foreach($resps as $result){
                    foreach($result as $user=>$part){
                        echo $user." = ".$part."<br>";
                    }
                }
            }
        }
    }



    //Use this function to update a beneficiary user's wallet
    function updateUserWallet()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $endpoint;
        global $u_id;
        global $wallet_id;
        global $wallet_name;

        $user_wallet_id = $wallet_id;
        $user_wallet_name = $wallet_name;
        
        $curl = curl_init();

        $request_fields = [
            "UpdateUserWallet"=>[
                "Request"=>[
                    "IssuerAccountNumber"=>$I_A_N,
                    "UserID"=>$u_id,
                    "WalletID"=>$user_wallet_id,
                    "WalletName"=>$user_wallet_name
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/v4/Wallet/UpdateUserWallet',
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

        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>User Wallet Updated</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
            foreach($resp as $resps){
                foreach($resps as $result){
                    foreach($result as $wallet=>$part){
                        echo $wallet." = ".$part."<br>";
                    }
                }
            }
        }
    }
    


    //Use this function to retrieve a list of a beneficiary's wallets
    //NOT CURRENTLY USED
    function getBeneficiaryWallets()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $endpoint;
        global $u_id;
        
        $curl = curl_init();

        $request_fields = [
            "GetBeneficiaryWallets"=>[  
                "request"=>[  
                    "IssuerAccountNumber"=>$I_A_N,
                    "BeneficiaryAccountNumber"=>$u_id
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/v4/Wallet/GetBeneficiaryWallets',
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

        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>Beneficiary Wallets</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
            foreach($resp as $resps){
                foreach($resps as $resp){
                    foreach($resp as $results){
                        foreach($results as $wallets){
                            foreach($wallets as $detail=>$part){
                                echo $detail." = ".$part."<br>";
                            }
                            echo "<br>";
                        }
                    }
                }
            }
        }
    }



    //Use this function to retrieve a beneficiary user's wallet balance
    function getUserWalletBalance()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $endpoint;
        global $u_id;
        global $wallet_currency;
        
        $curl = curl_init();

        $request_fields = [
            "GetUserWalletBalance"=>[  
                "request"=>[  
                    "IssuerAccountNumber"=>$I_A_N,
                    "BeneficiaryAccountNumber"=>$u_id,
                    "Currency"=>$wallet_currency
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/v4/Wallet/GetUserWalletBalance',
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

        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>User Wallet Balance</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
            foreach($resp as $resps){
                foreach($resps as $resp){
                    foreach($resp as $result){
                        foreach($result as $detail=>$part){
                            echo $detail." = ".$part."<br>";
                        }
                        echo "<br>";
                    }
                }
            }
        }
    }



    //Use this function to search for banks by name in a country 
    function searchBank()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $country_code;
        global $bank_name;
        global $endpoint;
        
        $curl = curl_init();

        $request_fields = [
            "SearchBank"=>[
                "request"=>[
                    "IssuerAccountNumber"=>$I_A_N,
                    "BankName"=>$bank_name,
                    "BankCountryISO2"=>$country_code,
                    "Pagination"=>[
                        "RecordsToSkip"=>1,
                        "RecordsToTake"=>10
                    ]
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/v4/Bank/SearchBank',
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

        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>Banks</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
            foreach($resp as $resps){
                foreach($resps as $results){
                    foreach($results as $banks=>$bank){
                        //echo $banks."<br>";
                        foreach($bank as $details=>$detail){
                            //echo $details." = ".$detail."<br>";
                            foreach($detail as $part=>$piece){
                                echo $part." = ".$piece."<br>";

                            }
                        }
                    }
                }
            }
        }
    }



    //Use this function to link a bank to a beneficiary wallet
    function linkBankBeneficiary()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $u_id;
        global $wallet_id;
        global $currency_code;
        global $first_name;
        global $last_name;
        global $mobile_number;
        global $address1;
        global $address2;
        global $city;
        global $region;
        global $postal_code;
        global $country_code;
        global $bank_name;
        global $bank_account_number;
        global $bank_routing_number;
        global $endpoint;

        $swift_id = filter_input(INPUT_POST,'swift_id');
        $withdraw_type = filter_input(INPUT_POST,'withdraw_type');
        $remittance_line3 = filter_input(INPUT_POST,'remittance3');
        $remittance_line4 = filter_input(INPUT_POST,'remittance4');
        
        $curl = curl_init();

        $request_fields = [
            "LinkBankBeneficiary"=>[
                "request"=>[
                  "IssuerAccountNumber"=>$I_A_N,
                  "UserID"=>$u_id,
                  "Beneficiary"=>[  
                    "BeneficiaryDetails"=>[  
                      "BeneficiaryInformation"=>[  
                        "ContactName"=>$first_name." ".$last_name,
                        "PhoneNumber"=>$mobile_number,
                        "AddressLine1"=>$address1,
                        "AddressLine2"=>$address2,
                        "City"=>$city,
                        "Region"=>$region,
                        "PostalCode"=>$postal_code,
                        "CountryISO2"=>$country_code
                      ]
                      ],
                    "BankDetails"=>[  
                      "BeneficiaryBankInformation"=>[  
                        "InstitutionName"=>$bank_name,
                        "WithdrawType"=>$withdraw_type,
                        "Currency"=>$currency_code,
                        "SWIFTBIC"=>$swift_id,
                        "AccountNumber"=>$bank_account_number,
                        "RoutingNumber"=>$bank_routing_number,
                        "CountryISO2"=>$country_code,
                        "RemittanceLine3"=>$remittance_line3,
                        "RemittanceLine4"=>$remittance_line4
                      ]
                    ]
                  ]
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/v4/Bank/LinkBankBeneficiary',
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

        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>Bank Linked</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
            foreach($resp as $resps){
                foreach($resps as $resp){
                    foreach($resp as $result){
                        foreach($result as $transaction){
                            foreach($transaction as $details=>$detail){
                                echo $details." = ".$detail."<br>";
                            }
                        }
                    }
                }
            }
        }
    }

/*****************************************************************************************************************************************************************************************************/

/**
 * Name: Andre Burte
 * Section: Non-specific user-type calls
 */



    //Use this function to get a list of digital gift cards supported by XTRM
    function getDigitalGiftCards()
    {
        $token = refreshAuthToken();
        
        global $I_A_N;
        global $wallet_currency;
        global $endpoint;
        
        $curl = curl_init();

        $request_fields = [
            "GetGiftCards"=>[
                "Request"=>[
                    "IssuerAccountNumber"=>$I_A_N,
                    "Currency"=>$wallet_currency,
                    "Pagination"=>[
                        "RecordsToSkip"=>"1",
                        "RecordsToTake"=>"20"
                    ]
                ]
            ]
        ];

        $json_typed = json_encode($request_fields);
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint.'/API/v4/GiftCard/GetDigitalGiftCards',
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

        //global $go_home;

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<h1>Digital Gift Cards</h1>";
            //echo "<p><a href='".$go_home."'>Return to API calls test page</a></p>";
            foreach($resp as $resps){
                foreach($resps as $resp){
                    foreach($resp as $results){
                        foreach($results as $gift_cards){
                            foreach($gift_cards as $details=>$detail){
                                echo $details." = ".$detail."<br>";
                                
                                foreach($detail as $items=>$parts){
                                    //echo $items." = ".$parts."<br><br>";
                                    
                                    foreach($parts as $part=>$pieces){
                                        if($part == "Img80W"){
                                            echo "&emsp;".$part." = <img src='".$pieces."'/><br>&emsp;&emsp;";
                                        }
                                        else{
                                            echo "&emsp;".$part." = ".$pieces."<br>&emsp;&emsp;";
                                        }

                                        foreach($pieces as $piece=>$item){
                                            echo $item.", ";
                                        }
                                       // echo "<br>";
                                    }
                                    echo "<br>";
                                }
                            }
                        }
                    }
                }
            }
        }
    }

/*****************************************************************************************************************************************************************************************************/

/**
 * Name: Andre Burte
 * Section: Function call hanlders
 */


/*
    $submitted = filter_input(INPUT_POST,'submit');

    if($submitted == 'create_user'){
        createUser();
    }
    elseif($submitted == 'create_user_wallet'){
        createUserWallet();
    }
    elseif($submitted == 'get_user_wallets'){
        getUserWallets();
    }
    elseif($submitted == 'get_user_wallet_balance'){
        getUserWalletBalance();
    }
    elseif($submitted == 'update_user_wallet'){
        updateUserWallet();
    }
    elseif($submitted == 'get_user_wallet_transactions'){
        getUserWalletTransactions();
    }
    elseif($submitted == 'get_user_wallet_transactions_by_remitter'){
        getUserWalletTransactionsByRemitter();
    }
    elseif($submitted == 'get_user_wallet_transaction_details'){
        getUserWalletTransactionDetails();
    }
    elseif($submitted == 'update_user'){
        updateUser();
    }
    elseif($submitted == 'link_beneficiary_bank'){
        linkBankBeneficiary();
    }
    elseif($submitted == 'get_linked_bank_accounts'){
        getLinkedBankAccounts();
    }
    elseif($submitted == 'delete_bank_beneficiary'){
        deleteBankBeneficiary();
    }
    elseif($submitted == 'create_company_wallet'){
        createCompanyWallet();
    }
    elseif($submitted === 'get_company_wallets'){
        getCompanyWallets();
    }
    elseif($submitted == 'update_company_wallet'){
        updateCompanyWallet();
    }
    elseif($submitted == 'get_company_wallet_transactions'){
        getCompanyWalletTransactions();
    }
    elseif($submitted == 'get_company_wallet_transaction_details'){
        getCompanyWalletTransactionDetails();
    }
    elseif($submitted == 'transfer_fund'){
        transferFund();
    }
    elseif($submitted == 'transfer_dynamic_create'){
        transferFundDynamicAccountCreateUser();
    }
    elseif($submitted == 'check_beneficiary_exist'){
        checkBeneficiaryExist();
    }
    elseif($submitted == 'check_user_exist'){
        checkUserExist();
    }
    elseif($submitted == 'get_payment_methods'){
        getPaymentMethods();
    }
    elseif($submitted == "get_user_payment_methods"){
        getUserPaymentMethods();
    }
    elseif($submitted == 'get_beneficiaries'){
        getBeneficiaries();
    }
    elseif($submitted == 'get_digital_gift_cards'){
        getDigitalGiftCards();
    }
    elseif($submitted == 'search_bank'){
        searchBank();
    }
    else{
        echo "<h2>That call is not yet setup.</h2>";
    }
    */