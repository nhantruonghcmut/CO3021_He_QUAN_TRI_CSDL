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

INSERT INTO users (username, password, name, phone, email, role)
VALUES
('thanhhangdang16', 'thanhhangdang16', 'Đặng Thanh Hàng', '0981868099', 'thanhhangdang16@gmail.com', 1),
('user2', 'user2', 'User 2', '987654321', 'user2@example.com', 2);

CREATE TABLE product(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    type ENUM('shoe', 'ball', 'goalkeeper', 'clothes', 'accessories') NOT NULL,
    price INT NOT NULL,
    quantity INT NOT NULL,
    description VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL
);

-- INSERT INTO product (name, type, price, quantity, description, image)
-- VALUES
--     ('Shoe 1', 'shoe', 100, 50, 'Description for Shoe 1', 'https://bizweb.dktcdn.net/100/218/328/products/ee72b0d2f6d5dcc721a89cca58a503cf-jpeg.jpg?v=1708929735023'),
--     ('Shoe 2', 'shoe', 120, 30, 'Description for Shoe 2', 'https://bizweb.dktcdn.net/100/218/328/products/ee72b0d2f6d5dcc721a89cca58a503cf-jpeg.jpg?v=1708929735023'),
--     ('Ball 1', 'ball', 50, 20, 'Description for Ball 1', 'https://bizweb.dktcdn.net/100/218/328/products/ee72b0d2f6d5dcc721a89cca58a503cf-jpeg.jpg?v=1708929735023'),
--     ('Ball 2', 'ball', 60, 10, 'Description for Ball 2', 'https://bizweb.dktcdn.net/100/218/328/products/ee72b0d2f6d5dcc721a89cca58a503cf-jpeg.jpg?v=1708929735023'),
--     ('Goalkeeper 1', 'goalkeeper', 150, 15, 'Description for Goalkeeper 1', 'https://bizweb.dktcdn.net/100/218/328/products/ee72b0d2f6d5dcc721a89cca58a503cf-jpeg.jpg?v=1708929735023'),
--     ('Goalkeeper 2', 'goalkeeper', 180, 20, 'Description for Goalkeeper 2', 'https://bizweb.dktcdn.net/100/218/328/products/ee72b0d2f6d5dcc721a89cca58a503cf-jpeg.jpg?v=1708929735023'),
--     ('Clothes 1', 'clothes', 80, 25, 'Description for Clothes 1', 'https://bizweb.dktcdn.net/100/218/328/products/ee72b0d2f6d5dcc721a89cca58a503cf-jpeg.jpg?v=1708929735023'),
--     ('Clothes 2', 'clothes', 90, 30, 'Description for Clothes 2', 'https://bizweb.dktcdn.net/100/218/328/products/ee72b0d2f6d5dcc721a89cca58a503cf-jpeg.jpg?v=1708929735023'),
--     ('Accessories 1', 'accessories', 40, 40, 'Description for Accessories 1', 'https://bizweb.dktcdn.net/100/218/328/products/ee72b0d2f6d5dcc721a89cca58a503cf-jpeg.jpg?v=1708929735023'),
--     ('Accessories 2', 'accessories', 35, 50, 'Description for Accessories 2', 'https://bizweb.dktcdn.net/100/218/328/products/ee72b0d2f6d5dcc721a89cca58a503cf-jpeg.jpg?v=1708929735023'),
--     ('Shoe 3', 'shoe', 110, 45, 'Description for Shoe 3', 'https://bizweb.dktcdn.net/100/218/328/products/ee72b0d2f6d5dcc721a89cca58a503cf-jpeg.jpg?v=1708929735023'),
--     ('Shoe 4', 'shoe', 130, 25, 'Description for Shoe 4', 'https://bizweb.dktcdn.net/100/218/328/products/ee72b0d2f6d5dcc721a89cca58a503cf-jpeg.jpg?v=1708929735023'),
--     ('Ball 3', 'ball', 55, 15, 'Description for Ball 3', 'https://bizweb.dktcdn.net/100/218/328/products/ee72b0d2f6d5dcc721a89cca58a503cf-jpeg.jpg?v=1708929735023'),
--     ('Ball 4', 'ball', 65, 5, 'Description for Ball 4', 'https://bizweb.dktcdn.net/100/218/328/products/ee72b0d2f6d5dcc721a89cca58a503cf-jpeg.jpg?v=1708929735023'),
--     ('Goalkeeper 3', 'goalkeeper', 160, 10, 'Description for Goalkeeper 3', 'https://bizweb.dktcdn.net/100/218/328/products/ee72b0d2f6d5dcc721a89cca58a503cf-jpeg.jpg?v=1708929735023'),
--     ('Goalkeeper 4', 'goalkeeper', 190, 15, 'Description for Goalkeeper 4', 'https://bizweb.dktcdn.net/100/218/328/products/ee72b0d2f6d5dcc721a89cca58a503cf-jpeg.jpg?v=1708929735023'),
--     ('Clothes 3', 'clothes', 85, 20, 'Description for Clothes 3', 'https://bizweb.dktcdn.net/100/218/328/products/ee72b0d2f6d5dcc721a89cca58a503cf-jpeg.jpg?v=1708929735023'),
--     ('Clothes 4', 'clothes', 95, 35, 'Description for Clothes 4', 'https://bizweb.dktcdn.net/100/218/328/products/ee72b0d2f6d5dcc721a89cca58a503cf-jpeg.jpg?v=1708929735023'),
--     ('Accessories 3', 'accessories', 45, 30, 'Description for Accessories 3', 'https://bizweb.dktcdn.net/100/218/328/products/ee72b0d2f6d5dcc721a89cca58a503cf-jpeg.jpg?v=1708929735023'),
--     ('Accessories 4', 'accessories', 40, 25, 'Description for Accessories 4', 'https://bizweb.dktcdn.net/100/218/328/products/ee72b0d2f6d5dcc721a89cca58a503cf-jpeg.jpg?v=1708929735023');

