<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ServicioUsuarios Controller
 *
 * @property \App\Model\Table\ServicioUsuariosTable $ServicioUsuarios
 *
 * @method \App\Model\Entity\ServicioUsuario[] paginate($object = null, array $settings = [])
 */
class ServicioUsuariosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Servicios', 'Usuarios']
        ];
        $servicioUsuarios = $this->paginate(
            $this->ServicioUsuarios->find('all')->where(['ServicioUsuarios.usuario_id' => $this->Auth->User('id')])
        );

        $this->set(compact('servicioUsuarios'));
        $this->set('_serialize', ['servicioUsuarios']);
    }

    /**
     * View method
     *
     * @param string|null $id Servicio Usuario id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $servicioUsuario = $this->ServicioUsuarios->get($id, [
            'contain' => ['Servicios', 'Usuarios']
        ]);

        $this->set('servicioUsuario', $servicioUsuario);
        $this->set('_serialize', ['servicioUsuario']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $servicioUsuario = $this->ServicioUsuarios->newEntity();
        if ($this->request->is('post')) {
            $servicioUsuario = $this->ServicioUsuarios->patchEntity($servicioUsuario, $this->request->getData());
            $servicioUsuario['usuario_id'] = $this->Auth->User('id');
            if ($this->ServicioUsuarios->save($servicioUsuario)) {
                $this->Flash->success(__('The servicio usuario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The servicio usuario could not be saved. Please, try again.'));
        }
        $servicios = $this->ServicioUsuarios->Servicios->find('list', ['limit' => 200]);
        $usuarios = $this->ServicioUsuarios->Usuarios->find('list', ['limit' => 200]);
        $this->set(compact('servicioUsuario', 'servicios', 'usuarios'));
        $this->set('_serialize', ['servicioUsuario']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Servicio Usuario id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $servicioUsuario = $this->ServicioUsuarios->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $servicioUsuario = $this->ServicioUsuarios->patchEntity($servicioUsuario, $this->request->getData());
            $servicioUsuario['usuario_id'] = $this->Auth->User('id');
            if ($this->ServicioUsuarios->save($servicioUsuario)) {
                $this->Flash->success(__('The servicio usuario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The servicio usuario could not be saved. Please, try again.'));
        }
        $servicios = $this->ServicioUsuarios->Servicios->find('list', ['limit' => 200]);
        $usuarios = $this->ServicioUsuarios->Usuarios->find('list', ['limit' => 200]);
        $this->set(compact('servicioUsuario', 'servicios', 'usuarios'));
        $this->set('_serialize', ['servicioUsuario']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Servicio Usuario id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $servicioUsuario = $this->ServicioUsuarios->get($id);
        if ($this->ServicioUsuarios->delete($servicioUsuario)) {
            $this->Flash->success(__('The servicio usuario has been deleted.'));
        } else {
            $this->Flash->error(__('The servicio usuario could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
