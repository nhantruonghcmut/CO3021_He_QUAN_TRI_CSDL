DROP DATABASE IF EXISTS sportshop;
CREATE DATABASE sportshop;
USE sportshop;

CREATE TABLE users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    role ENUM('1', '2') NOT NULL
);

CREATE TABLE product(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    type ENUM('shoe', 'ball', 'goalkeeper', 'clothes', 'accessories') NOT NULL,
    price INT NOT NULL,
    quantity INT NOT NULL,
    description VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL
);


CREATE TABLE orders(
    orderId INT NOT NULL AUTO_INCREMENT,
    userId INT NOT NULL,
    productId INT NOT NULL,
    orderdate date  NOT NULL,
    price_sell int  NOT NULL,
    quantity INT NOT NULL,
    primary key (orderID,productId),
    FOREIGN KEY (userId) REFERENCES users(id) ON UPDATE CASCADE,
    FOREIGN KEY (productId) REFERENCES product(id)  ON UPDATE CASCADE
);

CREATE TABLE cart_temp (
    userId INT NOT NULL,
    productId INT NOT NULL,
    quantity INT NOT NULL,
    primary key (userId,productId),
    FOREIGN KEY (userId) REFERENCES users(id) ON UPDATE CASCADE,
    FOREIGN KEY (productId) REFERENCES product(id)  ON UPDATE CASCADE
);


CREATE TABLE warehouse(
    importID INT not NULL,
    importdate date not NULL,
    productId INT NOT NULL,
    ori_price int NOT NULL,
    quantity INT NOT NULL,
    primary key (importID,productId),
    FOREIGN KEY (productId) REFERENCES product(id)  ON UPDATE CASCADE
);
DELIMITER $$

CREATE TRIGGER reduce_product_quantity
AFTER INSERT ON orders
FOR EACH ROW
BEGIN
    -- Giảm số lượng sản phẩm trong bảng product
    UPDATE product
    SET quantity = quantity - NEW.quantity
    WHERE id = NEW.productId;

    -- Kiểm tra nếu số lượng âm thì báo lỗi
    IF (SELECT quantity FROM product WHERE id = NEW.productId) < 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Không đủ hàng trong kho.';
    END IF;
END$$

DELIMITER ;
DELIMITER $$

CREATE TRIGGER increase_product_quantity
AFTER INSERT ON warehouse
FOR EACH ROW
BEGIN
    -- Tăng số lượng sản phẩm trong bảng product
    UPDATE product
    SET quantity = quantity + NEW.quantity
    WHERE id = NEW.productId;
END$$

DELIMITER ;
