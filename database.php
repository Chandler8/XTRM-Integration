<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Docs</title>
</head>
<body>
    
</body>
</html>

<!-- Here I will describe which files Kyck touches, and if XTRM also needs to touch them  -->
<!--

KyckGlobalAPIHelper.php
- This file works to create "helpers", a concept I don't fully understand yet.
- This file is massive and intricate, if we can re-create it under an XTRM config, that would be fine, but do we need it?

APIManagerTestControlller.php
- This file has some AWS components to it, potentially we just add XTRM into it and copy the Kyck setup
- No new file would need to be created in this instance

GoogleSheetController.php
- Nothing to create, just add the XTRM table to this file
- This file seemingly is important in regards to allowing users to be able to export chunks of info into CSV or other forms
- Do we want XTRM to exist in this file, and if so, to what extent?

APIJobQueueController.php
- This file seems important to add XTRM into, this seems like it setups up some important connections
- Many arrays and submodule links on this page, would need to set these same functions up to mirror Kyck

APIManagerController.php
- Important file for integrating XTRM, will need to also create some API connections in here
- This file holds the connections for a number of other API's

constants.php
- This file is where we actually define methods and put in links, very important 
- I will include some examples of the Kyck current setup;

class kyckglobal
{
    public static $_API_name = 'kyckglobal';
    public static $_username = 'username';
    public static $_password = 'password';
    public static $_base_url = 'https://sandbox.kyckglobal.com:90/apis/';
//    public static $_base_url = 'https://sandboxapi.kyckglobal.com:90/apis/';
//    public static $_base_url = 'https://api.kyckglobal.com:90/apis/';
}

class kyckglobalMethod
{
    public static $_user_auth = 'user_auth';
    public static $_create_payer_organization = 'create_payer_organiztion';
}

class kyckglobalUrls
{
    public static $_user_auth = 'userAuth';
    public static $_create_payer_organization = 'payerOnboarding';
}

-->