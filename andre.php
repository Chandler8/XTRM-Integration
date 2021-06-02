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
            <div class="container">
                <form action="scripts/XTRM.php" method="POST">
                    <div class="form-group user-group">
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control" id="fname" name="first_name" placeholder="Enter your first name">
                    </div>
                    <div class="form-group user-group">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" id="lname" name="last_name" placeholder="Enter your last name">
                    </div>
                    <div class="form-group user-group find-user">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="user_email" placeholder="Enter email">
                    </div>
                    <div class="form-group form-check user-group">
                        <input type="checkbox" class="form-check-input" id="notify">
                        <label class="form-check-label" for="notify">Check to be notified by email</label>
                    </div>
                    <div class="form-group user-group">
                        <label for="m_num">Mobile Number</label>
                        <input type="text" class="form-control" id="m_num" name="mobile_number" placeholder="Enter your mobile number">
                    </div>
                    <div class="form-group user-group">
                        <label for="tax">Tax ID</label>
                        <input type="text" class="form-control" id="tax" name="tax_ID" placeholder="Enter tax id">
                    </div>
                    <div class="form-group user-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="user_dob" placeholder="Now">
                    </div>
                    <div class="form-group user-group">
                        <label for="address1">Address</label>
                        <input type="text" class="form-control" id="address1" name="address1" placeholder="Enter street address">
                        <label for="address2">Apt/Suite</label>
                        <input type="text" class="form-control" id="address2" name="address2" placeholder="Enter apt or suite">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Enter city">
                        <label for="state">State</label>
                        <input type="text" class="form-control" id="state" name="state" placeholder="Enter state">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" id="country" name="country" placeholder="Enter country">
                        <label for="postal">Postal Code</label>
                        <input type="text" class="form-control" id="postal" name="postal" placeholder="Enter postal/zip code">
                    </div>

                    <div class="form-group user-group find-user">
                        <label for="u_id">User ID</label>
                        <input type="text" class="form-control" id="u_id" name="user_id" placeholder="Enter your User ID">
                    </div>

                    <!--<div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>-->
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>