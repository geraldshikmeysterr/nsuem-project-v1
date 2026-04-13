-- schema.sql — Структура базы данных
-- Выполните этот запрос в phpMyAdmin -> вкладка SQL

-- Таблица пользователей
CREATE TABLE IF NOT EXISTS `users` (
  `id`            INT(11)      NOT NULL AUTO_INCREMENT,
  `email`         VARCHAR(255) NOT NULL UNIQUE COMMENT 'Email (логин)',
  `password_hash` VARCHAR(255) NOT NULL COMMENT 'Хэш пароля (bcrypt)',
  `role`          ENUM('admin','client') NOT NULL DEFAULT 'client' COMMENT 'Роль',
  `created_at`    DATETIME     DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Таблица товаров
CREATE TABLE IF NOT EXISTS `products` (
  `id`          INT(11)        NOT NULL AUTO_INCREMENT,
  `title`       VARCHAR(255)   NOT NULL COMMENT 'Название',
  `description` TEXT                    COMMENT 'Описание',
  `price`       DECIMAL(10, 2) NOT NULL DEFAULT 0.00 COMMENT 'Цена',
  `image_url`   VARCHAR(255)   DEFAULT NULL COMMENT 'Ссылка на фото',
  `created_at`  DATETIME       DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Создание администратора (пароль: admin123 — смените при первом входе!)
-- Хэш сгенерирован через password_hash('admin123', PASSWORD_DEFAULT)
INSERT INTO `users` (email, password_hash, role)
VALUES ('admin@site.ru', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');
