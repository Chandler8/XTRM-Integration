using System;
using System.Collections.Generic;
using System.Net.Http;
using System.Net.Http.Headers;
using System.Text;
using System.Threading.Tasks;
using Newtonsoft.Json;
using Xamarin.Forms;

namespace XTRM
{
    public partial class PaymentsPage : ContentPage
    {
        public PaymentsPage(bool bankSubmitSuccessful)
        {
            InitializeComponent();
            CheckAndCreateUser();
            DisplayWalletBalance();
            SetPaymentOptionButtonColors(bankSubmitSuccessful);

            //For demo purposes: set bank account as set up.Change the bool in the set method.

        }

        //public static void SetAccountConfirmed()
        //{
        //     Application.Current.Properties.Add(true, "bank_account_confirmed");

        //}




        //If User Does Not Exist, Create User
        public static async void CheckAndCreateUser()
        {
            dynamic userExists = await CheckUserExists();

            if (userExists == null)
            {
                return;
            }
            if (userExists.CheckUserExistResponse.CheckUserExistResult.Beneficiary == null)
            {
                await CreateUser();
                await CreateUserWallet();

            }

            else
            {
                return;
            }
        }

        public static async void refreshAuthToken()
        {
            var client = new HttpClient();
            client.BaseAddress = new Uri("https://xapisandbox.xtrm.com/oAuth/token");
            var request = new HttpRequestMessage(HttpMethod.Post, "");
            string refresh_token = Application.Current.Properties["refresh_token"].ToString();

            var keyValues = new List<KeyValuePair<string, string>>();
            keyValues.Add(new KeyValuePair<string, string>("grant_type", "refresh_token"));
            keyValues.Add(new KeyValuePair<string, string>("client_id", "1930815_API_User"));
            keyValues.Add(new KeyValuePair<string, string>("client_secret", "TrXSmMCkrGTq2UVsOYMloiPmpwdvIkVrE56DJAkOBkg="));
            keyValues.Add(new KeyValuePair<string, string>("refresh_token", refresh_token));

            var content = new FormUrlEncodedContent(keyValues);

            content.Headers.Clear();
            content.Headers.Add("Content-Type", "application/x-www-form-urlencoded");

            request.Content = new FormUrlEncodedContent(keyValues);

            var response = await client.SendAsync(request);

            var data = await response.Content.ReadAsStringAsync();

            dynamic token = JsonConvert.DeserializeObject<object>(data);

            Application.Current.Properties["expires_in"] = token.expires_in;

        }


        //Check User Exists
        public static async Task<object> CheckUserExists()
        {
            refreshAuthToken();

            if (!Application.Current.Properties.ContainsKey("access_token"))
            {
                return null;
            }
            var token = Application.Current.Properties["access_token"].ToString();

            var client = new HttpClient();
            client.DefaultRequestHeaders.Authorization = new AuthenticationHeaderValue("Bearer", token);

            var innerObj = new { IssuerAccountNumber = "SPN19135579", Email = "zevans@senegalsoftware.com" };
            var innerObj2 = new { request = innerObj };
            var outerObj = new { CheckUserExist = innerObj2 };

            var json = JsonConvert.SerializeObject(outerObj);
            var content = new StringContent(json, Encoding.UTF8, "application/json");
            HttpResponseMessage response = await client.PostAsync("https://xapisandbox.xtrm.com/API/V4/Beneficiary/CheckUserExist", content);


            if (response.IsSuccessStatusCode)
            {
                var data = await response.Content.ReadAsStringAsync();
                object userWalletData = JsonConvert.DeserializeObject<object>(data);
                return userWalletData;
            }
            else
            {
                var data = await response.Content.ReadAsStringAsync();
                object errorResponse = JsonConvert.DeserializeObject<object>(data);
                return errorResponse;
            }
        }


