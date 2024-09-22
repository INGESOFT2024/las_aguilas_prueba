CREATE TABLE turnos (
    turno_id SERIAL,
    turno_empleado_id INTEGER,
    turno_puesto_id INTEGER,
    turno_fecha_inicio DATETIME YEAR TO MINUTE,
    turno_fecha_fin DATETIME YEAR TO MINUTE,
    turno_situacion SMALLINT DEFAULT 1,
    PRIMARY KEY (turno_id),
    FOREIGN KEY (turno_empleado_id) REFERENCES empleado(emp_id),
    FOREIGN KEY (turno_puesto_id) REFERENCES puestos(puesto_id)
);


CREATE TABLE puestos(
    puesto_id SERIAL,
    puesto_nombre VARCHAR(50),
    puesto_descripcion VARCHAR(150),
    puesto_salario MONEY (10,2),
    puesto_direccion VARCHAR (100),
    puesto_cliente INTEGER,
    puesto_situacion SMALLINT DEFAULT 1, 
    PRIMARY KEY (puesto_id),
    FOREIGN KEY (puesto_cliente) REFERENCES clientes(cliente_id)
);
 