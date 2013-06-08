<?php

class Reportes extends Conexion {

    public $date_start;
    public $date_end;
    public $sqlQuery;
    public $idUsuario;
    public $anio;
    public $texto_buscar;

    public function __construct() {
        parent::conexion();
    }

    public function __destruct() {
        parent::conexion();
    }

    public function load_becas($all_row = 0) {
        try {
            $array_data = array();
            //verificacion si se filtraran los datos
            $this->sqlQuery = "SELECT b.id_alumno,";
            $this->sqlQuery .="TRIM(concat(IFNULL(c.nombres,''),' ',IFNULL(c.apellido_pri,''),' ',IFNULL(c.apellido_seg,''))) alumno,";
            $this->sqlQuery .="d.nombre_institucion,e.grado,a.seccion,f.Monto,";
            $this->sqlQuery .="DATE_FORMAT(f.fecha_creacion,'%Y-%m-%d') fechabeca";
            $this->sqlQuery .=" from registro_alumno a inner join alumno b on a.id_alumno=b.id_alumno ";
            $this->sqlQuery .="inner join persona c on b.id_persona=c.id_persona ";
            $this->sqlQuery .="inner join institucion_educativa d on a.id_institucion_edu=d.id_institucion ";
            $this->sqlQuery .="inner join grado e on a.id_grado=e.id_grado ";
            $this->sqlQuery .="inner join beca_escolar f on a.id_registro=f.id_registro_alumno ";
            $this->sqlQuery .="where f.activo=1 and  ";
            if ($all_row == 1):
                $this->sqlQuery .=" f.fecha_creacion BETWEEN '" . date("Y") . "-" . date("m") . "-01 00:00:00' AND '" . date("Y") . "-" . date("m") . "-31 23:59:59'";
            elseif ($all_row == 2):
                $this->sqlQuery .=" f.fecha_creacion BETWEEN '" . $this->date_start . " 00:00:00' AND '" . $this->date_end . " 23:59:59'";
            elseif ($all_row == 3):
                $this->sqlQuery .=" a.id_institucion_edu= " . $this->texto_buscar;
            elseif ($all_row == 4):
                $this->sqlQuery .=" c.nombres like '%" . $this->texto_buscar . "%' OR  c.apellido_pri like '%" . $this->texto_buscar . "%' OR c.apellido_seg like '%" . $this->texto_buscar . "%'";
            endif;

            $this->sqlQuery .=" order by f.fecha_creacion,b.id_alumno asc";
            $resultSet = $this->conection->prepare($this->sqlQuery);
            $resultSet->execute();
            $coicidencias = $resultSet->rowCount();
            if ($coicidencias > 0) {
                $i = 1;
                while ($row = $resultSet->fetch(PDO::FETCH_ASSOC)) {
                    $array_data[$i] = array(
                        "idalumno" => $row["id_alumno"],
                        "alumno" => $row["alumno"],
                        "nombre_institucion" => $row["nombre_institucion"],
                        "grado" => $row["grado"],
                        "seccion" => $row["seccion"],
                        "monto" => $row["Monto"],
                        "fecha" => $row["fechabeca"]
                    );
                    $i++;
                }
                $this->bandera = 1;
            } else {
                $this->mensaje = "NO SE ENCONTRARON COICIDENCIAS";
                $this->bandera = 0;
            }
            return $array_data;
        } catch (PDOException $e) {
            $this->mensaje = "Error: " . $e->getMessage();
            $this->bandera = 0;
        }
    }

