-- Tabla Departamentos
CREATE TABLE departamentos
(
	id INT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(100) NOT NULL,
	
	PRIMARY KEY (id)
);

-- Tabla Ciudades
CREATE TABLE ciudades
(
	id INT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(100) NOT NULL,

	departamento_id INT NOT NULL,
	
	PRIMARY KEY (id)
);

ALTER TABLE ciudades 
    ADD CONSTRAINT FK001 FOREIGN KEY (departamento_id) 
REFERENCES departamentos (id);

-- Tabla Clientes
CREATE TABLE clientes
(
	id INT NOT NULL AUTO_INCREMENT,
	apellidos VARCHAR(100) NOT NULL,
	cedula INT NOT NULL UNIQUE,
	direccion VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL,
	fecha_creacion DATE NOT NULL,
	nombres VARCHAR(100) NOT NULL,
	plazo_factura DATE NOT NULL,
	telefono INT NOT NULL,

	ciudad_id INT NOT NULL,
	
	PRIMARY KEY (id)
);

ALTER TABLE clientes 
    ADD CONSTRAINT FK002 FOREIGN KEY (ciudad_id) 
REFERENCES ciudades (id);

-- Tabla Empleados
CREATE TABLE empleados
(
	id INT NOT NULL AUTO_INCREMENT,
	apellidos VARCHAR(100) NOT NULL,
	cedula INT NOT NULL UNIQUE,
	nombres VARCHAR(100) NOT NULL,

	PRIMARY KEY (id)
);

-- Tabla Facturas
CREATE TABLE facturas
(
	id INT NOT NULL AUTO_INCREMENT,
	fecha DATE NOT NULL,

	cliente_id  INT NOT NULL,
	empleado_id INT NOT NULL,

	PRIMARY KEY (id)
);

ALTER TABLE facturas 
    ADD CONSTRAINT FK003 FOREIGN KEY (cliente_id) 
REFERENCES clientes (id);

ALTER TABLE facturas 
    ADD CONSTRAINT FK004 FOREIGN KEY (empleado_id) 
REFERENCES empleados (id);

-- Tabla Clase de Productos
CREATE TABLE clase_productos
(
	id INT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(100) NOT NULL,

	PRIMARY KEY (id)
);

-- Tabla Productos
CREATE TABLE productos
(
	id INT NOT NULL AUTO_INCREMENT,
	codigo VARCHAR(50) NOT NULL UNIQUE,
	descripcion VARCHAR(100) NOT NULL,
	existencia INT NOT NUll,
	precio DOUBLE NOT NULL,

	clase_productos_id INT NOT NULL,

	PRIMARY KEY (id)
);

ALTER TABLE productos 
    ADD CONSTRAINT FK005 FOREIGN KEY (clase_productos_id) 
REFERENCES clase_productos (id);

-- Tabla Detalles de Facturas
CREATE TABLE detalles_facturas
(
	id INT NOT NULL AUTO_INCREMENT,
	cantidad INT NOT NUll,

	factura_id INT NOT NULL,
	producto_id INT NOT NULL,

	PRIMARY KEY (id, factura_id, producto_id)
);

ALTER TABLE detalles_facturas 
    ADD CONSTRAINT FK006 FOREIGN KEY (factura_id) 
REFERENCES facturas (id);

ALTER TABLE detalles_facturas 
    ADD CONSTRAINT FK007 FOREIGN KEY (producto_id) 
REFERENCES productos (id);

-- Tabla Tipos de incidentes
CREATE TABLE tipos_incidentes
(
	id INT NOT NULL AUTO_INCREMENT,
	tipo VARCHAR(100) NOT NULL,

	PRIMARY KEY (id)
);

-- Tabla Detalles de Incidentes
CREATE TABLE detalles_incidentes
(
	id INT NOT NULL AUTO_INCREMENT,
	fecha DATE NOT NULL,
	descripcion VARCHAR(255) NOT NULL,

	cliente_id INT NOT NULL,
	tipos_incidentes_id INT NOT NULL,
	empleado_recibe INT NOT NULL,
	empleado_responde INT NOT NULL,

	PRIMARY KEY (id)
);

ALTER TABLE detalles_incidentes 
    ADD CONSTRAINT FK008 FOREIGN KEY (cliente_id) 
REFERENCES clientes (id);

ALTER TABLE detalles_incidentes 
    ADD CONSTRAINT FK009 FOREIGN KEY (tipos_incidentes_id) 
REFERENCES tipos_incidentes (id);

ALTER TABLE detalles_incidentes 
    ADD CONSTRAINT FK010 FOREIGN KEY (empleado_recibe) 
REFERENCES empleados (id);

ALTER TABLE detalles_incidentes 
    ADD CONSTRAINT FK011 FOREIGN KEY (empleado_responde) 
REFERENCES empleados (id);