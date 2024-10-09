CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('employee', 'manager') DEFAULT 'employee'
);

CREATE TABLE fuels (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  price_per_liter DECIMAL(10, 2) NOT NULL
);

CREATE TABLE transactions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  fuel_type INT,
  liters_sold DECIMAL(10, 2),
  transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (fuel_type) REFERENCES fuels(id)
);

CREATE USER IF NOT EXISTS 'someuser'@'%' IDENTIFIED BY 'somepassword';
GRANT ALL PRIVILEGES ON gas_station_db.* TO 'someuser'@'%';
FLUSH PRIVILEGES;
