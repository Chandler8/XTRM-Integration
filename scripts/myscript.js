$(document).ready(()=>{
    var currency_codes = ['AED', 'AUD', 'BGN', 'BHD', 'BWP', 'CAD', 'CHF', 'CNH', 'CZK', 'DKK', 
            'EUR', 'FJD', 'GBP', 'HKD', 'HRK', 'HUF', 'IDR', 'ILS', 'JOD', 'JPY', 'KES', 'KWD', 
            'MAD', 'MGA', 'MUR', 'MXN', 'NOK', 'NZD', 'OMR', 'PLN', 'QAR', 'RON', 'SEK', 'SGD', 
            'THB', 'TND', 'TRY', 'USD', 'ZAR'];

    var country_names = ['Afghanistan','Åland Islands','Albania','Algeria','American Samoa',
            'Andorra','Angola','Anguilla','Antarctica','Antigua and Barbuda','Argentina',
            'Armenia','Aruba','Australia','Austria','Azerbaijan','Bahrain','Bahamas','Bangladesh',
            'Barbados','Belarus','Belgium','Belize','Benin','Bermuda','Bhutan',
            'Bolivia, Plurinational State of','Bonaire, Sint Eustatius and Saba',
            'Bosnia and Herzegovina','Botswana','Bouvet Island','Brazil','British Indian Ocean Territory',
            'Brunei Darussalam','Bulgaria','Burkina Faso','Burundi','Cambodia','Cameroon','Canada',
            'Cape Verde','Cayman Islands','Central African Republic','Chad','Chile','China',
            'Christmas Island','Cocos (Keeling) Islands','Colombia','Comoros','Congo',
            'Congo, the Democratic Republic of the','Cook Islands','Costa Rica',"Côte d'Ivoire",
            'Croatia','Cuba','Curaçao','Cyprus','Czech Republic','Denmark','Djibouti','Dominica',
            'Dominican Republic','Ecuador','Egypt','El Salvador','Equatorial Guinea','Eritrea',
            'Estonia','Ethiopia','Falkland Islands (Malvinas)','Faroe Islands','Fiji','Finland','France',
            'French Guiana','French Polynesia','French Southern Territories','Gabon','Gambia','Georgia',
            'Germany','Ghana','Gibraltar','Greece','Greenland','Grenada','Guadeloupe','Guam','Guatemala',
            'Guernsey','Guinea','Guinea-Bissau','Guyana','Haiti','Heard Island and McDonald Islands',
            'Holy See (Vatican City State)','Honduras','Hong Kong','Hungary','Iceland','India','Indonesia',
            'Iran, Islamic Republic of','Iraq','Ireland','Isle of Man','Israel','Italy','Jamaica','Japan',
            'Jersey','Jordan','Kazakhstan','Kenya','Kiribati',"Korea, Democratic People's Republic of",
            'Korea, Republic of','Kuwait','Kyrgyzstan',"Lao People's Democratic Republic",'Latvia',
            'Lebanon','Lesotho','Liberia','Libya','Liechtenstein','Lithuania','Luxembourg','Macao',
            'Macedonia, the Former Yugoslav Republic of','Madagascar','Malawi','Malaysia','Maldives',
            'Mali','Malta','Marshall Islands','Martinique','Mauritania','Mauritius','Mayotte','Mexico',
            'Micronesia, Federated States of','Moldova, Republic of','Monaco','Mongolia','Montenegro',
            'Montserrat','Morocco','Mozambique','Myanmar','Namibia','Nauru','Nepal','Netherlands',
            'New Caledonia','New Zealand','Nicaragua','Niger','Nigeria','Niue','Norfolk Island',
            'Northern Mariana Islands','Norway','Oman','Pakistan','Palau','Palestine, State of','Panama',
            'Papua New Guinea','Paraguay','Peru','Philippines','Pitcairn','Poland','Portugal','Puerto Rico',
            'Qatar','Réunion','Romania','Russian Federation','Rwanda','Saint Barthélemy',
            'Saint Helena, Ascension and Tristan da Cunha','Saint Kitts and Nevis','Saint Lucia',
            'Saint Martin (French part)','Saint Pierre and Miquelon','Saint Vincent and the Grenadines',
            'Samoa','San Marino','Sao Tome and Principe','Saudi Arabia','Senegal','Serbia','Seychelles',
            'Sierra Leone','Singapore','Sint Maarten (Dutch part)','Slovakia','Slovenia','Solomon Islands',
            'Somalia','South Africa','South Georgia and the South Sandwich Islands','South Sudan','Spain',
            'Sri Lanka','Sudan','Suriname','Svalbard and Jan Mayen','Swaziland','Sweden','Switzerland',
            'Syrian Arab Republic','Taiwan, Province of China','Tajikistan','Tanzania, United Republic of',
            'Thailand','Timor-Leste','Togo','Tokelau','Tonga','Trinidad and Tobago','Tunisia','Turkey',
            'Turkmenistan','Turks and Caicos Islands','Tuvalu','Uganda','Ukraine','United Arab Emirates',
            'United Kingdom','United States','United States Minor Outlying Islands','Uruguay','Uzbekistan',
            'Vanuatu','Venezuela, Bolivarian Republic of','Viet Nam','Virgin Islands, British',
            'Virgin Islands, U.S.','Wallis and Futuna','Western Sahara','Yemen','Zambia','Zimbabwe'];

    var country_codes = ['AF','AX','AL','DZ','AS','AD','AO','AI','AQ','AG',
            'AR','AM','AW','AU','AT','AZ','BH','BS','BD','BB','BY','BE','BZ',
            'BJ','BM','BT','BO','BQ','BA','BW','BV','BR','IO','BN','BG','BF',
            'BI','KH','CM','CA','CV','KY','CF','TD','CL','CN','CX','CC','CO',
            'KM','CG','CD','CK','CR','CI','HR','CU','CW','CY','CZ','DK','DJ',
            'DM','DO','EC','EG','SV','GQ','ER','EE','ET','FK','FO','FJ','FI',
            'FR','GF','PF','TF','GA','GM','GE','DE','GH','GI','GR','GL','GD',
            'GP','GU','GT','GG','GN','GW','GY','HT','HM','VA','HN','HK','HU',
            'IS','IN','ID','IR','IQ','IE','IM','IL','IT','JM','JP','JE','JO',
            'KZ','KE','KI','KP','KR','KW','KG','LA','LV','LB','LS','LR','LY',
            'LI','LT','LU','MO','MK','MG','MW','MY','MV','ML','MT','MH','MQ',
            'MR','MU','YT','MX','FM','MD','MC','MN','ME','MS','MA','MZ','MM',
            'NA','NR','NP','NL','NC','NZ','NI','NE','NG','NU','NF','MP','NO',
            'OM','PK','PW','PS','PA','PG','PY','PE','PH','PN','PL','PT','PR',
            'QA','RE','RO','RU','RW','BL','SH','KN','LC','MF','PM','VC','WS',
            'SM','ST','SA','SN','RS','SC','SL','SG','SX','SK','SI','SB','SO',
            'ZA','GS','SS','ES','LK','SD','SR','SJ','SZ','SE','CH','SY','TW',
            'TJ','TZ','TH','TL','TG','TK','TO','TT','TN','TR','TM','TC','TV',
            'UG','UA','AE','GB','US','UM','UY','UZ','VU','VE','VN','VG','VI',
            'WF','EH','YE','ZM','ZW'];
    
    function addCurrency(x){
        $('.currency_type').append("<option value="+x+">"+x+"</option>");
    }

    function addCountry(x,y){
        $('.country_code_type').append("<option value="+y+">"+x+"</option>");
    }

    console.log("Currency count: " + currency_codes.length);
    console.log("Country names count: " + country_names.length);
    console.log("Country codes count: " + country_codes.length);


    for(var i=0;i<currency_codes.length;i++){
        addCurrency(currency_codes[i]);
    }

    for(var i=0;i<country_codes.length;i++){
        addCountry(country_names[i],country_codes[i]);
    }

});

