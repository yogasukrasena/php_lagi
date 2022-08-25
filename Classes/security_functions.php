<?php

class security_functions
{	
	var $conn;
	var $lang;
	var $tblprefix;
	
	//defalt constructor which first checks if page is accessable.
	function security_functions($dbf,$page_type,$language)
	{
		//pre: $dbf must be a db_functions object and $page_type must be a string
		//post: denies access to page and stops php processing
		
		//$page_type will be either: Public, Admin, R&D-Collection, or Administration.
		//$usertype will be either: Admin, R&D-Collection, or Administration.
		//Their must be a session present in order to execute authoization.
		
		//sets class variables.
		$this->conn=$dbf->conn;
		$this->lang=$language;
		$this->tblprefix=$dbf->tblprefix;
		
		if(isset($_SESSION['session_user_name']))
		{
			$user_name=$_SESSION['session_user_name'];
			
			$tablename="$this->tblprefix".'tbluser';
			$result = mysql_query ("SELECT * FROM $tablename WHERE UserName=\"$user_name\"",$this->conn);
			$row = mysql_fetch_assoc($result);
			$usertype= $row['type'];
			
			
			//If the page is not public or the user is not an Admin, investigation must continue.
			if($page_type!='Public' or $usertype!='Admin')
			{
				if($usertype!='Admin' and $usertype!='Rnd' and $usertype!='Costing' and $usertype!='Administration')
				{
					//makes sure $usertype is not anything but Admin, Sales Clerk, Report Viewer

					echo "{$this->lang->attemptedSecurityBreech}";
					exit();
				}
				elseif($page_type!='Public' and $page_type!='Admin' and $page_type!='RnD' and $page_type!='Costing' and $page_type!='Administration')
				{
					//makes sure $page_type is not anything but Public, Admin, Sales Clerk or Report Viewer.

					echo "{$this->lang->attemptedSecurityBreech}";				
					exit();
				
				}
				elseif($usertype!='Admin' and $page_type=='Admin')
				{
					//if page is only intented for Admins but the user is not an admin, access is denied.

					echo "{$this->lang->mustBeAdmin}";				
					exit();	
				}
				elseif(($usertype=='RnD') and $page_type =='Administration')
				{
					//Page is only intented for Report Viewers and Admins.
					
					echo "{$this->lang->mustBeReportOrAdmin}";				
					exit();
				}
				elseif(($usertype=='Administration') and $page_type =='RnD')
				{
					//Page is only intented for Sales Clerks and Admins.
					
					echo "{$this->lang->mustBeSalesClerkOrAdmin}";				
					exit();
				}
			}
		}
	}
	
	function isLoggedIn()
	{
		//returns boolean based on if user is logged in.
		
		if(isset($_SESSION['session_user_id']))
		{
			$user_id=$_SESSION['session_user_id'];
			$tablename="$this->tblprefix".'tbluser';
			$result = mysql_query ("SELECT * FROM $tablename WHERE id=\"$user_id\"",$this->conn);
			$num = @mysql_num_rows($result);
			if($num> 0)
			{
				return true;
			}
			else
			{
			
				return false;
			}
		}
		return false;
	}
	
	function checkLogin($username,$password)
	{
		//pre: $username and $password must be strings. ($password is encrypted)
		//post: returns boolean based on if their login was succesfull.
		
		$tablename="$this->tblprefix".'tbluser';
		$result = mysql_query ("SELECT * FROM $tablename WHERE username=\"$username\" and password=\"$password\"",$this->conn);	
		$num = @mysql_num_rows($result);
		
		if($num > 0)
		{
			return true;
		}
		
		return false;
	}

	function closeSale()
	{
		//deletes sessions vars 
		session_unregister('items_in_sale'); 
    	session_unregister('current_sale_customer_id'); 
    	session_unregister('current_item_search'); 
    	session_unregister('current_customer_search'); 

	}
}

?>