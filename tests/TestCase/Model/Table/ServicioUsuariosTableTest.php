<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ServicioUsuariosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ServicioUsuariosTable Test Case
 */
class ServicioUsuariosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ServicioUsuariosTable
     */
    public $ServicioUsuarios;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.servicio_usuarios',
        'app.servicios',
        'app.usuarios',
        'app.cuentas',
        'app.monedas',
        'app.tipo_cuentas',
        'app.instituciones',
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
        $config = TableRegistry::exists('ServicioUsuarios') ? [] : ['className' => ServicioUsuariosTable::class];
        $this->ServicioUsuarios = TableRegistry::get('ServicioUsuarios', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ServicioUsuarios);

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
