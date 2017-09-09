<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InstitucionesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InstitucionesTable Test Case
 */
class InstitucionesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InstitucionesTable
     */
    public $Instituciones;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.instituciones'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Instituciones') ? [] : ['className' => InstitucionesTable::class];
        $this->Instituciones = TableRegistry::get('Instituciones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Instituciones);

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
