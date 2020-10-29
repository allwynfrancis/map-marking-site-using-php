CREATE DATABASE LocationDB;
use LocationDB;
CREATE TABLE `locations` (
`id` INT(10) NOT NULL AUTO_INCREMENT,
`name` VARCHAR(150) NOT NULL,
`address` VARCHAR(255) NOT NULL,
`contact` VARCHAR(20) NOT NULL,
`sunday` VARCHAR(20) NOT NULL,
`monday` VARCHAR(20) NOT NULL,
`tuesday` VARCHAR(20) NOT NULL,
`wednesday` VARCHAR(20) NOT NULL,
`thrusday` VARCHAR(20) NOT NULL,
`friday` VARCHAR(20) NOT NULL,
`saturday` VARCHAR(20) NOT NULL,
`lat` FLOAT(10,6) NOT NULL,
`lng` FLOAT(10,6) NOT NULL,
`city` TEXT NOT NULL,
PRIMARY KEY (`id`)
)
SELECT * FROM locations;
INSERT INTO `locations` ( `name`, `address`,`contact`,`sunday`,`monday`,`tuesday`,`wednesday`, `thrusday`,`friday`,`saturday`,`lat`, `lng`, `city`) VALUES ('Love.Fish', '580 Darling Street, Rozelle, NSW,1234','+91 9876543210','7am-5pm','7am-5pm','7am-5pm','7am-5pm','7am-5pm','7am-5pm','7am-5pm', '13.082680', '80.270721', 'chennai');
INSERT INTO `locations` ( `name`, `address`,`contact`,`sunday`,`monday`,`tuesday`,`wednesday`, `thrusday`,`friday`,`saturday`,`lat`, `lng`, `city`) VALUES ('Young Henrys', '76 Wilford Street, Newtown, NSW,1234','+91 9876543210','7am-5pm','7am-5pm','7am-5pm','7am-5pm','7am-5pm','7am-5pm','7am-5pm', '13.082380', '80.270721', 'chennai');
INSERT INTO `locations` ( `name`, `address`,`contact`,`sunday`,`monday`,`tuesday`,`wednesday`, `thrusday`,`friday`,`saturday`,`lat`, `lng`, `city`) VALUES ('Hunter Gatherer', 'Greenwood Plaza, 36 Blue St, North Sydney NSW,1234','+91 9876543210','7am-5pm','7am-5pm','7am-5pm','7am-5pm','7am-5pm','7am-5pm','7am-5pm','12.971599', '77.504566', 'bangalore');
INSERT INTO `locations` ( `name`, `address`,`contact`,`sunday`,`monday`,`tuesday`,`wednesday`, `thrusday`,`friday`,`saturday`,`lat`, `lng`, `city`) VALUES ('The Potting Shed', '7A, 2 Huntley Street, Alexandria, NSW,1234','+91 9876543210','7am-5pm','7am-5pm','7am-5pm','7am-5pm','7am-5pm','7am-5pm','7am-5pm', '12.901599', '77.594566', 'bangalore');
INSERT INTO `locations` ( `name`, `address`,`contact`,`sunday`,`monday`,`tuesday`,`wednesday`, `thrusday`,`friday`,`saturday`,`lat`, `lng`, `city`) VALUES ('Nomad', '16 Foster Street, Surry Hills, NSW,1234','+91 9876543210','7am-5pm','7am-5pm','7am-5pm','7am-5pm','7am-5pm','7am-5pm','7am-5pm', '12.971599', '77.597566', 'bangalore');
INSERT INTO `locations` ( `name`, `address`,`contact`,`sunday`,`monday`,`tuesday`,`wednesday`, `thrusday`,`friday`,`saturday`,`lat`, `lng`, `city`) VALUES ('Three Blue Ducks', '43 Macpherson Street, Bronte, NSW,1234','+91 9876543210','7am-5pm','7am-5pm','7am-5pm','7am-5pm','7am-5pm','7am-5pm','7am-5pm', '13.022680', '80.270721', 'chennai');
INSERT INTO `locations` ( `name`, `address`,`contact`,`sunday`,`monday`,`tuesday`,`wednesday`, `thrusday`,`friday`,`saturday`,`lat`, `lng`, `city`) VALUES ('Single Origin Roasters', '60-64 Reservoir Street, Surry Hills, NSW,1234','+91 9876543210','7am-5pm','7am-5pm','7am-5pm','7am-5pm','7am-5pm','7am-5pm','7am-5pm', '28.700060', '77.102493', 'delhi');
INSERT INTO `locations` ( `name`, `address`,`contact`,`sunday`,`monday`,`tuesday`,`wednesday`, `thrusday`,`friday`,`saturday`,`lat`, `lng`, `city`) VALUES ('Red Lantern', '60 Riley Street, Darlinghurst, NSW,1234','+91 9876543210','7am-5pm','7am-5pm','7am-5pm','7am-5pm','7am-5pm','7am-5pm','7am-5pm' ,'28.708060', '77.102493', 'delhi');

INSERT INTO mysql.user (Host, User, Password) VALUES ('localhost', 'root', 'root');
GRANT ALL ON *.* TO 'root'@'localhost' WITH GRANT OPTION;
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'root';

drop table locations;
