<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Cuentas Controller
 *
 * @property \App\Model\Table\CuentasTable $Cuentas
 *
 * @method \App\Model\Entity\Cuenta[] paginate($object = null, array $settings = [])
 */
class CuentasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['TipoCuentas', 'Instituciones', 'Usuarios']
        ];
        $cuentas = $this->paginate(
            $this->Cuentas->find('all')->where(['Cuentas.usuario_id' => $this->Auth->User('id')])
        );

        $this->set(compact('cuentas'));
        $this->set('_serialize', ['cuentas']);
    }

    /**
     * View method
     *
     * @param string|null $id Cuenta id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cuenta = $this->Cuentas->get($id, [
            'contain' => ['TipoCuentas', 'Instituciones', 'Usuarios']
        ]);

        $this->set('cuenta', $cuenta);
        $this->set('_serialize', ['cuenta']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cuenta = $this->Cuentas->newEntity();
        if ($this->request->is('post')) {
            $cuenta = $this->Cuentas->patchEntity($cuenta, $this->request->getData());
            $cuenta['usuario_id'] = $this->Auth->User('id');
            if ($this->Cuentas->save($cuenta)) {
                $this->Flash->success(__('The cuenta has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cuenta could not be saved. Please, try again.'));
        }
        $tipoCuentas = $this->Cuentas->TipoCuentas->find('list', ['limit' => 200]);
        $instituciones = $this->Cuentas->Instituciones->find('list', ['limit' => 200]);
        $usuarios = $this->Cuentas->Usuarios->find('list', ['limit' => 200]);
        $this->set(compact('cuenta', 'tipoCuentas', 'instituciones', 'usuarios'));
        $this->set('_serialize', ['cuenta']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cuenta id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cuenta = $this->Cuentas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cuenta = $this->Cuentas->patchEntity($cuenta, $this->request->getData());
            $cuenta['usuario_id'] = $this->Auth->User('id');
            if ($this->Cuentas->save($cuenta)) {
                $this->Flash->success(__('The cuenta has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cuenta could not be saved. Please, try again.'));
        }
        $tipoCuentas = $this->Cuentas->TipoCuentas->find('list', ['limit' => 200]);
        $instituciones = $this->Cuentas->Instituciones->find('list', ['limit' => 200]);
        $usuarios = $this->Cuentas->Usuarios->find('list', ['limit' => 200]);
        $this->set(compact('cuenta', 'tipoCuentas', 'instituciones', 'usuarios'));
        $this->set('_serialize', ['cuenta']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cuenta id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cuenta = $this->Cuentas->get($id);
        if ($this->Cuentas->delete($cuenta)) {
            $this->Flash->success(__('The cuenta has been deleted.'));
        } else {
            $this->Flash->error(__('The cuenta could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
