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
    FOREIGN KEY (userId) REFERENCES newsusers(id) ON UPDATE CASCADE,
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
DELIMITER $$

###################################################################### CÁC HÀM CHO DASHBOARD
DELIMITER $$

-- Monthly Revenue (6 months)
DROP PROCEDURE IF EXISTS calculate_monthly_revenue$$
CREATE PROCEDURE calculate_monthly_revenue()
BEGIN
    SELECT 
        DATE_FORMAT(orderdate, '%Y-%m') as month_year,
        SUM(price_sell * quantity) AS revenue
    FROM orders
    WHERE orderdate >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
    GROUP BY month_year
    ORDER BY month_year DESC;
END$$

-- Revenue by Product Type (Current Month)
DROP PROCEDURE IF EXISTS calculate_type_revenue$$
CREATE PROCEDURE calculate_type_revenue()
BEGIN
    SELECT 
        p.type,
        SUM(o.price_sell * o.quantity) as revenue
    FROM orders o
    JOIN product p ON o.productId = p.id
    WHERE DATE_FORMAT(o.orderdate,'%Y-%m') = DATE_FORMAT(CURDATE(),'%Y-%m')
    GROUP BY p.type;
END$$

-- Current Month Orders Count
DROP PROCEDURE IF EXISTS calculate_current_month_orders$$
CREATE PROCEDURE calculate_current_month_orders()
BEGIN
    SELECT COUNT(DISTINCT orderId) as order_count
    FROM orders
    WHERE DATE_FORMAT(orderdate,'%Y-%m') = DATE_FORMAT(CURDATE(),'%Y-%m');
END$$
CALL calculate_current_month_orders();
-- Inventory Ratio
DROP PROCEDURE IF EXISTS calculate_inventory_ratio$$
CREATE PROCEDURE calculate_inventory_ratio()
BEGIN
    SELECT 
        COALESCE(SUM(p.quantity) / NULLIF(SUM(w.quantity), 0) * 100, 0) as ratio
    FROM product p
    LEFT JOIN warehouse w ON p.id = w.productId
    WHERE DATE_FORMAT(w.importdate,'%Y-%m') = DATE_FORMAT(CURDATE(),'%Y-%m');
END$$

-- Monthly Profit (6 months)
DROP PROCEDURE IF EXISTS calculate_monthly_profit$$
CREATE PROCEDURE calculate_monthly_profit()
BEGIN
    SELECT 
        DATE_FORMAT(o.orderdate, '%Y-%m') AS month_year,
        SUM(o.price_sell * o.quantity) - SUM(w.ori_price * o.quantity) AS profit
    FROM orders o
    JOIN warehouse w ON o.productId = w.productId
    WHERE o.orderdate >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
    GROUP BY month_year
    ORDER BY month_year DESC;
END$$
-- Current Month Profit
DROP PROCEDURE IF EXISTS calculate_current_month_profit$$
CREATE PROCEDURE calculate_current_month_profit()
BEGIN
    SELECT 
        SUM(o.price_sell * o.quantity) - SUM(w.ori_price * o.quantity) AS profit
    FROM orders o
    JOIN warehouse w ON o.productId = w.productId
    WHERE DATE_FORMAT(o.orderdate,'%Y-%m') = DATE_FORMAT(CURDATE(),'%Y-%m');
END$$

DELIMITER ;

