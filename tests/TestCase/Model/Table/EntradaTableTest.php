<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EntradaTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EntradaTable Test Case
 */
class EntradaTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EntradaTable
     */
    public $Entrada;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.entrada',
        'app.entradas',
        'app.estacao',
        'app.estacaos',
        'app.usuario',
        'app.usuarios'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Entrada') ? [] : ['className' => 'App\Model\Table\EntradaTable'];
        $this->Entrada = TableRegistry::get('Entrada', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Entrada);

        parent::tearDown();
    }

    /**
     * Test getRelatorio method
     *
     * @return void
     */
    public function testGetRelatorio()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
