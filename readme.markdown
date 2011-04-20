# FACEOOK CAKEPHP INTEGRATION

* Version 1.4

* Author : Chilarai Mushahary

* Email : chilly5476@gmail.com

* Language: Php

* License: GNU/GPL

# CHANGELOG 1.3

* 1.	Added 'app.tar.gz'.

* 2.	Improvement in application access

* 3.	Added 'canvas page url' in config.php to directly access the application.

* 4.	Automatic display of relevant pages (login, permissions page, etc) in any actions that you call

* 5.	Removed loopback in default.ctp

* 6.	Complete 'app folder' with tests_controller and view files.

CHANGELOG 1.4

* 1.	Added sample tests_controller with the new component

* 2.	Help file update

* 3.	Added sample tests_controller.php


# NOTE :	
IN CASE YOU WANT TO COPY THE 'app' FOLDER, EXTRACT THE app.tar.gz AND REPLACE YOUR app FOLDER IN CAKEPHP.
ELSE IN CASE YOU FOLLOW THE STEPS BELOW, COPY THE 'facebook.php' COMPONENT FROM APP.TAR.GZ FILE. IT HAS SOME UPDATED CODE

# CONFIGURATION

* 1.Uncompress and copy the whole "facebook" folder in your `app/vendors/`

* 2.Copy the following in the bottom most section of your `app/config/core.php` file:
	(you can go to "http://facebook.com/developers/apps.php" to see your application. To create new app goto http://facebok.com/developers/createapp.php)
	
	`Configure::write('AppId','YOUR_APP_ID'); //--> from facebook app page`

	`Configure::write('AppKey','YOUR_API_KEY');	//--> from your facebook app page`

	`Configure::write('AppSecret','YOUR_APP_SECRET');	//--> from your facebook app page`

	`Configure::write('AppUri','APP_ADDRESS');	//--> your app folder (eg localhost/cake)`
       
   ` Configure::write('CanvasPage','CANVAS_PAGE_URL');	//--> your canvas page (eg http://apps.facebook.com/APP_NAME)``
    
    
    All these parameters are obtained from facebook. visit http://facebook.com/developers/apps.php to see your apps

 	
 	
* 3.Copy `facebook.php` file in your `app/controllers/components/` folder 

* 4.Go to your application page in facebook and click on `edit_settings`. Go to `website` link and then do as follows:
	
	Type `http://server_address/path_to_your_app/` (remember to put the backslash in the end) in the first text field (eg. http://localhost/app_path)
	Type `server_address` in the second text field (eg, localhost)

5.	Copy `default.ctp` file in your `app/views/layouts/` folder
	

## IMPORTANT 
Do not use cakephp `$this->Session->write()` and `$this->redirect()`. Try to avoid them
If you use them, the app will work perfectly in the server but will show bad looping behaviour in the canvas. Your app might even redirect back to the main server from the facebook app canvas.

Facebook maintains its own session. You can obtain the data from facebook using the accessToken provided already in this component. Read through and you will understand

## EXAMPLES


* In any controller, import the facebook component as:
	
	var $components = array('Facebook');

* Then in any of the functions/actions you can type the following:

		* To get your "friend list", type
		`debug(json_decode(file_get_contents($this->Facebook->getFriends()),true);`

		* To get your "own details", type
		`debug(json_decode(file_get_contents($this->Facebook->getMyDetails())),true);`
	
		* To get your "profile picture", type
		`debug($this->Facebook->getProfilePicture());`
	
		* To see if you have any request for this "application pending", type
		`debug($this->Facebook->getAppRequests());`
	
		* To see all your "albums", type
		`debug(json_decode(file_get_contents($this->Facebook->getAlbums())),true);`
	
		*To post on your "wall"
		`debug($this->Facebook->postWall($mainHeader, $subHeader, $appLink, $appName, $description, $pictureLink));`
	
		* To "invite friends"
		`debug($this->Facebook->appRequest($canvasPage, $message));`
	
	
We can do a lot more, but till now, I have written only these. You can access your pictures, comments, wall, about_me, etc and a lot more.
In future, the intention of this program is to write a full pledged plugin, so that a developer is able to import the plugin to readily integrate with cakephp and facebook.


#Cakephp-Facebook-Component
The Cakephp-Facebook-Component is written in PHP and is an open source software. The purpose of the code is to provide a general purpose cakephp component to build and integrate with an application. Main modules of the component are described here

### Main Modules 
***
** 1.facebook.php **<br/>
** 2.default.ctp **<br/>
** 3.facebook-php api (the facebook.tar.gz file) **<br/>
** 4.README **<br/>

### Description
***
** 1.facebook.php : **<br/>
In the source code, the facebook.php describes the main component. This component accesses the data from the facebook using the api provided in the facebook folder. The component contains the class which describes the use of the functions in cakephp. Detailed usage of the functions can be found in the README file. Once you download the source code, copy and paste the file to:  `app/controllers/components/facebook.php`<br/>

** 2.default.ctp : **<br/>
This file contains two important parts, namely, (a) fbml type declaration at top and (b) javascript element to asynchronously connect to facebook api. Line 1 of default.ctp <br/>
`<?php $appId =  Configure::read('AppId');?>`<br/>
describes the inclusion of application id from the config file in cakephp which will be described later.The fbml type declaraion is written in line 2 of default.ctp<br/>
`<!doctype html><html xmlns:fb="http://www.facebook.com/2008/fbml">`<br/>
Just below the body tag in the default.ctp
`	<div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId   : '<?php echo $appId ?>',
          session : '<?php echo json_encode($session); ?>', // don't refetch the session when PHP already has it
          status  : true, // check login status
          cookie  : true, // enable cookies to allow the server to access the session
          xfbml   : true // parse XFBML
        });

        // whenever the user logs in, we refresh the page
        FB.Event.subscribe('auth.login', function() {
       //   window.location.reload();
        });
      };

      (function() {
        var e = document.createElement('script');
        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
      }());
    </script>`
loads the javascript to asynchronously connect to the facebook application.<br/>

** 3.facebook folder : **<br/>
This is the official facebook-api which can also  be downloaded from [https://github.com/facebook/php-sdk/](https://github.com/facebook/php-sdk/). Extract the archived data and dump the whole folder to `app/vendors/facebook/`. 

** 3.README : **<br/>
README file describes the rest of the setup and example usage of the component. Before you can use the component, you have to setup your `app/config.core.php` file in cakephp. Add the following lines before the the end php tag (?>) in your core.php file<br/>`
	Configure::write('AppId','YOUR_APP_ID'); //--> from facebook app page<br/>
  	Configure::write('AppKey','YOUR_API_KEY');	//--> from your facebook app page<br/>
  	Configure::write('AppSecret','YOUR_APP_SECRET');	//--> from your facebook app page<br/>
  	Configure::write('AppUri','APP_ADDRESS');	//--> your app folder (eg localhost/cake)<br/>
    Configure::write('CanvasPage','CANVAS_PAGE_URL');  //--> your canvas page (eg http://apps.facebook.com/APP_NAME)<br/>
`
These details can be obtained from facebook once you set up a new application.

This handles the installation of the component. Hope you enjoy doing it


