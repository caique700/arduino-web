<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Estacao Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Estacaos
 *
 * @method \App\Model\Entity\Estacao get($primaryKey, $options = [])
 * @method \App\Model\Entity\Estacao newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Estacao[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Estacao|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Estacao patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Estacao[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Estacao findOrCreate($search, callable $callback = null)
 */
class EstacaoTable extends Table
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

        $this->table('estacao');
        $this->displayField('estacao_id');
        $this->primaryKey('estacao_id');

        $this->belongsTo('Estacaos', [
            'foreignKey' => 'estacao_id',
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
            ->allowEmpty('nome');

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
        $rules->add($rules->existsIn(['estacao_id'], 'Estacaos'));

        return $rules;
    }
}
