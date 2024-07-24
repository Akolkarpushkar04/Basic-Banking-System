CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    age INT NOT NULL,
    balance DECIMAL(10, 2) NOT NULL
);

INSERT INTO customers (name, email, age, balance) VALUES
('John Doe', 'john@example.com', 30, 1000.00),
('Jane Smith', 'jane@example.com', 25, 1500.00),
('Alice Johnson', 'alice@example.com', 28, 1200.00),
('Bob Brown', 'bob@example.com', 35, 2000.00),
('Charlie White', 'charlie@example.com', 40, 1300.00),
('Eve Black', 'eve@example.com', 22, 1800.00),
('Frank Green', 'frank@example.com', 33, 1100.00),
('Grace Blue', 'grace@example.com', 29, 1700.00),
('Hank Yellow', 'hank@example.com', 27, 1400.00),
('Ivy Orange', 'ivy@example.com', 31, 1600.00);
