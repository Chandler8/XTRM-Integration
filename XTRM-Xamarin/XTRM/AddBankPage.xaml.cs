using System;
using System.Collections.Generic;
using System.Net.Http;
using System.Net.Http.Headers;
using System.Text;
using System.Threading.Tasks;
using Newtonsoft.Json;
using Xamarin.Forms;

using Xamarin.Forms;

namespace XTRM
{
    public partial class AddBankPage : ContentPage
    {
        public AddBankPage()
        {
            InitializeComponent();
            loadingSpinner.IsVisible = false;
        }

        async void SubmitBank_Button_Pressed(System.Object sender, System.EventArgs e)
        {
            if (!Application.Current.Properties.ContainsKey("access_token"))
            {
                return;
            }

            if (firstName.Text == null || lastName.Text == null || phoneNumber.Text == null || addressLineOne.Text == null || city.Text == null || phoneNumber.Text == null || state.SelectedItem == null || zipCode.Text == null || country.Text == null || bankAccountNumber.Text == null || bankRoutingNumber.Text == null || bankName.Text == null)
            {
                await DisplayAlert("Oops!", "Please fill out all required fields.", "OK");
                return;
            }

            if (bankAccountNumber.Text != bankAccountNumberConfirm.Text)
            {
                await DisplayAlert("Oops!", "Bank account numbers do not match.", "OK");
                bankAccountNumber.Text = "";
                bankAccountNumberConfirm.Text = "";
                return;
            }

            loadingSpinner.IsVisible = true;


            var firstNameValue = firstName.Text;
            var lastNameValue = lastName.Text;
            var phoneNumberValue = phoneNumber.Text;
            var addressLineOneValue = addressLineOne.Text;
            //Address Line 2 must be an empty string, not null.
            var addressLineTwoValue = addressLineTwo.Text == null ? "" : addressLineTwo.Text;
            var cityValue = city.Text;
            var stateValue = state.Items[state.SelectedIndex];
            var zipCodeValue = zipCode.Text;
            var countryValue = country.Text;
            var bankAccountNumberValue = bankAccountNumber.Text;
            var bankAccountNumberConfirmValue = bankAccountNumberConfirm.Text;
            var bankRoutingNumberValue = bankRoutingNumber.Text;
            var bankNameValue = bankName.Text;
            var currencyValue = "USD";
            var countryCodeIso2Value = "US";
            var issuerAccountNumberValue = "SPN19135579";
            var userIdValue = "PAT21138510";

            dynamic response = await LinkBankBeneficiary(firstNameValue + ' ' + lastNameValue, phoneNumberValue, addressLineOneValue, addressLineTwoValue, cityValue, stateValue, zipCodeValue, countryCodeIso2Value, bankNameValue, currencyValue, bankAccountNumberValue, bankRoutingNumberValue, issuerAccountNumberValue, userIdValue);

            var bankSubmitSuccessful = (bool)response.LinkBankBeneficiaryResponse.LinkBankBeneficiaryResult.OperationStatus.Success;

            if (bankSubmitSuccessful)
            {
                await Navigation.PushAsync(new PaymentsPage(bankSubmitSuccessful));
                loadingSpinner.IsVisible = false;
                await DisplayAlert("Bank information added!", "Your bank account will be processed within 3-5 business days. Afterwards, you'll be able to transfer funds to your account.", "OK");
            }
            else
            {
                await DisplayAlert("Error", "Unable to process your bank information. Please try again.", "OK");
                loadingSpinner.IsVisible = false;
                return;
            }


        }

        //Link Bank Beneficiary
        public static async Task<object> LinkBankBeneficiary
            (string contactName, string phoneNumber, string addressLine1, string addressLine2, string city, string region, string postalCode, string countryISO2, string institutionName, string currency, string bankAccountNumber, string bankRoutingNumber, string issuerAccountNumber, string userID
            )
        {
            var token = Application.Current.Properties["access_token"].ToString();

            var client = new HttpClient();
            client.DefaultRequestHeaders.Authorization = new AuthenticationHeaderValue("Bearer", token);

            var beneficiaryInformationObj = new
            {
                ContactName = contactName,
                PhoneNumber = phoneNumber,
                AddressLine1 = addressLine1,
                City = city,
                Region = region,
                PostalCode = postalCode,
                CountryISO2 = countryISO2,
                AddressLine2 = addressLine2,
            };

            var beneficiaryDetailsObj = new
            {
                BeneficiaryInformation = beneficiaryInformationObj
            };

            var beneficiaryBankInformationObj = new
            {
                InstitutionName = institutionName,
                Currency = currency,
                SWIFTBIC = "Test",
                AccountNumber = bankAccountNumber,
                RoutingNumber = bankRoutingNumber,
                CountryISO2 = countryISO2,
                RemittanceLine3 = "",
                RemittanceLine4 = ""
            };

            var bankDetailsObj = new { BeneficiaryBankInformation = beneficiaryBankInformationObj };

            var beneficiaryObj = new { BeneficiaryDetails = beneficiaryDetailsObj, BankDetails = bankDetailsObj };

            var requestObj = new
            {
                IssuerAccountNumber = issuerAccountNumber,
                UserID = userID,
                Beneficiary = beneficiaryObj
            };

            var linkBankBeneficiaryObj = new { request = requestObj };

            var outerObj = new { LinkBankBeneficiary = linkBankBeneficiaryObj };

            var json = JsonConvert.SerializeObject(outerObj);

            var content = new StringContent(json, Encoding.UTF8, "application/json");
            HttpResponseMessage response = await client.PostAsync("https://xapisandbox.xtrm.com/API/V4/Bank/LinkBankBeneficiary", content);


            if (response.IsSuccessStatusCode)
            {
                var data = await response.Content.ReadAsStringAsync();
                object linkBankBeneficiaryData = JsonConvert.DeserializeObject<object>(data);
                return linkBankBeneficiaryData;
            }
            else
            {
                var data = await response.Content.ReadAsStringAsync();
                object errorResponse = JsonConvert.DeserializeObject<object>(data);
                return errorResponse;
            }
        }
    }
}
