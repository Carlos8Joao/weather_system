-- ============================================================
-- C.J_View — Sistema de Previsão do Tempo
-- Base de Dados: MySQL/MariaDB
-- Projecto #03 — IPIL 2025/2026 | Judson Paiva
-- ============================================================

CREATE DATABASE IF NOT EXISTS cjview_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE cjview_db;

-- Tabela 1: Utilizadores (Autenticação + Perfis)
CREATE TABLE IF NOT EXISTS users (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  first_name   VARCHAR(100) NOT NULL,
  last_name    VARCHAR(100) NOT NULL,
  email        VARCHAR(255) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,  -- bcrypt hash (PHP: password_hash())
  role         ENUM('admin', 'user') NOT NULL DEFAULT 'user',
  created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_email (email),
  INDEX idx_role (role)
);

-- Tabela 2: Cidades Monitoradas
CREATE TABLE IF NOT EXISTS cities (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  name         VARCHAR(150) NOT NULL,
  country      VARCHAR(100),
  temp         DECIMAL(5,2),
  feels_like   DECIMAL(5,2),
  humidity     INT,
  wind_speed   DECIMAL(6,2),
  pressure     INT,
  visibility   INT,
  condition    VARCHAR(150),
  icon_code    VARCHAR(20),
  last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_city_name (name)
);

-- Tabela 3: Favoritos por Utilizador
CREATE TABLE IF NOT EXISTS favorites (
  user_id    INT NOT NULL,
  city_id    INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (user_id, city_id),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (city_id) REFERENCES cities(id) ON DELETE CASCADE
);

-- Tabela 4: Alertas Meteorológicos
CREATE TABLE IF NOT EXISTS alerts (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  city_id     INT NOT NULL,
  user_id     INT NOT NULL,
  type        ENUM('chuva','vento','trovoada','calor','frio') NOT NULL,
  description VARCHAR(255),
  threshold   VARCHAR(100),
  severity    ENUM('critical','warning','info') NOT NULL DEFAULT 'warning',
  active      TINYINT(1) DEFAULT 1,
  created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (city_id) REFERENCES cities(id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  INDEX idx_active (active)
);

-- Tabela 5: Log de Pesquisas (Auditoria)
CREATE TABLE IF NOT EXISTS search_log (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  city_name   VARCHAR(150) NOT NULL,
  user_id     INT,
  searched_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  status      ENUM('success','not_found','error') DEFAULT 'success',
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
  INDEX idx_searched_at (searched_at)
);

-- ============================================================
-- DADOS INICIAIS (Seed)
-- ============================================================
INSERT INTO users (first_name, last_name, email, password_hash, role) VALUES
('Admin', 'Sistema', 'admin@cjview.ao', '$2y$10$exampleHashAdmin', 'admin'),
('Judson', 'Paiva', 'user@cjview.ao', '$2y$10$exampleHashUser', 'user');

INSERT INTO cities (name, country, temp, feels_like, humidity, wind_speed, pressure, visibility, condition, icon_code) VALUES
('Luanda',     'Angola',        28.0, 31.0, 72, 18.0, 1012, 10, 'Parcialmente nublado', '02d'),
('Lisboa',     'Portugal',      19.0, 18.0, 55, 12.0, 1018, 20, 'Ensolarado',           '01d'),
('Londres',    'Reino Unido',   12.0,  9.0, 85, 25.0, 1008,  8, 'Chuvoso',              '10d'),
('Paris',      'França',        16.0, 14.0, 68, 14.0, 1015, 15, 'Nublado',              '04d'),
('Nova Iorque','EUA',           22.0, 21.0, 45, 20.0, 1020, 25, 'Ensolarado',           '01d');

INSERT INTO alerts (city_id, user_id, type, description, threshold, severity) VALUES
(1, 1, 'calor',  'Calor extremo previsto',  '> 35°C',    'critical'),
(3, 2, 'chuva',  'Chuva intensa',           '> 20 mm/h', 'warning'),
(4, 2, 'vento',  'Vento forte',             '> 60 km/h', 'info');