        //Create User 
        public static async Task<object> CreateUser()
        {
            refreshAuthToken();
            var token = Application.Current.Properties["access_token"].ToString();

            var client = new HttpClient();
            client.DefaultRequestHeaders.Authorization = new AuthenticationHeaderValue("Bearer", token);

            var dobObj = new
            {
                Day = "04",
                Month = "04",
                Year = "2001"
            };
            var addressObj = new
            {
                AddressLine1 = "303 Twin Dolphin Drive",
                AddressLine2 = "",
                AptSuitNum = "",
                City = "Redwood City",
                Country = "United States",
                CountryISO2 = "US",
                PostalCode = "94065",
                Region = "CA"
            };
            var requestObj = new
            {
                IssuerAccountNumber = "SPN19135579",
                LegalFirstName = "Zac",
                LegalLastName = "Evans",
                EmailAddress = "zevans2@senegalsoftware.com",
                EmailNotification = "false",
                MobilePhone = "Mobile Number",
                TaxId = "555-55-5555",
                DateOfBirth = dobObj,
                Address = addressObj,
            };
            var createUserObj = new { request = requestObj };
            var outerObj = new { CreateUser = createUserObj };

            var json = JsonConvert.SerializeObject(outerObj);
            var content = new StringContent(json, Encoding.UTF8, "application/json");
            HttpResponseMessage response = await client.PostAsync("https://xapisandbox.xtrm.com/API/V4/Register/CreateUser", content);


            if (response.IsSuccessStatusCode)
            {
                var data = await response.Content.ReadAsStringAsync();
                object userData = JsonConvert.DeserializeObject<object>(data);
                return userData;
            }
            else
            {
                var data = await response.Content.ReadAsStringAsync();
                object errorResponse = JsonConvert.DeserializeObject<object>(data);
                return errorResponse;
            }

        }

        //Create User Wallet
        public static async Task<object> CreateUserWallet()
        {
            refreshAuthToken();
            var token = Application.Current.Properties["access_token"].ToString();

            var client = new HttpClient();
            client.DefaultRequestHeaders.Authorization = new AuthenticationHeaderValue("Bearer", token);

            var requestObj = new
            {
                IssuerAccountNumber = "SPN19135579",
                UserID = "PAT21138510",
                WalletName = "Wallet002",
                WalletCurrency = "CAD"
            };
            var createUserWalletObj = new { request = requestObj };
            var outerObj = new { CreateUserWallet = createUserWalletObj };

            var json = JsonConvert.SerializeObject(outerObj);
            var content = new StringContent(json, Encoding.UTF8, "application/json");
            HttpResponseMessage response = await client.PostAsync("https://xapisandbox.xtrm.com/API/V4/Wallet/CreateUserWallet", content);


            if (response.IsSuccessStatusCode)
            {
                var data = await response.Content.ReadAsStringAsync();
                object walletData = JsonConvert.DeserializeObject<object>(data);
                return walletData;
            }
            else
            {
                var data = await response.Content.ReadAsStringAsync();
                object errorResponse = JsonConvert.DeserializeObject<object>(data);
                return errorResponse;
            }


        }

        //Get User Wallet Balance
        public static async Task<object> GetUserWalletBalance()
        {
            refreshAuthToken();
            if (!Application.Current.Properties.ContainsKey("access_token"))
            {
                return new { };
            }

            var token = Application.Current.Properties["access_token"].ToString();

            var client = new HttpClient();
            client.DefaultRequestHeaders.Authorization = new AuthenticationHeaderValue("Bearer", token);

            var requestObj = new
            {
                IssuerAccountNumber = "SPN19135579",
                UserID = "PAT21138510",
                Currency = "USD"
            };
            var GetUserWalletObj = new { request = requestObj };
            var outerObj = new { GetUserWalletBalance = GetUserWalletObj };

            var json = JsonConvert.SerializeObject(outerObj);
            var content = new StringContent(json, Encoding.UTF8, "application/json");
            HttpResponseMessage response = await client.PostAsync("https://xapisandbox.xtrm.com/API/V4/Wallet/GetUserWalletBalance", content);


            if (response.IsSuccessStatusCode)
            {
                var data = await response.Content.ReadAsStringAsync();
                object walletBalanceData = JsonConvert.DeserializeObject<object>(data);
                return walletBalanceData;


            }
            else
            {
                var data = await response.Content.ReadAsStringAsync();
                object errorResponse = JsonConvert.DeserializeObject<object>(data);
                return errorResponse;
            }

        }

