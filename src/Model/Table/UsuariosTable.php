<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Usuarios Model
 *
 * @property \App\Model\Table\CuentasTable|\Cake\ORM\Association\HasMany $Cuentas
 * @property \App\Model\Table\ServiciosTable|\Cake\ORM\Association\BelongsToMany $Servicios
 *
 * @method \App\Model\Entity\Usuario get($primaryKey, $options = [])
 * @method \App\Model\Entity\Usuario newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Usuario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Usuario|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Usuario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Usuario[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Usuario findOrCreate($search, callable $callback = null, $options = [])
 */
class UsuariosTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('usuarios');
        $this->setDisplayField('nombre');
        $this->setPrimaryKey('id');

        $this->hasMany('Cuentas', [
            'foreignKey' => 'usuario_id'
        ]);
        $this->belongsToMany('Servicios', [
            'foreignKey' => 'usuario_id',
            'targetForeignKey' => 'servicio_id',
            'joinTable' => 'servicios_usuarios'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('nombre')
            ->requirePresence('nombre', 'create')
            ->notEmpty('nombre');

        $validator
            ->scalar('correo')
            ->requirePresence('correo', 'create')
            ->notEmpty('correo')
            ->add('correo', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('contrasena')
            ->requirePresence('contrasena', 'create')
            ->notEmpty('contrasena');

        $validator
            ->dateTime('creado')
            ->requirePresence('creado', 'create')
            ->notEmpty('creado');

        $validator
            ->dateTime('modificado')
            ->allowEmpty('modificado');

        $validator
            ->boolean('activo')
            ->requirePresence('activo', 'create')
            ->notEmpty('activo');

        $validator
            ->scalar('rol')
            ->allowEmpty('rol');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['correo']));

        return $rules;
    }

    public function findAuth(\Cake\ORM\Query $query, array $options) {
        $query
            ->select(['id', 'nombre', 'correo', 'contrasena', 'rol'])
            ->where(['Usuarios.activo' => 1]);
            
        return $query;
    }
}
