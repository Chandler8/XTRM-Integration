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

<header>
    <nav class="navbar navbar-expand">
        <div class="container-fluid pl-0">

            <ul class="navbar navbar-nav mr-auto" id="mainTopNavbar">
                <li class="nav-item">
                    <a class=" nav-link  " href="https://demo.v2.senegalsoftware.com/MARKETING/dashboard">
                        MARKETING
                    </a>
                </li>
                <li class="nav-item">
                    <a class=" nav-link  " href="https://demo.v2.senegalsoftware.com/CRM/dashboard">
                        CRM
                    </a>
                </li>
                <li class="nav-item">
                    <a class=" nav-link  " href="https://demo.v2.senegalsoftware.com/PROJECTS/dashboard">
                        PROJECTS
                    </a>
                </li>
                <li class="nav-item">
                    <a class=" nav-link  " href="https://demo.v2.senegalsoftware.com/HIRE/dashboard">
                        HIRE
                    </a>
                </li>

                <a class=" nav-link  " href="https://demo.v2.senegalsoftware.com/WORK/dashboard">
                    WORK
                </a>
                </li>
                <li class="nav-item">
                    <a class=" nav-link  " href="https://demo.v2.senegalsoftware.com/LOGISTICS/dashboard">
                        LOGISTICS
                    </a>
                </li>
                <li class="nav-item">
                    <a class=" nav-link  active" href="https://demo.v2.senegalsoftware.com/FINANCE/dashboard">
                        FINANCE
                    </a>
                </li>
            </ul>
            </li>

        </div>
    </nav>
</header>

