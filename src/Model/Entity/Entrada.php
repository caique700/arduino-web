<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Entrada Entity
 *
 * @property int $estacao_id_estacao
 * @property int $usuario_id_usuario
 * @property \Cake\I18n\Time $data_entrada
 * @property int $entrada_id
 * @property \Cake\I18n\Time $data_saida
 *
 * @property \App\Model\Entity\Entrada $entrada
 * @property \App\Model\Entity\Estacao $estacao
 * @property \App\Model\Entity\Usuario $usuario
 */
class Entrada extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'entrada_id' => false
    ];
}
