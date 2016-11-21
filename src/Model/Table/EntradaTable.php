<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Entrada Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Entrada
 *
 * @method \App\Model\Entity\Entrada get($primaryKey, $options = [])
 * @method \App\Model\Entity\Entrada newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Entrada[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Entrada|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Entrada patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Entrada[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Entrada findOrCreate($search, callable $callback = null)
 */
class EntradaTable extends Table
{
    private $dataEntrada;
    private $dataSaida;
    
    private function getDate(array $datas ){

    }


    private function manipulationEntrada($entradas){
        $estacao = array();
        $usuario = array();
        $datas = array();
        foreach( $entradas as $entrada ){
            $dataEntrada = $entrada->data_entrada["time"];
            $dataSaida = $entrada->data_saida["time"];
            array_push($estacao["estacao_id"],$entrada->_matchingData["Estacao"]->estacao_id);
            array_push($estacao["nome"],$entrada->_matchingData["Estacao"]->nome);
            array_push($usuario["usuario_id"],$entrada->_matchingData["Usuario"]->usuario_id);
            array_push($usuario["nome"],$entrada->_matchingData["Usuario"]->nome);
            array_push($usuario["tipo_deficiencia"],$entrada->_matchingData["Usuario"]->tipo_deficiencia);
            array_push($usuario["cpf"],$entrada->_matchingData["Usuario"]->cpf);
        }
        array_push($datas["data_entrada"],$dataEntrada);
        array_push($datas["data_saida"],$data_saida);

    }

    public function getEntrada($data){
        
        //debug($result);
        if(empty($data["tipo_data"])){
            $result = $this->find()
            ->matching('Estacao')
            ->matching('Usuario');
            //debug($this->getRelatorioEstacao());
            return $result->limit(10)->order(['data_entrada' => 'DESC'])->toArray();
        }
        else if(!empty($data["tipo_data"]) && $data["tipo_data"] == "year"){
            $result = $this->find()
            ->matching('Estacao')
            ->matching('Usuario');
            return $this->getRelatorioYear($result->toArray());
        }else if($data['tipo_data'] == "estacao"){
            return $this->getRelatorioEstacao();
        }
    }

    public function getRelatorioEstacao(){
        $result = $this->find()
        ->distinct("Estacao.nome")
        ->matching("Estacao")
        ->matching("Usuario")
        ->group("Estacao.nome");
        $result->select(['Estacao.nome', 'count' => $result->func()->count('Estacao.nome')])->toArray();
        return $result;
    }

    public function getRelatorioYear($entradas){
        $mouths = array( "janeiro" => array(), "fevereiro" => array(), "março" => array(), "abril" => array(), "maio" => array(), "junho" => array(), "julho" => array(), "agosto" => array(), "setembro" => array(), "outubro" => array(), "novembro" => array(), "dezembro" => array() );

        
        foreach( $entradas as $entrada){
            switch ($entrada->data_entrada->i18nFormat("MM")) {
                    case '1':
                        array_push($mouths["janeiro"],$entrada);
                        break;
                    case '2':
                        array_push($mouths["fevereiro"],$entrada);
                        break;
                    case '3':
                        array_push($mouths["março"],$entrada);
                        break;
                    case '4':
                        array_push($mouths["abril"],$entrada);
                        break;
                    case '5':
                        array_push($mouths["maio"],$entrada);
                        break;
                    case '6':
                        array_push($mouths["junho"],$entrada);
                        break;
                    case '7':
                        array_push($mouths["julho"],$entrada);
                        break;
                    case '8':
                        array_push($mouths["agosto"],$entrada);
                        break;
                    case '9':
                        array_push($mouths["setembro"],$entrada);
                        break;
                    case '10':
                        array_push($mouths["outubro"],$entrada);
                        break;
                    case '11':
                        array_push($mouths["novembro"],$entrada);
                        break;
                    case '12':
                        array_push($mouths["dezembro"],$entrada);
                        break;
                    
                    default:
                        # code...
                        break;
                }    
        }
        return $mouths;
    }
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('entrada');
        $this->displayField('entrada_id');
        $this->primaryKey('entrada_id');

        $this->belongsTo('Entrada', [
            'foreignKey' => 'entrada_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Estacao',[
            'foreignKey' => 'estacao_id_estacao',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Usuario',[
            'foreignKey' => 'usuario_id_usuario',
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
            ->date('data_entrada');


        $validator
            ->date('data_saida')
            ->allowEmpty('data_saida');

        $validator
            ->integer('estacao_id_estacao')
            ->allowEmpty('estacao_id_estacao');

        $validator
            ->integer('usuario_id_usuario')
            ->allowEmpty('usuario_id_usuario');

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
        $rules->add($rules->existsIn(['entrada_id'], 'Entrada'));

        return $rules;
    }
}
