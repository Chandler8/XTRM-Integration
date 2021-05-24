<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Chandler's page for working on XTRM API</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles/chanstyle.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Crimson+Pro">
</head>

<body>
    <div class="container">
        <h1>XTRM Testing of UI and white labeling!</h1>
        <p>Click here on this<a href="https://www.xtrm.com/web/Register/SponSimpleSignup.aspx" target="_blank"> link</a> to begin your XTRM setup.</p>
    </div>

    <div class="d-flex align-items-center">
        <div class="d-flex mr-4" title="Your low balance limit is $2500.00. If your balance is red, add funds." style="cursor:help;">
            <span class="input-group-addon ">Wallet Balance:</span>&nbsp;
            <span class="input-group-addon ">$</span>
            <span id="balance" style="color:#489c3b;font-weight:bold;letter-spacing:0.1em;">10000.00</span>
        </div>
        <div class="mr-2">
            <span class="input-group-addon ">Transfer from bank:</span>&nbsp;
            <span class="input-group-addon ">$</span>
            <input type="text" id="amount" placeholder="0.00" class="text-right p-1" size="8">
        </div>
        <div class="select_wrap mr-2">
            <select class="form-control form_additional_options" name="wallet_options" id="wallet_options" data-parent="" data-parentid="" data-module="TalentBill" data-mode="searchpage">
                <option value="add" selected="">Add funds to this wallet</option>
                <option value="transfer">Transfer funds to bank</option>
            </select>
        </div>
        <div id="button">
            <input type="submit" value="Submit" size="7">
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>