INSERT INTO product (name, type, price, quantity, description, image)
VALUES
    -- ('Giày bata tàu', 'shoe', 150000, 50, 'Thiết kế êm ái và dễ dàng vận động', 'https://bizweb.dktcdn.net/100/218/328/products/4c7457fd-384c-4342-ab25-db90ea8bb994-jpeg.jpg?v=1528819452747'),
    -- ('Giày bóng đá Jagarbola Colorlux', 'shoe', 690000, 30, 'Thiết kế đáp ứng phù hợp mọi loại sân', 'https://bizweb.dktcdn.net/100/218/328/products/fe5abb2c-015e-434e-8a33-68172410ac26-jpeg.jpg?v=1663780254003'),
    -- ('Bóng động lực UHV 2.07 COBRA', 'ball', 2350000, 20, 'Thiết kế chất lượng cao, đảm bảo độ tròn và độ bền', 'https://bizweb.dktcdn.net/100/218/328/products/053a323e-e5cc-40f4-b7cf-aac287f5e475-jpeg.jpg?v=1616406123687'),
    -- ('Bóng động lực UHV 2.07 Spectro', 'ball', 1500000, 10, 'Thiết kế chất lượng cao, đảm bảo độ tròn và độ bền', 'https://bizweb.dktcdn.net/100/218/328/products/9d60e72c-4f42-4c48-b497-39c049529c8e-jpeg.jpg?v=1616405982763'),
    -- ('Găng tay thủ môn GKVN Thanh xuân lính', 'goalkeeper', 150000, 15, 'Thiết kế với lớp đệm và lớp lót chống trượt', 'https://bizweb.dktcdn.net/100/218/328/products/910effd3-98fa-4429-817f-9f89da784af4-jpeg.jpg?v=1654776320897'),
    -- ('Quần áo bóng đá Odin', 'clothes', 169000, 25, 'Thiết kế đơn giản nhưng mạnh mẽ', 'https://bizweb.dktcdn.net/100/218/328/products/1hdfnlsmu-3j0s4o-jpeg.jpg?v=1703091284527'),
    -- ('Quần áo bóng đá Volvo', 'clothes', 220000, 30, 'Chất liệu chống nhăn và thoáng khí, thiết kế năng động', 'https://bizweb.dktcdn.net/100/218/328/products/0cf21ef0664db22c3be6bc90ab62c7d3-jpeg.jpg?v=1703091040133'),
    -- ('Cup lưu niệm', 'accessories', 590000, 40, 'Cup lưu niệm giải đấu', 'https://bizweb.dktcdn.net/100/218/328/products/ec925f30-bbe9-46d9-a4e1-ae3df513f872-jpeg.jpg?v=1654666275657'),
    -- ('Cờ lưu niệm', 'accessories', 50000, 50, 'Cờ lưu niệm giải đấu', 'https://bizweb.dktcdn.net/100/218/328/products/b89d9e57-dba5-4f69-92aa-f538b5642dc0-jpeg.jpg?v=1654666059483'),
    -- ('Giày Warrior chính hãng', 'shoe', 300000, 45, 'Sự kết hợp giữa sự linh hoạt và độ ổn định', 'https://bizweb.dktcdn.net/100/218/328/products/5930b764-d3fe-4b14-b685-8281ccfb2d98-jpeg.jpg?v=1597929941127'),
    -- ('Giày Velicodad Legend', 'shoe', 460000, 25, 'Thiết kế tăng cường khả năng kiểm soát bóng và độ bám mặt sân', 'https://bizweb.dktcdn.net/100/218/328/products/77ffd526-9f24-43b5-a46c-79cd1c4f541d-jpeg.jpg?v=1663780095177'),
    -- ('Bóng IKINGSPORT PRO', 'ball', 860000, 15, 'Thiết kế chất lượng cao, đảm bảo độ tròn và độ bền', 'https://bizweb.dktcdn.net/100/218/328/products/cb0c9fd6-a23b-4168-9d10-bdc2e7e7af41-jpeg.jpg?v=1661579473477'),
    -- ('Bóng Molten 2700', 'ball', 500000, 5, 'Thiết kế chất lượng cao, đảm bảo độ tròn và độ bền', 'https://bizweb.dktcdn.net/100/218/328/products/30adf82a-b5c3-4b52-a82a-cdfce7de0b8e-jpeg.jpg?v=1528560761983'),
    -- ('Quần áo bóng đá Kamito Prematch3', 'clothes', 230000, 20, 'Thiết kế độc đáo, mang lại sự thoải mái và linh hoạt', 'https://bizweb.dktcdn.net/100/218/328/products/ee72b0d2f6d5dcc721a89cca58a503cf-jpeg.jpg?v=1708929735023'),
    -- ('Quần áo bóng đá Kamito Prematch3', 'clothes', 230000, 35, 'Thiết kế độc đáo, mang lại sự thoải mái và linh hoạt', 'https://bizweb.dktcdn.net/100/218/328/products/8f842b1227ad1d6e61b11f582e6216f0-jpeg.jpg?v=1708929733427'),
    -- ('Huy chương', 'accessories', 60000, 30, 'Huy chương của nhà vô địch', 'https://bizweb.dktcdn.net/100/218/328/products/18033170-1875234382736379-2570991798436862335-n.jpg?v=1498755018720'),
    -- ('Quả bóng vàng lưu niệm', 'accessories', 850000, 25, 'Quả bóng vàng lưu niệm giải đấu', 'https://bizweb.dktcdn.net/100/218/328/products/ff11ec3b-76b5-461b-be8a-e676d96e0c8a-jpeg.jpg?v=1528913436057');
    ('Giày bata tàu', 'shoe', 150000, 50, 'Thiết kế êm ái và dễ dàng vận động', 'https://bizweb.dktcdn.net/100/218/328/products/4c7457fd-384c-4342-ab25-db90ea8bb994-jpeg.jpg?v=1528819452747'),
    ('Giày bóng đá Jagarbola Colorlux', 'shoe', 690000, 30, 'Thiết kế đáp ứng phù hợp mọi loại sân', 'https://bizweb.dktcdn.net/100/218/328/products/fe5abb2c-015e-434e-8a33-68172410ac26-jpeg.jpg?v=1663780254003'),
    ('Giày Velocidad Legend', 'shoe', 460000, 50, 'Thiết kế êm ái và dễ dàng vận động', 'https://bizweb.dktcdn.net/100/218/328/products/d14c0753-844d-44da-9aff-d27ed2bbfd6f-jpeg.jpg?v=1663780096047'),
    ('Giày bóng đá Jagarbola Colorlux', 'shoe', 690000, 30, 'Thiết kế đáp ứng phù hợp mọi loại sân', 'https://bizweb.dktcdn.net/100/218/328/products/34f52076-d522-43ef-84bf-54b8202f9368-jpeg.jpg?v=1663780255553'),
    ('Giày Velocidad Legend', 'shoe', 460000, 50, 'Thiết kế êm ái và dễ dàng vận động', 'https://bizweb.dktcdn.net/100/218/328/products/f38c7121-7099-4a37-8e7f-f22923fb463c-jpeg.jpg?v=1663780097493'),
    ('Giày bóng đá Jagarbola Colorlux', 'shoe', 690000, 30, 'Thiết kế đáp ứng phù hợp mọi loại sân', 'https://bizweb.dktcdn.net/100/218/328/products/aed38257-11bd-4a8e-a98c-0d00c80d5a2e-jpeg.jpg?v=1663780259667'),
    ('Giày Velocidad Legend', 'shoe', 460000, 50, 'Thiết kế êm ái và dễ dàng vận động', 'https://bizweb.dktcdn.net/100/218/328/products/edc27d70-01eb-4116-8b65-4ba2a77baafd-jpeg.jpg?v=1663780098810'),
    ('Giày bóng đá Jagarbola Colorlux', 'shoe', 690000, 30, 'Thiết kế đáp ứng phù hợp mọi loại sân', 'https://bizweb.dktcdn.net/100/218/328/products/0ad9fb42-43ff-4905-b002-dcab794b62f9-jpeg.jpg?v=1663780261697'),
    ('Giày Velocidad Legend', 'shoe', 460000, 50, 'Thiết kế êm ái và dễ dàng vận động', 'https://bizweb.dktcdn.net/100/218/328/products/4a5b1342-26fe-44bd-bd57-7be8457a9871-jpeg.jpg?v=1663780099960'),
    ('Giày bóng đá Jagarbola Colorlux', 'shoe', 690000, 30, 'Thiết kế đáp ứng phù hợp mọi loại sân', 'https://bizweb.dktcdn.net/100/218/328/products/f73a04d7-f884-48cc-bb31-791b90d1245d-jpeg.jpg?v=1663780268707'),
    ('Giày bata tàu', 'shoe', 150000, 50, 'Thiết kế êm ái và dễ dàng vận động', 'https://bizweb.dktcdn.net/100/218/328/products/4c7457fd-384c-4342-ab25-db90ea8bb994-jpeg.jpg?v=1528819452747'),
    ('Giày bóng đá Jagarbola Colorlux', 'shoe', 690000, 30, 'Thiết kế đáp ứng phù hợp mọi loại sân', 'https://bizweb.dktcdn.net/100/218/328/products/fe5abb2c-015e-434e-8a33-68172410ac26-jpeg.jpg?v=1663780254003'),
    ('Giày bata tàu', 'shoe', 150000, 50, 'Thiết kế êm ái và dễ dàng vận động', 'https://bizweb.dktcdn.net/100/218/328/products/4c7457fd-384c-4342-ab25-db90ea8bb994-jpeg.jpg?v=1528819452747'),
    ('Giày bóng đá Jagarbola Colorlux', 'shoe', 690000, 30, 'Thiết kế đáp ứng phù hợp mọi loại sân', 'https://bizweb.dktcdn.net/100/218/328/products/fe5abb2c-015e-434e-8a33-68172410ac26-jpeg.jpg?v=1663780254003'),
    ('Giày bata tàu', 'shoe', 150000, 50, 'Thiết kế êm ái và dễ dàng vận động', 'https://bizweb.dktcdn.net/100/218/328/products/4c7457fd-384c-4342-ab25-db90ea8bb994-jpeg.jpg?v=1528819452747'),
    ('Giày bóng đá Jagarbola Colorlux', 'shoe', 690000, 30, 'Thiết kế đáp ứng phù hợp mọi loại sân', 'https://bizweb.dktcdn.net/100/218/328/products/fe5abb2c-015e-434e-8a33-68172410ac26-jpeg.jpg?v=1663780254003'),
    ('Giày bata tàu', 'shoe', 150000, 50, 'Thiết kế êm ái và dễ dàng vận động', 'https://bizweb.dktcdn.net/100/218/328/products/4c7457fd-384c-4342-ab25-db90ea8bb994-jpeg.jpg?v=1528819452747'),
    ('Giày bóng đá Jagarbola Colorlux', 'shoe', 690000, 30, 'Thiết kế đáp ứng phù hợp mọi loại sân', 'https://bizweb.dktcdn.net/100/218/328/products/fe5abb2c-015e-434e-8a33-68172410ac26-jpeg.jpg?v=1663780254003'),
    ('Bóng động lực UHV 2.07 COBRA', 'ball', 2350000, 20, 'Thiết kế chất lượng cao, đảm bảo độ tròn và độ bền', 'https://bizweb.dktcdn.net/100/218/328/products/053a323e-e5cc-40f4-b7cf-aac287f5e475-jpeg.jpg?v=1616406123687'),
    ('Bóng động lực UHV 2.07 Spectro', 'ball', 1500000, 10, 'Thiết kế chất lượng cao, đảm bảo độ tròn và độ bền', 'https://bizweb.dktcdn.net/100/218/328/products/9d60e72c-4f42-4c48-b497-39c049529c8e-jpeg.jpg?v=1616405982763'),
    ('Bóng động lực UHV 2.07 Galaxy', 'ball', 1500000, 20, 'Thiết kế chất lượng cao, đảm bảo độ tròn và độ bền', 'https://bizweb.dktcdn.net/100/218/328/products/01-500x500.jpg?v=1498059955067'),
    ('Bóng động lực UHV 2.07 Spectro', 'ball', 1500000, 10, 'Thiết kế chất lượng cao, đảm bảo độ tròn và độ bền', 'https://bizweb.dktcdn.net/100/218/328/products/9d60e72c-4f42-4c48-b497-39c049529c8e-jpeg.jpg?v=1616405982763'),
    ('Bóng động lực UHV 2.07 COBRA', 'ball', 2350000, 20, 'Thiết kế chất lượng cao, đảm bảo độ tròn và độ bền', 'https://bizweb.dktcdn.net/100/218/328/products/053a323e-e5cc-40f4-b7cf-aac287f5e475-jpeg.jpg?v=1616406123687'),
    ('Bóng động lực UHV 2.07 Spectro', 'ball', 1500000, 10, 'Thiết kế chất lượng cao, đảm bảo độ tròn và độ bền', 'https://bizweb.dktcdn.net/100/218/328/products/9d60e72c-4f42-4c48-b497-39c049529c8e-jpeg.jpg?v=1616405982763'),
    ('Bóng động lực UHV 2.07 COBRA', 'ball', 2350000, 20, 'Thiết kế chất lượng cao, đảm bảo độ tròn và độ bền', 'https://bizweb.dktcdn.net/100/218/328/products/053a323e-e5cc-40f4-b7cf-aac287f5e475-jpeg.jpg?v=1616406123687'),
    ('Bóng động lực UHV 2.07 Spectro', 'ball', 1500000, 10, 'Thiết kế chất lượng cao, đảm bảo độ tròn và độ bền', 'https://bizweb.dktcdn.net/100/218/328/products/9d60e72c-4f42-4c48-b497-39c049529c8e-jpeg.jpg?v=1616405982763'),
    ('Bóng động lực UHV 2.07 COBRA', 'ball', 2350000, 20, 'Thiết kế chất lượng cao, đảm bảo độ tròn và độ bền', 'https://bizweb.dktcdn.net/100/218/328/products/053a323e-e5cc-40f4-b7cf-aac287f5e475-jpeg.jpg?v=1616406123687'),
    ('Bóng động lực UHV 2.07 Spectro', 'ball', 1500000, 10, 'Thiết kế chất lượng cao, đảm bảo độ tròn và độ bền', 'https://bizweb.dktcdn.net/100/218/328/products/9d60e72c-4f42-4c48-b497-39c049529c8e-jpeg.jpg?v=1616405982763'),
    ('Găng tay thủ môn GKVN Thanh xuân lính', 'goalkeeper', 150000, 15, 'Thiết kế với lớp đệm và lớp lót chống trượt', 'https://bizweb.dktcdn.net/100/218/328/products/910effd3-98fa-4429-817f-9f89da784af4-jpeg.jpg?v=1654776320897'),
    ('Găng tay thủ môn GKVN Thanh xuân lính', 'goalkeeper', 150000, 15, 'Thiết kế với lớp đệm và lớp lót chống trượt', 'https://bizweb.dktcdn.net/100/218/328/products/5d7896bf-69bd-4999-9ee3-be402f122351-jpeg.jpg?v=1654776321937'),
    ('Găng tay thủ môn GKVN Thanh xuân lính', 'goalkeeper', 150000, 15, 'Thiết kế với lớp đệm và lớp lót chống trượt', 'https://bizweb.dktcdn.net/100/218/328/products/e6c3957d-67ed-4cc3-945c-dcb47e28878f-jpeg.jpg?v=1654776322600'),
    ('Găng tay thủ môn GKVN Thanh xuân lính', 'goalkeeper', 150000, 15, 'Thiết kế với lớp đệm và lớp lót chống trượt', 'https://bizweb.dktcdn.net/100/218/328/products/910effd3-98fa-4429-817f-9f89da784af4-jpeg.jpg?v=1654776320897'),
    ('Găng tay thủ môn GKVN Thanh xuân lính', 'goalkeeper', 150000, 15, 'Thiết kế với lớp đệm và lớp lót chống trượt', 'https://bizweb.dktcdn.net/100/218/328/products/910effd3-98fa-4429-817f-9f89da784af4-jpeg.jpg?v=1654776320897'),
    ('Găng tay thủ môn GKVN Thanh xuân lính', 'goalkeeper', 150000, 15, 'Thiết kế với lớp đệm và lớp lót chống trượt', 'https://bizweb.dktcdn.net/100/218/328/products/e6c3957d-67ed-4cc3-945c-dcb47e28878f-jpeg.jpg?v=1654776322600'),
    ('Găng tay thủ môn GKVN Thanh xuân lính', 'goalkeeper', 150000, 15, 'Thiết kế với lớp đệm và lớp lót chống trượt', 'https://bizweb.dktcdn.net/100/218/328/products/910effd3-98fa-4429-817f-9f89da784af4-jpeg.jpg?v=1654776320897'),
    ('Găng tay thủ môn GKVN Thanh xuân lính', 'goalkeeper', 150000, 15, 'Thiết kế với lớp đệm và lớp lót chống trượt', 'https://bizweb.dktcdn.net/100/218/328/products/910effd3-98fa-4429-817f-9f89da784af4-jpeg.jpg?v=1654776320897'),
    ('Găng tay thủ môn GKVN Thanh xuân lính', 'goalkeeper', 150000, 15, 'Thiết kế với lớp đệm và lớp lót chống trượt', 'https://bizweb.dktcdn.net/100/218/328/products/5d7896bf-69bd-4999-9ee3-be402f122351-jpeg.jpg?v=1654776321937'),
    ('Găng tay thủ môn GKVN Thanh xuân lính', 'goalkeeper', 150000, 15, 'Thiết kế với lớp đệm và lớp lót chống trượt', 'https://bizweb.dktcdn.net/100/218/328/products/910effd3-98fa-4429-817f-9f89da784af4-jpeg.jpg?v=1654776320897'),
    ('Găng tay thủ môn GKVN Thanh xuân lính', 'goalkeeper', 150000, 15, 'Thiết kế với lớp đệm và lớp lót chống trượt', 'https://bizweb.dktcdn.net/100/218/328/products/e6c3957d-67ed-4cc3-945c-dcb47e28878f-jpeg.jpg?v=1654776322600'),
    ('Găng tay thủ môn GKVN Thanh xuân lính', 'goalkeeper', 150000, 15, 'Thiết kế với lớp đệm và lớp lót chống trượt', 'https://bizweb.dktcdn.net/100/218/328/products/910effd3-98fa-4429-817f-9f89da784af4-jpeg.jpg?v=1654776320897'),
    ('Găng tay thủ môn GKVN Thanh xuân lính', 'goalkeeper', 150000, 15, 'Thiết kế với lớp đệm và lớp lót chống trượt', 'https://bizweb.dktcdn.net/100/218/328/products/5d7896bf-69bd-4999-9ee3-be402f122351-jpeg.jpg?v=1654776321937'),
    ('Quần áo bóng đá Riki k logo', 'clothes', 170000, 25, 'Thiết kế đơn giản nhưng mạnh mẽ', 'https://bizweb.dktcdn.net/100/218/328/products/img-1901-jpeg.jpg?v=1708930085877'),
    ('Quần áo bóng đá Volvo', 'clothes', 220000, 30, 'Chất liệu chống nhăn và thoáng khí, thiết kế năng động', 'https://bizweb.dktcdn.net/100/218/328/products/0cf21ef0664db22c3be6bc90ab62c7d3-jpeg.jpg?v=1703091040133'),
    ('Quần áo bóng đá Riki k logo', 'clothes', 170000, 25, 'Thiết kế đơn giản nhưng mạnh mẽ', 'https://bizweb.dktcdn.net/100/218/328/products/img-1899-jpeg.jpg?v=1708930088117'),
    ('Quần áo bóng đá Volvo', 'clothes', 220000, 30, 'Chất liệu chống nhăn và thoáng khí, thiết kế năng động', 'https://bizweb.dktcdn.net/100/218/328/products/2c90dcef18441740f6a6b71b062284f0-jpeg.jpg?v=1703091041087'),
    ('Quần áo bóng đá Riki k logo', 'clothes', 170000, 25, 'Thiết kế đơn giản nhưng mạnh mẽ', 'https://bizweb.dktcdn.net/100/218/328/products/img-1898-jpeg.jpg?v=1708930089280'),
    ('Quần áo bóng đá Volvo', 'clothes', 220000, 30, 'Chất liệu chống nhăn và thoáng khí, thiết kế năng động', 'https://bizweb.dktcdn.net/100/218/328/products/6e97ee6b6c3817766df1e4a05d7b98f2-jpeg.jpg?v=1703091042020'),
    ('Quần áo bóng đá Riki k logo', 'clothes', 170000, 25, 'Thiết kế đơn giản nhưng mạnh mẽ', 'https://bizweb.dktcdn.net/100/218/328/products/img-1897-jpeg.jpg?v=1708930090560'),
    ('Quần áo bóng đá Volvo', 'clothes', 220000, 30, 'Chất liệu chống nhăn và thoáng khí, thiết kế năng động', 'https://bizweb.dktcdn.net/100/218/328/products/1d291b046834b391f0534bda3240232e-jpeg.jpg?v=1703091042580'),
    ('Quần áo bóng đá Odin', 'clothes', 169000, 25, 'Thiết kế đơn giản nhưng mạnh mẽ', 'https://bizweb.dktcdn.net/100/218/328/products/1hdfnlsmu-3j0s4o-jpeg.jpg?v=1703091284527'),
    ('Quần áo bóng đá Dreams', 'clothes', 179000, 30, 'Chất liệu chống nhăn và thoáng khí, thiết kế năng động', 'https://bizweb.dktcdn.net/100/218/328/products/img-1164-jpeg.jpg?v=1703090771060'),
    ('Quần áo bóng đá Odin', 'clothes', 169000, 25, 'Thiết kế đơn giản nhưng mạnh mẽ', 'https://bizweb.dktcdn.net/100/218/328/products/1hdfnlsmr-3j0s4o-jpeg.jpg?v=1703091285330'),
    ('Quần áo bóng đá Dreams', 'clothes', 179000, 30, 'Chất liệu chống nhăn và thoáng khí, thiết kế năng động', 'https://bizweb.dktcdn.net/100/218/328/products/img-1167-jpeg.jpg?v=1703090767017'),
    ('Cup lưu niệm', 'accessories', 590000, 40, 'Cup lưu niệm giải đấu', 'https://bizweb.dktcdn.net/100/218/328/products/ec925f30-bbe9-46d9-a4e1-ae3df513f872-jpeg.jpg?v=1654666275657'),
    ('Cờ lưu niệm', 'accessories', 50000, 50, 'Cờ lưu niệm giải đấu', 'https://bizweb.dktcdn.net/100/218/328/products/b89d9e57-dba5-4f69-92aa-f538b5642dc0-jpeg.jpg?v=1654666059483'),
    ('Cup lưu niệm', 'accessories', 590000, 40, 'Cup lưu niệm giải đấu', 'https://bizweb.dktcdn.net/100/218/328/products/ec925f30-bbe9-46d9-a4e1-ae3df513f872-jpeg.jpg?v=1654666275657'),
    ('Cờ lưu niệm', 'accessories', 50000, 50, 'Cờ lưu niệm giải đấu', 'https://bizweb.dktcdn.net/100/218/328/products/b89d9e57-dba5-4f69-92aa-f538b5642dc0-jpeg.jpg?v=1654666059483'),
    ('Cup lưu niệm', 'accessories', 590000, 40, 'Cup lưu niệm giải đấu', 'https://bizweb.dktcdn.net/100/218/328/products/ec925f30-bbe9-46d9-a4e1-ae3df513f872-jpeg.jpg?v=1654666275657'),
    ('Cờ lưu niệm', 'accessories', 50000, 50, 'Cờ lưu niệm giải đấu', 'https://bizweb.dktcdn.net/100/218/328/products/b89d9e57-dba5-4f69-92aa-f538b5642dc0-jpeg.jpg?v=1654666059483'),
    ('Cup lưu niệm', 'accessories', 590000, 40, 'Cup lưu niệm giải đấu', 'https://bizweb.dktcdn.net/100/218/328/products/ec925f30-bbe9-46d9-a4e1-ae3df513f872-jpeg.jpg?v=1654666275657'),
    ('Cờ lưu niệm', 'accessories', 50000, 50, 'Cờ lưu niệm giải đấu', 'https://bizweb.dktcdn.net/100/218/328/products/b89d9e57-dba5-4f69-92aa-f538b5642dc0-jpeg.jpg?v=1654666059483'),
    ('Cup lưu niệm', 'accessories', 590000, 40, 'Cup lưu niệm giải đấu', 'https://bizweb.dktcdn.net/100/218/328/products/ec925f30-bbe9-46d9-a4e1-ae3df513f872-jpeg.jpg?v=1654666275657'),
    ('Cờ lưu niệm', 'accessories', 50000, 50, 'Cờ lưu niệm giải đấu', 'https://bizweb.dktcdn.net/100/218/328/products/b89d9e57-dba5-4f69-92aa-f538b5642dc0-jpeg.jpg?v=1654666059483'),
    ('Cup lưu niệm', 'accessories', 590000, 40, 'Cup lưu niệm giải đấu', 'https://bizweb.dktcdn.net/100/218/328/products/ec925f30-bbe9-46d9-a4e1-ae3df513f872-jpeg.jpg?v=1654666275657'),
    ('Cờ lưu niệm', 'accessories', 50000, 50, 'Cờ lưu niệm giải đấu', 'https://bizweb.dktcdn.net/100/218/328/products/b89d9e57-dba5-4f69-92aa-f538b5642dc0-jpeg.jpg?v=1654666059483'),
    ('Giày Warrior chính hãng', 'shoe', 300000, 45, 'Sự kết hợp giữa sự linh hoạt và độ ổn định', 'https://bizweb.dktcdn.net/100/218/328/products/5930b764-d3fe-4b14-b685-8281ccfb2d98-jpeg.jpg?v=1597929941127'),
    ('Giày Velicodad Legend', 'shoe', 460000, 25, 'Thiết kế tăng cường khả năng kiểm soát bóng và độ bám mặt sân', 'https://bizweb.dktcdn.net/100/218/328/products/77ffd526-9f24-43b5-a46c-79cd1c4f541d-jpeg.jpg?v=1663780095177'),
    ('Bóng IKINGSPORT PRO', 'ball', 860000, 15, 'Thiết kế chất lượng cao, đảm bảo độ tròn và độ bền', 'https://bizweb.dktcdn.net/100/218/328/products/cb0c9fd6-a23b-4168-9d10-bdc2e7e7af41-jpeg.jpg?v=1661579473477'),
    ('Bóng Molten 2700', 'ball', 500000, 5, 'Thiết kế chất lượng cao, đảm bảo độ tròn và độ bền', 'https://bizweb.dktcdn.net/100/218/328/products/30adf82a-b5c3-4b52-a82a-cdfce7de0b8e-jpeg.jpg?v=1528560761983'),
    ('Quần áo bóng đá Kamito Prematch3', 'clothes', 230000, 20, 'Thiết kế độc đáo, mang lại sự thoải mái và linh hoạt', 'https://bizweb.dktcdn.net/100/218/328/products/ee72b0d2f6d5dcc721a89cca58a503cf-jpeg.jpg?v=1708929735023'),
    ('Quần áo bóng đá Kamito Prematch3', 'clothes', 230000, 35, 'Thiết kế độc đáo, mang lại sự thoải mái và linh hoạt', 'https://bizweb.dktcdn.net/100/218/328/products/8f842b1227ad1d6e61b11f582e6216f0-jpeg.jpg?v=1708929733427'),
    ('Huy chương', 'accessories', 60000, 30, 'Huy chương của nhà vô địch', 'https://bizweb.dktcdn.net/100/218/328/products/18033170-1875234382736379-2570991798436862335-n.jpg?v=1498755018720'),
    ('Quả bóng vàng lưu niệm', 'accessories', 850000, 25, 'Quả bóng vàng lưu niệm giải đấu', 'https://bizweb.dktcdn.net/100/218/328/products/ff11ec3b-76b5-461b-be8a-e676d96e0c8a-jpeg.jpg?v=1528913436057');


CREATE TABLE orders(
    orderId INT PRIMARY KEY AUTO_INCREMENT,
    userId INT NOT NULL,
    productId INT NOT NULL,
    number INT NOT NULL,
    FOREIGN KEY (userId) REFERENCES users(id),
    FOREIGN KEY (productId) REFERENCES product(id)
);

INSERT INTO orders(userId, productId,  number) 
VALUES
(2, 10, 6),
(2, 5, 5);
