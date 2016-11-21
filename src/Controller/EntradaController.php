<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Entrada Controller
 *
 * @property \App\Model\Table\EntradaTable $Entrada
 */
class EntradaController extends AppController
{


    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->entrada = $this->loadModel("Entrada");
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        //$entradaDeficiente = $this->paginate($this->EntradaDeficiente);
        $data = $this->request->query; 
        $this->RequestHandler->renderAs($this, 'json');
        $entrada = $this->entrada->getEntrada($data);
        $this->set(compact('entrada'));
        $this->set('_serialize', ['entrada']);
    }

    /**
     * View method
     *
     * @param string|null $id Entrada id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $entrada = $this->Entrada->get($id, [
            'contain' => ['Entrada']
        ]);

        $this->set('entrada', $entrada);
        $this->set('_serialize', ['entrada']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->RequestHandler->renderAs($this, 'json');
        $entrada = $this->Entrada->newEntity();
        if ($this->request->is('post')) {
            $entrada = $this->Entrada->patchEntity($entrada,$this->request->data);  
            $this->Entrada->save($entrada);
            $entrada["sucess"] = true;
        }else{
            $entrada["sucess"] = false;
        }
        $this->set(compact('entrada'));
        $this->set('_serialize', ['entrada']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Entrada id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $entrada = $this->Entrada->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $entrada = $this->Entrada->patchEntity($entrada, $this->request->data);
            if ($this->Entrada->save($entrada)) {
                $this->Flash->success(__('The entrada has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The entrada could not be saved. Please, try again.'));
            }
        }
        $entrada = $this->Entrada->Entrada->find('list', ['limit' => 200]);
        $this->set(compact('entrada', 'entrada'));
        $this->set('_serialize', ['entrada']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Entrada id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $entrada = $this->Entrada->get($id);
        if ($this->Entrada->delete($entrada)) {
            $this->Flash->success(__('The entrada has been deleted.'));
        } else {
            $this->Flash->error(__('The entrada could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
