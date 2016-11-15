<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Estacao Controller
 *
 * @property \App\Model\Table\EstacaoTable $Estacao
 */
class EstacaoController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Estacaos']
        ];
        $estacao = $this->paginate($this->Estacao);

        $this->set(compact('estacao'));
        $this->set('_serialize', ['estacao']);
    }

    /**
     * View method
     *
     * @param string|null $id Estacao id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $estacao = $this->Estacao->get($id, [
            'contain' => ['Estacaos']
        ]);

        $this->set('estacao', $estacao);
        $this->set('_serialize', ['estacao']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $estacao = $this->Estacao->newEntity();
        if ($this->request->is('post')) {
            $estacao = $this->Estacao->patchEntity($estacao, $this->request->data);
            if ($this->Estacao->save($estacao)) {
                $this->Flash->success(__('The estacao has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The estacao could not be saved. Please, try again.'));
            }
        }
        $estacaos = $this->Estacao->Estacaos->find('list', ['limit' => 200]);
        $this->set(compact('estacao', 'estacaos'));
        $this->set('_serialize', ['estacao']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Estacao id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $estacao = $this->Estacao->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $estacao = $this->Estacao->patchEntity($estacao, $this->request->data);
            if ($this->Estacao->save($estacao)) {
                $this->Flash->success(__('The estacao has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The estacao could not be saved. Please, try again.'));
            }
        }
        $estacaos = $this->Estacao->Estacaos->find('list', ['limit' => 200]);
        $this->set(compact('estacao', 'estacaos'));
        $this->set('_serialize', ['estacao']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Estacao id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $estacao = $this->Estacao->get($id);
        if ($this->Estacao->delete($estacao)) {
            $this->Flash->success(__('The estacao has been deleted.'));
        } else {
            $this->Flash->error(__('The estacao could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
