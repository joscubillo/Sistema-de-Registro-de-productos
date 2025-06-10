
create database  sistemaregistroproductos;
 
CREATE TABLE bodegas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL
);

CREATE TABLE sucursales (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_bodega INT NOT NULL,
  nombre VARCHAR(50) NOT NULL,
  FOREIGN KEY (id_bodega) REFERENCES bodegas(id)
);

CREATE TABLE monedas (
  id INT AUTO_INCREMENT PRIMARY KEY,
   codigo VARCHAR(10) NOT NULL,
  nombre VARCHAR(20) NOT NULL
); 

CREATE TABLE productos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  codigo VARCHAR(15) UNIQUE NOT NULL,
  nombre VARCHAR(50) NOT NULL,
  id_bodega INT NOT NULL,
  id_sucursal INT NOT NULL,
  id_moneda INT NOT NULL,
  precio DECIMAL(10,2) NOT NULL,
  materiales TEXT NOT NULL, 
  descripcion TEXT NOT NULL,
  FOREIGN KEY (id_bodega) REFERENCES bodegas(id),
  FOREIGN KEY (id_sucursal) REFERENCES sucursales(id),
  FOREIGN KEY (id_moneda) REFERENCES monedas(id)
);
