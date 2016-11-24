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
        }else if($data['tipo_data'] == "hora"){
            $result = $this->find()
            ->matching('Estacao')
            ->matching('Usuario')->toArray();
            return $this->entradaEstacaoHora($result);
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


    private function entradaEstacaoHora($data){
        $dataAtual = date('d-m');
        debug($dataAtual);
        $dataProcessamento = array();
        //debug($data[0]->data_entrada->i18nFormat());
        /*foreach( $data as $dsEstacao){
        }*/
        $horas = array( "horas" => array( ));
        foreach($data as $ds){
           debug($ds->data_entrada->i18nFormat('dd-MM'));
           //debug($ds->data_entrada->i18nFormat('HH'));
            if($ds->data_entrada->i18nFormat('dd-MM') == $dataAtual ){
                switch ($ds->data_entrada->i18nFormat('HH')) {
                      case '00':

                            $quantidade = $horas['horas']['00'][$ds->_matchingData['Estacao']->nome] + 1;
                            $horas['horas']['00'][$ds->_matchingData['Estacao']->nome] = $quantidade; 
                                            
                          break;
                      case '01':
                            $quantidade = $horas['horas']['01'][$ds->_matchingData['Estacao']->nome] + 1;
                            $horas['horas']['01'][$ds->_matchingData['Estacao']->nome] = $quantidade; 
                              case '02':
                            $quantidade = $horas['horas']['02'][$ds->_matchingData['Estacao']->nome] + 1;
                            $horas['horas']['02'][$ds->_matchingData['Estacao']->nome] = $quantidade; 
                              case '03':
                            $quantidade = $horas['horas']['03'][$ds->_matchingData['Estacao']->nome] + 1;
                            $horas['horas']['03'][$ds->_matchingData['Estacao']->nome] = $quantidade; 
                        
                          break;                      
                      case '04':
                            $quantidade = $horas['horas']['04'][$ds->_matchingData['Estacao']->nome] + 1;
                            $horas['horas']['04'][$ds->_matchingData['Estacao']->nome] = $quantidade; 
                        
                          break;                      
                      case '05':
                            $quantidade = $horas['horas']['05'][$ds->_matchingData['Estacao']->nome] + 1;
                            $horas['horas']['05'][$ds->_matchingData['Estacao']->nome] = $quantidade; 
                        
                          break;                      
                      case '06':
                            $quantidade = $horas['horas']['06'][$ds->_matchingData['Estacao']->nome] + 1;
                            $horas['horas']['06'][$ds->_matchingData['Estacao']->nome] = $quantidade; 
                        
                          break;                      
                      case '07':
                            $quantidade = $horas['horas']['07'][$ds->_matchingData['Estacao']->nome] + 1;
                            $horas['horas']['07'][$ds->_matchingData['Estacao']->nome] = $quantidade; 
                        
                          break;                      
                      case '08':
                            $quantidade = $horas['horas']['08'][$ds->_matchingData['Estacao']->nome] + 1;
                            $horas['horas']['08'][$ds->_matchingData['Estacao']->nome] = $quantidade; 
                        
                          break;                      
                      case '09':
                            $quantidade = $horas['horas']['09'][$ds->_matchingData['Estacao']->nome] + 1;
                            $horas['horas']['09'][$ds->_matchingData['Estacao']->nome] = $quantidade; 
                        
                          break;                      
                      case '10':
                            $quantidade = $horas['horas']['10'][$ds->_matchingData['Estacao']->nome] + 1;
                            $horas['horas']['10'][$ds->_matchingData['Estacao']->nome] = $quantidade;

                          break;                      
                      case '11':
                            $quantidade = $horas['horas']['11'][$ds->_matchingData['Estacao']->nome] + 1;
                            $horas['horas']['11'][$ds->_matchingData['Estacao']->nome] = $quantidade; 
                        
                          break;                      
                      case '12':
                            $quantidade = $horas['horas']['12'][$ds->_matchingData['Estacao']->nome] + 1;
                            $horas['horas']['12'][$ds->_matchingData['Estacao']->nome] = $quantidade; 
                        
                          break;                      
                      case '13':
                            $quantidade = $horas['horas']['13'][$ds->_matchingData['Estacao']->nome] + 1;
                            $horas['horas']['13'][$ds->_matchingData['Estacao']->nome] = $quantidade; 
                        
                          break;                      
                      case '14':
                            $quantidade = $horas['horas']['14'][$ds->_matchingData['Estacao']->nome] + 1;
                            $horas['horas']['14'][$ds->_matchingData['Estacao']->nome] = $quantidade; 
                        
                          break;                      
                      case '15':
                            $quantidade = $horas['horas']['15'][$ds->_matchingData['Estacao']->nome] + 1;
                            $horas['horas']['15'][$ds->_matchingData['Estacao']->nome] = $quantidade; 
                        
                          break;                      
                      case '16':
                            $quantidade = $horas['horas']['16'][$ds->_matchingData['Estacao']->nome] + 1;
                            $horas['horas']['16'][$ds->_matchingData['Estacao']->nome] = $quantidade; 
                        
                          break;                      
                      case '17':
                            $quantidade = $horas['horas']['17'][$ds->_matchingData['Estacao']->nome] + 1;
                            $horas['horas']['17'][$ds->_matchingData['Estacao']->nome] = $quantidade; 
                        
                          break;                      
                      case '18':
                            $quantidade = $horas['horas']['18'][$ds->_matchingData['Estacao']->nome] + 1;
                            $horas['horas']['18'][$ds->_matchingData['Estacao']->nome] = $quantidade; 
                        
                          break;                      
                      case '19':
                            $quantidade = $horas['horas']['19'][$ds->_matchingData['Estacao']->nome] + 1;
                            $horas['horas']['19'][$ds->_matchingData['Estacao']->nome] = $quantidade; 
                        
                          break;                      
                      case '20':
                            $quantidade = $horas['horas']['20'][$ds->_matchingData['Estacao']->nome] + 1;
                            $horas['horas']['20'][$ds->_matchingData['Estacao']->nome] = $quantidade; 
                        
                          break;                      
                      case '21':
                            $quantidade = $horas['horas']['21'][$ds->_matchingData['Estacao']->nome] + 1;
                            $horas['horas']['21'][$ds->_matchingData['Estacao']->nome] = $quantidade; 
                        
                          break;                      
                      case '22':
                            $quantidade = $horas['horas']['22'][$ds->_matchingData['Estacao']->nome] + 1;
                            $horas['horas']['22'][$ds->_matchingData['Estacao']->nome] = $quantidade; 
                        
                          break;                      
                      case '23':
                            $quantidade = $horas['horas']['23'][$ds->_matchingData['Estacao']->nome] + 1;
                            $horas['horas']['23'][$ds->_matchingData['Estacao']->nome] = $quantidade; 
                        
                          break;                      

                      default:
                          # code...
                          break;
                  }  
                
            } 
        }
        //debug($horas['horas']);
        //$estacaoHorario;
        /*foreach ($horas['horas'] as $hs) {
            //$hs['horas']->estacao;
            //debug($hs);

            /*foreach ($hs as $ob) {
                debug($ob);

                /*$estacaoHorario['horario'][] = $ob->horario;
                if( !in_array($ob->estacao, $estacaoHorario['horario']['estacao'] )  ){
                    $estacaoHorario['horario']['estacao'] = $ob->estacao;
                }
                debug($estacaoHorario);*/


          /*  }*/
            /*$obj = new \StdClass;
            $obj->horas = $hs[0];
            debug($hs);
            $obj->quantidade = $hs['quantidade'] + $;
            array_push($dataProcessamento, $obj);
            */
        /*}*/
        return $horas;

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
