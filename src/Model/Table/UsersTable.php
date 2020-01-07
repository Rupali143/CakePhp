<?php
namespace App\Model\Table;

use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Text;
use Cake\Event\Event;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;
use Cake\Utility\Security;

class UsersTable extends Table
{
    public function initilize(array $config){
        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator){
        $validator 
               ->notEmpty('fullname')
               ->requirePresence('fullname')
               ->notEmpty('email')
               ->requirePresence('email')
               ->notEmpty('username')
               ->add('password',[
                    'minLength' =>[
                        'rule' => ['minLength',5],
                        'last' => true,
                        'message' => 'Password is Low,Add more Characters'
                    ]
                    // ]
                    // ,'email',[
                    //     'unique' =>[
                    //         'rule' => 'validateUnique',
                    //         'message' => 'Email is already used'
                    //     ]
                    ]);
            //    ->lengthBetween('password', [4,4]);
           

               return $validator;
    }

    public function buildRules(RulesChecker $rules)
          {
            $rules->add($rules->isUnique(array('email')));
            return $rules;
          }

    public function beforeSave(Event $event)
    {
        $entity = $event->getData('entity');
       

        if ($entity->isNew()) {
            $hasher = new DefaultPasswordHasher();

            // Generate an API 'token'
            $entity->api_key_plain = Security::hash(Security::randomBytes(32), 'sha256', false);
            // Bcrypt the token so BasicAuthenticate can check
            // it during login.
            $entity->api_key = $hasher->hash($entity->api_key_plain);

            // pr($entity->api_key);die;
        }
        return true;
    }
          
}