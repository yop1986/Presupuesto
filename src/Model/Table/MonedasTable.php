<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Monedas Model
 *
 * @property \App\Model\Table\CuentasTable|\Cake\ORM\Association\HasMany $Cuentas
 *
 * @method \App\Model\Entity\Moneda get($primaryKey, $options = [])
 * @method \App\Model\Entity\Moneda newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Moneda[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Moneda|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Moneda patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Moneda[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Moneda findOrCreate($search, callable $callback = null, $options = [])
 */
class MonedasTable extends Table
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

        $this->setTable('monedas');
        $this->setDisplayField('codigo');
        $this->setPrimaryKey('id');

        $this->hasMany('Cuentas', [
            'foreignKey' => 'moneda_id'
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
            ->scalar('codigo')
            ->requirePresence('codigo', 'create')
            ->notEmpty('codigo')
            ->add('codigo', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('descripcion')
            ->requirePresence('descripcion', 'create')
            ->notEmpty('descripcion');

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
        $rules->add($rules->isUnique(['codigo']));

        return $rules;
    }
}
