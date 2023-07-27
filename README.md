# Codego Sandbox SDK core banking frontend

Codego Sandbox github is an demontration of how the sandbox api will work on your whitelabel system.To run this script you need to create sandbox account on https://apikey-sandbox.codegotech.com/ to get your api keys

##System Requirements manual installation
	PHP 8.0 or above

##what you need to do to see landing Page

1) Assuming your on Linux and have composer installed then all you have to do , clone or download git :

unpack downloaded zip file to say your Desktop.
and upload on your server


2) Make sure permissions are  read and write  for user, group and everybody else to the folder

##Make Changes in .htacess file on root

If the script has to run in a subfolder then define RewriteBase /yourfoldername  in .htacess file
But if its running on root then define RewriteBase /y

Ubuntu 22.04 automatic installation

in ssh ubuntu server digit
wget https://codegotech.com/install.sh
#chmod +x install.sh
#./install.sh 

##How to get credentials to get started

create a new sandbox account here https://apikey-sandbox.codegotech.com/  and you will get the credentials 

These credentials you have to set in file app\Config\Constants.php


define('CLIENT_KEY', '');       //copy paste client key here
define('SECRET_KEY', '');      //copy paste secret key here
define('API_KEY', '');		  //copy paste API key here
define('WHITELABEL_ID', ''); //copy paste whitelabel id here

##set the authentication token

To get a authentication token please run URL with https://yourdomain.com/authenticate an authentication code will be populated.Copy that code and set in file app\Config\Constants.php

define('AUTHTOKEN', '');  //copy paste authentication token here

Once you create the token remove the file app\Controllers\Auth.php from server


##Setup captcha keys

Before run the application you need to setup the google captcha keys
populate captcha keys for your server from here https://www.google.com/recaptcha/admin/create

Setup the keys here in file app\Config\Constants.php

define('GOOGLE_SITE_KEY', '');
define('GOOGLE_SECRET_KEY', '');
define('GOOGLE_HOST', '');


Once all these settings done start signup for your whitelabel https://yourdomain.com/signup

	
