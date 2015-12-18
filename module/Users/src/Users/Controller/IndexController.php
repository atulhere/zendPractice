<?php

namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Users\Form\RegisterForm;
use Users\Model\User;
use Users\Model\UserTable;

use Benhawker\Pipedrive\Pipedrive;

class IndexController extends AbstractActionController {

    public function indexAction() {

        $view = new ViewModel();
        return $view;
    }

    public function registerAction() {

        $form = new RegisterForm();
        $viewModel = new ViewModel(array('form' => $form));
        return $viewModel;
    }

    public function loginAction() {
        $view = new ViewModel();
        return $view;
    }

    public function signupAction() {
        $data = $this->getRequest()->getPost();
        if ($_POST) {
            $success = $this->createUser($_POST);
            if ($success) {
                $view = new ViewModel();
                return $view->setTemplate('users/index/confirm');
            }
        }
        else{
            $this->loginAction();
        }
    }

    protected function createUser(array $data) {

        $sm = $this->getServiceLocator();
        $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
        $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new \Users\Model\User);
        $tableGateway = new \Zend\Db\TableGateway\TableGateway('user', $dbAdapter, null, $resultSetPrototype);
        $user = new \Users\Model\User();
        $user->exchangeArray($data);
        $userTable = new \Users\Model\UserTable($tableGateway);
        $userTable->saveUser($user);
        return true;
    }
    
    public function pipedriveAction(){

        $result = '';
        $data = array();
        
        $pipedrive = new Pipedrive('61feeee8b93408071fc202b57a689a229c2991a9');  
        
        $result = $pipedrive->deals()->getByName('A00000X');
        
        
        $data['6b69eb5081674c79916e74624883adc02be3769f'] = 'Hero';
        $response = $pipedrive->deals()->update(1847,$data);
        
        var_dump($response);die;
        
        
    }

}

?>