<section>
    <div class="main_tabs">
        <div class="container-fluid">
            <div class="main_tabs_inner">
                <ul class="navbar" id="mainNavbar">
                    <li class="" for_tab="Estimates">
                        <a href="https://demo.v2.senegalsoftware.com/Estimates/list">Estimates
                        </a>
                    </li>
                    <li class="" for_tab="Proposals">
                        <a href="https://demo.v2.senegalsoftware.com/Proposals/list">Proposals
                        </a>
                    </li>
                    <li class="" for_tab="Invoices">
                        <a href="https://demo.v2.senegalsoftware.com/Invoices/list">Invoices
                        </a>
                    </li>
                    <li class="active" for_tab="TalentBill">
                        <a href="https://demo.v2.senegalsoftware.com/TalentBill/list">Talent Bills
                        </a>
                    </li>
                    <li class="" for_tab="Profitability">
                        <a href="https://demo.v2.senegalsoftware.com/Profitability/list">Profitability
                        </a>
                    </li>
                    <li class="" for_tab="Commissions">
                        <a href="https://demo.v2.senegalsoftware.com/Commissions/list">Commissions
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="main_sec">
        <div class="listing_wrap p-3">
            <div class="pt-2 pb-3 d-flex align-items-center justify-content-between overflow border_btm">
                <div class="d-flex align-items-center">
                    <span class="form-control advanced_filter mr-3 cursor_pointer min_w_auto text-nowrap" data-target="advanced_search_TalentBill_searchpage"><i class="fal fa-sliders-h mr-2"></i> Filters</span>
                    <span id="view_actionscontainer_TalentBill_searchpage"></span>

                </div>
                <div class="d-flex align-items-center">

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

                    <div class="select_wrap mr-3">
                        <select class="form-control form_additional_options" name="records_per_page" id="records_per_page" data-parent="" data-parentid="" data-module="TalentBill" data-mode="searchpage">
                            <option value="10" selected="">10 entries</option>
                            <option value="25">25 entries</option>
                            <option value="50">50 entries</option>
                            <option value="100">100 entries</option>
                        </select>
                    </div>

                    <div id="paginationcontainer_TalentBill_searchpage">
                        <div class="pagination form-control mr-6">
                            <ul class="d-flex">

                                <li>
                                    <input class="form_additional_options current_page" name="current_page" data-sort="TalentBill.date_created" data-sortdir="DESC" id="current_page_TalentBill_searchpage" data-parent="" data-parentid="" type="text" value="1" data-module="TalentBill" data-mode="searchpage">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <input type="hidden" id="viewmode_container_TalentBill_searchpage" value="" autocomplete="off">

                </div>
            </div>

            <div class="listing_view d-flex">
                <div class="advanced_search bg_gray" id="advanced_search_TalentBill_searchpage">
                    <div class="p-3">
                        <input type="hidden" id="select_type_TalentBill_searchpage" value="" autocomplete="off">
                        <form action="" method="get" class="searchform ng-pristine ng-valid" name="SearchForm" id="SearchForm_TalentBill_searchpage" data-parent="" data-parentid="" data-module="TalentBill" data-mode="searchpage">
                            <div class="form-group">


                                <div class="listing_warp w-100" id="searchcontainer_TalentBill_searchpage">
                                    <input type="hidden" id="searchcontainer_TalentBill_searchpage-total_count" value="3" autocomplete="off">

                                    <table class="table table-bordered listing_table th_bg col_custom_width first_col_center">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    <div class="d-flex align-items-center dropdown action_dropdown">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input crmcheckboxaction_head" id="searchcontainer_TalentBill_searchpage-checkbox-head" data-container="searchcontainer_TalentBill_searchpage">
                                                            <label class="custom-control-label" for="searchcontainer_TalentBill_searchpage-checkbox-head"></label>
                                                        </div>

                                                        <i class="fal fa-angle-down font_20 cursor_pointer" data-toggle="dropdown" aria-expanded="false"></i>
                                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(24px, 22px, 0px);">
                                                            <a class="dropdown-item crmmultiactionbutton" data-container="searchcontainer_TalentBill_searchpage" data-action="MassCreate" data-key="AddNote" data-module="TalentBill" data-parent="" data-parentid="">Add Note</a>
                                                            <a class="dropdown-item crmmultiactionbutton" data-container="searchcontainer_TalentBill_searchpage" data-action="MassCreate" data-key="AddTask" data-module="TalentBill" data-parent="" data-parentid="">Add Task</a>
                                                            <a class="dropdown-item crmmultiactionbutton" data-container="searchcontainer_TalentBill_searchpage" data-action="Archive" data-key="Archive" data-module="TalentBill" data-parent="" data-parentid="">Archive</a>
                                                            <a class="dropdown-item crmmultiactionbutton" data-container="searchcontainer_TalentBill_searchpage" data-action="Delete" data-key="Delete" data-module="TalentBill" data-parent="" data-parentid="">Delete</a>
                                                            <a class="dropdown-item crmmultiactionbutton" data-container="searchcontainer_TalentBill_searchpage" data-action="Export" data-key="Export" data-module="TalentBill" data-parent="" data-parentid="">Export</a>
                                                            <a class="dropdown-item crmmultiactionbutton" data-container="searchcontainer_TalentBill_searchpage" data-action="Lock" data-key="Lock" data-module="TalentBill" data-parent="" data-parentid="">Lock</a>
                                                            <a class="dropdown-item crmmultiactionbutton" data-container="searchcontainer_TalentBill_searchpage" data-action="Pay" data-key="Pay" data-module="TalentBill" data-parent="" data-parentid="">Pay</a>
                                                            <a class="dropdown-item crmmultiactionbutton" data-container="searchcontainer_TalentBill_searchpage" data-action="Unlock" data-key="Unlock" data-module="TalentBill" data-parent="" data-parentid="">Unlock</a>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th scope="col">Edit</th>
                                                <th scope="col"><a class="sortresults" href="#" data-sort="TalentBill.data_work_talents_id" data-sortdir="asc" data-parent="" data-parentid="" data-module="TalentBill" data-mode="searchpage">Talent Name</a>

                                                </th>
                                                <th scope="col"><a class="sortresults" href="#" data-sort="TalentBill.name" data-sortdir="asc" data-parent="" data-parentid="" data-module="TalentBill" data-mode="searchpage">Name</a>

                                                </th>
                                                <th scope="col"><a class="sortresults" href="#" data-sort="TalentBill.parent_id" data-sortdir="asc" data-parent="" data-parentid="" data-module="TalentBill" data-mode="searchpage">Related To</a>

                                                </th>
                                                <th scope="col"><a class="sortresults" href="#" data-sort="TalentBill.locked" data-sortdir="asc" data-parent="" data-parentid="" data-module="TalentBill" data-mode="searchpage">Locked</a>

                                                </th>
                                                <th scope="col"><a class="sortresults" href="#" data-sort="TalentBill.amount" data-sortdir="asc" data-parent="" data-parentid="" data-module="TalentBill" data-mode="searchpage">Amount</a>

                                                </th>
                                                <th scope="col"><a class="sortresults" href="#" data-sort="TalentBill.due_date" data-sortdir="asc" data-parent="" data-parentid="" data-module="TalentBill" data-mode="searchpage">Due Date</a>

                                                </th>
                                                <th scope="col"><a class="sortresults" href="#" data-sort="TalentBill.date_created" data-sortdir="asc" data-parent="" data-parentid="" data-module="TalentBill" data-mode="searchpage">Date Created</a>
                                                    <span class="up_down"><i class="far fa-sort-down"></i></span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input crmcheckboxaction searchcontainer_TalentBill_searchpage-searchresult-checkbox" data-container="searchcontainer_TalentBill_searchpage-searchresult-checkbox" id="checkbox-TalentBill_searchpage_982914B4-9FDA-4C74-BC1B-AACB2E200682">
                                                        <label class="custom-control-label" for="checkbox-TalentBill_searchpage_982914B4-9FDA-4C74-BC1B-AACB2E200682"></label>
                                                    </div>
                                                </td>
                                                <td><a name="quickedit" data-module="TalentBill" class="fas fa-pen-square mr-2 crmcreatebutton" data-createtype="quickedit" data-toggle="modal" data-target="#createrecord" data-parent="" data-parentid="" data-record="982914B4-9FDA-4C74-BC1B-AACB2E200682" data-searchid="222197_1621951483.7837" data-usermode="tenant"></a></td>
                                                <td><a href="https://demo.v2.senegalsoftware.com/Talents/detail?id=280D9D3C-C75F-4412-B2D5-EADDD1AF688D">Chandler Testing</a></td>
                                                <td><a style="color: inherit;" href="https://demo.v2.senegalsoftware.com/TalentBill/detail?id=1EDE3E3F-61A5-4ABE-B6D2-AD7D236AA683"><b>Alpha Promo Event - 04/12/21</b></a></td>
                                                <td>Shifts: <a href="https://demo.v2.senegalsoftware.com/Shifts/detail?id=3F6A10CD-14C1-439C-8AC9-030E1D22DD4B">Alpha Promo Event - 04/12/21</a></td>
                                                <td>Yes</td>
                                                <td>$0.00</td>
                                                <td>04/14/2021</td>
                                                <td>05/04/2021 01:24 PM</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input crmcheckboxaction searchcontainer_TalentBill_searchpage-searchresult-checkbox" data-container="searchcontainer_TalentBill_searchpage-searchresult-checkbox" id="checkbox-TalentBill_searchpage_64B5563D-E3F7-4A1B-970A-4117BF4F3E5A">
                                                        <label class="custom-control-label" for="checkbox-TalentBill_searchpage_64B5563D-E3F7-4A1B-970A-4117BF4F3E5A"></label>
                                                    </div>
                                                </td>
                                                <td><a name="quickedit" data-module="TalentBill" class="fas fa-pen-square mr-2 crmcreatebutton" data-createtype="quickedit" data-toggle="modal" data-target="#createrecord" data-parent="" data-parentid="" data-record="64B5563D-E3F7-4A1B-970A-4117BF4F3E5A" data-searchid="222197_1621951483.7837" data-usermode="tenant"></a></td>
                                                <td><a href="https://demo.v2.senegalsoftware.com/Talents/detail?id=280D9D3C-C75F-4412-B2D5-EADDD1AF688D">Chandler Testing</a></td>
                                                <td><a style="color: inherit;" href="https://demo.v2.senegalsoftware.com/TalentBill/detail?id=1EDE3E3F-61A5-4ABE-B6D2-AD7D236AA683"><b>Alpha Promo Event - 04/12/21</b></a></td>
                                                <td>Shifts: <a href="https://demo.v2.senegalsoftware.com/Shifts/detail?id=3F6A10CD-14C1-439C-8AC9-030E1D22DD4B">Alpha Promo Event - 04/12/21</a></td>
                                                <td>Yes</td>
                                                <td>$0.00</td>
                                                <td>01/04/0000</td>
                                                <td>05/04/2021 01:22 PM</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input crmcheckboxaction searchcontainer_TalentBill_searchpage-searchresult-checkbox" data-container="searchcontainer_TalentBill_searchpage-searchresult-checkbox" id="checkbox-TalentBill_searchpage_1EDE3E3F-61A5-4ABE-B6D2-AD7D236AA683">
                                                        <label class="custom-control-label" for="checkbox-TalentBill_searchpage_1EDE3E3F-61A5-4ABE-B6D2-AD7D236AA683"></label>
                                                    </div>
                                                </td>
                                                <td><a name="quickedit" data-module="TalentBill" class="fas fa-pen-square mr-2 crmcreatebutton" data-createtype="quickedit" data-toggle="modal" data-target="#createrecord" data-parent="" data-parentid="" data-record="1EDE3E3F-61A5-4ABE-B6D2-AD7D236AA683" data-searchid="222197_1621951483.7837" data-usermode="tenant"></a></td>
                                                <td><a href="https://demo.v2.senegalsoftware.com/Talents/detail?id=280D9D3C-C75F-4412-B2D5-EADDD1AF688D">Chandler Testing</a></td>
                                                <td><a style="color: inherit;" href="https://demo.v2.senegalsoftware.com/TalentBill/detail?id=1EDE3E3F-61A5-4ABE-B6D2-AD7D236AA683"><b>Alpha Promo Event - 04/12/21</b></a></td>
                                                <td>Shifts: <a href="https://demo.v2.senegalsoftware.com/Shifts/detail?id=3F6A10CD-14C1-439C-8AC9-030E1D22DD4B">Alpha Promo Event - 04/12/21</a></td>
                                                <td>Yes</td>
                                                <td>$0.00</td>
                                                <td>06/09/2021</td>
                                                <td>04/20/2021 08:50 AM</td>
                                            </tr>
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                    </div>
                </div>
                <div id="modal-popup" tabindex="-1" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="modal fade" role="dialog" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-xl">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 id="modal-heading" class="modal-title color_green"></h5>
                                <button class="close" data-dismiss="modal"><i class="far fa-times-circle"></i></button>
                            </div>
                            <div id="modal-body" class="modal-body">

                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal" id="LargeImageModal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <!-- Modal body -->
                            <div class="modal-body text-center">
                                <button class="close mb-3" data-dismiss="modal"><i class="far fa-times-circle"></i></button>
                                <img id="bigimageid" src="%LargeImageSource%">
                                <h3 class="my-3" id="phototitle">%PhotoCategory%</h3>
                                <p class="my-3 color_gray" id="photodescription">%PhotoDescription%</p>
                            </div>
                        </div>
                    </div>
                </div>

