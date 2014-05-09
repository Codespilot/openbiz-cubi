<?php 
require_once MODULE_PATH.'/websvc/lib/WebsvcService.php';
class userService extends  WebsvcService
{
	protected $username;
	protected $password;
	protected $smartcard;

    /**
     * login action
     *
     * @return void
     */
    public function login($username=null, $password=null)
    {
	  	/*try
        {
            $this->ValidateForm();
        }
        catch (ValidationException $e)
        {        	
            $this->processFormObjError($e->m_Errors);
            return;
        }*/

	  	// get the username and password	
		$this->username = $username;
		$this->password = $password;		
		$this->smartcard = null;
		
		
		global $g_BizSystem;		
		$eventlog 	= BizSystem::getService(EVENTLOG_SERVICE);
		try {
    		if ($this->authUser()) 
    		{
                // after authenticate user: 1. init profile
    			$profile = $g_BizSystem->InitUserProfile($this->username);
    	   	   
    			// after authenticate user: 2. insert login event
    			$logComment=array(	$this->username, $_SERVER['REMOTE_ADDR']);
    			$eventlog->log("LOGIN", "MSG_LOGIN_SUCCESSFUL", $logComment);
    			
    			// after authenticate user: 3. update login time in user record
    	   	    if (!$this->UpdateloginTime())
    	   	        return false;
    	   	            	   	        
    	   	    // after authenticate user: 3. update current theme and language
       			$currentLanguage = BizSystem::ClientProxy()->getFormInputs("current_language");
   				if($currentLanguage!=''){
   				   	if($currentLanguage=='user_default'){
		   				$currentLanguage = DEFAULT_LANGUAGE;
		   			}else{
       					BizSystem::sessionContext()->setVar("LANG",$currentLanguage );
		   			}
   				}

				$currentTheme = BizSystem::ClientProxy()->getFormInputs("current_theme");
				if($currentTheme!=''){
					if($currentTheme=='user_default'){
		   				$currentTheme = DEFAULT_THEME_NAME;
		   			}else{
   						BizSystem::sessionContext()->setVar("THEME",$currentTheme );
		   			}
				}
    	   	   		
    	   	    $redirectPage = APP_INDEX.$profile['roleStartpage'][0];
    	   	   	if(!$profile['roleStartpage'][0])
    	   	   	{
    	   	   		$result['errors']['password'] = $this->getMessage("PERM_INCORRECT");
					$result['errors']['login_status'] = $this->getMessage("LOGIN_FAILED");
    				return $result;
    	   	   	}
    	   	    $cookies = BizSystem::ClientProxy()->getFormInputs("session_timeout");
    	   	    if($cookies)
    	   	    {
    	   	    	$password = $this->password;    	   	    	
    	   	    	$password = md5(md5($password.$this->username).md5($profile['create_time']));
    	   	    	setcookie("SYSTEM_SESSION_USERNAME",$this->username,time()+(int)$cookies,"/");
    	   	    	setcookie("SYSTEM_SESSION_PASSWORD",$password,time()+(int)$cookies,"/");
    	   	    }
    	   	    
    	   	    //if its admin first time login, then show init system wizard
    	   	    $initLock = APP_HOME.'/files/initialize.lock';
    	   	    if($profile['Id']==1 && !is_file($initLock))
    	   	    {
    	   	    	$redirectPage = APP_INDEX."/system/initialize";
    	   	    	return array('redirect'=>$redirectPage);
    	   	    }
    	   	    
    	   	    //if admin is not init profile yet
    			$initLock = APP_HOME.'/files/initialize_profile.lock';
    	   	    if($profile['Id']==1 && !is_file($initLock))
    	   	    {
    	   	    	$redirectPage = APP_INDEX."/system/initialize_profile";
    	   	    	return array('redirect'=>$redirectPage);
    	   	    }
    	   	    
    	   	    if($this->m_LastViewedPage!=""){
					return array('redirect'=>$this->m_LastViewedPage);
    	   	    }
				return array('redirect'=>$redirectPage);
    		}
    		else
    		{ 
    			switch($this->auth_method)
    			{
    				case "smartcard":
    					$logComment=array($this->smartcard);
    					$eventlog->log("LOGIN", "MSG_SMARTCARD_LOGIN_FAILED", $logComment);    					
    					$result['errors']['smartcard'] = $this->getMessage("SMARTCARD_INCORRECT");
						$result['errors']['login_status'] = $this->getMessage("LOGIN_FAILED");
    					break;
    				default:
						$logComment=array($this->username,
    								$_SERVER['REMOTE_ADDR'],
    								$this->password);
    					$eventlog->log("LOGIN", "MSG_LOGIN_FAILED", $logComment);
    					$result['errors']['password'] = $this->getMessage("PASSWORD_INCORRECT");  
						$result['errors']['login_status'] = $this->getMessage("LOGIN_FAILED");						
    					break;
    			} 			    			   			
    		}
    	}
    	catch (Exception $e) {    	
    		$result['errors']['login_status'] = $this->getMessage("LOGIN_FAILED");
    	}
		
		return $result;
    }
    
