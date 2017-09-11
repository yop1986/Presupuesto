<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Instituciones Controller
 *
 * @property \App\Model\Table\InstitucionesTable $Instituciones
 *
 * @method \App\Model\Entity\Institucione[] paginate($object = null, array $settings = [])
 */
class InstitucionesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $instituciones = $this->paginate($this->Instituciones);

        $this->set(compact('instituciones'));
        $this->set('_serialize', ['instituciones']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $institucion = $this->Instituciones->newEntity();
        if ($this->request->is('post')) {
            $institucion = $this->Instituciones->patchEntity($institucion, $this->request->getData());
            if ($this->Instituciones->save($institucion)) {
                $this->Flash->success(__('The institucion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The institucion could not be saved. Please, try again.'));
        }
        $this->set(compact('institucion'));
        $this->set('_serialize', ['institucion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Institucione id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $institucion = $this->Instituciones->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $institucion = $this->Instituciones->patchEntity($institucion, $this->request->getData());
            if ($this->Instituciones->save($institucion)) {
                $this->Flash->success(__('The institucion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The institucion could not be saved. Please, try again.'));
        }
        $this->set(compact('institucion'));
        $this->set('_serialize', ['institucion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Institucione id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $institucion = $this->Instituciones->get($id);
        if ($this->Instituciones->delete($institucion)) {
            $this->Flash->success(__('The institucion has been deleted.'));
        } else {
            $this->Flash->error(__('The institucion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
