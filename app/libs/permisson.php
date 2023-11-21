<?php

namespace Adso\libs;

use Adso\libs\Database;
use Adso\model\Permisson_RoleModel;
use Adso\model\PermissonModel;
use Adso\model\RoleModel;

/**
 * La clase Permisson proporciona metodos para trabajar con las url protegidas 
 * @package libs
 * @author Jhonatan David Motta Medina
 */
class Permisson
{

    private $sesion;
    protected $model;
    protected $model2;
    protected $model3;

    /**
     * Metodo constructor devuelve una instancia de la clase Session que sirve para inicializar una sesion
     *
     *
     * @return object de la clase Session
     */
    function __construct()
    {
        $this->sesion = new Session();
        $this->model = new RoleModel();
        $this->model2 = new PermissonModel;
        $this->model3 = new Permisson_RoleModel();
    }

    /**
     * Obtiene el rol de la session que se ha inicializado y verifica que rol tiene el usuario
     *  para darle acceso a determinada vista
     *
     * @return void
     */
    function getRoles()
    {
        /*
         * Verifica si la el metodo getLogin de la clase Session devulve true o false dependiendo
         * si la session se ha iniciado o no
         */
        if ($this->sesion->getLogin()) {
            /*
             * Le asigna a la variable $role el id_role_fk usando el metodo getUser que devuelve 
             * la session que es un array asociativo
             */
            $role = $this->sesion->getUser()['id_role_fk'];
            /*
             * Recorre el array ROLES que contiene los id de los dos roles
             * y si $role es igual al $valor del array lo lleva a la vista ya sea de admin o user
             * de lo contrario devuel al login 
             */
            foreach (constant('ROLES') as $key => $valor) {
                if ($role == $valor) {
                    header('location:' . URL . '/' . $key);
                }
            }
            /*
             * Devuelve el usuario al login si no posee uno de los dos roles existentes (admin o user)
             */
        } else {
            header('location:' . URL . '/login');
        }
    }

    /**
     * Verifica que permisos tiene el usuario y devuelve
     *
     * @param int $id del rol para verificar que permisos tiene relacionados dichol rol
     * @return array devuelve true si tiene permiso, false si no posee el permiso
     */
    public function ifpermisson()
    {

        $role = $this->sesion->getUser()["id_role_fk"];


        /**Usa el metodo getPermisson de PermissonModel que a su vez usa el metodo select de 
         * Model que obtiene todos los datos de una tabla en especifico
         */
        $permit = $this->model2->getPermisson();
        /*Usa el metodo selectPermits de Permisson_RoleModel que a su vez usa el metodo getRowById 
        de Model que obtiene una fila por id
        */
    
        $permit_role = $this->model3->selectPermits(["id_role_fk" => $role]);
    
        $permissons = array();
    
        foreach ($permit as $value) {
    
          foreach ($permit_role as $value_role) {
            
            if ($value_role['id_permisson_fk'] == $value['id_permission']) {
    
              $permissons[$value['name_permisson']] = true;
              break;
            } else {
              $permissons[$value['name_permisson']] = false;
            }
          }
    
        }
       
        return $permissons;
    }
}