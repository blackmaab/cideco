--PAGO DE DONACIONES (incluir al donante)

select c.id_persona,TRIM(concat(IFNULL(d.nombres,''),' ',IFNULL(d.apellido_pri,''),' ',IFNULL(d.apellido_seg,''))) donante,TRIM(concat(IFNULL(f.nombres,''),' ',IFNULL(f.apellido_pri,''),' ',IFNULL(f.apellido_seg,''))) promotor,b.descripcion tipo_pago,g.monto,g.numero_recibo,g.fecha from donacion a inner join tipo_pago b on a.id_tipo_pago=b.id_tipo_pago inner join donante c on a.id_donante=c.id_donante inner join persona d on c.id_persona=d.id_persona inner join promotor e on a.id_promotor=e.id_promotor inner join persona f on e.id_persona=f.id_persona inner join pagos g on a.id_donacion=g.id_donacion where g.fecha BETWEEN '2013-05-30' AND '2013-05-30' order by g.fecha,c.id_persona asc



--LISTADO DE DONACIONES
select c.id_persona,TRIM(concat(IFNULL(d.nombres,''),' ',IFNULL(d.apellido_pri,''),' ',IFNULL(d.apellido_seg,''))) donante,TRIM(concat(IFNULL(f.nombres,''),' ',IFNULL(f.apellido_pri,''),' ',IFNULL(f.apellido_seg,''))) promotor,b.descripcion tipo_pago,a.Monto from donacion a inner join tipo_pago b on a.id_tipo_pago=b.id_tipo_pago inner join donante c on a.id_donante=c.id_donante inner join persona d on c.id_persona=d.id_persona inner join promotor e on a.id_promotor=e.id_promotor inner join persona f on e.id_persona=f.id_persona where a.fecha_creacion BETWEEN '2013-05-01 00:00:00' AND '2013-05-31 23:59:59' AND a.estado=2 order by c.id_persona asc


--CONSULTA BECAS


select b.id_alumno,TRIM(concat(IFNULL(c.nombres,''),' ',IFNULL(c.apellido_pri,''),' ',IFNULL(c.apellido_seg,''))) alumno,d.nombre_institucion,e.grado,a.seccion,f.Monto,DATE_FORMAT(f.fecha_creacion,'%Y-%m-%d') fechabeca from registro_alumno a inner join alumno b on a.id_alumno=b.id_alumno inner join persona c on b.id_persona=c.id_persona inner join institucion_educativa d on a.id_institucion_edu=d.id_institucion inner join grado e on a.id_grado=e.id_grado inner join beca_escolar f on a.id_registro=f.id_registro_alumno where f.activo=1 and f.fecha_creacion BETWEEN '2013-05-01 00:00:00' AND '2013-05-31 23:59:59' order by f.fecha_creacion,b.id_alumno asc


--CONSULTAS DE NOTAS
--se debe de considerar para que el donante pueda realizar la consulta
-- y tambien una vista general para la administracion sin filtro el donante
//para el id_donante
$_SESSION['USERID']

select b.id_alumno,TRIM(concat(IFNULL(c.nombres,''),' ',IFNULL(c.apellido_pri,''),' ',IFNULL(c.apellido_seg,''))) alumno,d.nombre_institucion,e.grado,a.seccion,a.nota_promedio,a.anio,TRIM(concat(IFNULL(h.nombres,''),' ',IFNULL(h.apellido_pri,''),' ',IFNULL(h.apellido_seg,''))) donante from registro_alumno a inner join alumno b on a.id_alumno=b.id_alumno inner join persona c on b.id_persona=c.id_persona inner join institucion_educativa d on a.id_institucion_edu=d.id_institucion inner join grado e on a.id_grado=e.id_grado inner join donacion f  on a.id_registro=f.id_registro_alumno inner join donante g on f.id_donante=g.id_donante inner join persona h on g.id_persona=h.id_persona where a.activa=1 and a.anio='2013' order by a.fecha_creacion,b.id_alumno asc