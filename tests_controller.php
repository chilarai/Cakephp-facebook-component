<?php
/*
 * Name : tests_controller.php
 * Cakephp Controller to integrate with Facebook
 * Copyright (C) 2011,  Chilarai Mushahary.
 * Write to me at : chilly5476@hotmail.com 
 * http:www.wreken.com/facebook-component
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
 * along with this program.  If not, see <http:www.gnu.org/licenses/>.
 *
*/
class TestsController extends AppController {
	var $name = 'Tests';
	var $components = array('Facebook');
	var $uses = NULL;
	
	
	function index()
	{
		//Get user details from facebook
		$get_UserDetails = $this->Facebook->getMyDetails();

		//Check if the User is loggedin
		if($get_UserDetails['status']== 0) 	{
			//	 if user not logged in facebook, prompt for login
				echo '<script>top.location="'.appUrl().'";</script>';
		}
		else{
			//User Loggedin
			$array_UserDetail =json_decode(file_get_contents($get_UserDetails["object"]),true);
		}
	
	
?>		