    protected function authUser()
    {
    	$svcobj 	= BizSystem::getService(AUTH_SERVICE);    	
    	switch($this->auth_method)
    	{
    		case "smartcard":
    			$result = $svcobj->authenticateUserBySmartCard($this->smartcard);
    			if($result!=false){
    				$this->username = $result;
    				$result = true;
    			}
    			break;
    		default:    			
    			$result = $svcobj->authenticateUser($this->username,$this->password);
    			break;	
    	}    	
    	return $result;
    }
   
    /**
     * Update login time
     *
     * @return void
     */
    protected function UpdateloginTime()
    {
        $userObj = BizSystem::getObject('system.do.UserDO');
        try {
            $curRecs = $userObj->directFetch("[username]='".$this->username."'", 1);
            if(count($curRecs)==0){
            	return false;
            }
            $dataRec = new DataRecord($curRecs[0], $userObj);            
            $dataRec['lastlogin'] = date("Y-m-d H:i:s");
            $ok = $dataRec->save();
            if (! $ok) {
                $errorMsg = $userObj->getErrorMessage();
                BizSystem::log(LOG_ERR, "DATAOBJ", "DataObj error = ".$errorMsg);
                BizSystem::ClientProxy()->showErrorMessage($errorMsg);
                return false;
            }
        } 
        catch (BDOException $e) 
        {
            $errorMsg = $e->getMessage();
            BizSystem::log(LOG_ERR, "DATAOBJ", "DataObj error = ".$errorMsg);
            BizSystem::ClientProxy()->showErrorMessage($errorMsg);
            return false;
        }
        return true;
   }
   
   public function ChangeLanguage(){
   		$currentLanguage = BizSystem::ClientProxy()->getFormInputs("current_language");
   		if($currentLanguage!=''){
   		   	if($currentLanguage=='user_default'){
   				$currentTheme = DEFAULT_LANGUAGE;
   			}else{
		   		BizSystem::sessionContext()->setVar("LANG",$currentLanguage );
				$this->m_Notices[] = "<script>window.location.reload()</script>";
		   		$this->UpdateForm();   
   			}				
   		}
   		return;
   }
   
   public function ChangeTheme(){
   		$currentTheme = BizSystem::ClientProxy()->getFormInputs("current_theme");
   		if($currentTheme!=''){
   			if($currentTheme=='user_default'){
   				$currentTheme = DEFAULT_THEME_NAME;
   			}else{
		   		BizSystem::sessionContext()->setVar("THEME",$currentTheme );
		   		$recArr = $this->readInputRecord();
        		$this->setActiveRecord($recArr);
				$this->m_Notices[] = "<script>window.location.reload()</script>";
		   		$this->UpdateForm(); 
   			}
   		} 
   		return;
   }

}
?>