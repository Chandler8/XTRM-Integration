﻿using System;
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



        async void Auth_Button_Pressed(System.Object sender, System.EventArgs e)
        {
            dynamic token = await getAuthToken();
            Application.Current.Properties.Add("access_token", token.access_token);
            Application.Current.Properties.Add("refresh_token", token.refresh_token);
            Application.Current.Properties.Add("expires_in", token.expires_in);
            //string authorizationToken = Application.Current.Properties["access_token"].ToString();
            authToken.Text = "Sign in successful.";
        }

        async void Refresh_Button_Pressed(System.Object sender, System.EventArgs e)
        {
            dynamic token = await refreshAuthToken();
            Application.Current.Properties["expires_in"] = token.expires_in;
            //refreshToken.Text = Application.Current.Properties["refresh_token"].ToString();
            refreshToken.Text = "Token refresh successful.";
        }

        async void CheckUserExists_Button_Pressed(System.Object sender, System.EventArgs e)
        {

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

        public MainPage()
        {

            InitializeComponent();


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
    }
}
