<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MonedasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MonedasTable Test Case
 */
class MonedasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MonedasTable
     */
    public $Monedas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.monedas',
        'app.cuentas',
        'app.tipo_cuentas',
        'app.instituciones',
        'app.usuarios',
        'app.servicios',
        'app.servicios_usuarios'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Monedas') ? [] : ['className' => MonedasTable::class];
        $this->Monedas = TableRegistry::get('Monedas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Monedas);

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