        async void DisplayWalletBalance()
        {
            if (!Application.Current.Properties.ContainsKey("access_token"))
            {
                walletBalance.Text = "Login to see wallet balance";
                return;
            }
            dynamic walletBalanceData = await GetUserWalletBalance();
            if (String.IsNullOrWhiteSpace(Convert.ToString(walletBalanceData)))
            {
                walletBalance.Text = "Login to see wallet balance";
                return;
            }
            else
            {
                walletBalance.Text = "Wallet Balance: $" + walletBalanceData.UserWalletBalnceResponse.UserWalletBalanceResult.Balance + " " + walletBalanceData.UserWalletBalnceResponse.UserWalletBalanceResult.Currency;
            }
        }

        //Set button color for payment options
        public async void SetPaymentOptionButtonColors(bool bankSubmitSuccessful)
        {
            refreshAuthToken();
            dynamic bankAccountData = await GetLinkedBankAccount();

            var Beneficiary = bankAccountData.GetLinkedBankAccountsResponse.GetLinkedBankAccountsResult.Beneficiary;

            dynamic accountConfirmed = Beneficiary ?? false;

            //For demo purposes, set globally
            accountConfirmed = false;


            if (bankSubmitSuccessful)
            {
                BankButton.BackgroundColor = Color.FromHex("#decf00");
                BankButton.TextColor = Color.FromHex("#000000");
                return;
            }

            if (accountConfirmed == false)
            {
                BankButton.BackgroundColor = Color.FromHex("#d40020");
                return;
            }
            if (accountConfirmed == true)
            {
                BankButton.BackgroundColor = Color.FromHex("#879114");
                return;
            }


        }

        //Get Linked Bank Accounts
        public static async Task<object> GetLinkedBankAccount()
        {
            refreshAuthToken();
            var token = Application.Current.Properties["access_token"].ToString();
            var client = new HttpClient();
            client.DefaultRequestHeaders.Authorization = new AuthenticationHeaderValue("Bearer", token);

            var requestObj = new
            {
                IssuerAccountNumber = "SPN19135579",
                RecipientUserID = "PAT21138510",
            };
            var getLinkedBankAccountsObj = new { request = requestObj };
            var outerObj = new { GetLinkedBankAccounts = getLinkedBankAccountsObj };

            var json = JsonConvert.SerializeObject(outerObj);

            var content = new StringContent(json, Encoding.UTF8, "application/json");
            HttpResponseMessage response = await client.PostAsync("https://xapisandbox.xtrm.com/API/V4/Bank/GetLinkedBankAccounts", content);


            if (response.IsSuccessStatusCode)
            {
                var data = await response.Content.ReadAsStringAsync();
                object bankAccountData = JsonConvert.DeserializeObject<object>(data);

                return bankAccountData;
            }
            else
            {
                var data = await response.Content.ReadAsStringAsync();
                object errorResponse = JsonConvert.DeserializeObject<object>(data);
                return errorResponse;
            }
        }

        async void Bank_Button_Pressed(System.Object sender, System.EventArgs e)
        {
            refreshAuthToken();
            if (!Application.Current.Properties.ContainsKey("access_token"))
            {
                return;
            }
            dynamic bankAccountData = await GetLinkedBankAccount();

            var beneficiary = bankAccountData.GetLinkedBankAccountsResponse.GetLinkedBankAccountsResult.Beneficiary;

            var accountConfirmed = beneficiary ?? beneficiary.BeneficiaryDetails ?? false;

            //For demo purposes
            accountConfirmed = true;


            if (accountConfirmed == false)
            {
                await Navigation.PushAsync(new AddBankPage());
            }
            else
            {
                if (beneficiary == null)
                {
                    //Set for demo purposes
                    bankName.Text = "Wells Fargo";
                    transferForm.IsVisible = true;
                }
                else
                {
                    var bankDetails = await beneficiary.BeneficiaryDetails.BeneficiaryBankInformation;
                    var bankName = bankDetails.BankName;
                    //Set for demo purposes
                    bankName = "Wells Fargo";
                    bankName.Text = bankName;
                    transferForm.IsVisible = true;
                }
            }
        }


        //async void SubmitBank_Button_Pressed(System.Object sender, System.EventArgs e)
        //{
        //    if (!Application.Current.Properties.ContainsKey("access_token"))
        //    {
        //        return;
        //    }