    public function load_donaciones($all_row = 0) {
        try {
            $array_data = array();
            //verificacion si se filtraran los datos                     
            $this->sqlQuery = "select c.id_persona,TRIM(concat(IFNULL(d.nombres,''),' ',IFNULL(d.apellido_pri,''),' ',IFNULL(d.apellido_seg,''))) donante,";
            $this->sqlQuery .="TRIM(concat(IFNULL(f.nombres,''),' ',IFNULL(f.apellido_pri,''),' ',IFNULL(f.apellido_seg,''))) promotor,";
            $this->sqlQuery .="b.descripcion tipo_pago,g.monto,g.numero_recibo,g.fecha ";
            $this->sqlQuery .="from donacion a ";
            $this->sqlQuery .="inner join tipo_pago b on a.id_tipo_pago=b.id_tipo_pago ";
            $this->sqlQuery .="inner join donante c on a.id_donante=c.id_donante ";
            $this->sqlQuery .="inner join persona d on c.id_persona=d.id_persona ";
            $this->sqlQuery .="inner join promotor e on a.id_promotor=e.id_promotor ";
            $this->sqlQuery .="inner join persona f on e.id_persona=f.id_persona ";
            $this->sqlQuery .="inner join pagos g on a.id_donacion=g.id_donacion ";
            $this->sqlQuery.="where  ";
            if ($all_row == 1):
                $this->sqlQuery .=" g.fecha BETWEEN '" . date("Y") . "-" . date("m") . "-01 00:00:00' AND '" . date("Y") . "-" . date("m") . "-31 23:59:59'";
                $this->sqlQuery .=" AND c.id_usuario=" . $this->idUsuario;
            elseif ($all_row == 2):
                $this->sqlQuery .=" g.fecha BETWEEN '" . $this->date_start . " 00:00:00' AND '" . $this->date_end . " 23:59:59'";
                $this->sqlQuery .=" AND c.id_usuario=" . $this->idUsuario;
            elseif ($all_row == 3):
                //PARA EL MODULO DEL ADMINISTRADOR - AUTOCARGA
                $this->sqlQuery .=" g.fecha BETWEEN '" . date("Y") . "-" . date("m") . "-01 00:00:00' AND '" . date("Y") . "-" . date("m") . "-31 23:59:59'";
                $this->sqlQuery .=" AND c.id_usuario=" . $this->idUsuario;
            elseif ($all_row == 4):
                //PARA EL MODULO DEL ADMINISTRADOR - BUSQUEDA POR FECHAS
                $this->sqlQuery .=" g.fecha BETWEEN '" . $this->date_start . " 00:00:00' AND '" . $this->date_end . " 23:59:59'";
            elseif ($all_row == 5):
                //PARA EL MODULO DEL ADMINISTRADOR - BUSQUEDA POR DONANTE
                $this->sqlQuery .=" d.nombres like '%" . $this->texto_buscar . "%' OR  d.apellido_pri like '%" . $this->texto_buscar . "%' OR d.apellido_seg like '%" . $this->texto_buscar . "%'";
            elseif ($all_row == 6):
                //PARA EL MODULO DEL ADMINISTRADOR - BUSQUEDA POR DONANTE
                $this->sqlQuery .=" f.nombres like '%" . $this->texto_buscar . "%' OR  f.apellido_pri like '%" . $this->texto_buscar . "%' OR f.apellido_seg like '%" . $this->texto_buscar . "%'";
            endif;

            $this->sqlQuery .=" order by g.fecha,c.id_persona asc ";
            $resultSet = $this->conection->prepare($this->sqlQuery);
            $resultSet->execute();
            $coicidencias = $resultSet->rowCount();
            if ($coicidencias > 0) {
                $i = 1;
                while ($row = $resultSet->fetch(PDO::FETCH_ASSOC)) {
                    $array_data[$i] = array(
                        "donante" => $row["donante"],
                        "promotor" => $row["promotor"],
                        "tipo_pago" => $row["tipo_pago"],
                        "monto" => $row["monto"],
                        "numero_recibo" => $row["numero_recibo"],
                        "fecha" => $row["fecha"]
                    );
                    $i++;
                }
                $this->bandera = 1;
            } else {
                $this->mensaje = "NO SE ENCONTRARON COICIDENCIAS";
                $this->bandera = 0;
            }
            return $array_data;
        } catch (PDOException $e) {
            $this->mensaje = "Error: " . $e->getMessage();
            $this->bandera = 0;
        }
    }

