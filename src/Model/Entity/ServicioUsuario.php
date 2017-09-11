<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ServicioUsuario Entity
 *
 * @property int $id
 * @property string $descripcion
 * @property int $servicio_id
 * @property int $usuario_id
 *
 * @property \App\Model\Entity\Servicio $servicio
 * @property \App\Model\Entity\Usuario $usuario
 */
class ServicioUsuario extends Entity
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

    protected function _getServicioDetallado()
    {
        return $this->_properties['servicio']['nombre'] . ' - ' . $this->_properties['descripcion'];
    }
}
