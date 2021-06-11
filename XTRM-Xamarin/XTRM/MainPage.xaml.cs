using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.ComponentModel;
using System.Diagnostics;
using System.Linq;
using System.Net.Http;
using System.Net.Http.Headers;
using System.Text;
using System.Threading.Tasks;
using Newtonsoft.Json;
using Xamarin.Forms;

namespace XTRM
{



    public partial class MainPage : ContentPage
    {
        public MainPage()
        {

            InitializeComponent();

        }


        async void To_Payments_Button_Pressed(System.Object sender, System.EventArgs e)
        {
            var setBankVerification = false;
            await Navigation.PushAsync(new PaymentsPage(setBankVerification));
        }

        async void Auth_Button_Pressed(System.Object sender, System.EventArgs e)
        {
            if (Application.Current.Properties.ContainsKey("access_token"))
            {
                authToken.Text = "You are already signed in";
            }
            else
            {
                dynamic token = await getAuthToken();
                Application.Current.Properties.Add("access_token", token.access_token);
                Application.Current.Properties.Add("refresh_token", token.refresh_token);
                Application.Current.Properties.Add("expires_in", token.expires_in);
                //string authorizationToken = Application.Current.Properties["access_token"].ToString();
                authToken.Text = "Sign in successful.";
            }
        }

        async void Refresh_Button_Pressed(System.Object sender, System.EventArgs e)
        {
            if (!Application.Current.Properties.ContainsKey("access_token"))
            {
                refreshToken.Text = "Please sign in first.";
                return;
            }

            dynamic token = await refreshAuthToken();
            Application.Current.Properties["expires_in"] = token.expires_in;
            //refreshToken.Text = Application.Current.Properties["refresh_token"].ToString();
            refreshToken.Text = "Token refresh successful.";

        }

        async void CheckUserExists_Button_Pressed(System.Object sender, System.EventArgs e)
        {
            if (!Application.Current.Properties.ContainsKey("access_token"))
            {
                checkUser.Text = "Please sign in first.";
                return;
            }


            dynamic userExists = await CheckUserExists();
            if (userExists.CheckUserExistResponse.CheckUserExistResult.Beneficiary == null)
            {
                checkUser.Text = "No user exists";
            }
            else
            {
                checkUser.Text = "User " + userExists.CheckUserExistResponse.CheckUserExistResult.Beneficiary[0].Name + " exists.";
            }
        }

        async void CreateUser_Button_Pressed(System.Object sender, System.EventArgs e)
        {
            if (!Application.Current.Properties.ContainsKey("access_token"))
            {
                createUser.Text = "Please sign in first.";
                return;
            }

            dynamic userData = await CreateUser();

            if (userData.CreateUserResponse.CreateUserResult.UserID == null)
            {
                createUser.Text = "User already exists";
            }
            else
            {
                createUser.Text = "User " + userData.CreateUserResponse.CreateUserResult.UserID + " created";
            }
        }

        async void CreateUserWallet_Button_Pressed(System.Object sender, System.EventArgs e)
        {
            if (!Application.Current.Properties.ContainsKey("access_token"))
            {
                createUserWallet.Text = "Please sign in first.";
                return;
            }

            dynamic walletData = await CreateUserWallet();

            if (walletData.CreateUserWalletResponse.CreateUserWalletResult.WalletID == 0)
            {
                createUserWallet.Text = "Wallet exists for this currency";
            }
            else
            {
                createUserWallet.Text = "Wallet " + walletData.CreateUserWalletResponse.CreateUserWalletResult.WalletID + " created";
            }
        }

        async void GetUserWalletBalance_Button_Pressed(System.Object sender, System.EventArgs e)
        {
            if (!Application.Current.Properties.ContainsKey("access_token"))
            {
                getUserWalletBalance.Text = "Please sign in first.";
                return;
            }
            dynamic walletBalanceData = await GetUserWalletBalance();
            getUserWalletBalance.Text = "Your wallet balance is " + walletBalanceData.UserWalletBalnceResponse.UserWalletBalanceResult.Balance + " " + walletBalanceData.UserWalletBalnceResponse.UserWalletBalanceResult.Currency;
        }

        async void GetLinkedBankAccounts_Button_Pressed(System.Object sender, System.EventArgs e)
        {
            if (!Application.Current.Properties.ContainsKey("access_token"))
            {
                getLinkedBankAccounts.Text = "Please sign in first.";
                return;
            }

            dynamic bankAccountData = await GetLinkedBankAccount();

            var Beneficiary = bankAccountData.GetLinkedBankAccountsResponse.GetLinkedBankAccountsResult.Beneficiary;

            if (Beneficiary == null || Beneficiary.BeneficiaryDetails == null)
            {
                getLinkedBankAccounts.Text = "No bank account is linked to this user.";
            }
            else
            {
                getLinkedBankAccounts.Text = bankAccountData.GetLinkedBankAccountsResponse.GetLinkedBankAccountResult.Beneficiary.BeneficiaryDetails;
            }




        }

