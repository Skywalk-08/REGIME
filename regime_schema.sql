-- REGIME DATABASE SCHEMA
-- Created for REGIME Application

-- Users Table
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    genre ENUM('M', 'F') NOT NULL,
    taille INT NOT NULL COMMENT 'en cm',
    poids DECIMAL(5,2) NOT NULL COMMENT 'en kg',
    imc DECIMAL(5,2) COMMENT 'Indice de Masse Corporelle',
    password VARCHAR(255) NOT NULL,
    is_gold BOOLEAN DEFAULT FALSE,
    gold_purchased_at DATETIME,
    wallet_balance DECIMAL(10,2) DEFAULT 0,
    profile_completed BOOLEAN DEFAULT FALSE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at DATETIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Objectives Table (Augmenter poids, Réduire poids, Atteindre IMC idéal)
CREATE TABLE IF NOT EXISTS objectives (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    type ENUM('gain_weight', 'lose_weight', 'ideal_imc') NOT NULL,
    target_value DECIMAL(5,2),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_objective (user_id, type)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Regimes Table
CREATE TABLE IF NOT EXISTS regimes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(150) NOT NULL,
    description TEXT,
    pourcentage_viande INT NOT NULL COMMENT 'en %',
    pourcentage_poisson INT NOT NULL COMMENT 'en %',
    pourcentage_volaille INT NOT NULL COMMENT 'en %',
    prix_base DECIMAL(10,2) NOT NULL,
    duree_jours INT NOT NULL,
    poids_variation_min DECIMAL(5,2) COMMENT 'en kg',
    poids_variation_max DECIMAL(5,2) COMMENT 'en kg',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at DATETIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sports Activities Table
CREATE TABLE IF NOT EXISTS activites_sportives (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(150) NOT NULL,
    description TEXT,
    calories_brulees INT COMMENT 'calories brûlées par heure',
    difficulte ENUM('facile', 'moyen', 'difficile') DEFAULT 'moyen',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at DATETIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Wallet Codes Table
CREATE TABLE IF NOT EXISTS codes_portefeuille (
    id INT PRIMARY KEY AUTO_INCREMENT,
    code VARCHAR(20) UNIQUE NOT NULL,
    montant DECIMAL(10,2) NOT NULL,
    is_used BOOLEAN DEFAULT FALSE,
    utilisateur_id INT,
    used_at DATETIME,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- User Regimes (History)
CREATE TABLE IF NOT EXISTS user_regimes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    regime_id INT NOT NULL,
    date_debut DATETIME NOT NULL,
    date_fin DATETIME NOT NULL,
    prix_paye DECIMAL(10,2) NOT NULL,
    statut ENUM('actif', 'termine', 'annule') DEFAULT 'actif',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (regime_id) REFERENCES regimes(id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- User Activities (History)
CREATE TABLE IF NOT EXISTS user_activites (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    activite_id INT NOT NULL,
    frequence VARCHAR(50) COMMENT 'ex: 3x par semaine',
    date_debut DATETIME NOT NULL,
    date_fin DATETIME,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (activite_id) REFERENCES activites_sportives(id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =====================================================
-- TEST DATA
-- =====================================================

-- Insert test users
INSERT INTO users (nom, email, genre, taille, poids, imc, password, wallet_balance, profile_completed) VALUES
('Jean Dupont', 'jean@test.com', 'M', 180, 85.5, 26.4, '$2y$10$4L7u6z9Rm3Z0JZq8dB1G0e5L8K9mP2N3Q4R5S6T7U8V9W0X1Y2Z3', 50.00, TRUE),
('Marie Martin', 'marie@test.com', 'F', 165, 62.3, 22.9, '$2y$10$4L7u6z9Rm3Z0JZq8dB1G0e5L8K9mP2N3Q4R5S6T7U8V9W0X1Y2Z3', 30.00, TRUE),
('Pierre Lefevre', 'pierre@test.com', 'M', 175, 92.1, 30.1, '$2y$10$4L7u6z9Rm3Z0JZq8dB1G0e5L8K9mP2N3Q4R5S6T7U8V9W0X1Y2Z3', 0.00, TRUE),
('Sophie Bernard', 'sophie@test.com', 'F', 170, 58.2, 20.1, '$2y$10$4L7u6z9Rm3Z0JZq8dB1G0e5L8K9mP2N3Q4R5S6T7U8V9W0X1Y2Z3', 100.00, TRUE),
('Thomas Moreau', 'thomas@test.com', 'M', 182, 75.5, 22.8, '$2y$10$4L7u6z9Rm3Z0JZq8dB1G0e5L8K9mP2N3Q4R5S6T7U8V9W0X1Y2Z3', 75.50, FALSE);

-- Insert test objectives
INSERT INTO objectives (user_id, type, target_value) VALUES
(1, 'lose_weight', 75.0),
(1, 'ideal_imc', 24.5),
(2, 'gain_weight', 65.0),
(3, 'lose_weight', 80.0),
(4, 'ideal_imc', 21.0);

-- Insert test regimes
INSERT INTO regimes (nom, description, pourcentage_viande, pourcentage_poisson, pourcentage_volaille, prix_base, duree_jours, poids_variation_min, poids_variation_max) VALUES
('Regime Proteines', 'Riche en protéines pour la prise de muscle', 40, 30, 30, 15.99, 30, -1.0, 5.0),
('Regime Equilibre', 'Régime équilibré pour la stabilisation', 25, 35, 40, 12.99, 30, -2.0, 2.0),
('Regime Minceur', 'Régime hypocalorique pour la perte de poids', 30, 40, 30, 18.99, 30, -5.0, -1.0),
('Regime Athletique', 'Régime sportif haute performance', 35, 35, 30, 22.99, 60, -3.0, 3.0),
('Regime Vegetarien', 'Régime sans viande mais riche en protéines', 0, 50, 50, 14.99, 30, -2.5, 1.5);

-- Insert test sports activities
INSERT INTO activites_sportives (nom, description, calories_brulees, difficulte) VALUES
('Course à pied', 'Course d''endurance', 600, 'moyen'),
('Musculation', 'Entraînement avec poids', 500, 'difficile'),
('Yoga', 'Étirement et flexibility', 200, 'facile'),
('Natation', 'Entraînement cardiovasculaire', 700, 'difficile'),
('Cyclisme', 'Vélo sur route ou montagne', 550, 'moyen');

-- Insert test wallet codes
INSERT INTO codes_portefeuille (code, montant, is_used, utilisateur_id) VALUES
('CODE2026BIENVENUE', 10.00, 0, NULL),
('DISCOUNT50', 50.00, 1, 1),
('GOLD20', 20.00, 0, NULL),
('SUMMER100', 100.00, 0, NULL),
('WELCOME25', 25.00, 1, 2),
('PROMO15', 15.00, 0, NULL),
('FLASH30', 30.00, 0, NULL),
('LOYALTY40', 40.00, 1, 3),
('FRIEND20', 20.00, 0, NULL),
('NEWBIE10', 10.00, 1, 4),
('POWER50', 50.00, 0, NULL),
('EXTRA25', 25.00, 0, NULL),
('MEGA100', 100.00, 0, NULL),
('PRIME30', 30.00, 0, NULL),
('ULTIMATE75', 75.00, 0, NULL);

-- Create indexes for performance
CREATE INDEX idx_user_email ON users(email);
CREATE INDEX idx_user_gold ON users(is_gold);
CREATE INDEX idx_objectives_user ON objectives(user_id);
CREATE INDEX idx_user_regimes_user ON user_regimes(user_id);
CREATE INDEX idx_user_regimes_regime ON user_regimes(regime_id);
CREATE INDEX idx_user_activites_user ON user_activites(user_id);
CREATE INDEX idx_codes_used ON codes_portefeuille(is_used);
CREATE INDEX idx_codes_user ON codes_portefeuille(utilisateur_id);
