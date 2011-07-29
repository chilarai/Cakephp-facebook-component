# FACEOOK CAKEPHP INTEGRATION

* Version 1.5

* Author : Chilarai Mushahary

* Email : chilly5476@gmail.com

* Language: Php

* License: GNU/GPL

#### Please use the code from cakephp_facebook_integration_full_app_with_cakephp1_3_8_autoInstaller.tar.gz for latest updated code




# CHANGELOG 1.3

* 1.	Added 'app.tar.gz'.

* 2.	Improvement in application access

* 3.	Added 'canvas page url' in config.php to directly access the application.

* 4.	Automatic display of relevant pages (login, permissions page, etc) in any actions that you call

* 5.	Removed loopback in default.ctp

* 6.	Complete 'app folder' with tests_controller and view files.




# CHANGELOG 1.4

* 1.	Added sample tests_controller with the new component

* 2.	Help file update




# CHANGELOG 1.5

* 1.	Added friend request, app request, gift request

* 2.	Operate on the request ids from app requests and delete the request from facebook once clicked on the link 

* 3.	Get the 'facebook_access_token' by calling the function directly from the component wherever in the controller

* 4.	Get your friends' profile picture from your controller

* 5		Auto logout from app when logged out of facebook

* 6.	All codes modified in app.tar.gz. Latest code updated for the new component

* 7.	Updated Help file




# NEXT CHANGELOG

* 1.	Embed youtube, mp3 in the facebook wall posts with the new facebook-api

* 2.	Full pledged support for facebook-javascript sdk

* 3.	Will be based on the same component. So dont have to worry about the existing codes	




# NOTE :	
IN CASE YOU WANT TO COPY THE 'app' FOLDER, EXTRACT THE app.tar.gz AND REPLACE YOUR app FOLDER IN CAKEPHP.
ELSE IN CASE YOU FOLLOW THE STEPS BELOW, COPY THE 'facebook.php' COMPONENT FROM APP.TAR.GZ FILE. IT HAS SOME UPDATED CODE




# CONFIGURATION

* 1.Uncompress and copy the whole "facebook" folder in your `app/vendors/`

* 2.Copy the following in the bottom most section of your `app/config/core.php` file:
	(you can go to "http://facebook.com/developers/apps.php" to see your application. To create new app goto http://facebok.com/developers/createapp.php)
	
	Configure::write('AppId','YOUR_APP_ID'); //--> from facebook app page

	Configure::write('AppKey','YOUR_API_KEY');	//--> from your facebook app page

	Configure::write('AppSecret','YOUR_APP_SECRET');	//--> from your facebook app page

	Configure::write('AppUri','APP_ADDRESS');	//--> your app folder (eg localhost/cake)
       
    Configure::write('CanvasPage','CANVAS_PAGE_URL');	//--> your canvas page (eg http://apps.facebook.com/APP_NAME)
    
    
    All these parameters are obtained from facebook. visit http://facebook.com/developers/apps.php to see your apps

 	
 	
* 3.Copy `facebook.php` file in your `app/controllers/components/` folder 

* 4.Go to your application page in facebook and click on `edit_settings`. Go to `website` link and then do as follows:
	
	Type `http://server_address/path_to_your_app/` (remember to put the backslash in the end) in the first text field (eg. http://localhost/app_path)
	Type `server_address` in the second text field (eg, localhost)

5.	Copy `default.ctp` file in your `app/views/layouts/` folder
	




## BUGFIXES 

*1.  I have found many people complaining in the forums about the app not loggin out by itself when loogin out of the facebook. I have modified the component to kill the existing cookies and the sessions in the component once you logout from facebook. You need not do anything in the code itself. The component itself will handle it.

*2.  The existing data about facebook maintaining its own session and not allowing to create our own sessions is invalid.
Facebook do allows you to maintain sessions but any major change that you do in your code with cakephp takes some time for facebook to ammend in its canvas. Hence, if you have developed any code and you feel it is not behaving properly but the code is absolutely right, then wait for sometime and maybe try to call the url from facebook directly for few times and then it will work alright

------------------------------------------------------------------



### NB: IMPORTANT


#### To Facebook game requests instead of app requests you do not need to change in the code. You have to modify the settings in the application. To do that you need to:

1. Go to http://facebook.com/developers/apps.php
2. Go to application profile page
3. Edit app
4. Set application as game or any other app according to the app content
 
 
#### Deleting app request once you click on the Accept button
Facebook by default does not delete your app request which your app sends, you need to do it through your app itself.
	ie, if some user x in Mafia Wars sends you a healthdrink and you click on the accept button, the request doesnot go away by itself. Mafia wars delete the request and not facebook. 
	 
	 
#### Remember, when you click on the accept button, you get both post and get requests
	The get request will get you the request id of the request
	The post request will contain all the data. ie request_id, sender_id, receiver_id, message, etc





## EXAMPLES


* In any controller, import the facebook component as:
	
	var $components = array('Facebook');

* Then in any of the functions/actions you can type the following:

		* To get the access token
		debug(file_get_contents($this->Facebook->getAccessToken());
		
		* To get your "friend list", type
		debug(json_decode(file_get_contents($this->Facebook->getFriends()),true);

		* To get your "own details", type
		debug(json_decode(file_get_contents($this->Facebook->getMyDetails())),true);
	
		* To get your "profile picture", type
		debug($this->Facebook->getProfilePicture($facebook_id=null));
		where 
			$facebook_id = facebook id of the user
			if $facebook_id == null, you will get your own profile picture
	
		* To see if you have any request for this "application pending", type
		debug($this->Facebook->getAppRequests());
	
		* To see all your "albums", type
		debug(json_decode(file_get_contents($this->Facebook->getAlbums())),true);
	
		*To post on your "wall"
		debug($this->Facebook->postWall($mainHeader, $subHeader=null, $appLink, $appName, $description, $pictureLink=null));
		where, 
			$subHeader and $pictureLink are optional
	
		* To "send app requests"
		debug($this->Facebook->appRequest($message, $page=null, $data=null));
		where 
			$message = message to appear in the send app request box
			$page = page to redirect once the send request is done (if null redirect to the app uri)
			$data = additional data to be passed from the sender (optional)
	
	
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