</section>


<body>
    <div class="container">
        <h1>XTRM Testing of UI and white labeling!</h1>
        <p>Click here on this<a href="https://www.xtrm.com/web/Register/SponSimpleSignup.aspx" target="_blank"> link</a> to begin your XTRM setup.</p>
    </div>

<br>

<br>


        <p>To set up your merchant services account with XTRM, please go to the following
            <a href="andre.php">PAGE</a> </p>

            <br>

        <form action="{{ route('save-form-data') }}" method="POST" id="settingsForm" class="form-validate">
        
            <div class="setting_wrap_scroll">
                <input type="hidden" name="section_name" value="FinanceSettings">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" class="form-control" placeholder="Email Address" name="KyckGlobal:email_address[value]" title="Email Address" data-type="crmfield" required>
                    <!-- value="{{isset($pageData['fieldsData']['email_address']) ? $pageData['fieldsData']['email_address'] : ''}}" Needs to get input in the field above, after name and before title -->

                    <input type="hidden" name="KyckGlobal:email_address[label]" value="Email Address">
                    <input type="hidden" name="KyckGlobal:email_address[type]" value="text">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="text" class="form-control" placeholder="Password" name="KyckGlobal:password[value]" title="Password" data-type="crmfield" required>
                    <!-- value="{{isset($pageData['fieldsData']['password']) ? $pageData['fieldsData']['password'] : ''}}" Needs to get input in the field above, after name and before title -->

                    <input type="hidden" name="KyckGlobal:password[label]" value="Password">
                    <input type="hidden" name="KyckGlobal:password[type]" value="text">
                </div>
            </div>

            <button class="btn mt-2" id="settingsBtn">Save</button>

        </form>

    </div>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="submit.php" crossorigin="anonymous"></script>

</html>