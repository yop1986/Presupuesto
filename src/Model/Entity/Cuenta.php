<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cuenta Entity
 *
 * @property int $id
 * @property string $nombre
 * @property float $saldo
 * @property bool $estado
 * @property int $moneda_id
 * @property int $tipo_cuenta_id
 * @property int $institucion_id
 * @property int $usuario_id
 *
 * @property \App\Model\Entity\Moneda $moneda
 * @property \App\Model\Entity\TipoCuenta $tipo_cuenta
 * @property \App\Model\Entity\Institucion $institucion
 * @property \App\Model\Entity\Usuario $usuario
 */
class Cuenta extends Entity
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
        'id' => false
    ];
}
