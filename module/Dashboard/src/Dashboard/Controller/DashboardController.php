<?php
namespace Dashboard\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Entity\User;
//use \Exception;
class DashboardController extends AbstractActionController{
    protected $em;
     public function getEntityManager(){
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }
    public function indexAction(){
       
       $this->layout("layout/dashbord_headerfooter");
       $data = array('username'=>'not yet','password'=>'dfdf','email'=>'razakballa@gmail.com','role'=>'user');
                 $user = new \User\Entity\User($data);
                 $em = $this->getEntityManager();
               // $user->validate($this->em);
                 $this->getEntityManager()->persist($user);
                 $this->getEntityManager()->flush(); 
        
    }
     public function dashboarduserAction(){
         $this->layout("layout/dashbord_headerfooter");
         
         
    }
    public function dashboardadminAction(){
         $this->layout("layout/dashbord_headerfooter");
         
    }

    public function dashboardsuperadminAction(){
         $this->layout("layout/dashbord_headerfooter");
         
    }
    
   
}