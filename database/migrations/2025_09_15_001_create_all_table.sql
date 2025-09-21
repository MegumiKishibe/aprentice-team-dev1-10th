/*!50503 SET NAMES utf8mb4 */;
ALTER DATABASE app CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;

CREATE TABLE body_types(
    id INT AUTO_INCREMENT PRIMARY KEY,
    body_type_name VARCHAR(255),
    protein INT,
    fat INT,
    carbohydrates INT
);


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255),
    body_type_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_users_body_type
      FOREIGN KEY (body_type_id) REFERENCES body_types(id)
      ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE points(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    point INT DEFAULT 0,

    CONSTRAINT  fk_points_users
    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE measurements(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    weight DECIMAL(5,2),
    height DECIMAL(5,2),
    body_fat DECIMAL(5,2) NULL,
    muscle_mass DECIMAL(5,2) NULL,


    CONSTRAINT  fk_measurements_users
    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE genres(
    id INT AUTO_INCREMENT PRIMARY KEY,
    genre_name VARCHAR(255)
);

CREATE TABLE main_foods(
    id INT AUTO_INCREMENT PRIMARY KEY,
    main_food_name VARCHAR(255)
);

CREATE TABLE methods(
    id INT AUTO_INCREMENT PRIMARY KEY,
    method_name VARCHAR(255)
);

CREATE TABLE dishes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dish_name VARCHAR(255),
    genre_id INT,
    main_food_id INT,
    method_id INT,

    CONSTRAINT fk_dishes_genre
      FOREIGN KEY (genre_id) REFERENCES genres(id)
      ON DELETE SET NULL ON UPDATE CASCADE,

    CONSTRAINT fk_dishes_main_food
      FOREIGN KEY (main_food_id) REFERENCES main_foods(id)
      ON DELETE SET NULL ON UPDATE CASCADE,

    CONSTRAINT fk_dishes_method
      FOREIGN KEY (method_id) REFERENCES methods(id)
      ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE meal_log (
	id INT AUTO_INCREMENT PRIMARY KEY,  
  users_id  INT NOT NULL,
	detail TEXT NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_meal_log_user
    FOREIGN KEY (users_id) REFERENCES users(id)
    ON DELETE CASCADE ON UPDATE CASCADE

);
