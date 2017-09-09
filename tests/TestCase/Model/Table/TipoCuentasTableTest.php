<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TipoCuentasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TipoCuentasTable Test Case
 */
class TipoCuentasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TipoCuentasTable
     */
    public $TipoCuentas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tipo_cuentas',
        'app.cuentas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TipoCuentas') ? [] : ['className' => TipoCuentasTable::class];
        $this->TipoCuentas = TableRegistry::get('TipoCuentas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TipoCuentas);

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
