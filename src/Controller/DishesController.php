<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\InternalErrorException;
use Cake\ORM\TableRegistry;

/**
 * Dishes Controller
 *
 * @property \App\Model\Table\DishesTable $Dishes
 *
 * @method \App\Model\Entity\Dish[] paginate($object = null, array $settings = [])
 */
class DishesController extends AppController
{

    public $paginate = [
        'limit' => 9,
    ];

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $dishes = $this->Dishes->find()->where(['user_id' => $this->Auth->user('id')]);
        $dishes = $this->paginate($dishes);

        $this->set(compact('dishes'));
        $this->set('_serialize', ['dishes']);
    }

    /**
     * View method
     *
     * @param string|null $id Dish id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $commentsTable = TableRegistry::get('comments');
        $comment = $commentsTable->newEntity();
        if ($this->request->is('post')) {
            $comment = $commentsTable->patchEntity($comment, $this->request->getData());
            $comment->dish_id = $id;
            $comment->user_id = $this->Auth->user('id');
            if ($commentsTable->save($comment)) {
                $this->Flash->success(__('The dish has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dish could not be saved. Please, try again.'));
        }

        $dish = $this->Dishes->get($id, [
            'contain' => []
        ]);
        $comments = $commentsTable->find()->where(['dish_id' => $id]);

        $this->set('dish', $dish);
        $this->set('comment', $comment);
        $this->set('comments', $comments);
        $this->set('_serialize', ['dish', 'comment', 'comments']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dish = $this->Dishes->newEntity();
        if ($this->request->is('post')) {
            $img = $_FILES['img'] or $this->request->data['img'];
            if(! $ext = array_search(
                mime_content_type($img['tmp_name']),
                array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                ),
                true
            )) throw new InternalErrorException(__('非対応のファイル形式'));
            $imgname = sprintf("dish/%s.%s", sha1_file($img['tmp_name']), $ext);
            move_uploaded_file($img['tmp_name'], WWW_ROOT . 'img/' . $imgname);
            $dish = $this->Dishes->patchEntity($dish, $this->request->getData());
            $dish->imgname = $imgname;
            $dish->user_id = $this->Auth->user('id');
            if ($this->Dishes->save($dish)) {
                $this->Flash->success(__('The dish has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dish could not be saved. Please, try again.'));
        }
        $this->set(compact('dish'));
        $this->set('_serialize', ['dish']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Dish id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dish = $this->Dishes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dish = $this->Dishes->patchEntity($dish, $this->request->getData());
            if ($this->Dishes->save($dish)) {
                $this->Flash->success(__('The dish has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dish could not be saved. Please, try again.'));
        }
        $this->set(compact('dish'));
        $this->set('_serialize', ['dish']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Dish id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dish = $this->Dishes->get($id);
        if ($this->Dishes->delete($dish)) {
            $this->Flash->success(__('The dish has been deleted.'));
        } else {
            $this->Flash->error(__('The dish could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
