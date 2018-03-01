create database agromoise;
use agromoise;

create table clientes (
cod_cliente int(11) primary key auto_increment,
nombre varchar(255),
apellidos varchar(255),
telefono char(9) null,
direccion varchar(255),
roll enum('admin','usuario'),
usuario varchar (255),
contrasena varchar (255)
);
drop table proveedores;

alter table productos
modify tipo  enum('remolques','ordeñadoras','mezclador');


create table ventas (
cod_ventas int(11) primary key auto_increment,
cod_cliente int(8),
fecha date,
valor_total char(9), 
foreign key fk1 (cod_cliente) references clientes (cod_cliente)
);

create table contiene (
cod_ventas int(11),
cod_producto int(11),
cantidad char(9),
foreign key fk1 (cod_ventas) references ventas (cod_ventas),
foreign key fk2 (cod_producto) references productos (cod_producto)
);

create table productos (
cod_producto int(11) primary key auto_increment,
tipo varchar(255),
nombre varchar(255),
descripcion varchar(255),
precio_unidad char(9),
cod_proveedor int(11),
foreign key fk1 (cod_proveedor) references proveedores (cod_proveedor)
);
alter table productos add imagen varchar(255);

create table proveedores (
cod_proveedor int(11) primary key auto_increment,
nombre varchar(255)
);

alter table contiene add primary key (cod_ventas, cod_producto);
select * from clientes;

alter table clientes change contraseña contrasena varchar(255);
