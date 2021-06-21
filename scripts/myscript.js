$(document).ready(()=>{
    var currencies = ['AED', 'AUD', 'BGN', 'BHD', 'BWP', 'CAD', 'CHF', 'CNH', 'CZK', 'DKK', 
                    'EUR', 'FJD', 'GBP', 'HKD', 'HRK', 'HUF', 'IDR', 'ILS', 'JOD', 'JPY', 
                    'KES', 'KWD', 'MAD', 'MGA', 'MUR', 'MXN', 'NOK', 'NZD', 'OMR', 'PLN', 
                    'QAR', 'RON', 'SEK', 'SGD', 'THB', 'TND', 'TRY', 'USD', 'ZAR'];

    function addCurrency($x){
        $('#currency_type').append("<option>"+$x+"</option>");
    }

    var i = 0;

    for(;i<currencies.length;i++){
        addCurrency(currencies[i]);
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
