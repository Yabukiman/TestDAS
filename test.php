<?php
class FTP {
	$conn = new DatabaseConnection("localhost", "user", "password", "db");

	# 1: Subir archivo
	public function upload($file) {
		move_uploaded_file($file['tmp_name'][0], $this->destination.$this->fileName) or $this->error .= 'Error al mover archivo.';
		if ($this->error) {
			echo $this->error;
		} else {
			echo "Archivo movido exitosamente.";
		}
	}

	#2: Eliminar archivo
	public function delete($file) {
		if (file_exists($file)) unlink($file) or $this->error .= 'Error al borrar.';
    	if ($this->error) {
			echo $this->error;
		} else {
			echo "Archivo eliminado exitosamente.";
		}
  	}

  	#3: Creación recursiva de carpetas
	public function create_folders($folders, $permissions) {
  		mkdir($folders, $permissions, true) or $this->error .= 'Error al crear carpetas.';
    	if ($this->error) {
			echo $this->error;
		} else {
			echo "Carpeta creada exitosamente.";
		}
  	}

  	#4: Cerrar conexión
	public function close_connection($conn) {
  		ftp_close($conn) or $this->error .= 'No se pudo cerrar la conexión.';
    	if ($this->error) {
			echo $this->error;
		} else {
			echo "Conexión cerrada.";
		}
  	}

  	#5, #6: Permisos a carpetas o archivos
	public function change_permissions($conn, $permissions, $file_folder) {
  		ftp_chmod($conn, $permissions, $file_folder) or $this->error .= 'Error al asignar permisos.';
    	if ($this->error) {
			echo $this->error;
		} else {
			echo "Permisos cambiados.";
		}
  	}

  	#7, #8: Renombrar carpetas o archivos
  	public function rename($conn, $file_folder, $new_name) {
  		ftp_rename($conn, $file_folder, $new_name) or $this->error .= 'Error al renombrar.';
    	if ($this->error) {
			echo $this->error;
		} else {
			echo "Elemento renombrado.";
		}
  	}

  	#9: Obtener tamaño de archivo
  	public function get_size($conn, $file) {
  		$size = ftp_size($conn, $file) or $this->error .= 'Error al consultar tamaño.';
    	if ($this->error) {
			echo $this->error;
		} else {
			echo "El tamaño del archivo es de " . $size . ".";
		}
  	}
}
?>