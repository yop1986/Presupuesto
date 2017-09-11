<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Monedas Controller
 *
 * @property \App\Model\Table\MonedasTable $Monedas
 *
 * @method \App\Model\Entity\Moneda[] paginate($object = null, array $settings = [])
 */
class MonedasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $monedas = $this->paginate($this->Monedas);

        $this->set(compact('monedas'));
        $this->set('_serialize', ['monedas']);
    }

    /**
     * View method
     *
     * @param string|null $id Moneda id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $moneda = $this->Monedas->get($id, [
            'contain' => ['Cuentas']
        ]);

        $this->set('moneda', $moneda);
        $this->set('_serialize', ['moneda']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $moneda = $this->Monedas->newEntity();
        if ($this->request->is('post')) {
            $moneda = $this->Monedas->patchEntity($moneda, $this->request->getData());
            if ($this->Monedas->save($moneda)) {
                $this->Flash->success(__('The moneda has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The moneda could not be saved. Please, try again.'));
        }
        $this->set(compact('moneda'));
        $this->set('_serialize', ['moneda']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Moneda id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $moneda = $this->Monedas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $moneda = $this->Monedas->patchEntity($moneda, $this->request->getData());
            if ($this->Monedas->save($moneda)) {
                $this->Flash->success(__('The moneda has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The moneda could not be saved. Please, try again.'));
        }
        $this->set(compact('moneda'));
        $this->set('_serialize', ['moneda']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Moneda id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $moneda = $this->Monedas->get($id);
        if ($this->Monedas->delete($moneda)) {
            $this->Flash->success(__('The moneda has been deleted.'));
        } else {
            $this->Flash->error(__('The moneda could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
