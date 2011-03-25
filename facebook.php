<?php
/*
 * Name : facebook.php
 * Cakephp Component to integrate with Facebook
 * Copyright (C) 2011,  Chilarai Mushahary.
 * Write to me at : chilly5476@hotmail.com 
 * http://www.wreken.com/facebook-component
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
*/
App::import('Vendor','facebook',array('file'=>'src/facebook.php'));

/* Initialise session, check session and get login/logout url*/
    
function init() {
	$facebook = new Facebook(array(
	  'appId'  => Configure::read('AppId'),
	  'secret' => Configure::read('AppSecret'),
	  'cookie' => true,
	));
	$session = $facebook->getSession();
	$me = null;
	// Session based API call.
	if ($session) {
	  try {
		$uid = $facebook->getUser();
		$me = $facebook->api('/me');
	  } catch (FacebookApiException $e) {
		error_log($e);
	  }
	}
	$retVar['object'] = $facebook;
	if ($me){
		 $retVar['status'] = 1; // active session
	}
	else {
		$retVar['status'] = 0; // no session
	}
	return $retVar;
}

function appUrl() {
	$facebook = init();
	if($facebook['status'] == 0) {
		$appId = Configure::read('AppId');
		$uri = Configure::read('AppUri');
		$scope = "user_photos,email,user_birthday,user_online_presence,offline_access,publish_stream";
		$loginUrl = $facebook['object']->getLoginUrl(
			array(
			    'canvas' => 1,
			    'fbconnect' => 0,
			    'req_perms' => $scope
			)
		);
		//echo '<script>top.location="'.$loginUrl.'";</script>';
		return $loginUrl;
	}
}
class FacebookComponent extends Object {
	 var $controller = true;
     var $Session;
     
	 function startup(&$controller) {
        $this->Session = $controller->Session;
    }

    function getFriends() {
		  $facebook = init();
		  if($facebook['status'] == 1){
		  	$path['object'] = 'https://graph.facebook.com/me/friends?access_token='.$facebook['object']->getAccessToken();
		  	$path['status'] = 1;
		  }
		  else {
				$path['object'] = appUrl();
				$path['status'] = 0;	
		  }
    	 
    	  return $path;
    }
    
    function getMyDetails() {
    	  $facebook = init();
		  if($facebook['status'] == 1){
		  	$path['object'] = 'https://graph.facebook.com/me?access_token='.$facebook['object']->getAccessToken();
		  	$path['status'] = 1;
		  }
		  else {
		  	$path['object'] = appUrl();
		  	$path['status'] = 0;
		  }
    	  
    	  return $path;
    }
    
    function getProfilePicture() {
    	  $facebook = init();
		  if($facebook['status'] == 1){
		  	$path['object'] = 'https://graph.facebook.com/me/picture?access_token='.$facebook['object']->getAccessToken();
		  	$path['status'] = 1;
		  }
		  else {
		  	$path['object'] = appUrl();
		  	$path['status'] = 0;
		  }
    	  
    	  return $path;
    }
    
    function getAppRequests() {
    	  $facebook = init();
		  if($facebook['status'] == 1){
		  	$path['object'] = 'https://graph.facebook.com/me/apprequests?access_token='.$facebook['object']->getAccessToken();
		  	$path['status'] = 1;
		  }
		  else {
		  	$path['object'] = appUrl();
		  	$path['status'] = 0;
		  }
    	  
    	  return $path;
    }
    
    function getAlbums() {
    	  $facebook = init();
		  if($facebook['status'] == 1){
		  	$path['object'] = 'https://graph.facebook.com/me/albums?access_token='.$facebook['object']->getAccessToken();
		  	$path['status'] = 1;
		  }
		  else {
		  	$path['object'] = appUrl();
		  	$path['status'] = 0;
		  }
    
    	  return $path;
    }
    
    function postWall($heading,$subheading=NULL,$appLink,$appName,$description,$pictureLink=NULL) {
    	  $facebook = init();
		  if($facebook['status'] == 1){			  		
			$attachment = array(
			  'message' => $heading,
			  'caption' => $subheading,
			  'link' => $appLink, 
			  'name' => $appName,
			  'description' => $description,
			  'picture' => $pictureLink,
			  'privacy' => array('value' => 'EVERYONE'),
			  'actions' => '',
			  'cb' => ''
			);
			$path['object'] = NULL;
			$path['status'] = 1;
			$facebook['object']->api('/me/feed', 'post', $attachment);
		  }
		  else {
		  	$path['object'] = appUrl();
		  	$path['status'] = 0;
		  }
	 
    	  return $path;
    }
    
    function appRequest($message) {
    	$facebook = init();
		  if($facebook['status'] == 1){	
   			 $app_id = Configure::read('AppId');
        	 $canvas_page = Configure::read('CanvasPage');
         	 $message = $message;
        	 $requests_url = "http://www.facebook.com/dialog/apprequests?app_id=" 
                . $app_id . "&redirect_uri=" . urlencode($canvas_page)
                . "&message=" . $message;

		     if (empty($_REQUEST["request_ids"])) {
		     	$path['object'] = $requests_url;
		     	$path['status'] = 1;
		     } 
		     else {
		        $path['object'] = $_REQUEST['request_ids'];
		        $this->Session->setFlash($path['object']);        
		     }
    	}
    	else {
		  	$path['object'] = appUrl();
		  	$path['status'] = 0;
		  }
    	return $path;
    }
    
}
?>
