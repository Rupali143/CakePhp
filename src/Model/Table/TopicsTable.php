<?php
namespace App\Model\Table;

use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Text;
use Cake\Event\Event;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TopicsTable extends Table
{
    public function initilize(array $config){
        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator){
        $validator 
               ->notEmpty('title')
               ->requirePresence('title')
               ->notEmpty('content')
               ->requirePresence('content')
               ->notEmpty('tags')
               ->notEmpty('tags');

               return $validator;
    }
}