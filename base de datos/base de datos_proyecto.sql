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

describe clientes;

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
select * from productos;
SELECT * from productos WHERE tipo='remolques';
insert into productos (tipo, nombre, descripcion, precio_unidad, cod_proveedor) 
values ('mezclador', '1,5 M', 'Este es el mezclador mas pequeño que tenemos 1,5 M','900€','1');
INSERT INTO VEHICULOS(nombre,tipo,descripcion,precio_unidad,cod_proveedor) VALUES ('ejemplo','remolque','hola','12','1')
SELECT * from productos WHERE tipo="ordeñadoras";
SELECT * from productos WHERE tipo="remolques";

create table proveedores (
cod_proveedor int(11) primary key auto_increment,
nombre varchar(255)
);
insert into proveedores (cod_proveedor, nombre) values (null, 'romsan');
alter table contiene add primary key (cod_ventas, cod_producto);
select * from clientes;
insert into clientes (nombre, apellidos, telefono, direccion, roll, usuario, contraseña) values ('admin', 'admin', '696859185', 'Caño Ronco Nº 29', 'admin', 'admin', 'admin' );
INSERT INTO clientes (cod_cliente,nombre, apellidos, telefono, direccion, roll, usuario, contrasena) VALUES(null,'admin','admin','696859185','admin','admin','admin',md5('admin'));
alter table clientes change contraseña contrasena varchar(255);
select * from clientes where usuario='edu' and contrasena=md5('202cb962ac59075b964b07152d234b70');
describe clientes;
select roll from clientes where usuario='admin' and contrasena=md5('admin');
select roll from clientes where usuario='admin' and contrasena=md5('admin');
select * from productos;
SELECT * from productos where cod_producto='2';

SELECT * from productos WHERE tipo='ordeñadoras';

delete from productos where cod_producto=