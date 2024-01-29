<?php

  # Incluimos la clase conexion para poder heredar los metodos de ella.
  require_once('conexion.php');


  class Usuario extends Conexion
  {

    public function login($user, $clave)
    {
      # Nos conectamos a la base de datos
      parent::conectar();

      // El metodo salvar sirve para escapar cualquier comillas doble o simple y otros caracteres que pueden vulnerar nuestra consulta SQL
      $user  = parent::salvar($user);
      $clave = parent::salvar($clave);
      // traemos el id y el nombre de la tabla usuarios donde el usuario sea igual al usuario ingresado y ademas la clave sea igual a la ingresada para ese usuario.
      $consulta = 'select id, nombre from administradores where email="'.$user.'" and clave= MD5("'.$clave.'")';
      $verificar_usuario = parent::verificarRegistros($consulta);

      // si la consulta es mayor a 0 el usuario existe
      if($verificar_usuario > 0){

        $user = parent::consultaArreglo($consulta);
        session_start();

        $_SESSION['id']     = $user['id'];
        $_SESSION['nombre'] = $user['nombre'];
        //Estableciendo una variable de sesión especifica para indicar que es un administrador
        $_SESSION['es_administrador']=true;
        echo 'administrador.php';
        
      }else{
        // El usuario y la clave son incorrectos
        echo 'error_3';
      }


      # Cerramos la conexion
      parent::cerrar();
    }

    public function registroUsuario($name, $email, $clave)
    {
      parent::conectar();

      $name  = parent::filtrar($name);
      $email = parent::filtrar($email);
      $clave = parent::filtrar($clave);


      // validar que el correo no exito
      $verificarCorreo = parent::verificarRegistros('select id from administradores where email="'.$email.'" ');


      if($verificarCorreo > 0){
        echo 'error_3';
      }else{

        parent::query('insert into administradores(nombre, email, clave) values("'.$name.'", "'.$email.'", MD5("'.$clave.'"))');

        session_start();

        $_SESSION['nombre'] = $name;

        echo 'index.php';

      }

      parent::cerrar();
    }

  }


?>
