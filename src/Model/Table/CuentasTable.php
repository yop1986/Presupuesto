<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cuentas Model
 *
 * @property \App\Model\Table\TipoCuentasTable|\Cake\ORM\Association\BelongsTo $TipoCuentas
 * @property \App\Model\Table\InstitucionesTable|\Cake\ORM\Association\BelongsTo $Instituciones
 * @property \App\Model\Table\UsuariosTable|\Cake\ORM\Association\BelongsTo $Usuarios
 *
 * @method \App\Model\Entity\Cuenta get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cuenta newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Cuenta[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cuenta|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cuenta patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cuenta[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cuenta findOrCreate($search, callable $callback = null, $options = [])
 */
class CuentasTable extends Table
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

        $this->setTable('cuentas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('TipoCuentas', [
            'foreignKey' => 'tipo_cuenta_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Instituciones', [
            'foreignKey' => 'institucion_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Usuarios', [
            'foreignKey' => 'usuario_id',
            'joinType' => 'INNER'
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('nombre')
            ->requirePresence('nombre', 'create')
            ->notEmpty('nombre')
            ->add('nombre', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->decimal('saldo')
            ->requirePresence('saldo', 'create')
            ->notEmpty('saldo');

        $validator
            ->boolean('estado')
            ->requirePresence('estado', 'create')
            ->notEmpty('estado');

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
        $rules->add($rules->isUnique(['nombre']));
        $rules->add($rules->existsIn(['tipo_cuenta_id'], 'TipoCuentas'));
        $rules->add($rules->existsIn(['institucion_id'], 'Instituciones'));
        $rules->add($rules->existsIn(['usuario_id'], 'Usuarios'));

        return $rules;
    }
}
