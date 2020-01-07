<?php

// namespace App\Controller;
use App\Controller\AppController;
use Cake\Validation\Validation;

class ArticlesController extends AppController{

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['articles']);
    }

    public function add()
    {
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            // Prior to 3.4.0 $this->request->data() was used.
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            // Added this line
            $article->user_id = $this->Auth->user('id');
            // You could also do the following
            //$newData = ['user_id' => $this->Auth->user('id')];
            //$article = $this->Articles->patchEntity($article, $newData);
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article.'));
        }
        $this->set('article', $article);
    
        // Just added the categories list to be able to choose
        // one category for an article
        $categories = $this->Articles->Categories->find('treeList');
        $this->set(compact('categories'));
    }


    public function isAuthorized($user)
{
    // All registered users can add articles
    // Prior to 3.4.0 $this->request->param('action') was used.
    if ($this->request->getParam('action') === 'add') {
        return true;
    }

    // The owner of an article can edit and delete it
    // Prior to 3.4.0 $this->request->param('action') was used.
    if (in_array($this->request->getParam('action'), ['edit', 'delete'])) {
        // Prior to 3.4.0 $this->request->params('pass.0')
        $articleId = (int)$this->request->getParam('pass.0');
        if ($this->Articles->isOwnedBy($articleId, $user['id'])) {
            return true;
        }        
    }

    return parent::isAuthorized($user);
}
public function isOwnedBy($articleId, $userId)
{
    return $this->exists(['id' => $articleId, 'user_id' => $userId]);
}
}