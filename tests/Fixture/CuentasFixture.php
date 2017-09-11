<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CuentasFixture
 *
 */
class CuentasFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'cuentas';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 8, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'nombre' => ['type' => 'string', 'length' => 60, 'null' => false, 'default' => null, 'collate' => 'utf8_spanish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'saldo' => ['type' => 'decimal', 'length' => 15, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => '0.00', 'comment' => ''],
        'estado' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => 'true: activo/false: inactivo', 'precision' => null],
        'tipo_cuenta_id' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'institucion_id' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'usuario_id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'cuentas_fk_tpcuentas' => ['type' => 'index', 'columns' => ['tipo_cuenta_id'], 'length' => []],
            'cuentas_fk_institucion' => ['type' => 'index', 'columns' => ['institucion_id'], 'length' => []],
            'cuentas_fk_usuario' => ['type' => 'index', 'columns' => ['usuario_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'cuentas_unq_nombre' => ['type' => 'unique', 'columns' => ['nombre'], 'length' => []],
            'cuentas_fk_institucion' => ['type' => 'foreign', 'columns' => ['institucion_id'], 'references' => ['instituciones', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'cuentas_fk_tpcuentas' => ['type' => 'foreign', 'columns' => ['tipo_cuenta_id'], 'references' => ['tipo_cuentas', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'cuentas_fk_usuario' => ['type' => 'foreign', 'columns' => ['usuario_id'], 'references' => ['usuarios', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_spanish_ci'
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
            'id' => 1,
            'nombre' => 'Lorem ipsum dolor sit amet',
            'saldo' => 1.5,
            'estado' => 1,
            'tipo_cuenta_id' => 1,
            'institucion_id' => 1,
            'usuario_id' => 1
        ],
    ];
}
