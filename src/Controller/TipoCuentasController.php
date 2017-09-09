<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TipoCuentas Controller
 *
 * @property \App\Model\Table\TipoCuentasTable $TipoCuentas
 *
 * @method \App\Model\Entity\TipoCuenta[] paginate($object = null, array $settings = [])
 */
class TipoCuentasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $tipoCuentas = $this->paginate($this->TipoCuentas);

        $this->set(compact('tipoCuentas'));
        $this->set('_serialize', ['tipoCuentas']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tipoCuenta = $this->TipoCuentas->newEntity();
        if ($this->request->is('post')) {
            $tipoCuenta = $this->TipoCuentas->patchEntity($tipoCuenta, $this->request->getData());
            if ($this->TipoCuentas->save($tipoCuenta)) {
                $this->Flash->success(__('The tipo cuenta has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tipo cuenta could not be saved. Please, try again.'));
        }
        $this->set(compact('tipoCuenta'));
        $this->set('_serialize', ['tipoCuenta']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Tipo Cuenta id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tipoCuenta = $this->TipoCuentas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tipoCuenta = $this->TipoCuentas->patchEntity($tipoCuenta, $this->request->getData());
            if ($this->TipoCuentas->save($tipoCuenta)) {
                $this->Flash->success(__('The tipo cuenta has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tipo cuenta could not be saved. Please, try again.'));
        }
        $this->set(compact('tipoCuenta'));
        $this->set('_serialize', ['tipoCuenta']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tipo Cuenta id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tipoCuenta = $this->TipoCuentas->get($id);
        if ($this->TipoCuentas->delete($tipoCuenta)) {
            $this->Flash->success(__('The tipo cuenta has been deleted.'));
        } else {
            $this->Flash->error(__('The tipo cuenta could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