function showCompanyOptions(){
    defaultButtonColor();
    $('form').addClass("d-none");
    $(".beneficiary-options-btns").addClass("d-none");
    $(".company-options-btns").removeClass("d-none");
}

function showBeneficiaryOptions(){
    defaultButtonColor();
    $('form').addClass("d-none");
    $(".company-options-btns").addClass("d-none");
    $(".beneficiary-options-btns").removeClass("d-none");
}

$(".option-type").change(function(){
    var option_selected = $("input[name='view-options']:checked").val();

    console.log(option_selected);

    if(option_selected == 'beneficiary-options'){
        showBeneficiaryOptions();
    }else{
        showCompanyOptions();
    }
});

function defaultButtonColor(){
    $(".btn").removeClass("active");
}

$("#create_user_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#create_user_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#create-user-form").removeClass("d-none");
});

$("#create_user_wallet_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#create_user_wallet_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#create-user-wallet-form").removeClass("d-none");
});

$("#get_user_wallets_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#get_user_wallets_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#get-user-wallets-form").removeClass("d-none");
});

$("#get_user_wallet_balance_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#get_user_wallet_balance_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#get-user-wallet-balance-form").removeClass("d-none");
});

$("#update_user_wallet_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#update_user_wallet_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#update-user-wallet-form").removeClass("d-none");
});

