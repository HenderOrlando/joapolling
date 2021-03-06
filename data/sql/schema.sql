CREATE TABLE archivo (id_archivo BIGINT UNSIGNED AUTO_INCREMENT, nombre VARCHAR(30) NOT NULL, src VARCHAR(120) NOT NULL, extension VARCHAR(5) NOT NULL, PRIMARY KEY(id_archivo)) ENGINE = INNODB;
CREATE TABLE archivos_entidad_educativa (id_entidad_educativa BIGINT UNSIGNED, id_archivo BIGINT UNSIGNED, id_tipo_uso BIGINT UNSIGNED NOT NULL, fecha_creado DATETIME NOT NULL, INDEX id_tipo_uso_idx (id_tipo_uso), PRIMARY KEY(id_entidad_educativa, id_archivo)) ENGINE = INNODB;
CREATE TABLE candidato (id_candidato BIGINT UNSIGNED, no TINYINT UNSIGNED NOT NULL, foto BIGINT UNSIGNED, votos BIGINT UNSIGNED DEFAULT '0' NOT NULL, id_tipo_eleccion BIGINT UNSIGNED NOT NULL, id_candidato_representa BIGINT UNSIGNED, fecha_creado DATETIME NOT NULL, INDEX foto_idx (foto), INDEX id_tipo_eleccion_idx (id_tipo_eleccion), PRIMARY KEY(id_candidato)) ENGINE = INNODB;
CREATE TABLE curso (id_curso BIGINT UNSIGNED AUTO_INCREMENT, nombre VARCHAR(30) NOT NULL, abreviatura VARCHAR(3) NOT NULL, fecha_creado DATETIME NOT NULL, PRIMARY KEY(id_curso)) ENGINE = INNODB;
CREATE TABLE cursos_grado (id_curso_grado BIGINT UNSIGNED AUTO_INCREMENT, id_curso BIGINT UNSIGNED NOT NULL, id_grado BIGINT UNSIGNED NOT NULL, id_entidad_educativa BIGINT UNSIGNED NOT NULL, fecha_creado DATETIME NOT NULL, INDEX id_curso_idx (id_curso), INDEX id_grado_idx (id_grado), INDEX id_entidad_educativa_idx (id_entidad_educativa), PRIMARY KEY(id_curso_grado)) ENGINE = INNODB;
CREATE TABLE entidad_educativa (id_entidad_educativa BIGINT UNSIGNED, nombre VARCHAR(64) NOT NULL, abreviatura VARCHAR(15) NOT NULL, id_tipo_entidad_educativa BIGINT UNSIGNED NOT NULL, fecha_creado DATETIME NOT NULL, INDEX id_tipo_entidad_educativa_idx (id_tipo_entidad_educativa), PRIMARY KEY(id_entidad_educativa)) ENGINE = INNODB;
CREATE TABLE estudiante (id_curso BIGINT UNSIGNED NOT NULL, id_estudiante BIGINT UNSIGNED, cod_curso TINYINT UNSIGNED NOT NULL, fecha_creado DATETIME NOT NULL, INDEX id_curso_idx (id_curso), PRIMARY KEY(id_estudiante)) ENGINE = INNODB;
CREATE TABLE grado (id_grado BIGINT UNSIGNED AUTO_INCREMENT, abreviatura VARCHAR(3) NOT NULL, nombre VARCHAR(30) NOT NULL, fecha_creado DATETIME NOT NULL, PRIMARY KEY(id_grado)) ENGINE = INNODB;
CREATE TABLE grado_entidad_educativa (id_grado BIGINT UNSIGNED, id_entidad_educativa BIGINT UNSIGNED, fecha_creado DATETIME NOT NULL, PRIMARY KEY(id_grado, id_entidad_educativa)) ENGINE = INNODB;
CREATE TABLE grupo (id_grupo BIGINT UNSIGNED AUTO_INCREMENT, no_grupo CHAR(3) NOT NULL, id_curso VARCHAR(2), nombre VARCHAR(30) NOT NULL, id_tipo BIGINT UNSIGNED NOT NULL, fecha_creado DATETIME NOT NULL, INDEX id_tipo_idx (id_tipo), PRIMARY KEY(id_grupo)) ENGINE = INNODB;
CREATE TABLE jurado (id_jurado BIGINT UNSIGNED, id_entidad_educativa BIGINT UNSIGNED NOT NULL, id_mesa TINYINT UNSIGNED NOT NULL, id_tipo_jurado BIGINT UNSIGNED NOT NULL, fecha_creado DATETIME NOT NULL, INDEX id_tipo_jurado_idx (id_tipo_jurado), INDEX id_entidad_educativa_idx (id_entidad_educativa), INDEX id_mesa_idx (id_mesa), PRIMARY KEY(id_jurado)) ENGINE = INNODB;
CREATE TABLE mesa (id_mesa TINYINT UNSIGNED, nombre VARCHAR(30) NOT NULL, fecha_creado DATETIME NOT NULL, PRIMARY KEY(id_mesa)) ENGINE = INNODB;
CREATE TABLE mesa_entidad_educativa (id_entidad_educativa BIGINT UNSIGNED, id_mesa TINYINT UNSIGNED, id_tipo_jornada BIGINT UNSIGNED NOT NULL, fecha_creado DATETIME NOT NULL, INDEX id_tipo_jornada_idx (id_tipo_jornada), PRIMARY KEY(id_entidad_educativa, id_mesa)) ENGINE = INNODB;
CREATE TABLE perfiles_persona (id_persona BIGINT UNSIGNED, id_tipo_perfil BIGINT UNSIGNED, id_entidad_educativa BIGINT UNSIGNED NOT NULL, fecha_creado DATETIME NOT NULL, INDEX id_entidad_educativa_idx (id_entidad_educativa), PRIMARY KEY(id_persona, id_tipo_perfil)) ENGINE = INNODB;
CREATE TABLE persona (id_persona BIGINT UNSIGNED, tipo_doc_id BIGINT UNSIGNED NOT NULL, nombre VARCHAR(40) NOT NULL, clave VARCHAR(60) NOT NULL, fecha_creado DATETIME NOT NULL, INDEX tipo_doc_id_idx (tipo_doc_id), PRIMARY KEY(id_persona)) ENGINE = INNODB;
CREATE TABLE tipo (id_tipo BIGINT UNSIGNED AUTO_INCREMENT, nombre VARCHAR(30) NOT NULL, descripcion TEXT NOT NULL, fecha_creado DATETIME NOT NULL, objeto VARCHAR(30) NOT NULL, PRIMARY KEY(id_tipo)) ENGINE = INNODB;
CREATE TABLE votante (id_votante BIGINT UNSIGNED, voto TINYINT DEFAULT '0' NOT NULL, fecha_voto DATETIME, id_entidad_educativa BIGINT UNSIGNED NOT NULL, id_mesa TINYINT UNSIGNED NOT NULL, habilitado TINYINT DEFAULT '0' NOT NULL, ingreso_votar TINYINT DEFAULT '0' NOT NULL, id_tipo_eleccion BIGINT UNSIGNED NOT NULL, INDEX id_entidad_educativa_idx (id_entidad_educativa), INDEX id_mesa_idx (id_mesa), INDEX id_tipo_eleccion_idx (id_tipo_eleccion), PRIMARY KEY(id_votante)) ENGINE = INNODB;
ALTER TABLE archivos_entidad_educativa ADD CONSTRAINT archivos_entidad_educativa_id_tipo_uso_tipo_id_tipo FOREIGN KEY (id_tipo_uso) REFERENCES tipo(id_tipo);
ALTER TABLE archivos_entidad_educativa ADD CONSTRAINT archivos_entidad_educativa_id_archivo_candidato_foto FOREIGN KEY (id_archivo) REFERENCES candidato(foto);
ALTER TABLE archivos_entidad_educativa ADD CONSTRAINT archivos_entidad_educativa_id_archivo_archivo_id_archivo FOREIGN KEY (id_archivo) REFERENCES archivo(id_archivo);
ALTER TABLE archivos_entidad_educativa ADD CONSTRAINT aiei FOREIGN KEY (id_entidad_educativa) REFERENCES entidad_educativa(id_entidad_educativa);
ALTER TABLE candidato ADD CONSTRAINT candidato_id_tipo_eleccion_tipo_id_tipo FOREIGN KEY (id_tipo_eleccion) REFERENCES tipo(id_tipo);
ALTER TABLE candidato ADD CONSTRAINT candidato_foto_archivos_entidad_educativa_id_archivo FOREIGN KEY (foto) REFERENCES archivos_entidad_educativa(id_archivo);
ALTER TABLE cursos_grado ADD CONSTRAINT cursos_grado_id_grado_grado_entidad_educativa_id_grado FOREIGN KEY (id_grado) REFERENCES grado_entidad_educativa(id_grado);
ALTER TABLE cursos_grado ADD CONSTRAINT cursos_grado_id_curso_curso_id_curso FOREIGN KEY (id_curso) REFERENCES curso(id_curso);
ALTER TABLE cursos_grado ADD CONSTRAINT cigi FOREIGN KEY (id_entidad_educativa) REFERENCES grado_entidad_educativa(id_entidad_educativa);
ALTER TABLE entidad_educativa ADD CONSTRAINT entidad_educativa_id_tipo_entidad_educativa_tipo_id_tipo FOREIGN KEY (id_tipo_entidad_educativa) REFERENCES tipo(id_tipo);
ALTER TABLE estudiante ADD CONSTRAINT estudiante_id_curso_cursos_grado_id_curso_grado FOREIGN KEY (id_curso) REFERENCES cursos_grado(id_curso_grado);
ALTER TABLE grado_entidad_educativa ADD CONSTRAINT grado_entidad_educativa_id_grado_grado_id_grado FOREIGN KEY (id_grado) REFERENCES grado(id_grado);
ALTER TABLE grado_entidad_educativa ADD CONSTRAINT grado_entidad_educativa_id_grado_cursos_grado_id_grado FOREIGN KEY (id_grado) REFERENCES cursos_grado(id_grado);
ALTER TABLE grado_entidad_educativa ADD CONSTRAINT giei FOREIGN KEY (id_entidad_educativa) REFERENCES entidad_educativa(id_entidad_educativa);
ALTER TABLE grado_entidad_educativa ADD CONSTRAINT gici FOREIGN KEY (id_entidad_educativa) REFERENCES cursos_grado(id_entidad_educativa);
ALTER TABLE grupo ADD CONSTRAINT grupo_id_tipo_tipo_id_tipo FOREIGN KEY (id_tipo) REFERENCES tipo(id_tipo);
ALTER TABLE jurado ADD CONSTRAINT jurado_id_tipo_jurado_tipo_id_tipo FOREIGN KEY (id_tipo_jurado) REFERENCES tipo(id_tipo);
ALTER TABLE jurado ADD CONSTRAINT jurado_id_mesa_mesa_entidad_educativa_id_mesa FOREIGN KEY (id_mesa) REFERENCES mesa_entidad_educativa(id_mesa);
ALTER TABLE jurado ADD CONSTRAINT jimi FOREIGN KEY (id_entidad_educativa) REFERENCES mesa_entidad_educativa(id_entidad_educativa);
ALTER TABLE mesa_entidad_educativa ADD CONSTRAINT mivi FOREIGN KEY (id_entidad_educativa) REFERENCES votante(id_entidad_educativa);
ALTER TABLE mesa_entidad_educativa ADD CONSTRAINT miji FOREIGN KEY (id_entidad_educativa) REFERENCES jurado(id_entidad_educativa);
ALTER TABLE mesa_entidad_educativa ADD CONSTRAINT miei FOREIGN KEY (id_entidad_educativa) REFERENCES entidad_educativa(id_entidad_educativa);
ALTER TABLE mesa_entidad_educativa ADD CONSTRAINT mesa_entidad_educativa_id_tipo_jornada_tipo_id_tipo FOREIGN KEY (id_tipo_jornada) REFERENCES tipo(id_tipo);
ALTER TABLE mesa_entidad_educativa ADD CONSTRAINT mesa_entidad_educativa_id_mesa_votante_id_mesa FOREIGN KEY (id_mesa) REFERENCES votante(id_mesa);
ALTER TABLE mesa_entidad_educativa ADD CONSTRAINT mesa_entidad_educativa_id_mesa_mesa_id_mesa FOREIGN KEY (id_mesa) REFERENCES mesa(id_mesa);
ALTER TABLE mesa_entidad_educativa ADD CONSTRAINT mesa_entidad_educativa_id_mesa_jurado_id_mesa FOREIGN KEY (id_mesa) REFERENCES jurado(id_mesa);
ALTER TABLE perfiles_persona ADD CONSTRAINT piei FOREIGN KEY (id_entidad_educativa) REFERENCES entidad_educativa(id_entidad_educativa);
ALTER TABLE perfiles_persona ADD CONSTRAINT perfiles_persona_id_tipo_perfil_tipo_id_tipo FOREIGN KEY (id_tipo_perfil) REFERENCES tipo(id_tipo);
ALTER TABLE perfiles_persona ADD CONSTRAINT perfiles_persona_id_persona_persona_id_persona FOREIGN KEY (id_persona) REFERENCES persona(id_persona);
ALTER TABLE persona ADD CONSTRAINT persona_tipo_doc_id_tipo_id_tipo FOREIGN KEY (tipo_doc_id) REFERENCES tipo(id_tipo);
ALTER TABLE votante ADD CONSTRAINT votante_id_tipo_eleccion_tipo_id_tipo FOREIGN KEY (id_tipo_eleccion) REFERENCES tipo(id_tipo);
ALTER TABLE votante ADD CONSTRAINT votante_id_mesa_mesa_entidad_educativa_id_mesa FOREIGN KEY (id_mesa) REFERENCES mesa_entidad_educativa(id_mesa);
ALTER TABLE votante ADD CONSTRAINT vimi FOREIGN KEY (id_entidad_educativa) REFERENCES mesa_entidad_educativa(id_entidad_educativa);
