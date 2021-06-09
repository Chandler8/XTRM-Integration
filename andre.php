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
            <div class="option-types">
                <div class="company-options-btns d-none">
                    <div class="row">
                        <div class="col">
                            <div class="btn btn-success btn-sm">Create Company Wallet</div>
                            <div class="btn btn-success btn-sm">Get Compny Wallets</div>
                            <div class="btn btn-success btn-sm">Fund Wallet Using ACH Debit</div>
                            <div class="btn btn-success btn-sm">Update Company Wallet</div>
                            <div class="btn btn-success btn-sm">Get Company Wallet Transactions</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="btn btn-success btn-sm">Get Payment Methods</div>
                            <div class="btn btn-success btn-sm">Check Beneficiary Exists</div>
                            <div class="btn btn-success btn-sm">Get Beneficiaruy Wallets</div>
                            <div class="btn btn-success btn-sm">Transfer Fund</div>
                            <div class="btn btn-success btn-sm">Transfer Fund / Create User</div>
                            <div class="btn btn-success btn-sm">Get Company Wallet Transaction Details</div>
                        </div>
                    </div>
                </div>
                <div class="beneficiary-options-btns d-none">
                    <div class="row">
                        <div class="col">
                            <div class="btn btn-success btn-sm">Create User</div>
                            <div class="btn btn-success btn-sm">Check User Exists</div>
                            <div class="btn btn-success btn-sm">Create User Wallet</div>
                            <div class="btn btn-success btn-sm">Get User Wallets</div>
                            <div class="btn btn-success btn-sm">Get User Payment Methods</div>
                            <div class="btn btn-success btn-sm">Get User Wallet Transactions</div>
                            <div class="btn btn-success btn-sm">Get User Wallet Transactions By Remitter</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="btn btn-success btn-sm">Get User Wallet Transaction Details</div>
                            <div class="btn btn-success btn-sm">Search Bank</div>
                            <div class="btn btn-success btn-sm">Link Benefiacry Bank</div>
                            <div class="btn btn-success btn-sm">Get Linked Bank Accounts</div>
                            <div class="btn btn-success btn-sm">Delete Linked Bank Account</div>
                            <div class="btn btn-success btn-sm">Update User</div>
                            <div class="btn btn-success btn-sm">Update User Wallet</div>
                            <div class="btn btn-success btn-sm">Get User Wallet Balance</div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="container">
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
                        <div class="form-group form-check user-group">
                            <input type="checkbox" class="form-check-input" id="notify">
                            <label class="form-check-label" for="notify">Check to be notified by email</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group user-group">
                            <label for="tax">Tax ID</label>
                            <input type="text" class="form-control" id="tax" name="tax_ID" placeholder="Enter tax id">
                        </div>
                        <div class="form-group user-group">
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
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
        <!--------------------------------------------------------------------------------------------------------------------------------->
                <form id="get-user-wallet-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group find-user col-6">
                            <label for="u_id">User ID</label>
                            <input type="text" class="form-control" id="u_id" name="user_id" placeholder="Enter your user ID">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group user-group find-user col-4">
                            <label for="wallet_id">Wallet ID</label>
                            <input type="text" class="form-control" id="wallet_id" name="wallet_id" placeholder="Enter your wallet ID">
                        </div>
                        <div class="form-group user-group find-user col-4">
                            <label for="currency_type">Select type of wallet</label>
                            <select class="custom-select" name="wallet_type" id="wallet_type">
                                <option value="standard">Standard</option>
                                <option value="accrual">Accrual</option>
                            </select>
                        </div>
                        <div class="form-group user-group find-user col-4">
                            <label for="currency_type">Select currency type</label>
                            <select class="custom-select" name="wallet_currency" id="currency_type">
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group user-group find-bank col-6">
                            <label for="bank_name">Bank name</label>
                            <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Name already provided" disabled>
                        </div>
                        <div class="form-group user-group find-bank col-6">
                            <label for="bank_name">Bank account number</label>
                            <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Enter the bank name to search">
                        </div>
                        <div class="form-group user-group find-bank col-6">
                            <label for="bank_name">Bank routing number</label>
                            <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Routing number already provided" disabled>
                        </div>
                        <div class="form-group user-group find-bank col-6">
                            <label for="country_code">Country</label>
                            <input type="text" class="form-control" id="country_code" name="country_code" placeholder="Enter the country of the bank to search">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
        <!--------------------------------------------------------------------------------------------------------------------------------->
                <form id="update-user-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group col-4">
                            <label for="fname">First Name</label>
                            <input type="text" class="form-control" id="fname" name="first_name" placeholder="Enter your first name">
                        </div>
                        <div class="form-group user-group col-4">
                            <label for="lname">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="last_name" placeholder="Enter your last name">
                        </div>
                        <div class="form-group user-group col-4">
                            <label for="user_id">User ID</label>
                            <input type="text" class="form-control" id="user_id" name="u_id" placeholder="Enter the user's ID">
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
                        <div class="form-group form-check user-group">
                            <input type="checkbox" class="form-check-input" id="notify">
                            <label class="form-check-label" for="notify">Check to be notified by email</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group user-group">
                            <label for="tax">Tax ID</label>
                            <input type="text" class="form-control" id="tax" name="tax_ID" placeholder="Enter tax id">
                        </div>
                        <div class="form-group user-group">
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
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
        <!--------------------------------------------------------------------------------------------------------------------------------->
                <form id="link-beneficiary-bank-form" class="d-none" action="scripts/XTRM.php" method="POST">
                    <div class="form-row">
                        <div class="form-group user-group col-4">
                            <label for="fname">First Name</label>
                            <input type="text" class="form-control" id="fname" name="first_name" placeholder="Enter your first name">
                        </div>
                        <div class="form-group user-group col-4">
                            <label for="lname">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="last_name" placeholder="Enter your last name">
                        </div>
                        <div class="form-group user-group col-4">
                            <label for="user_id">User ID</label>
                            <input type="text" class="form-control" id="user_id" name="u_id" placeholder="Enter the user's ID">
                        </div>
                    </div>
                    <div class="form-group user-group col-6">
                        <label for="m_num">Mobile Number</label>
                        <input type="text" class="form-control" id="m_num" name="mobile_number" placeholder="Enter your mobile number">
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
                            <label for="bank_name">Bank account number</label>
                            <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Enter the bank name to search">
                        </div>
                        <div class="form-group user-group find-bank col-6">
                            <label for="bank_name">Bank routing number</label>
                            <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Routing number already provided" disabled>
                        </div>
                        <div class="form-group user-group find-bank col-6">
                            <label for="country_code">Country</label>
                            <input type="text" class="form-control" id="country_code" name="country_code" placeholder="Enter the country of the bank to search">
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
                            <select class="custom-select" name="wallet_currency" id="currency_type">
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
        <!--------------------------------------------------------------------------------------------------------------------------------->
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
                            <select class="custom-select" name="wallet_currency" id="currency_type">
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                            </select>
                        </div>
                        <div class="form-group user-group col-8">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter reason for the transfer">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            <button type="submit" class="btn btn-success">Submit</button>
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