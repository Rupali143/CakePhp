<?php
 
namespace App\Controller;
 
use App\Controller\AppController;
 
class TopicsController extends AppController
{
 
   public function initialize()
    {
        parent::initialize();
        
        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->Auth->allow(['index']);
    }
 
    public function index()
    {
        $this->set('topics', $this->Topics->find('all'));
    }
    public function view($id)
    {
        $topic = $this->Topics->get($id);
        $this->set(compact('topic'));
    }
 
    public function add()
        {
            $topic = $this->Topics->newEntity();
            
            if ($this->request->is('post')) {
                $topic = $this->Topics->patchEntity($topic, $this->request->data);
                // pr($topic);die;
            if ($this->Topics->save($topic)) {
                  $this->Flash->success(__('Your topic has been saved.'));
                  return $this->redirect(['action' => 'index']);
                 }
                $this->Flash->error(__('Unable to add your topic.'));
            }
            $this->set('topic', $topic);
        }
    public function edit($id = null)
        {
            $topic = $this->Topics->get($id);
            if ($this->request->is(['post', 'put'])) {
            $this->Topics->patchEntity($topic, $this->request->data);
            if ($this->Topics->save($topic)) {
            $this->Flash->success(__('Your topic has been updated.'));
            return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your topic.'));
            }
            
            $this->set('topic', $topic);
        }

    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);
        
        $topic = $this->Topics->get($id);
        if ($this->Topics->delete($topic)) {
        $this->Flash->success(__('The topic with id: {0} has been deleted.', h($id)));
        return $this->redirect(['action' => 'index']);
        }
    }
    public function logout(){
        return $this->redirect($this->Auth->logout());

     }
}