        //    var firstNameValue = firstName.Text;
        //    var lastNameValue = lastName.Text;
        //    var phoneNumberValue = phoneNumber.Text;
        //    var addressLineOneValue = addressLineOne.Text;
        //    //Address Line 2 must be a empty string, not null.
        //    var addressLineTwoValue = addressLineTwo.Text == null ? "" : addressLineTwo.Text;
        //    var cityValue = city.Text;
        //    var stateValue = state.Text;
        //    var zipCodeValue = zipCode.Text;
        //    var countryValue = country.Text;
        //    var bankAccountNumberValue = bankAccountNumber.Text;
        //    var bankAccountNumberConfirmValue = bankAccountNumberConfirm.Text;
        //    var bankRoutingNumberValue = bankRoutingNumber.Text;
        //    var bankNameValue = bankName.Text;
        //    var currencyValue = "VUV";
        //    var countryCodeIso2Value = "VU";
        //    var issuerAccountNumberValue = "SPN19135579";
        //    var userIdValue = "PAT21138510";

        //    Console.WriteLine("Button pressed");

        //    var response = await LinkBankBeneficiary(firstNameValue + ' ' + lastNameValue, phoneNumberValue, addressLineOneValue, addressLineTwoValue, cityValue, stateValue, zipCodeValue, countryCodeIso2Value, bankNameValue, currencyValue, bankAccountNumberValue, bankRoutingNumberValue, issuerAccountNumberValue, userIdValue);

        //    BankForm.IsVisible = false;



        //}

        //Link Bank Beneficiary
        public static async Task<object> LinkBankBeneficiary
            (string contactName, string phoneNumber, string addressLine1, string addressLine2, string city, string region, string postalCode, string countryISO2, string institutionName, string currency, string bankAccountNumber, string bankRoutingNumber, string issuerAccountNumber, string userID
            )
        {
            refreshAuthToken();
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

            Console.Write(json);

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

        //Transfer Funds
        public static async Task<object> TransferFunds()
        {
            var token = Application.Current.Properties["access_token"].ToString();

            var client = new HttpClient();
            client.DefaultRequestHeaders.Authorization = new AuthenticationHeaderValue("Bearer", token);

            var transactionDetailsObj = new
            {
                IssuerTransactionId = "aliquip com",
                PaymentAmount = "341.25",
                PartnerAccountNumber = "SPN1234567",
                RecipientUserID = "SPN1234567",
                Comment = "Long comment up to five hundred (500) characters",
                DealRegId = "H. Smith - Canada",
                SKU = "U935268",
                UserGiftCardEmailID = "genevieveshefa@xtrm.com",
                UserLinkedBankID = "982353390933219d9",
                UserPrepaidVisaEmailID = "genevieveshefa@xtrm.com"
            };

            var transactionDetailsArr = new
            {
                TransactionDetails = new[] {
                    transactionDetailsObj
                    }
            };

            var requestObj = new
            {
                IssuerAccountNumber = "SPN1234567",
                PaymentType = "Credits",
                PaymentMethodID = "Use API",
                ProgramID = "2314",
                WalletID = "289112",
                PaymentDescription = "commodo magna amet dolore",
                PaymentCurrency = "VUV",
                EmailNotification = true,
                TransactionDetails = transactionDetailsArr
            };

            var transferFundObj = new { request = requestObj };

            var outerObj = new { TransferFund = transferFundObj };

            var json = JsonConvert.SerializeObject(outerObj);
            var content = new StringContent(json, Encoding.UTF8, "application/json");
            HttpResponseMessage response = await client.PostAsync("https://xapisandbox.xtrm.com/API/V4/Fund/TransferFund", content);


            if (response.IsSuccessStatusCode)
            {
                var data = await response.Content.ReadAsStringAsync();
                object bankTransferData = JsonConvert.DeserializeObject<object>(data);
                return bankTransferData;
            }
            else
            {
                var data = await response.Content.ReadAsStringAsync();
                object errorResponse = JsonConvert.DeserializeObject<object>(data);
                return errorResponse;
            }
        }

        async void TransferFunds_Button_Pressed(System.Object sender, System.EventArgs e)
        {
            if (!Application.Current.Properties.ContainsKey("access_token"))
            {
                transferFunds.Text = "Please sign in first.";
                return;
            }

            dynamic transferFundsData = await TransferFunds();

            Console.WriteLine(transferFundsData.ToString());

            transferFunds.Text = "Funds transfered.";

        }
    }

}