        async void GetPaymentMethods_Button_Pressed(System.Object sender, System.EventArgs e)
        {
            if (!Application.Current.Properties.ContainsKey("access_token"))
            {
                getPaymentMethods.ItemsSource = new ObservableCollection<string> { "Please sign in first." };
                return;
            }

            dynamic paymentMethodsData = await GetPaymentMethods();

            var paymentMethodsArr = paymentMethodsData.GetUserPaymentMethodsResponse.UserPaymentMethodResult.UserPaymentMethods.UserPaymentMethodDetails;

            ObservableCollection<string> paymentMethods = new ObservableCollection<string>();

            foreach (var method in paymentMethodsArr)
            {
                paymentMethods.Add((string)method.UserPaymentMethodName);
            }


            getPaymentMethods.ItemsSource = paymentMethods;


        }

        async void LinkBankBeneficiary_Button_Pressed(System.Object sender, System.EventArgs e)
        {
            if (!Application.Current.Properties.ContainsKey("access_token"))
            {
                linkBankBeneficiary.Text = "Please sign in first.";
                return;
            }

            dynamic linkBankBeneficiaryData = await LinkBankBeneficiary();

            linkBankBeneficiary.Text = "Bank linked. ID is " + linkBankBeneficiaryData.LinkBankBeneficiaryResponse.LinkBankBeneficiaryResult.BeneficiaryId;

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



        public static async Task<object> getAuthToken()
        {

            var client = new HttpClient();
            client.BaseAddress = new Uri("https://xapisandbox.xtrm.com/oAuth/token");
            var request = new HttpRequestMessage(HttpMethod.Post, "");

            var keyValues = new List<KeyValuePair<string, string>>();
            keyValues.Add(new KeyValuePair<string, string>("grant_type", "password"));
            keyValues.Add(new KeyValuePair<string, string>("client_id", "1930815_API_User"));
            keyValues.Add(new KeyValuePair<string, string>("client_secret", "TrXSmMCkrGTq2UVsOYMloiPmpwdvIkVrE56DJAkOBkg="));

            var content = new FormUrlEncodedContent(keyValues);

            content.Headers.Clear();
            content.Headers.Add("Content-Type", "application/x-www-form-urlencoded");
            request.Content = new FormUrlEncodedContent(keyValues);

            var response = await client.SendAsync(request);
            var data = await response.Content.ReadAsStringAsync();
            var token = JsonConvert.DeserializeObject<object>(data);
            return token;

        }

        public static async Task<object> refreshAuthToken()
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

            var token = JsonConvert.DeserializeObject<object>(data);


            return token;
        }

        //Check User Exists
        public static async Task<object> CheckUserExists()
        {

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

        //Get Payment Methods
        public static async Task<object> GetPaymentMethods()
        {
            var token = Application.Current.Properties["access_token"].ToString();

            var client = new HttpClient();
            client.DefaultRequestHeaders.Authorization = new AuthenticationHeaderValue("Bearer", token);


            var outerObj = new { };

            var json = JsonConvert.SerializeObject(outerObj);
            var content = new StringContent(json, Encoding.UTF8, "application/json");
            HttpResponseMessage response = await client.PostAsync("https://xapisandbox.xtrm.com/API/V4/Payment/GetUserPaymentMethods", content);


            if (response.IsSuccessStatusCode)
            {
                var data = await response.Content.ReadAsStringAsync();
                object paymentMethodData = JsonConvert.DeserializeObject<object>(data);
                return paymentMethodData;
            }
            else
            {
                var data = await response.Content.ReadAsStringAsync();
                object errorResponse = JsonConvert.DeserializeObject<object>(data);
                return errorResponse;
            }
        }

        //Link Bank Beneficiary
        public static async Task<object> LinkBankBeneficiary()
        {
            var token = Application.Current.Properties["access_token"].ToString();

            var client = new HttpClient();
            client.DefaultRequestHeaders.Authorization = new AuthenticationHeaderValue("Bearer", token);

            var beneficiaryInformationObj = new
            {
                ContactName = "Genevieve",
                PhoneNumber = "14085556245",
                AddressLine1 = "1234 Alhambra Street Way",
                City = "Port Vila",
                Region = "Shefa",
                PostalCode = "94553-1258",
                CountryISO2 = "VU",
                AddressLine2 = "1234 Alhambra Street Way"
            };

            var beneficiaryDetailsObjInner = new
            {
                BeneficiaryInformation = beneficiaryInformationObj
            };

            var beneficiaryBankInformationObj = new
            {
                InstitutionName = "sint dolore magna l",
                Currency = "VUV",
                SWIFTBIC = "conse",
                AccountNumber = "laborum dolore pariatur ipsum",
                RoutingNumber = "825331988",
                CountryISO2 = "VU",
                RemittanceLine3 = "A string of at most fifty (50) characters",
                RemittanceLine4 = "A string of at most fifty (50) characters"
            };

            var bankDetailsObj = new { BeneficiaryBankInformation = beneficiaryBankInformationObj };

            var beneficiaryObj = new { BeneficiaryDetails = beneficiaryDetailsObjInner, BankDetails = bankDetailsObj };

            var requestObj = new
            {
                IssuerAccountNumber = "SPN19135579",
                UserID = "PAT21138510",
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
