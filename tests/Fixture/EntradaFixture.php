<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EntradaFixture
 *
 */
class EntradaFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'entrada';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'estacao_id_estacao' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'usuario_id_usuario' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'data_entrada' => ['type' => 'date', 'length' => null, 'default' => 'now()', 'null' => true, 'comment' => null, 'precision' => null],
        'entrada_id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'data_saida' => ['type' => 'date', 'length' => null, 'default' => 'now()', 'null' => true, 'comment' => null, 'precision' => null],
        '_constraints' => [
            'estacao_fk' => ['type' => 'foreign', 'columns' => ['estacao_id_estacao'], 'references' => ['estacao', 'estacao_id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'usuario_fk' => ['type' => 'foreign', 'columns' => ['usuario_id_usuario'], 'references' => ['usuario', 'usuario_id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'estacao_id_estacao' => 1,
            'usuario_id_usuario' => 1,
            'data_entrada' => '2016-11-14',
            'entrada_id' => 1,
            'data_saida' => '2016-11-14'
        ],
    ];
}
