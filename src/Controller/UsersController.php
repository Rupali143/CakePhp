<?php 
namespace App\Controller;


use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;
use BaconQrCode\Renderer\Image\Png;
// App::uses('AppController', 'Controller');
// App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController
{
    // var $components = array('Auth');

    public function beforeFilter(Event $event)
    {
        
        parent::beforeFilter($event);
        // $this->Auth->allow('add');
      //  $this->getEventManager()->off($this->Csrf);
        $this->Auth->allow(['add','login','register','send_mail']);
        
    }

    public function initialize()
    {
    parent::initialize();
    $this->loadComponent('Auth', [
        'authenticate' => [
            'Form' => [
                'fields' => ['username' => 'email', 'password' => 'passwd']
            ]
        ]
    ]);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
           if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect(['controller' =>'topics','action'=>'index']);
            }
            
            $this->Flash->error('Incorrect Login Credentials');
        }
    }

    public function logout1()
    {
        echo 'here'; die;
        //  $this->Flash->success('You are logged Out');
        //  //$this->request->session()->destroy();
        //  $this->Session->destroy();
        //  $this->request->getSession()->delete('Auth');
        // // $session = $this->request->session();  
        // // $this->$session->delete();
        // return $this->redirect($this->Auth->logout());
    }

    function register()
   {
     $user = $this->Users->newEntity();
    //print_r($user);die;
    //generate barcode start
    // $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
    // print_r($generator);die;
    // echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode('081231723897', $generator::TYPE_CODE_128)) . '">';
    //generate barcode end
    
    if($this->request->is('post')){
        
        $file = $this->request->data['photo'];
       
        $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
        $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
        $setNewFileName = time() . "_" . rand(000000, 999999);
        if (in_array($ext, $arr_ext)) {
            //do the actual uploading of the file. First arg is the tmp name, second arg is 
            //where we are putting it
            if (!file_exists(WWW_ROOT.'/upload/avatar')) {
                mkdir(WWW_ROOT.'/upload/avatar', 0777, true);
            }
            move_uploaded_file($file['tmp_name'], WWW_ROOT . '/upload/avatar/' . $setNewFileName . '.' . $ext);
            $imageFileName = $setNewFileName . '.' . $ext;
            }
            //print_r($imageFileName);die;
            $this->request->data['photo'] = $imageFileName;
            $user = $this->Users->patchEntity($user, $this->request->data);
        if($this->Users->save($user)){
            $this->Flash->success('You are registered');
            // $this->send_mail($user);
            //echo'hello';die;
            $this->redirect($this->Auth->redirectUrl());
          //  return $this->redirect(['action' =>'login']);
        }else{
            $this->Flash->error('You are not registered');
        }
    }
    $this->set(compact('user'));
    $this->set('_serialize', ['user']);
   }

   public function send_mail($user){
       $to=$user['email'];
    //    echo $to;die;
       ///$confirmation_link = "http://" . $_SERVER['HTTP_HOST'] . $this->webroot . "users/login/";
       //App::uses('CakeEmail', 'Network/Email');
       $message = 'Hi,' . $user['fullname'] . ', Your Password is: ' . $user['username'];
       $email = new CakeEmail('default');
       $email->from('rupalisatpute289@gmail.com');
       $email->to($to);
       $email->subject('Mail Confirmation');  
       $email->send($message);
       //echo '<pre>';print_r($email);die;
      
   }

   function barcode_generate(){
    $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
    print_r($generator);die;
    echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode('081231723897', $generator::TYPE_CODE_128)) . '">';
   }
}