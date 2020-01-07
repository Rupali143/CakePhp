<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Validation\Validation;
use Cake\Event\Event;
/**
 * Register Controller
 *
 *
 * @method \App\Model\Entity\Register[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RegisterController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        //$register = $this->paginate($this->Register);
        echo'ggggg';die;
        $this->set(compact('register'));
    }


    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow('add','view','register');
    }


    /**
     * View method
     *
     * @param string|null $id Register id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view1($id = null)
    {
        $register = $this->Register->get($id, [
            'contain' => []
        ]);

        $this->set('register', $register);
    }

    // public function view()
    // {
    //     // $register = $this->Register->get($id, [
    //     //     'contain' => []
    //     // ]);
    //         echo'asdasd';die;
    //     $this->set('register', $register);
    // }

    function register()
  {
    if (!empty($this->data))
    {
      if ($this->data['User']['password'] == $this->Auth->password($this->data['User']['password_confirm']))
      {
        $this->User->create();
        if($this->User->save($this->data))
        {
          $this->Auth->login($this->data);
          $this->redirect(array('action' => 'index'));
        }
      }
    }
  }
    


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $register = $this->Register->newEntity();
        if ($this->request->is('post')) {
            $register = $this->Register->patchEntity($register, $this->request->getData());
            if ($this->Register->save($register)) {
                $this->Flash->success(__('The register has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The register could not be saved. Please, try again.'));
        }
        $this->set(compact('register'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Register id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $register = $this->Register->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $register = $this->Register->patchEntity($register, $this->request->getData());
            if ($this->Register->save($register)) {
                $this->Flash->success(__('The register has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The register could not be saved. Please, try again.'));
        }
        $this->set(compact('register'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Register id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $register = $this->Register->get($id);
        if ($this->Register->delete($register)) {
            $this->Flash->success(__('The register has been deleted.'));
        } else {
            $this->Flash->error(__('The register could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
