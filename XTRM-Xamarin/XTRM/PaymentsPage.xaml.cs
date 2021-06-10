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
        public PaymentsPage()
        {
            InitializeComponent();
            CheckAndCreateUser();
            DisplayWalletBalance();
        }

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


        //Check User Exists
        public static async Task<object> CheckUserExists()
        {
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

        //Get Linked Bank Accounts
        public static async Task<object> GetLinkedBankAccount()
        {
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

        async void BankACH_Button_Pressed(System.Object sender, System.EventArgs e)
        {
            if (!Application.Current.Properties.ContainsKey("access_token"))
            {
                return;
            }
            dynamic bankAccountData = await GetLinkedBankAccount();

            var Beneficiary = bankAccountData.GetLinkedBankAccountsResponse.GetLinkedBankAccountsResult.Beneficiary;

            if (Beneficiary == null || Beneficiary.BeneficiaryDetails == null)
            {
                BankForm.IsVisible = true;
            }
            else
            {
                var bankDetails = bankAccountData.GetLinkedBankAccountsResponse.GetLinkedBankAccountResult.Beneficiary.BeneficiaryDetails;
            }

        }
    }

}




