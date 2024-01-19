<!DOCTYPE html>
<html>
<head>
  <title>Enter Address</title>
  <style>
    h1 {
      text-align: center;
    }

    form {
      max-width: 400px;
      margin: 0 auto;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"],
    select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      margin-bottom: 10px;
    }

    select {
      height: 40px;
    }

    button[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
    }

    button[type="submit"]:hover {
      background-color: #45a049;
    }

    .error-message {
  color: red;
  font-size: 12px;
  margin-top: 5px;
}
  </style>
</head>
<body>
<h1>Inserir Endereço</h1>


<?php echo form_open('address/saveAddress'); ?>
<div>
<?php echo form_error('address', '<p class="error-message">Endereço: ', '</p>'); ?>
    <label for="address">Endereço</label>
    <input type="text" name="address" id="address" value="<?php echo set_value('address'); ?>" autocomplete="address">
</div>
<div>
    <?php echo form_error('city', '<p class="error-message">', '</p>'); ?>
    <label for="city">Cidade</label>
    <input type="text" name="city" id="city" value="<?php echo set_value('city'); ?>" autocomplete="city">
</div>
<div>
<?php echo form_error('postal_code', '<p class="error-message">', '</p>'); ?>
<label for="postal_code">Código Postal</label>
    <input type="text" name="postal_code" id="postal_code" value="<?php echo set_value('postal_code'); ?>" autocomplete="postal-code">
