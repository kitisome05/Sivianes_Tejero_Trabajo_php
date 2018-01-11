create database agromoise;
use agromoise;

create table clientes (
cod_cliente char(8) primary key,
nombre varchar(255),
apellidos varchar(255),
telefono char(9) null,
direccion varchar(255),
roll enum('admin','usuario')
);

create table ventas (
cod_ventas char(255) primary key,
cod_cliente char(8),
fecha date,
valor_total char(9), 
foreign key fk1 (cod_cliente) references clientes (cod_cliente)
);

create table contiene (
cod_ventas char(255),
cod_producto char(255),
cantidad char(9),
foreign key fk1 (cod_ventas) references ventas (cod_ventas),
foreign key fk2 (cod_producto) references productos (cod_producto)
);

create table productos (
cod_producto char(255) primary key,
nombre varchar(255),
descripcion varchar(255),
precio_unidad char(9),
cod_proveedor char(9),
foreign key fk1 (cod_proveedor) references proveedores (cod_proveedor)
);

create table proveedores (
cod_proveedor char(9) primary key,
nombre varchar(255)
);
