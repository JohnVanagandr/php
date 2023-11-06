<?php

namespace Adso\libs;

use Adso\libs\Database;

/**
 * La clase Permisson proporciona metodos para trabajar con las url protegidas 
 * @package libs
 * @author Jhonatan David Motta Medina
 */
class Permisson
{

    private $sesion;

    /**
     * Metodo constructor devuelve una instancia de la clase Session que sirve para inicializar una sesion
     *
     *
     * @return object de la clase Session
     */
    function __construct()
    {
        $this->sesion = new Session();
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
     * @return boolean devuelve true si tiene permiso, false si no posee el permiso
     */
    public function ifpermisson($id)
    {

        print_r($id);
        die();
        /*
         * se inicializa la variable $respuesta como false que sera la variable de retorno
         * para validar si el rol posee el permiso o no
         */
        $respuesta = false;
        /*
         * obtiene el id_rol_fk del usuario que inicio session
         */
        $role = $this->sesion->getUser()['id_role_fk'];
        /*
         * si el id_rol_fk del usuario es igual al id que llega por parametro $respuesta es true
         * o sea si posee el permiso
         * 
         */
        if ($this->sesion->getLogin()) {
            if ($role == $id) {
                $respuesta = true;
            }
        }

        return $respuesta;
    }
}