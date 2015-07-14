<?php
//=================================================================================================
// Begin Class ajaxHandler
//=================================================================================================
abstract class baseAjaxHandler
{
	protected $content;
	public function handleRequest()
	{
		try
		{
			$this->_getContent();
			$this->_okHeader();
			echo $this->content;
		}
		catch (Exception $e)
		{
			$this->_errorHeader();
			echo $e->getMesaage();
		}
	}
	
	protected function _okHeader()
	{
		header('HTTP/1.1 200 OK');
	}

	protected function _errorHeader()
	{
		header('HTTP/1.1 500 Internal Server Error');
	}
	
	abstract protected function _getContent();
}
?>