<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
		$this->db = Zend_Db_Table::getDefaultAdapter();
    }

    public function indexAction()
    {
		$ms = new Application_Model_Index();
		$msp = $ms->pages();
		$this->view->menu = $msp;
		$content = $ms->page_text('/');
		$this->view->content = $content;
		$form = new Application_Form_Admin();
		if (Zend_Auth::getInstance()->hasIdentity()) {
			$this->view->form = "admin";
			$this->view->layout()->form = "admin";
			$this->view->url = 1;
			$this->view->layout()->url = 1;
		}
		else {
			$this->view->form = $form;
			$this->view->layout()->form = $form;
			$this->view->url = 0;
		}
		//var_dump($tab);
		$meta = $ms->select_meta();
		$this->view->layout()->meta = $meta;
    }

	public function loginAction() 
	{
		$this->view->content = "login";
	}

}