$("#get_user_wallet_transactions_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#get_user_wallet_transactions_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#get-user-wallet-transactions-form").removeClass("d-none");
});

$("#get_user_wallet_transactions_by_remitter_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#get_user_wallet_transactions_by_remitter_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#get-user-wallet-transactions-by-remitter-form").removeClass("d-none");
});

$("#get_user_wallet_transaction_details_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#get_user_wallet_transaction_details_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#get-user-wallet-transaction-details-form").removeClass("d-none");
});

$("#update_user_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#update_user_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#update-user-form").removeClass("d-none");
});

$("#link_beneficiary_bank_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#link_beneficiary_bank_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#link-beneficiary-bank-form").removeClass("d-none");
});

$("#get_linked_bank_accounts_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#get_linked_bank_accounts_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#get-linked-bank-accounts-form").removeClass("d-none");
});

$("#delete_beneficiary_linked_bank_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#delete_beneficiary_linked_bank_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#delete-bank-beneficiary-form").removeClass("d-none"); 
});

$("#create_company_wallet_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#create_company_wallet_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#create-company-wallet-form").removeClass("d-none");
});

$("#get_company_wallets_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#get_company_wallets_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#get-company-wallets-form").removeClass("d-none");
});

$("#fund_wallet_using_ACH_debit_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#fund_wallet_using_ACH_debit_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#fund-wallet-using-ACH-debit-form").removeClass("d-none");
});

$("#update_company_wallet_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#update_company_wallet_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#update-company-wallet-form").removeClass("d-none");
});

$("#get_company_wallet_transactions_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#get_company_wallet_transactions_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#get-company-wallet-transactions-form").removeClass("d-none");
});

$("#get_company_wallet_transaction_details_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#get_company_wallet_transaction_details_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#get-company-wallet-transaction-details-form").removeClass("d-none");
});

$("#transfer_fund_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#transfer_fund_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#transfer-fund-form").removeClass("d-none");
});

$("#transfer_fund_create_user_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#transfer_fund_create_user_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#transfer-dynamic-create-form").removeClass("d-none");
});

$("#check_beneficiary_exists_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#check_beneficiary_exists_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#check-beneficiary-exist-form").removeClass("d-none");
});

$("#check_user_exists_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#check_user_exists_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#check-user-exist-form").removeClass("d-none");
});

$("#get_payment_methods_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#get_payment_methods_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#get-payment-methods-form").removeClass("d-none");
});

$("#get_user_payment_methods_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#get_user_payment_methods_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#get-user-payment-methods-form").removeClass("d-none");
});

$("#get_beneficiaries_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#get_beneficiaries_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#get-beneficiaries-form").removeClass("d-none");
});

$("#get_digital_gift_cards_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#get_digital_gift_cards_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#get-digital-gift-cards-form").removeClass("d-none");
});

$("#search_bank_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#search_bank_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#search-bank-form").removeClass("d-none");
});

$("#get_beneficiary_wallets_option_btn").on('click',()=>{
    defaultButtonColor();
    $("#get_beneficiary_wallets_option_btn").addClass("active");
    $('form').addClass("d-none");
    $("#get-beneficiary-wallets-form").removeClass("d-none");
});