</div>
    <div>
      <label for="country">Country</label>
      <select name="country">       
      <option value="Afghanistan">&#x1F1E6&#x1F1EB Afghanistan</option>
        <option value="Albania">&#x1F1E6&#x1F1FD Albania</option>
        <option value="Algeria">&#x1F1E9&#x1F1FF Algeria</option>
        <option value="Andorra">&#x1F1E6&#x1F1E9 Andorra</option>
        <option value="Angola">&#x1F1E6&#x1F1F4 Angola</option>
        <option value="Anguilla">&#x1F1E6&#x1F1EE Anguilla</option>
        <option value="Antigua &amp; Barbuda">&#x1F1E6&#x1F1EC Antigua &amp; Barbuda</option>
        <option value="Argentina">&#x1F1E6&#x1F1F7 Argentina</option>
        <option value="Armenia">&#x1F1E6&#x1F1F2 Armenia</option>
        <option value="Aruba">&#x1F1E6&#x1F1FC Aruba</option>
        <option value="Ascension Island">&#x1F1E6&#x1F1E8 Ascension Island</option>
        <option value="Australia">&#x1F1E6&#x1F1FA Australia</option>
        <option value="Austria">&#x1F1E6&#x1F1F9 Austria</option>
        <option value="Azerbaijan">&#x1F1E6&#x1F1FF Azerbaijan</option>
        <option value="Bahamas">&#x1F1E7&#x1F1F8 Bahamas</option>
        <option value="Bahrain">&#x1F1E7&#x1F1ED Bahrain</option>
        <option value="Bangladesh">&#x1F1E7&#x1F1E9 Bangladesh</option>
        <option value="Barbados">&#x1F1E7&#x1F1E7 Barbados</option>
        <option value="Belarus">&#x1F1E7&#x1F1FE Belarus</option>
        <option value="Belgium">&#x1F1E7&#x1F1EA Belgium</option>
        <option value="Belize">&#x1F1E7&#x1F1FF Belize</option>
        <option value="Benin">&#x1F1E7&#x1F1EF Benin</option>
        <option value="Bermuda">&#x1F1E7&#x1F1F2 Bermuda</option>
        <option value="Bhutan">&#x1F1E7&#x1F1F9 Bhutan</option>
        <option value="Bolivia">&#x1F1E7&#x1F1F4 Bolivia</option>
        <option value="Bonaire, Saba and Sint Eustatius">&#x1F1E7&#x1F1F6 Bonaire, Saba and Sint Eustatius</option>
        <option value="Bosnia Herzegovina">&#x1F1E7&#x1F1E6 Bosnia Herzegovina</option>
        <option value="Botswana">&#x1F1E7&#x1F1FC Botswana</option>
        <option value="Brazil">&#x1F1E7&#x1F1F7 Brazil</option>
        <option value="British Indian Ocean Territory">&#x1F1EE&#x1F1F4 British Indian Ocean Territory</option>
        <option value="Brunei">&#x1F1E7&#x1F1F3 Brunei</option>
        <option value="Bulgaria">&#x1F1E7&#x1F1EC Bulgaria</option>
        <option value="Burkina Faso">&#x1F1E7&#x1F1EB Burkina Faso</option>
        <option value="Burundi">&#x1F1E7&#x1F1EE Burundi</option>
        <option value="Cambodia">&#x1F1F0&#x1F1ED Cambodia</option>
        <option value="Cameroon">&#x1F1E8&#x1F1F2 Cameroon</option>
        <option value="Canada">&#x1F1E8&#x1F1E6 Canada</option>
        <option value="Cape Verde Islands">&#x1F1E8&#x1F1FB Cape Verde Islands</option>
        <option value="Cayman Islands">&#x1F1F0&#x1F1FE Cayman Islands</option>
        <option value="Central African Republic">&#x1F1E8&#x1F1EB Central African Republic</option>
        <option value="Chad">&#x1F1F9&#x1F1E9 Chad</option>
        <option value="Chile">&#x1F1E8&#x1F1F1 Chile</option>
        <option value="China">&#x1F1E8&#x1F1F3 China</option>
        <option value="Colombia">&#x1F1E8&#x1F1F4 Colombia</option>
        <option value="Comoros">&#x1F1F0&#x1F1F2 Comoros</option>
        <option value="Congo">&#x1F1E8&#x1F1EC Congo</option>
        <option value="Congo, Democratic Republic of the">&#x1F1E8&#x1F1E9 Congo, Democratic Republic of the</option>
        <option value="Cook Islands">&#x1F1E8&#x1F1F0 Cook Islands</option>
        <option value="Costa Rica">&#x1F1E8&#x1F1F7 Costa Rica</option>
        <option value="Croatia">&#x1F1ED&#x1F1F7 Croatia</option>
        <option value="Cuba">&#x1F1E8&#x1F1FA Cuba</option>
        <option value="Curaçao">&#x1F1E8&#x1F1FC Curaçao</option>
        <option value="Cyprus">&#x1F1E8&#x1F1FE Cyprus</option>
        <option value="Czech Republic">&#x1F1E8&#x1F1FF Czech Republic</option>
        <option value="Denmark">&#x1F1E9&#x1F1F0 Denmark</option>
        <option value="Djibouti">&#x1F1E9&#x1F1EF Djibouti</option>
        <option value="Dominica">&#x1F1E9&#x1F1F2 Dominica</option>
        <option value="Dominican Republic">&#x1F1E9&#x1F1F4 Dominican Republic</option>
        <option value="East Timor">&#x1F1F9&#x1F1F1 East Timor</option>
        <option value="Ecuador">&#x1F1EA&#x1F1E8 Ecuador</option>
        <option value="Egypt">&#x1F1EA&#x1F1EC Egypt</option>
        <option value="El Salvador">&#x1F1F8&#x1F1FB El Salvador</option>
        <option value="Equatorial Guinea">&#x1F1EC&#x1F1F6 Equatorial Guinea</option>
        <option value="Eritrea">&#x1F1EA&#x1F1F7 Eritrea</option>
        <option value="Estonia">&#x1F1EA&#x1F1EA Estonia</option>
        <option value="Eswatini">&#x1F1F8&#x1F1FF Eswatini</option>
        <option value="Ethiopia">&#x1F1EA&#x1F1F9 Ethiopia</option>
        <option value="Falkland Islands">&#x1F1EB&#x1F1F0 Falkland Islands</option>
        <option value="Faroe Islands">&#x1F1EB&#x1F1F4 Faroe Islands</option>
        <option value="Fiji">&#x1F1EB&#x1F1EF Fiji</option>
        <option value="Finland">&#x1F1EB&#x1F1EE Finland</option>
        <option value="France">&#x1F1EB&#x1F1F7 France</option>
        <option value="French Guiana">&#x1F1EC&#x1F1EB French Guiana</option>
        <option value="French Polynesia">&#x1F1F5&#x1F1EB French Polynesia</option>
        <option value="Gabon">&#x1F1EC&#x1F1E6 Gabon</option>
        <option value="Gambia">&#x1F1EC&#x1F1F2 Gambia</option>
        <option value="Georgia">&#x1F1EC&#x1F1EA Georgia</option>
        <option value="Germany">&#x1F1E9&#x1F1EA Germany</option>
        <option value="Ghana">&#x1F1EC&#x1F1ED Ghana</option>
        <option value="Gibraltar">&#x1F1EC&#x1F1EE Gibraltar</option>
        <option value="Greece">&#x1F1EC&#x1F1F7 Greece</option>
        <option value="Greenland">&#x1F1EC&#x1F1F1 Greenland</option>
        <option value="Grenada">&#x1F1EC&#x1F1E9 Grenada</option>
        <option value="Guadeloupe">&#x1F1EC&#x1F1F5 Guadeloupe</option>
        <option value="Guam">&#x1F1EC&#x1F1FA Guam</option>
        <option value="Guatemala">&#x1F1EC&#x1F1F9 Guatemala</option>
        <option value="Guinea">&#x1F1EC&#x1F1F3 Guinea</option>
        <option value="Guinea - Bissau">&#x1F1EC&#x1F1FC Guinea - Bissau</option>
        <option value="Guyana">&#x1F1EC&#x1F1FE Guyana</option>
        <option value="Haiti">&#x1F1ED&#x1F1F9 Haiti</option>
        <option value="Honduras">&#x1F1ED&#x1F1F3 Honduras</option>
        <option value="Hong Kong">&#x1F1ED&#x1F1F0 Hong Kong</option>
        <option value="Hungary">&#x1F1ED&#x1F1FA Hungary</option>
        <option value="Iceland">&#x1F1EE&#x1F1F8 Iceland</option>
        <option value="India">&#x1F1EE&#x1F1F3 India</option>
        <option value="Indonesia">&#x1F1EE&#x1F1E9 Indonesia</option>
        <option value="Iran">&#x1F1EE&#x1F1F7 Iran</option>
        <option value="Iraq">&#x1F1EE&#x1F1F6 Iraq</option>
        <option value="Ireland">&#x1F1EE&#x1F1EA Ireland</option>
        <option value="Israel">&#x1F1EE&#x1F1F1 Israel</option>
        <option value="Italy">&#x1F1EE&#x1F1F9 Italy</option>
        <option value="Ivory Coast">&#x1F1E8&#x1F1EE Ivory Coast</option>
        <option value="Jamaica">&#x1F1EF&#x1F1F2 Jamaica</option>
        <option value="Japan">&#x1F1EF&#x1F1F5 Japan</option>
        <option value="Jordan">&#x1F1EF&#x1F1F4 Jordan</option>
        <option value="Kazakhstan">&#x1F1F0&#x1F1FF Kazakhstan</option>
        <option value="Kenya">&#x1F1F0&#x1F1EA Kenya</option>
        <option value="Kiribati">&#x1F1F0&#x1F1EE Kiribati</option>
        <option value="Korea, North">&#x1F1F0&#x1F1F5 Korea, North</option>
        <option value="Korea, South">&#x1F1F0&#x1F1F7 Korea, South</option>
        <option value="Kosovo">&#x1F1FD&#x1F1F0 Kosovo</option>
        <option value="Kuwait">&#x1F1F0&#x1F1FC Kuwait</option>
        <option value="Kyrgyzstan">&#x1F1F0&#x1F1EC Kyrgyzstan</option>
        <option value="Laos">&#x1F1F1&#x1F1E6 Laos</option>
        <option value="Latvia">&#x1F1F1&#x1F1FB Latvia</option>
        <option value="Lebanon">&#x1F1F1&#x1F1E7 Lebanon</option>
        <option value="Lesotho">&#x1F1F1&#x1F1F8 Lesotho</option>
        <option value="Liberia">&#x1F1F1&#x1F1F7 Liberia</option>
        <option value="Libya">&#x1F1F1&#x1F1FE Libya</option>
        <option value="Liechtenstein">&#x1F1F1&#x1F1EE Liechtenstein</option>
        <option value="Lithuania">&#x1F1F1&#x1F1F9 Lithuania</option>
        <option value="Luxembourg">&#x1F1F1&#x1F1FA Luxembourg</option>
        <option value="Macao">&#x1F1F2&#x1F1F4 Macao</option>
        <option value="Macedonia">&#x1F1F2&#x1F1F0 Macedonia</option>
        <option value="Madagascar">&#x1F1F2&#x1F1EC Madagascar</option>
        <option value="Malawi">&#x1F1F2&#x1F1FC Malawi</option>
        <option value="Malaysia">&#x1F1F2&#x1F1FE Malaysia</option>
        <option value="Maldives">&#x1F1F2&#x1F1FB Maldives</option>
        <option value="Mali">&#x1F1F2&#x1F1F1 Mali</option>
        <option value="Malta">&#x1F1F2&#x1F1F9 Malta</option>
        <option value="Marshall Islands">&#x1F1F2&#x1F1ED Marshall Islands</option>
        <option value="Martinique">&#x1F1F2&#x1F1F6 Martinique</option>
        <option value="Mauritania">&#x1F1F2&#x1F1F7 Mauritania</option>
        <option value="Mauritius">&#x1F1F2&#x1F1FA Mauritius</option>
        <option value="Mayotte">&#x1F1FE&#x1F1F9 Mayotte</option>
        <option value="Mexico">&#x1F1F2&#x1F1FD Mexico</option>
        <option value="Micronesia">&#x1F1EB&#x1F1F2 Micronesia</option>
        <option value="Moldova">&#x1F1F2&#x1F1E9 Moldova</option>
        <option value="Monaco">&#x1F1F2&#x1F1E8 Monaco</option>
        <option value="Mongolia">&#x1F1F2&#x1F1F3 Mongolia</option>
        <option value="Montenegro">&#x1F1F2&#x1F1EA Montenegro</option>
        <option value="Montserrat">&#x1F1F2&#x1F1F8 Montserrat</option>
        <option value="Morocco">&#x1F1F2&#x1F1E6 Morocco</option>
        <option value="Mozambique">&#x1F1F2&#x1F1FF Mozambique</option>
        <option value="Myanmar">&#x1F1F2&#x1F1F2 Myanmar</option>
        <option value="Namibia">&#x1F1F3&#x1F1E6 Namibia</option>
        <option value="Nauru">&#x1F1F3&#x1F1F7 Nauru</option>
        <option value="Nepal">&#x1F1F3&#x1F1F5 Nepal</option>
        <option value="Netherlands">&#x1F1F3&#x1F1F1 Netherlands</option>
        <option value="New Caledonia">&#x1F1F3&#x1F1E8 New Caledonia</option>
        <option value="New Zealand">&#x1F1F3&#x1F1FF New Zealand</option>
        <option value="Nicaragua">&#x1F1F3&#x1F1EE Nicaragua</option>
        <option value="Niger">&#x1F1F3&#x1F1EA Niger</option>
        <option value="Nigeria">&#x1F1F3&#x1F1EC Nigeria</option>
        <option value="Niue">&#x1F1F3&#x1F1FA Niue</option>
        <option value="Norfolk Islands">&#x1F1F3&#x1F1EB Norfolk Islands</option>
        <option value="Northern Mariana Islands">&#x1F1F2&#x1F1F5 Northern Mariana Islands</option>
        <option value="Norway">&#x1F1F3&#x1F1F4 Norway</option>
        <option value="Oman">&#x1F1F4&#x1F1F2 Oman</option>
        <option value="Pakistan">&#x1F1F5&#x1F1F0 Pakistan</option>
        <option value="Palau">&#x1F1F5&#x1F1FC Palau</option>
        <option value="Palestine">&#x1F1F5&#x1F1F8 Palestine</option>
        <option value="Panama">&#x1F1F5&#x1F1E6 Panama</option>
        <option value="Papua New Guinea">&#x1F1F5&#x1F1EC Papua New Guinea</option>
        <option value="Paraguay">&#x1F1F5&#x1F1FE Paraguay</option>
        <option value="Peru">&#x1F1F5&#x1F1EA Peru</option>
        <option value="Philippines">&#x1F1F5&#x1F1ED Philippines</option>
        <option value="Poland">&#x1F1F5&#x1F1F1 Poland</option>
        <option value="Portugal">&#x1F1F5&#x1F1F9 Portugal</option>
        <option value="Puerto Rico">&#x1F1F5&#x1F1F7 Puerto Rico</option>
        <option value="Qatar">&#x1F1F6&#x1F1E6 Qatar</option>
        <option value="Réunion">&#x1F1F7&#x1F1EA Réunion</option>
        <option value="Romania">&#x1F1F7&#x1F1F4 Romania</option>
        <option value="Russia">&#x1F1F7&#x1F1FA Russia</option>
        <option value="Rwanda">&#x1F1F7&#x1F1FC Rwanda</option>
        <option value="Samoa">&#x1F1FC&#x1F1F8 Samoa</option>
        <option value="San Marino">&#x1F1F8&#x1F1F2 San Marino</option>
        <option value="São Tomé &amp; Principe">&#x1F1F8&#x1F1F9 São Tomé &amp; Principe</option>
        <option value="Saudi Arabia">&#x1F1F8&#x1F1E6 Saudi Arabia</option>
        <option value="Senegal">&#x1F1F8&#x1F1F3 Senegal</option>
        <option value="Serbia">&#x1F1F7&#x1F1F8 Serbia</option>
        <option value="Seychelles">&#x1F1F8&#x1F1E8 Seychelles</option>
        <option value="Sierra Leone">&#x1F1F8&#x1F1F1 Sierra Leone</option>
        <option value="Singapore">&#x1F1F8&#x1F1EC Singapore</option>
        <option value="Slovakia">&#x1F1F8&#x1F1F0 Slovakia</option>
        <option value="Slovenia">&#x1F1F8&#x1F1EE Slovenia</option>
        <option value="Solomon Islands">&#x1F1F8&#x1F1E7 Solomon Islands</option>
        <option value="Somalia">&#x1F1F8&#x1F1F4 Somalia</option>
        <option value="South Africa">&#x1F1FF&#x1F1E6 South Africa</option>
        <option value="South Sudan">&#x1F1F8&#x1F1F8 South Sudan</option>
        <option value="Spain">&#x1F1EA&#x1F1F8 Spain</option>
        <option value="Sri Lanka">&#x1F1F1&#x1F1F0 Sri Lanka</option>
        <option value="St. Helena">&#x1F1F8&#x1F1ED St. Helena</option>
        <option value="St. Kitts and Nevis">&#x1F1F0&#x1F1F3 St. Kitts and Nevis</option>
        <option value="St. Lucia">&#x1F1F1&#x1F1E8 St. Lucia</option>
        <option value="St. Pierre and Miquelon">&#x1F1F5&#x1F1F2 St. Pierre and Miquelon</option>
        <option value="Sudan">&#x1F1F8&#x1F1E9 Sudan</option>
        <option value="Suriname">&#x1F1F8&#x1F1F7 Suriname</option>
        <option value="Sweden">&#x1F1F8&#x1F1EA Sweden</option>
        <option value="Switzerland">&#x1F1E8&#x1F1ED Switzerland</option>
        <option value="Syria">&#x1F1F8&#x1F1FE Syria</option>
        <option value="Taiwan">&#x1F1F9&#x1F1FC Taiwan</option>
        <option value="Tajikstan">&#x1F1F9&#x1F1EF Tajikstan</option>
        <option value="Tanzania">&#x1F1F9&#x1F1FF Tanzania</option>
        <option value="Thailand">&#x1F1F9&#x1F1ED Thailand</option>
        <option value="Togo">&#x1F1F9&#x1F1EC Togo</option>
        <option value="Tokelau">&#x1F1F9&#x1F1F0 Tokelau</option>
        <option value="Tonga">&#x1F1F9&#x1F1F4 Tonga</option>
        <option value="Trinidad &amp; Tobago">&#x1F1F9&#x1F1F9 Trinidad &amp; Tobago</option>
        <option value="Tunisia">&#x1F1F9&#x1F1F3 Tunisia</option>
        <option value="Turkey">&#x1F1F9&#x1F1F7 Turkey</option>
        <option value="Turkmenistan">&#x1F1F9&#x1F1F2 Turkmenistan</option>
        <option value="Turks &amp; Caicos Islands">&#x1F1F9&#x1F1E8 Turks &amp; Caicos Islands</option>
        <option value="Tuvalu">&#x1F1F9&#x1F1FB Tuvalu</option>
        <option value="Uganda">&#x1F1FA&#x1F1EC Uganda</option>
        <option value="Ukraine">&#x1F1FA&#x1F1E6 Ukraine</option>
        <option value="United Arab Emirates">&#x1F1E6&#x1F1EA United Arab Emirates</option>
        <option value="United Kingdom">&#x1F1EC&#x1F1E7 United Kingdom</option>
        <option value="United States of America">&#x1F1FA&#x1F1F8 United States of America</option>
        <option value="Uruguay">&#x1F1FA&#x1F1FE Uruguay</option>
        <option value="Uzbekistan">&#x1F1FA&#x1F1FF Uzbekistan</option>
        <option value="Vanuatu">&#x1F1FB&#x1F1FA Vanuatu</option>
        <option value="Vatican City">&#x1F1FB&#x1F1E6 Vatican City</option>
        <option value="Venezuela">&#x1F1FB&#x1F1EA Venezuela</option>
        <option value="Vietnam">&#x1F1FB&#x1F1F3 Vietnam</option>
        <option value="Virgin Islands - British">&#x1F1FB&#x1F1EC Virgin Islands - British</option>
        <option value="Virgin Islands - US">&#x1F1FB&#x1F1EE Virgin Islands - US</option>
        <option value="Wallis &amp; Futuna">&#x1F1FC&#x1F1EB Wallis &amp; Futuna</option>
        <option value="Western Sahara">&#x1F1EA&#x1F1ED Western Sahara</option>
        <option value="Yemen">&#x1F1FE&#x1F1EA Yemen</option>
        <option value="Zambia">&#x1F1FF&#x1F1F2 Zambia</option>
        <option value="Zimbabwe">&#x1F1FF&#x1F1FC Zimbabwe</option>
    </select>
    </div>
    <div>
      <button type="submit">Guardar</button>
    </div>
  <?php echo form_close(); ?>
</body>
</html>
