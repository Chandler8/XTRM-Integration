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
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="view-options" id="company-options" value="company-options">
                <label class="form-check-label" for="company-options">View Company Options</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="view-options" id="inlineRadio2" value="beneficiary-options">
                <label class="form-check-label" for="beneficiary-options">View Beneficiary Options</label>
            </div>
            <hr>
            <div class="container">
                <form action="scripts/XTRM.php" method="POST">
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
                    </div>
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
                            <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Enter the bank name to search">
                        </div>
                        <div class="form-group user-group find-bank col-6">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" name="country" placeholder="Enter the country of the bank to search">
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