<?php

namespace Controllers;

use Exception;
use Model\Puesto;
use MVC\Router;

class PuestoController

{
    // Método para mostrar todos los puestos en la vista
    public static function index(Router $router)
    {
        $puestos = Puesto::obtenerPuestosconQuery();  // Obtener todos los puestos con el método del modelo
        $router->render('puestos/index', [
            'puestos' => $puestos
        ]);
    }

    // Método para guardar un puesto usando la API
    public static function guardarAPI()
    {
        // Sanitizamos los datos del formulario
        $_POST['puesto_nombre'] = htmlspecialchars($_POST['puesto_nombre']);
        $_POST['puesto_descripcion'] = htmlspecialchars($_POST['puesto_descripcion']);
        $_POST['puesto_salario'] = filter_var($_POST['puesto_salario'], FILTER_SANITIZE_NUMBER_FLOAT);
        $_POST['puesto_direccion'] = htmlspecialchars($_POST['puesto_direccion']);
        $_POST['puesto_cliente'] = filter_var($_POST['puesto_cliente'], FILTER_SANITIZE_NUMBER_INT);

        try {
            // Crear un nuevo puesto con los datos recibidos
            $puesto = new Puesto($_POST);
            $resultado = $puesto->crear();  // Método heredado de ActiveRecord
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Puesto guardado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al guardar puesto',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    // Método para buscar puestos y devolverlos en formato JSON
    public static function buscarAPI()
    {
        try {
            // Obtener todos los puestos activos
            $puestos = Puesto::obtenerPuestosconQuery();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Datos encontrados',
                'detalle' => '',
                'datos' => $puestos
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al buscar puestos',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    // Método para modificar un puesto usando la API
    public static function modificarAPI()
    {
        $_POST['puesto_nombre'] = htmlspecialchars($_POST['puesto_nombre']);
        $_POST['puesto_descripcion'] = htmlspecialchars($_POST['puesto_descripcion']);
        $_POST['puesto_salario'] = filter_var($_POST['puesto_salario'], FILTER_SANITIZE_NUMBER_FLOAT);
        $_POST['puesto_direccion'] = htmlspecialchars($_POST['puesto_direccion']);
        $_POST['puesto_cliente'] = filter_var($_POST['puesto_cliente'], FILTER_SANITIZE_NUMBER_INT);
        $id = filter_var($_POST['puesto_id'], FILTER_SANITIZE_NUMBER_INT);

        try {
            // Buscar el puesto por su ID
            $puesto = Puesto::find($id);
            // Sincronizar los nuevos datos con el objeto
            $puesto->sincronizar($_POST);
            // Actualizar en la base de datos
            $puesto->actualizar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Puesto modificado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al modificar puesto',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    // Método para eliminar un puesto usando la API
    public static function eliminarAPI()
    {
        $id = filter_var($_POST['puesto_id'], FILTER_SANITIZE_NUMBER_INT);
        try {
            // Buscar el puesto por su ID
            $puesto = Puesto::find($id);
            // Eliminar el registro
            $puesto->eliminar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Puesto eliminado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al eliminar puesto',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
}
