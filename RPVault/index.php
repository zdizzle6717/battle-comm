<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>BattleComm: Subscribe</title>
    <link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/magnificent-popup/magnificent-popup.css">
    <script src="../ScriptLibrary/AngularJS/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script>
    <script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
    <script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "logged_in_player_full" */
       jQuery.dmxDataSet(
         {"id": "logged_in_player_full", "url": "/dmxDatabaseSources/logged_in_player_full.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "logged_in_player_full" */
  </script>
</head>
	<?php $pathToFile = $_SERVER['DOCUMENT_ROOT'];
    include ($pathToFile. "/Templates/parts/header.php"); ?>
        <?php include ($pathToFile. "/Templates/parts/container-top.php"); ?>
                <div id="rpvault_summary">
                  <div class="full_width no_padding center"><h1><u>Subscribe to Battle-Comm</u></h1></div>
                  <div class="four_column_1">
                  <img src="/media/independent-locations.jpg" class="shadow" width="100%" src="Uploads/news/battlecomm.png">
                  </div>
                  <div class="four_column_3">
                  <p class="full_width no_padding">
                  Subscribe to Battle-Comm to participate in tournament RP rewards.  Earn RP by competing in organized tournaments with the
                  BC online tournament organizer.  RP is automatically stored in your vault after each win.  Spend RP on new gaming supplies
                  for any game system including new decks, paint, miniatures, and more!
                  </p>
                  </div>
                  <div class="fill right">
                    <a href=""><button type="button" class="button-link-reverse">Subscribe Now</button></a>
                  </div>
                </div>
                <div class="full_width"><hr></div>
                <div class="two_column_1">
                <h2 class="no_shadow">Create an Account</h2>
                <tbody><tr id="row_nameaddr_0">
							<td id="blurb0_nameaddr" class="blurb" colspan="2"><i>Fields with * are required.</i></td><br/>
                            <td id="blurb0_nameaddr" class="blurb" colspan="2"><i><a href="/loginA.php">Already have an account? Login.</a></i></td>
                            <br/>
                            <br/>
						</tr><tr id="row_nameaddr_1">
							<td></td><td></td>
						</tr><tr id="row_nameaddr_3">
							<td class="cell1_nameaddr"><span id="lblf_name">First Name<span class="reqstar">*</span></span></td><td class="control_cell_nameaddr"><input name="f_name" type="text" maxlength="20" size="30" id="f_name" class="txtbox_nameaddr"><span id="f_name_req" class="reqmsg" style="color:Red;display:none;"> Required</span><span id="rgValidatorf_name122629" class="reqmsg" style="color:Red;display:none;">Maximum 20 characters allowed.</span></td>
						</tr><tr id="row_nameaddr_4">
							<td class="cell1_nameaddr"><span id="lbll_name">Last Name<span class="reqstar">*</span></span></td><td class="control_cell_nameaddr"><input name="l_name" type="text" maxlength="20" size="30" id="l_name" class="txtbox_nameaddr"><span id="l_name_req" class="reqmsg" style="color:Red;display:none;"> Required</span><span id="rgValidatorl_name122629" class="reqmsg" style="color:Red;display:none;">Maximum 20 characters allowed.</span></td>
						</tr><tr id="row_nameaddr_6">
							<td class="cell1_nameaddr"><span id="lblcompany">Company</span></td><td class="control_cell_nameaddr"><input name="company" type="text" maxlength="38" size="40" id="company" class="txtbox_nameaddr"><span id="company_req" class="reqmsg" style="color:Red;display:none;"> Required</span><span id="rgValidatorcompany122629" class="reqmsg" style="color:Red;display:none;">Maximum 38 characters allowed.</span></td>
						</tr><tr id="row_nameaddr_7">
							<td class="cell1_nameaddr"><span id="lblstreet">Delivery Address<span class="reqstar">*</span></span></td><td class="control_cell_nameaddr"><input name="street" type="text" maxlength="38" size="40" id="street" class="txtbox_nameaddr"><span id="street_req" class="reqmsg" style="color:Red;display:none;"> Required</span><span id="rgValidatorstreet122629" class="reqmsg" style="color:Red;display:none;">Maximum 38 characters allowed.</span></td>
						</tr><tr id="row_nameaddr_8">
							<td class="cell1_nameaddr"><span id="lbladdr2">Suite / Floor / Apt.#</span></td><td class="control_cell_nameaddr"><input name="addr2" type="text" maxlength="38" size="40" id="addr2" class="txtbox_nameaddr"><span id="rgValidatoraddr2122629" class="reqmsg" style="color:Red;display:none;">Maximum 38 characters allowed.</span></td>
						</tr><tr id="row_nameaddr_9">
							<td class="cell1_nameaddr"><span id="lblcity">City<span class="reqstar">*</span></span></td><td class="control_cell_nameaddr"><input name="city" type="text" maxlength="23" size="30" id="city" class="txtbox_nameaddr"><span id="city_req" class="reqmsg" style="color:Red;display:none;"> Required</span><span id="rgValidatorcity122629" class="reqmsg" style="color:Red;display:none;">Maximum 23 characters allowed.</span></td>
						</tr><tr id="row_nameaddr_10">
							<td class="cell1_nameaddr"><span id="lblstate">State<span class="reqstar">*</span></span></td><td id="dropdown_state" class="control_cell_nameaddr"><select name="state" id="state" class="dropdown_nameaddr">
								<option value=""></option>
								<option value="">Other - Not Listed</option>
								<option value="--">--------US States--------</option>
								<option value="AK">Alaska</option>
								<option value="AL">Alabama</option>
								<option value="AR">Arkansas</option>
								<option value="AZ">Arizona</option>
								<option value="CA">California</option>
								<option value="CO">Colorado</option>
								<option value="CT">Connecticut</option>
								<option value="DC">District of Columbia</option>
								<option value="DE">Delaware</option>
								<option value="FL">Florida</option>
								<option value="GA">Georgia</option>
								<option value="HI">Hawaii</option>
								<option value="IA">Iowa</option>
								<option value="ID">Idaho</option>
								<option value="IL">Illinois</option>
								<option value="IN">Indiana</option>
								<option value="KS">Kansas</option>
								<option value="KY">Kentucky</option>
								<option value="LA">Louisiana</option>
								<option value="MA">Massachusetts</option>
								<option value="MD">Maryland</option>
								<option value="ME">Maine</option>
								<option value="MI">Michigan</option>
								<option value="MN">Minnesota</option>
								<option value="MO">Missouri</option>
								<option value="MS">Mississippi</option>
								<option value="MT">Montana</option>
								<option value="NC">North Carolina</option>
								<option value="ND">North Dakota</option>
								<option value="NE">Nebraska</option>
								<option value="NH">New Hampshire</option>
								<option value="NJ">New Jersey</option>
								<option value="NM">New Mexico</option>
								<option value="NV">Nevada</option>
								<option value="NY">New York</option>
								<option value="OH">Ohio</option>
								<option value="OK">Oklahoma</option>
								<option value="OR">Oregon</option>
								<option value="PA">Pennsylvania</option>
								<option value="RI">Rhode Island</option>
								<option value="SC">South Carolina</option>
								<option value="SD">South Dakota</option>
								<option value="TN">Tennessee</option>
								<option value="TX">Texas</option>
								<option value="UT">Utah</option>
								<option value="VA">Virginia</option>
								<option value="VT">Vermont</option>
								<option value="WA">Washington</option>
								<option value="WI">Wisconsin</option>
								<option value="WV">West Virginia</option>
								<option value="WY">Wyoming</option>
								<option value="--">--------US Territories--------</option>
								<option value="AA">Armed Forces Americas</option>
								<option value="AE">Armed Forces Europe</option>
								<option value="AP">Armed Forces Pacific AP</option>
								<option value="AS">American Samoa</option>
								<option value="GU">Guam</option>
								<option value="PR">Puerto Rico</option>
								<option value="VI">Virgin Islands</option>
								<option value="--">------Canadian Provinces------</option>
								<option value="AB">Alberta</option>
								<option value="BC">British Columbia</option>
								<option value="MB">Manitoba</option>
								<option value="NB">New Brunswick</option>
								<option value="NL">Newfoundland and Labrador</option>
								<option value="NS">Nova Scotia</option>
								<option value="NT">Northwest Territories</option>
								<option value="NU">Nunavut</option>
								<option value="ON">Ontario</option>
								<option value="PE">Prince Edward Island</option>
								<option value="QC">Quebec</option>
								<option value="SK">Saskatchewan</option>
								<option value="YT">Yukon</option>

							</select><span id="state_req" class="reqmsg" style="color:Red;display:none;"> Required</span></td>
						</tr><tr id="row_nameaddr_11">
							<td class="cell1_nameaddr"><span id="lblzip">Zip / Postal Code<span class="reqstar">*</span></span></td><td class="control_cell_nameaddr"><input name="zip" type="text" maxlength="10" size="10" id="zip" class="txtbox_nameaddr"><a id="hlValidFormats" href="javascript:popUp('validPostalCodeFormats.htm',525,700,1);" style="padding-left:5px; white-space: nowrap; display:none;">Valid Formats</a><span id="zip_req" class="reqmsg" style="color:Red;display:none;"> Invalid Code</span><span id="rgValidatorzip122629" class="reqmsg" style="color:Red;display:none;">Maximum 10 characters allowed.</span></td>
						</tr><tr id="row_nameaddr_12">

							<td class="cell1_nameaddr"><span id="lblcountry">Country<span class="reqstar">*</span></span></td><td id="dropdown_country" class="control_cell_nameaddr"><select name="country" id="country" class="dropdown_locked" onchange="AddDonationtoGrandTotal()">
								
								<option value="001">Canada</option>
								<option value="002">Mexico</option>
								<option value="AFG">Afghanistan</option>
								<option value="ALB">Albania</option>
								<option value="ALG">Algeria</option>
								<option value="AND">Andorra</option>
								<option value="ANG">Angola</option>
								<option value="ANU">Anguilla</option>
								<option value="ANT">Antigua</option>
								<option value="ARG">Argentina</option>
								<option value="ARM">Armenia</option>
								<option value="ARU">Aruba</option>
								<option value="ASC">Ascension</option>
								<option value="AUT">Australia</option>
								<option value="AUS">Austria</option>
								<option value="AZE">Azerbaijan</option>
								<option value="BAH">Bahamas</option>
								<option value="BAA">Bahrain</option>
								<option value="BAN">Bangladesh</option>
								<option value="BAR">Barbados</option>
								<option value="BRB">Barbuda</option>
								<option value="BEA">Belarus</option>
								<option value="BLU">Belau</option>
								<option value="BEL">Belgium</option>
								<option value="BEI">Belize</option>
								<option value="BEN">Benin</option>
								<option value="BER">Bermuda</option>
								<option value="BHU">Bhutan</option>
								<option value="BOL">Bolivia</option>
								<option value="BHE">Bosnia-Herzegovina</option>
								<option value="BOT">Botswana</option>
								<option value="BRA">Brazil</option>
								<option value="BVI">British Virgin Islands</option>
								<option value="BRU">Brunei</option>
								<option value="BUL">Bulgaria</option>
								<option value="BUK">Burkina Faso</option>
								<option value="BUM">Burma</option>
								<option value="BUR">Burundi</option>
								<option value="CAE">Cambodia</option>
								<option value="CAM">Cameroon</option>
								<option value="CVE">Cape Verde</option>
								<option value="CIS">Cayman Islands</option>
								<option value="CAR">Central African Republic</option>
								<option value="CHA">Chad</option>
								<option value="CSI">Channel Islands</option>
								<option value="CHL">Chile</option>
								<option value="CHI">China</option>
								<option value="COL">Colombia</option>
								<option value="COM">Comoros</option>
								<option value="CON">Congo</option>
								<option value="CKI">Cook Island</option>
								<option value="CRI">Costa Rica</option>
								<option value="CRO">Croatia</option>
								<option value="CUB">Cuba</option>
								<option value="CYP">Cyprus</option>
								<option value="CZE">Czech Republic</option>
								<option value="DEN">Denmark</option>
								<option value="DJI">Djibouti</option>
								<option value="DOM">Dominica</option>
								<option value="DRI">Dominican Republic</option>
								<option value="ECU">Ecuador</option>
								<option value="EGY">Egypt</option>
								<option value="ELS">El Salvador</option>
								<option value="EGU">Equatorial Guinea</option>
								<option value="ERI">Eritrea</option>
								<option value="EST">Estonia</option>
								<option value="ETH">Ethiopia</option>
								<option value="FAR">Faroe Islands</option>
								<option value="FIJ">Fiji Islands</option>
								<option value="FIN">Finland</option>
								<option value="FRA">France</option>
								<option value="FGU">French Guiana</option>
								<option value="FRE">French Polynesia</option>
								<option value="GAB">Gabon</option>
								<option value="GAM">Gambia</option>
								<option value="GEO">Georgia</option>
								<option value="GER">Germany</option>
								<option value="GHA">Ghana</option>
								<option value="GIB">Gibraltar</option>
								<option value="GRE">Greece</option>
								<option value="GRN">Greenland</option>
								<option value="GRA">Grenada</option>
								<option value="GUD">Guadeloupe</option>
								<option value="GUA">Guatemala</option>
								<option value="GUI">Guinea</option>
								<option value="GBI">Guinea-Bissau</option>
								<option value="GUY">Guyana</option>
								<option value="HAI">Haiti</option>
								<option value="HON">Honduras</option>
								<option value="HKO">Hong Kong</option>
								<option value="HUN">Hungary</option>
								<option value="ICE">Iceland</option>
								<option value="IND">India</option>
								<option value="INO">Indonesia</option>
								<option value="IRA">Iran</option>
								<option value="IRQ">Iraq</option>
								<option value="IRE">Ireland</option>
								<option value="IOM">Isle Of Man</option>
								<option value="ISR">Israel</option>
								<option value="ITA">Italy</option>
								<option value="IVO">Ivory Coast</option>
								<option value="JAM">Jamaica</option>
								<option value="JAP">Japan</option>
								<option value="JOR">Jordan</option>
								<option value="KAZ">Kazakhstan</option>
								<option value="KEN">Kenya</option>
								<option value="KTO">Kingdom Of Tonga</option>
								<option value="KIR">Kiribati</option>
								<option value="KOS">Kosovo</option>
								<option value="KUW">Kuwait</option>
								<option value="KYR">Kyrgyzstan</option>
								<option value="LAO">Laos</option>
								<option value="LAT">Latvia</option>
								<option value="LEB">Lebanon</option>
								<option value="LES">Lesotho</option>
								<option value="LIB">Liberia</option>
								<option value="LIY">Libya</option>
								<option value="LIE">Liechtenstein</option>
								<option value="LIT">Lithuania</option>
								<option value="LUX">Luxembourg</option>
								<option value="MAC">Macao</option>
								<option value="MAE">Macedonia</option>
								<option value="MAD">Madagascar</option>
								<option value="MAW">Malawi</option>
								<option value="MAL">Malaysia</option>
								<option value="MAV">Maldives</option>
								<option value="MAI">Mali</option>
								<option value="MAA">Malta</option>
								<option value="MRS">Marshall Islands</option>
								<option value="MAT">Martinique</option>
								<option value="MAR">Mauritania</option>
								<option value="MAU">Mauritius</option>
								<option value="MOL">Moldova</option>
								<option value="MOA">Monaco</option>
								<option value="MOG">Mongolia</option>
								<option value="MON">Monserrat</option>
								<option value="MOT">Montenegro</option>
								<option value="MOR">Morocco</option>
								<option value="MOZ">Mozambique</option>
								<option value="MYA">Myanmar</option>
								<option value="NAM">Namibia</option>
								<option value="NAU">Nauru</option>
								<option value="NEP">Nepal</option>
								<option value="NET">Netherlands</option>
								<option value="NAN">Netherlands Antilles</option>
								<option value="NCA">New Caledonia</option>
								<option value="NZE">New Zealand</option>
								<option value="NIC">Nicaragua</option>
								<option value="NIE">Niger</option>
								<option value="NIG">Nigeria</option>
								<option value="NKO">North Korea</option>
								<option value="NOR">Norway</option>
								<option value="OMA">Oman</option>
								<option value="PAK">Pakistan</option>
								<option value="PAU">Palau</option>
								<option value="PAL">Palestine</option>
								<option value="PAN">Panama</option>
								<option value="PNG">Papua New Guinea</option>
								<option value="PAR">Paraguay</option>
								<option value="PER">Peru</option>
								<option value="PHI">Philippines</option>
								<option value="PIT">Pitcairn Is</option>
								<option value="POL">Poland</option>
								<option value="POR">Portugal</option>
								<option value="QAT">Qatar</option>
								<option value="REU">Reunion</option>
								<option value="ROM">Romania</option>
								<option value="RUS">Russia</option>
								<option value="RWA">Rwanda</option>
								<option value="SMR">San Marino</option>
								<option value="SAO">Sao Tome &amp; Principe</option>
								<option value="SAU">Saudi Arabia</option>
								<option value="SEN">Senegal</option>
								<option value="SER">Serbia-Montenegro</option>
								<option value="SEY">Seychelles</option>
								<option value="SIE">Sierra Leone</option>
								<option value="SIN">Singapore</option>
								<option value="SLO">Slovakia</option>
								<option value="SLV">Slovenia</option>
								<option value="SOL">Solomon Islands</option>
								<option value="SOM">Somalia</option>
								<option value="SAF">South Africa</option>
								<option value="SKO">South Korea</option>
								<option value="SPA">Spain</option>
								<option value="SRI">Sri Lanka</option>
								<option value="SKI">St Kitts</option>
								<option value="SLU">St Lucia</option>
								<option value="SMA">St Martin</option>
								<option value="STO">St Pierre</option>
								<option value="SVI">St Vincent And The Grenadines</option>
								<option value="SUD">Sudan</option>
								<option value="SUR">Suriname</option>
								<option value="SWA">Swaziland</option>
								<option value="SWE">Sweden</option>
								<option value="SWI">Switzerland</option>
								<option value="SYR">Syria</option>
								<option value="TAI">Taiwan</option>
								<option value="TAJ">Tajikistan</option>
								<option value="TAN">Tanzania</option>
								<option value="THA">Thailand</option>
								<option value="TOG">Togo</option>
								<option value="TON">Tonga</option>
								<option value="TRI">Trinidad &amp; Tobago</option>
								<option value="TUN">Tunisia</option>
								<option value="TUR">Turkey</option>
								<option value="TUK">Turkmenistan</option>
								<option value="TCI">Turks And Caicos Islands</option>
								<option value="TUV">Tuvalu</option>
								<option value="UGA">Uganda</option>
								<option value="UKR">Ukraine</option>
								<option value="UAE">United Arab Emirates</option>
								<option value="UNK">United Kingdom</option>
								<option value="URU">Uruguay</option>
								<option value="UZB">Uzbekistan</option>
								<option value="VAN">Vanuatu</option>
								<option value="VCI">Vatican City</option>
								<option value="VEN">Venezuela</option>
								<option value="VIE">Vietnam</option>
								<option value="WSA">Western Samoa</option>
								<option value="YEM">Yemen</option>
								<option value="ZAM">Zambia</option>
								<option value="ZIM">Zimbabwe</option>

							</select><span id="country_req" class="reqmsg" style="color:Red;display:none;"> Required</span></td>
						</tr><tr id="row_nameaddr_13">
							<td class="cell1_nameaddr"><span id="lblphone">Telephone number<span class="reqstar">*</span></span></td><td class="control_cell_nameaddr"><input name="phone" type="text" maxlength="20" size="12" id="phone" class="txtbox_nameaddr"><span id="phone_req" class="reqmsg" style="color:Red;display:none;"> Required</span><span id="phone_regex" class="reqmsg" style="color:Red;display:none;"> Invalid Phone Number</span><span id="rgValidatorphone122629" class="reqmsg" style="color:Red;display:none;">Maximum 20 characters allowed.</span></td>
						</tr><tr id="row_nameaddr_16">
							<td class="cell1_nameaddr"><span id="lblemail">Email<span class="reqstar">*</span></span></td><td class="control_cell_nameaddr"><input name="email" type="text" size="50" id="email" class="txtbox_nameaddr"><span id="email_req" class="reqmsg" style="color:Red;display:none;"> Required</span><span id="email_regex" class="reqmsg" style="color:Red;display:none;"> Invalid Email Address</span></td>
						</tr><tr id="row_nameaddr_17">
							<td class="cell1_nameaddr"><span id="lblemail2">Re-Type Email<span class="reqstar">*</span></span></td><td class="control_cell_nameaddr"><input name="email2" type="text" size="50" id="email2" class="txtbox_nameaddr"><span id="email2_req" class="reqmsg" style="color:Red;display:none;"> Required</span><span id="email2_compare" class="reqmsg" style="color:Red;display:none;"> Email does not match</span></td>
						</tr><tr id="row_nameaddr_18">
							<td id="blurb18_nameaddr" class="blurb" colspan="2"></td>
						</tr>
					</tbody>
                </div>
                <div class="two_column_1">
                	<img src="/images/plaque-logo.png" width="100%">
                </div>
		<?php include ($pathToFile. "/Templates/parts/container-bottom.php"); ?>
<?php include ($pathToFile. "/Templates/parts/footer.php"); ?>