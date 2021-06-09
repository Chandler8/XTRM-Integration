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
    $(".beneficiary-options-btns").addClass("d-none");
    $(".company-options-btns").removeClass("d-none");
}

function showBeneficiaryOptions(){
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
