<?php 
include_once dirname(__FILE__).'/MessageForm.php';
class MessageDraftEditForm extends MessageForm
{
	public function fetchData()
	{
		$_GET["F"]='RPCInvoke';
		return parent::fetchData();
	}	
}
?>