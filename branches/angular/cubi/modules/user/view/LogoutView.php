<?php
/**
 * Openbiz Cubi Application Platform
 *
 * LICENSE http://code.google.com/p/openbiz-cubi/wiki/CubiLicense
 *
 * @package   cubi.user.view
 * @copyright Copyright (c) 2005-2011, Openbiz Technology LLC
 * @license   http://code.google.com/p/openbiz-cubi/wiki/CubiLicense
 * @link      http://code.google.com/p/openbiz-cubi/
 * @version   $Id$
 */

class LogoutView extends EasyView
{
    public function render()
    {
        $this->Logout();
    }
    
    public function Logout()
    {
		// destroy all data associated with current session:
		BizSystem::SessionContext()->destroy();
			
		// Redirect:
		if(isset($_GET['redirect_url'])) {
			$url = $_GET['redirect_url'];
		}
		else {
			$url = "login";	
		}
		
		header("Location: $url");
		exit;
    }
}
?>