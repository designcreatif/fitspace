CREATE DATABASE IF NOT EXISTS fitspace
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE fitspace;

-- =====================================================
-- TABLE USERS
-- =====================================================

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    membership ENUM('basic','pro','elite') NOT NULL DEFAULT 'basic',
    reset_token VARCHAR(64) DEFAULT NULL,
    reset_expires DATETIME DEFAULT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- =====================================================
-- TABLE ARTICLES / OFFRES
-- =====================================================

CREATE TABLE articles (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    short_description TEXT NOT NULL,
    full_description TEXT NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    author_id INT UNSIGNED DEFAULT NULL,
    status ENUM('draft', 'published') NOT NULL DEFAULT 'published',
    published_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_article_author
        FOREIGN KEY (author_id)
        REFERENCES users(id)
        ON DELETE SET NULL
) ENGINE=InnoDB;

-- =====================================================
-- TABLE RESERVATIONS
-- =====================================================

CREATE TABLE reservations (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    article_id INT UNSIGNED NOT NULL,
    reservation_date DATETIME NOT NULL,
    status ENUM('pending','confirmed','cancelled')
        NOT NULL DEFAULT 'confirmed',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_reservation_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_reservation_article
        FOREIGN KEY (article_id)
        REFERENCES articles(id)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- =====================================================
-- TABLE USER_STATS
-- =====================================================

CREATE TABLE user_stats (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    calories_burned INT DEFAULT 0,
    streak_days INT DEFAULT 0,
    total_volume INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_stats_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- =====================================================
-- DONNÉES DE DÉMONSTRATION
-- =====================================================

INSERT INTO users (
    first_name,
    last_name,
    username,
    email,
    password,
    role,
    membership
) VALUES (
    'Admin',
    'FitSpace',
    'admin',
    'admin@fitspace.fr',
    '$2y$10$CcFcV.CZcoZK5DjP97cX2OSmSyaUPDhGLYoOl6IpFV3W9qP2qMhqW',
    'admin',
    'elite'
);

INSERT INTO articles (
    title,
    slug,
    short_description,
    full_description,
    image,
    author_id,
    status,
    published_at
) VALUES

(
'Abonnement Premium',
'abonnement-premium',
'Accès illimité à toutes les salles et cours collectifs.',
'L''abonnement Premium vous offre un accès illimité à tous les équipements et cours collectifs.',
'premium.jpg',
1,
'published',
NOW()
),

(
'Abonnement Standard',
'abonnement-standard',
'L''essentiel pour progresser à votre rythme.',
'Accès complet à la salle et aux équipements principaux.',
'standard.jpg',
1,
'published',
NOW()
),

(
'Cours Collectifs',
'cours-collectifs',
'Plus de 30 cours par semaine.',
'Yoga, Pilates, HIIT, Spinning et bien plus encore.',
'cours.jpg',
1,
'published',
NOW()
),

(
'Coaching Personnel',
'coaching-personnel',
'Programme personnalisé.',
'Suivi individuel avec un coach diplômé.',
'coaching.jpg',
1,
'published',
NOW()
);

INSERT INTO user_stats (
    user_id,
    calories_burned,
    streak_days,
    total_volume
) VALUES (
    1,
    2500,
    12,
    45000
);