    public function load_notas_becados($all_row = 0) {
        try {
            $array_data = array();
            //verificacion si se filtraran los datos                     
            $this->sqlQuery = "select DISTINCT(a.id_alumno),TRIM(concat(IFNULL(c.nombres,''),' ',IFNULL(c.apellido_pri,''),' ',IFNULL(c.apellido_seg,''))) alumno,";
            $this->sqlQuery .="d.nombre_institucion,e.grado,a.seccion,a.nota_promedio,a.anio, ";
            $this->sqlQuery .="TRIM(concat(IFNULL(h.nombres,''),' ',IFNULL(h.apellido_pri,''),' ',IFNULL(h.apellido_seg,''))) donante ";
            $this->sqlQuery .="from registro_alumno a ";
            $this->sqlQuery .="inner join alumno b on a.id_alumno=b.id_alumno ";
            $this->sqlQuery .="inner join persona c on b.id_persona=c.id_persona ";
            $this->sqlQuery .="inner join institucion_educativa d on a.id_institucion_edu=d.id_institucion ";
            $this->sqlQuery .="inner join grado e on a.id_grado=e.id_grado ";
            $this->sqlQuery .="inner join donacion f  on a.id_registro=f.id_registro_alumno ";
            $this->sqlQuery .="inner join donante g on f.id_donante=g.id_donante ";
            $this->sqlQuery.="inner join persona h on g.id_persona=h.id_persona ";
            $this->sqlQuery.="where a.activa=1 ";
            if ($all_row == 1):
                //PARA EL MODULO DEL DONANTE - AUTOCARGA
                $this->sqlQuery .="and a.anio=" . date('Y');
                $this->sqlQuery .=" AND g.id_usuario=" . $this->idUsuario;
            elseif ($all_row == 2):
                //PARA EL MODULO DEL DONANTE - BUSQUEDA DE ANIO
                $this->sqlQuery .=" and a.anio=" . $this->anio;
                $this->sqlQuery .=" AND g.id_usuario=" . $this->idUsuario;
            elseif ($all_row == 3):
                //PARA EL MODULO DEL DONANTE - BUSQUEDA DE NOMBRE ALUMNO                
                $this->sqlQuery .=" AND c.nombres like '%" . $this->texto_buscar . "%' OR  c.apellido_pri like '%" . $this->texto_buscar . "%' OR c.apellido_seg like '%" . $this->texto_buscar . "%'";
            elseif ($all_row == 4):
                //PARA EL MODULO DEL DONANTE - BUSQUEDA AUTO CARGA POR AÑO 
                $this->sqlQuery .="and a.anio=" . date('Y');
            elseif ($all_row == 5):
                //PARA EL MODULO DEL DONANTE - BUSQUEDA POR AÑO 
                $this->sqlQuery .="and a.anio=" . $this->anio;
            elseif ($all_row == 6):
                //PARA EL MODULO DEL DONANTE - BUSQUEDA POR INSTITUCION 
                $this->sqlQuery .="and a.id_institucion_edu=" . $this->texto_buscar;
            elseif ($all_row == 7):
                //PARA EL MODULO DEL DONANTE - BUSQUEDA POR FECHAS 
                $this->sqlQuery .=" AND a.fecha_creacion BETWEEN '" . $this->date_start . " 00:00:00' AND '" . $this->date_end . " 23:59:59'";
            elseif ($all_row == 8):
                //PARA EL MODULO DEL DONANTE - BUSQUEDA DE NOMBRE DONANTE                
                $this->sqlQuery .=" AND h.nombres like '%" . $this->texto_buscar . "%' OR  h.apellido_pri like '%" . $this->texto_buscar . "%' OR h.apellido_seg like '%" . $this->texto_buscar . "%'";
            endif;

            $this->sqlQuery .=" order by a.fecha_creacion,b.id_alumno asc ";
            $resultSet = $this->conection->prepare($this->sqlQuery);
            $resultSet->execute();
            $coicidencias = $resultSet->rowCount();
            if ($coicidencias > 0) {
                $i = 1;
                while ($row = $resultSet->fetch(PDO::FETCH_ASSOC)) {
                    $array_data[$i] = array(
                        "alumno" => $row["alumno"],
                        "institucion" => $row["nombre_institucion"],
                        "grado" => $row["grado"],
                        "seccion" => $row["seccion"],
                        "nota" => $row["nota_promedio"],
                        "anio" => $row["anio"],
                        "donante" => $row["donante"]
                    );
                    $i++;
                }
                $this->bandera = 1;
            } else {
                $this->mensaje = "NO SE ENCONTRARON COICIDENCIAS";
                $this->bandera = 0;
            }
            return $array_data;
        } catch (PDOException $e) {
            $this->mensaje = "Error: " . $e->getMessage();
            $this->bandera = 0;
        }
    }

}

?>
