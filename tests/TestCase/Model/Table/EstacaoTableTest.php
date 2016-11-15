<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EstacaoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EstacaoTable Test Case
 */
class EstacaoTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EstacaoTable
     */
    public $Estacao;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.estacao',
        'app.estacaos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Estacao') ? [] : ['className' => 'App\Model\Table\EstacaoTable'];
        $this->Estacao = TableRegistry::get('Estacao', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Estacao);

        parent::tearDown();
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
