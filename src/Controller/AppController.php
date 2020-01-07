<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller
{
    //...

    public function initialize()
    {
        $this->loadComponent('Flash');
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Auth');
            // 'autherize' => [
                
            //     'Form' =>[
            //         'fields' => [
            //             'username' => 'username',
            //             'password' => 'password'
            //         ]
            //     ],
            //     'loginAction' => [
            //         'controller' =>'Users',
            //         'action' =>'login'
            //     ],
            //     // 'logoutRedirect' => [
            //     //     'controller' => 'Users',
            //     //     'action' => 'login'
            //     // ]
            //     //'unauthorizedRedirect' => false,
            // ]
       
       
        
    }

    public function beforeRender(Event $event){
        $this->set('Auth', $this->Auth);
    }

    public function beforeFilter(Event $event)
    { 
        // parent::beforeRender($event);
        // $u = $this->Auth->user();
        // if($this->Auth){
         //   $this->set('Auth', $this->Auth);
        // }
        // if($this->isAuthorized($u)){
        //     $this->Auth->allow();
        //     $this->set('auth',$u);
        //     return;
        // }
        $this->Auth->allow(['view', 'display']);
    }

    public function isAuthorized($user)
    {
        // Admin can access every action
        // if (isset($user['role']) && $user['role'] === 'admin') {
        // }

        // // Default deny
        //      return true;
        
       return false;
    }


    // public function beforeRender(Event $event)
    // {
    //     if($this->request->session()->read('Auth.User')){
    //         $this->set('loggedIn',true);
    //     }else{
    //         $this->set('loggedIn',false);
    //     }
    // }

}
