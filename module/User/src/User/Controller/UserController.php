<?php
namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\Validator\File\UploadFile;
use ZendService\Amazon\S3;
use User\Form\RegisterForm;
use User\Form\LoginForm;
use User\Exception\NotFoundException;
use Zend\Session\Storage\ArrayStorage;
use Zend\Session\SessionManager;


use Zend\Mail;

class UserController extends AbstractActionController{

    protected $em;
    protected $authservice;
    protected $storage;

    public function getAuthService()
    {
        if (! $this->authservice) {
            $this->authservice = $this->getServiceLocator()
                                      ->get('AuthService');
        }

        return $this->authservice;
    }

    public function getEntityManager(){
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function indexAction(){

     $this->layout("layout/headeandfooter");
    }
    public function registerAction(){
        $this->layout("layout/headeandfooter");
        $form = new RegisterForm();
        $form->get('submit')->setValue('Add');
        $request = $this->getRequest();
            if ($request->isPost()) {
            
                 $register= new RegisterForm();
                 $form->setData($request->getPost());
                 $data = array('username'=>$request->getPost('username'),'password'=>md5($request->getPost('password')),'email'=>$request->getPost('email'),'role'=>'user');
                 $user = new \User\Entity\User($data);
                 $em = $this->getEntityManager();
                 $form->isValid();
                 $user->validate($this->em);
                 $this->getEntityManager()->persist($user);
                 $this->getEntityManager()->flush(); 
                 //return $this->redirect()->toRoute('user');
               $a= "100"; 
                
             }
           
        return array('form' => $form,'d'=>isset($a)?$a:'');
        }
       
    public function getSessionStorage() {
        if (! $this->storage) {
            $this->storage = $this->getServiceLocator()
                                  ->get('User\Model\MyAuthStorage');
        }

        return $this->storage;
    }
    
    public function loginAction(){  
        $this->layout("layout/headeandfooter");
        $form = new LoginForm();
        $form->get('submit')->setValue('Login');
        $request = $this->getRequest();
            if ($request->isPost()) { 
                $data = array('email'=>$request->getPost('email'),'password'=>md5($request->getPost('password')));
                $user = new \User\Entity\User($data);
                if($user->validateLogin($this->em)){
                   $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
                   $adapter = $authService->getAdapter();
                   $adapter->setIdentityValue($data['email']);
                   $adapter->setCredentialValue($data['password']);
                   $authResult = $authService->authenticate();
                   if ($authResult->isValid()) {
                       $em = $this->getEntityManager();
                       $queryBuilder = $em->createQueryBuilder();
                       $queryBuilder->select('o.role')->from('User\Entity\User', 'o')
                       ->where('o.email = :emailaddress')
                       ->setParameter('emailaddress', $data['email']);
                       $result = $queryBuilder->getQuery();
                       $getdata=$result->getResult();
                       if($getdata[0]['role']=='user')
                          return $this->redirect()->toRoute('user',array('action' => 'userprofile'));
                       if($getdata[0]['role']=='admin')
                          return $this->redirect()->toRoute('dash',array('action' => 'dashboardadmin'));
                       if($getdata[0]['role']=='superadmin')
                          return $this->redirect()->toRoute('dash',array('action' => 'dashboardsuperadmin'));
                       $identity = $authResult->getIdentity();
                       $authService->getStorage()->write($identity);
                       $identity = $authResult->getIdentity();
                       $logged_in_user_details = $identity->toArray();
                       $a = 'valid';
                    }else{        
                        $a = "failed";
                      
                        }
           
                    } 
               }
        return array('form' => $form,'d'=>isset($a)?$a:'');

            }
    public function userprofileAction(){
       $this->layout("layout/dashbord_headerfooter");
       
       }
           
       public function emailverificationAction(){
         $this->layout("layout/dashbord_headerfooter");
         $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
         $result =  $authService->getStorage()->read();
         $email = $result->getEmail();
         if(!empty($email)){
         //print_r($getdata); exit();       
         $content = '<p>Dear '.$result->getUsername().',</p>';
         $content .= '<p>Password details are below.</p>';
         $content .= '<p>Username : '.$result->getUsername().'</p>';
        
         $content .= '<p><href=http://localhost/marketing/public/user/userprofile></p>';
         $content .= '<p><p>';
         $plugin = $this->SendEmailPlugin();
         $plugin->sendemail($content, 'razakballa@gmail.com', 'razak.mailbox@gmail.com', 'DASH : Forgot Password', true);

         }

                       

       }
    }