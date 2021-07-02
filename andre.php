<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Andre's page for working on XTRM API</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="styles/mystyle.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Crimson+Pro">
    </head>
    <body>
        <div class="container-fluid">
            <div class="jumbotron" id="jumbo">
                <h1>XTRM Testing of form submissions</h1>
                <div class="nav flex-column">
                    <p class="nav-link">Click this <a href="https://www.xtrm.com/web/Register/SponSimpleSignup.aspx" target="_blank">link</a> to begin your XTRM setup.</p>
                    <p class="nav-link">To visit talent bills, click this link: <a href="chandler.php" target="_blank">Talent Bills</a></p>
                </div>
            </div>
            <hr>
            <h3>Select one:</h3>
            <div class="option-types">
                <div class="form-check form-check-inline">
                    <input class="form-check-input option-type" type="radio" name="view-options" id="company-options" value="company-options">
                    <label class="form-check-label" for="company-options">View Company Options</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input option-type" type="radio" name="view-options" id="beneficiary-options" value="beneficiary-options">
                    <label class="form-check-label" for="beneficiary-options">View Beneficiary Options</label>
                </div>
            </div>
    <!---------------Option Types---------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="option-types">
                <div class="company-options-btns d-none">
                    <div class="row">
                        <div class="btn-group mb-2 col">
                            <div class="btn btn-success btn-sm" id="create_company_wallet_option_btn">Create Company Wallet</div>
                            <div class="btn btn-success btn-sm" id="get_company_wallets_option_btn">Get Compny Wallets</div>
                            <div class="btn btn-success btn-sm" id="fund_wallet_using_ACH_debit_option_btn">Fund Wallet Using ACH Debit</div>
                            <div class="btn btn-success btn-sm" id="update_company_wallet_option_btn">Update Company Wallet</div>
                            <div class="btn btn-success btn-sm" id="get_company_wallet_transactions_option_btn">Get Company Wallet Transactions</div>
                            <div class="btn btn-success btn-sm" id="get_beneficiaries_option_btn">Get Beneficiaries</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="btn-group mb-2 col">
                            <div class="btn btn-success btn-sm" id="get_payment_methods_option_btn">Get Payment Methods</div>
                            <div class="btn btn-success btn-sm" id="check_beneficiary_exists_option_btn">Check Beneficiary Exists</div>
                            <div class="btn btn-success btn-sm" id="get_beneficiary_wallets_option_btn">Get Beneficiary Wallets</div>
                            <div class="btn btn-success btn-sm" id="transfer_fund_option_btn">Transfer Fund</div>
                            <div class="btn btn-success btn-sm" id="transfer_fund_create_user_option_btn">Transfer Fund / Create User</div>
                            <div class="btn btn-success btn-sm" id="get_company_wallet_transaction_details_option_btn">Get Company Wallet Transaction Details</div>
                        </div>
                    </div>
                </div>
                <div class="beneficiary-options-btns d-none">
                    <div class="row">
                        <div class="btn-group mb-2 col">
                            <div class="btn btn-success btn-sm" id="create_user_option_btn">Create User</div>
                            <div class="btn btn-success btn-sm" id="check_user_exists_option_btn">Check User Exists</div>
                            <div class="btn btn-success btn-sm" id="create_user_wallet_option_btn">Create User Wallet</div>
                            <div class="btn btn-success btn-sm" id="get_user_wallets_option_btn">Get User Wallets</div>
                            <div class="btn btn-success btn-sm" id="get_user_payment_methods_option_btn">Get User Payment Methods</div>
                            <div class="btn btn-success btn-sm" id="get_user_wallet_transactions_option_btn">Get User Wallet Transactions</div>
                            <div class="btn btn-success btn-sm" id="get_user_wallet_transactions_by_remitter_option_btn">Get User Wallet Transactions By Remitter</div>
                            <div class="btn btn-success btn-sm" id="get_digital_gift_cards_option_btn">Get Digital Gift Cards</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="btn-group mb-2 col">
                            <div class="btn btn-success btn-sm" id="get_user_wallet_transaction_details_option_btn">Get User Wallet Transaction Details</div>
                            <div class="btn btn-success btn-sm" id="search_bank_option_btn">Search Bank</div>
                            <div class="btn btn-success btn-sm" id="link_beneficiary_bank_option_btn">Link Benefiacry Bank</div>
                            <div class="btn btn-success btn-sm" id="get_linked_bank_accounts_option_btn">Get Linked Bank Accounts</div>
                            <div class="btn btn-success btn-sm" id="delete_beneficiary_linked_bank_option_btn">Delete Beneficiary Linked Bank</div>
                            <div class="btn btn-success btn-sm" id="update_user_option_btn">Update User</div>
                            <div class="btn btn-success btn-sm" id="update_user_wallet_option_btn">Update User Wallet</div>
                            <div class="btn btn-success btn-sm" id="get_user_wallet_balance_option_btn">Get User Wallet Balance</div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="container">
        <!--------------------createUser----------------------------------------------------------------------------------------------------------------------------------------->
                <form id="create-user-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group col-6">
                            <label for="fname">First Name</label>
                            <input type="text" class="form-control" id="fname" name="first_name" placeholder="Enter your first name">
                        </div>
                        <div class="form-group user-group col-6">
                            <label for="lname">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="last_name" placeholder="Enter your last name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group user-group find-user col-6">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="user_email" placeholder="Enter email">
                        </div>
                        <div class="form-group user-group col-6">
                            <label for="m_num">Mobile Number</label>
                            <input type="text" class="form-control" id="m_num" name="mobile_number" placeholder="Enter your mobile number">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group form-check user-group col-3">
                            <input type="checkbox" class="form-check-input" id="notify">
                            <label class="form-check-label" for="notify">Check to be notified by email</label>
                        </div>
                        <div class="form-group user-group col-4">
                            <label for="tax">Tax ID</label>
                            <input type="text" class="form-control" id="tax" name="tax_ID" placeholder="Enter tax id">
                        </div>
                        <div class="form-group user-group col-2">
                            <label for="dob">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="user_dob" placeholder="Now">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-10">
                            <label for="address1">Address</label>
                            <input type="text" class="form-control" id="address1" name="address1" placeholder="Enter street address">
                        </div>
                        <div class="form-group col-2">
                            <label for="address2">Apt/Suite</label>
                            <input type="text" class="form-control" id="address2" name="address2" placeholder="Enter suite number">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-10">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="Enter city">
                        </div>
                        <div class="form-group col-2">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="state" name="state" placeholder="Enter state">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-10">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" name="country" placeholder="Enter country">
                        </div>
                        <div class="form-group col-2">
                            <label for="postal">Postal Code</label>
                            <input type="text" class="form-control" id="postal" name="postal" placeholder="Enter postal code">
                        </div>
                        <div class="form-group col-2">
                            <label for="region">Region</label>
                            <input type="text" class="form-control" id="region" name="region" placeholder="Enter your region">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success" name="submit" value="create_user">Submit</button>
                        </div>
                    </div>
                </form>
        <!---------------------createUserWallet------------------------------------------------------------------------------------------------------------>
                <form id="create-user-wallet-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group col-8">
                            <label for="wallet_name">Wallet name</label>
                            <input type="text" class="form-control" id="wallet_name" name="wallet_name" placeholder="Enter a name for this wallet, Ex:(Ruples)">
                        </div>
                        <div class="form-group user-group find-user col-2">
                            <label for="wallet_type">Select wallet type</label>
                            <select class="custom-select" name="wallet_type" id="wallet_type">
                                <option value="standard">Standard</option>
                                <option value="non-standard">Non-standard</option>
                            </select>
                        </div>
                        <div class="form-group user-group find-user col-2">
                            <label for="currency_type">Select currency type</label>
                            <select class="custom-select currency_type" name="wallet_currency"></select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success" name="submit" value="create_user_wallet">Submit</button>
                        </div>
                    </div>
                </form>
        <!----------------------getUserWallets------------------------------------------------------------------------------------------------------------->
                <form id="get-user-wallets-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group find-user col-6">
                            <label for="u_id">User ID</label>
                            <input type="text" class="form-control" id="u_id" name="user_id" placeholder="Enter your user ID">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success" name="submit" value="get_user_wallets">Submit</button>
                        </div>
                    </div>
                </form>
        <!---------------------getUserWalletBalance------------------------------------------------------------------------------------------------------------>
                <form id="get-user-wallet-balance-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group">
                            <label for="user_id">User ID</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Enter the user ID">
                        </div>
                        <div class="form-group user-group find-user col-4">
                            <label for="currency_type">Select currency type</label>
                            <select class="custom-select currency_type" name="wallet_currency"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" class="btn btn-success" name="submit" value="get_user_wallet_balance">Submit</button>
                    </div>
                </form>
        <!---------------------updateUserWallet------------------------------------------------------------------------------------------------------------>
                <form id="update-user-wallet-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group col-6">
                            <label for="user_id">User ID</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Enter the user ID">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group user-group col-6">
                            <label for="wallet_id">Wallet ID</label>
                            <input type="text" class="form-control" id="wallet_id" name="wallet_id" placeholder="Enter the wallet ID">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group user-group col-6">
                            <label for="update_wallet_name">Update wallet name</label>
                            <input type="text" class="form-control" id="update_wallet_name" name="wallet_name" placeholder="Enter the new wallet name, Ex:(College Fund)">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success" name="submit" value="update_user_wallet">Submit</button>
                        </div>
                    </div>
                </form>
        <!---------------------getUserWalletTransactions------------------------------------------------------------------------------------------------------------>
                <form id="get-user-wallet-transactions-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group">
                            <label for="user_id">User ID</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Enter the user ID">
                        </div>
                        <div class="form-group user-group find-user col-4">
                            <label for="currency_type">Select currency type</label>
                            <select class="custom-select currency_type" name="wallet_currency"></select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success" name="submit" value="get_user_wallet_transactions">Submit</button>
                        </div>
                    </div>
                </form>
        <!---------------------getUserWalletTransactionsByRemitter------------------------------------------------------------------------------------------------------------>
                <form id="get-user-wallet-transactions-by-remitter-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group col-6">
                            <label for="user_id">User ID</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Enter the user ID">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group user-group col-6">
                            <label for="remitter_number">Remitter Account Number</label>
                            <input type="text" class="form-control" id="remitter_number" name="remitter_number" placeholder="Remitter Account Number" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group user-group find-user col-6">
                            <label for="currency_type">Select currency type</label>
                            <select class="custom-select currency_type" name="wallet_currency"></select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success" name="submit" value="get_user_wallet_transactions_by_remitter">Submit</button>
                        </div>
                    </div>
                </form>
        <!---------------------getUserWalletTransactionDetails------------------------------------------------------------------------------------------------------------>
                <form id="get-user-wallet-transaction-details-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group col-6">
                            <label for="user_id">User ID</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Enter the user ID">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group user-group col-6">
                            <label for="transaction_id">Transaction ID</label>
                            <input type="text" class="form-control" id="transcation_id" name="transaction_id" placeholder="Enter the transaction ID">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success" name="submit" value="get_user_wallet_transaction_details">Submit</button>
                        </div>
                    </div>
                </form>
        <!------------------------updateUser------------------------------------------------------------------------------------------------------------------------------>
                <form id="update-user-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group col-6">
                            <label for="user_id">User ID</label>
                            <input type="text" class="form-control" id="user_id" name="u_id" placeholder="Enter the user's ID">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group user-group col-6">
                            <label for="fname">First Name</label>
                            <input type="text" class="form-control" id="fname" name="first_name" placeholder="Enter your first name">
                        </div>
                        <div class="form-group user-group col-6">
                            <label for="lname">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="last_name" placeholder="Enter your last name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group user-group find-user col-6">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="user_email" placeholder="Enter email">
                        </div>
                        <div class="form-group user-group col-6">
                            <label for="m_num">Mobile Number</label>
                            <input type="text" class="form-control" id="m_num" name="mobile_number" placeholder="Enter your mobile number">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group form-check user-group col-3">
                            <input type="checkbox" class="form-check-input" id="notify">
                            <label class="form-check-label" for="notify">Check to be notified by email</label>
                        </div>
                        <div class="form-group user-group col-4">
                            <label for="tax">Tax ID</label>
                            <input type="text" class="form-control" id="tax" name="tax_ID" placeholder="Enter tax id">
                        </div>
                        <div class="form-group user-group col-3">
                            <label for="dob">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="user_dob" placeholder="Now">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-10">
                            <label for="address1">Address</label>
                            <input type="text" class="form-control" id="address1" name="address1" placeholder="Enter street address">
                        </div>
                        <div class="form-group col-2">
                            <label for="address2">Apt/Suite</label>
                            <input type="text" class="form-control" id="address2" name="address2" placeholder="Enter suite number">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-10">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="Enter city">
                        </div>
                        <div class="form-group col-2">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="state" name="state" placeholder="Enter state">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-8">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" name="country" placeholder="Enter country">
                        </div>
                        <div class="form-group col-2">
                            <label for="postal">Postal Code</label>
                            <input type="text" class="form-control" id="postal" name="postal" placeholder="Enter postal code">
                        </div>
                        <div class="form-group col-2">
                            <label for="region">Region</label>
                            <input type="text" class="form-control" id="region" name="region" placeholder="Enter your region">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success" name="submit" value="update_user">Submit</button>
                        </div>
                    </div>
                </form>
        <!-----------------------linkBeneficiaryBank-------------------------------------------------------------------------------------------------------------------------->
                <form id="link-beneficiary-bank-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group col-6">
                            <label for="user_id">User ID</label>
                            <input type="text" class="form-control" id="user_id" name="u_id" placeholder="Enter the user's ID">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group user-group col-6">
                            <label for="fname">First Name</label>
                            <input type="text" class="form-control" id="fname" name="first_name" placeholder="Enter your first name">
                        </div>
                        <div class="form-group user-group col-6">
                            <label for="lname">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="last_name" placeholder="Enter your last name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group user-group col-6">
                            <label for="m_num">Mobile Number</label>
                            <input type="text" class="form-control" id="m_num" name="mobile_number" placeholder="Enter your mobile number">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-10">
                            <label for="address1">Address</label>
                            <input type="text" class="form-control" id="address1" name="address1" placeholder="Enter street address">
                        </div>
                        <div class="form-group col-2">
                            <label for="address2">Apt/Suite</label>
                            <input type="text" class="form-control" id="address2" name="address2" placeholder="Enter suite number">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-10">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="Enter city">
                        </div>
                        <div class="form-group col-2">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="state" name="state" placeholder="Enter state">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-8">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" name="country" placeholder="Enter country">
                        </div>
                        <div class="form-group col-2">
                            <label for="postal">Postal Code</label>
                            <input type="text" class="form-control" id="postal" name="postal" placeholder="Enter postal code">
                        </div>
                        <div class="form-group col-2">
                            <label for="region">Region</label>
                            <input type="text" class="form-control" id="region" name="region" placeholder="Enter your region">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group user-group find-bank col-6">
                            <label for="bank_name">Bank name</label>
                            <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Name already provided" disabled>
                        </div>
                        <div class="form-group user-group find-bank col-6">
                            <label for="country_code">Select the bank's country</label>
                            <select class="custom-select country_code_type" name="wallet_currency"></select>
                        </div>
                        <div class="form-group user-group find-bank col-6">
                            <label for="bank_name">Bank account number</label>
                            <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Enter the bank name to search">
                        </div>
                        <div class="form-group user-group find-bank col-6">
                            <label for="bank_name">Bank routing number</label>
                            <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Routing number already provided" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="swift_id">SWIFTBIC</label>
                            <input type="text" class="form-control" id="swift_id" name="swift_id" placeholder="Enter the bank's SWIFT#">
                        </div>
                        <div class="form-group user-group find-user col-4">
                            <label for="withdraw_type">Select type of withdrawal</label>
                            <select class="custom-select" name="withdraw_type" id="withdraw_type">
                                <option value="checking">Checking</option>
                                <option value="savings">Savings</option>
                            </select>
                        </div>
                        <div class="form-group user-group find-user col-4">
                            <label for="currency_type">Select currency type</label>
                            <select class="custom-select currency_type" name="wallet_currency"></select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success" name="submit" value="link_beneficiary_bank">Submit</button>
                        </div>
                    </div>
                </form>
        <!---------------------getLinkedBankAccounts------------------------------------------------------------------------------------------------------------>
                <form id="get-linked-bank-accounts-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group">
                            <label for="user_id">Recipient User ID</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Enter the recipient user ID">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success" name="submit" value="get_linked_bank_accounts">Submit</button>
                        </div>
                    </div>
                </form>
        <!---------------------deleteBankBeneficiary------------------------------------------------------------------------------------------------------------>
                <form id="delete-bank-beneficiary-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group col-6">
                            <label for="user_id">User ID</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Enter the user ID">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group user-group col-6">
                            <label for="bank_id">Bank ID</label>
                            <input type="text" class="form-control" id="bank_id" name="bank_id" placeholder="Enter the bank ID">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success" name="submit" value="delete_bank_beneficiary">Submit</button>
                        </div>
                    </div>
                </form>
        <!---------------------createCompanyWallet------------------------------------------------------------------------------------------------------------>
                <form id="create-company-wallet-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group col-8">
                            <label for="wallet_name">Wallet name</label>
                            <input type="text" class="form-control" id="wallet_name" name="wallet_name" placeholder="Enter a name for this wallet, Ex:(Sweden Trip)">
                        </div>
                        <div class="form-group user-group find-user col-2">
                            <label for="wallet_type">Select wallet type</label>
                            <select class="custom-select" name="wallet_type" id="wallet_type">
                                <option value="standard">Standard</option>
                                <option value="non-standard">Non-standard</option>
                            </select>
                        </div>
                        <div class="form-group user-group find-user col-2">
                            <label for="currency_type">Select currency type</label>
                            <select class="custom-select currency_type" name="wallet_currency"></select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success" name="submit" value="create_company_wallet">Submit</button>
                        </div>
                    </div>
                </form>
        <!---------------------getCompanyWallets------------------------------------------------------------------------------------------------------------>
                <form id="get-company-wallets-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <p>Just click the button for now.</p>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" name="submit" value="get_company_wallets">Submit</button>
                        </div>
                    </div>
                </form>
        <!---------------------fundWalletUsingACHDebit------------------------------------------------------------------------------------------------------------>
                <form id="fund-wallet-using-ACH-debit-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group col-6">
                            <label for="wallet_id">Wallet ID</label>
                            <input type="text" class="form-control" id="wallet_id" name="wallet_id" placeholder="Enter the wallet ID">
                        </div>
                        <div class="form-group user-group find-user col-2">
                            <label for="currency_type">Select currency type</label>
                            <select class="custom-select currency_type" name="wallet_currency"></select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group user-group col-6">
                            <label for="bank_id">Bank ID</label>
                            <input type="text" class="form-control" id="bank_id" name="bank_id" placeholder="Enter the bank ID">
                        </div>
                        <div class="form-group user-group col-2">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter amount to transfer, Ex: 235.67">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success" name="submit" value="fund_wallet_using_ACH_debit">Submit</button>
                        </div>
                    </div>
                </form>
        <!---------------------updateCompanyWallet------------------------------------------------------------------------------------------------------------>
                <form id="update-company-wallet-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group col-6">
                            <label for="wallet_id">Wallet ID</label>
                            <input type="text" class="form-control" id="wallet_id" name="wallet_id" placeholder="Enter the wallet ID">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group user-group col-6">
                            <label for="update_wallet_name">Update wallet name</label>
                            <input type="text" class="form-control" id="update_wallet_name" name="wallet_name" placeholder="Enter the new wallet name, Ex:(Finland Trip)">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success" name="submit" value="update_company_wallet">Submit</button>
                        </div>
                    </div>
                </form>
        <!---------------------getCompanyWalletTransactions------------------------------------------------------------------------------------------------------------>
                <form id="get-company-wallet-transactions-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group col-6">
                            <label for="wallet_id">Wallet ID</label>
                            <input type="text" class="form-control" id="wallet_id" name="wallet_id" placeholder="Enter the wallet ID">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success" name="submit" value="get_company_wallet_transactions">Submit</button>
                        </div>
                    </div>
                </form>
        <!---------------------getCompanyWalletTransactionDetails------------------------------------------------------------------------------------------------------------>
                <form id="get-company-wallet-transaction-details-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group col-6">
                            <label for="transaction_id">Transaction ID</label>
                            <input type="text" class="form-control" id="transcation_id" name="transaction_id" placeholder="Enter the transaction ID">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success" name="submit" value="get_company_wallet_transaction_details">Submit</button>
                        </div>
                    </div>
                </form>
        <!---------------------transferFund--------------------------------------------------------------------------------------------------------------------->
                <form id="transfer-fund-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group col-6">
                            <label for="wallet_id">Wallet ID</label>
                            <input type="text" class="form-control" id="wallet_id" name="wallet_id" placeholder="Enter the wallet ID">
                        </div>
                        <div class="form-group user-group find-user col-2">
                            <label for="currency_type">Select currency type</label>
                            <select class="custom-select currency_type" name="wallet_currency"></select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group user-group col-6">
                            <label for="user_id">Recipient User ID</label>
                            <input type="text" class="form-control" id="user_id" name="u_id" placeholder="Enter the recipient user's ID">
                        </div>
                        <div class="form-group user-group col-3">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount to transfer, Ex: 235.67">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group user-group col-12">
                            <label for="pay_description">Description</label>
                            <input type="text" class="form-control" id="pay_description" name="payment_description" placeholder="Enter a reason for this transfer">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group form-check user-group">
                            <input type="checkbox" class="form-check-input" id="notify">
                            <label class="form-check-label" for="notify">Check to be notified by email</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success" name="submit" value="transfer_fund">Submit</button>
                        </div>
                    </div>
                </form>
        <!---------------------transferFundDynamicAccountCreateUser------------------------------------------------------------------------------------------------------------>
                <form id="transfer-dynamic-create-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group col-3">
                            <label for="fname">Recipient First Name</label>
                            <input type="text" class="form-control" id="fname" name="first_name" placeholder="Enter recipient first name">
                        </div>
                        <div class="form-group user-group col-3">
                            <label for="lname">Recipient Last Name</label>
                            <input type="text" class="form-control" id="lname" name="last_name" placeholder="Enter recipient last name">
                        </div>
                        <div class="form-group user-group find-user col-6">
                            <label for="email">Recipient Email Address</label>
                            <input type="email" class="form-control" id="email" name="user_email" placeholder="Enter recipient email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group user-group col-2">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter amount to transfer, Ex: 235.67">
                        </div>
                        <div class="form-group user-group find-user col-2">
                            <label for="currency_type">Select currency type</label>
                            <select class="custom-select currency_type" name="wallet_currency"></select>
                        </div>
                        <div class="form-group user-group col-8">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter reason for the transfer">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success" name="submit" value="transfer_dynamic_create">Submit</button>
                        </div>
                    </div>
                </form>
        <!---------------------checkBeneficiaryExist------------------------------------------------------------------------------------------------------------>
                <form id="check-beneficiary-exist-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group">
                            <label for="company_name">Company Name</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter the company name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success" name="submit" value="check_beneficiary_exist">Submit</button>
                        </div>
                    </div>
                </form>
        <!---------------------checkUserExist------------------------------------------------------------------------------------------------------------>
                <form id="check-user-exist-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group">
                            <label for="user_email">Email</label>
                            <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Enter the user's email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success" name="submit" value="check_user_exist">Submit</button>
                        </div>
                    </div>
                </form>
        <!---------------------getPaymentMethods--------------------------------------------------------------------------------------------------------->
                <form id="get-payment-methods-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <p>Just click the button for now.</p>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" name="submit" value="get_payment_methods">Submit</button>
                        </div>
                    </div>
                </form>
        <!---------------------getUserPaymentMethods--------------------------------------------------------------------------------------------------------->
                <form id="get-user-payment-methods-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <p>Just click the button for now.</p>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" name="submit" value="get_user_payment_methods">Submit</button>
                        </div>
                    </div>
                </form>
        <!---------------------getBeneficiaries--------------------------------------------------------------------------------------------------------->
                <form id="get-beneficiaries-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <p>Just click the button for now.</p>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" name="submit" value="get_beneficiaries">Submit</button>
                        </div>
                    </div>
                </form>
        <!---------------------getDigitalGiftCards--------------------------------------------------------------------------------------------------------->
                <form id="get-digital-gift-cards-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group find-user col-2">
                            <label for="currency_type">Select currency type</label>
                            <select class="custom-select currency_type" name="wallet_currency"></select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" name="submit" value="get_digital_gift_cards">Submit</button>
                        </div>
                    </div>
                </form>
        <!-----------------------searchBank-------------------------------------------------------------------------------------------------------------------------->
                <form id="search-bank-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group find-bank col-8">
                            <label for="bank_name">Bank name</label>
                            <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Name already provided" disabled>
                        </div>
                        <div class="form-group user-group find-bank col-2">
                            <label for="country_code">Select the bank's country</label>
                            <select class="custom-select country_code_type" name="country_code"></select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success" name="submit" value="search_bank">Submit</button>
                        </div>
                    </div>
                </form>
        <!----------------------getBeneficiaryWallets------------------------------------------------------------------------------------------------------------->
                <form id="get-beneficiary-wallets-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group find-user col-6">
                            <label for="b_id">Beneficiary ID</label>
                            <input type="text" class="form-control" id="b_id" name="user_id" placeholder="Enter the beneficiary user ID">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success" name="submit" value="get_beneficiary_wallets">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="scripts/myscript.js"></script>
</html>    