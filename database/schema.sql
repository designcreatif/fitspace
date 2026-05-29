CREATE DATABASE IF NOT EXISTS fitspace CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE fitspace;

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    reset_token VARCHAR(64) DEFAULT NULL,
    reset_expires DATETIME DEFAULT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

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
    FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB;

INSERT INTO users (first_name, last_name, username, email, password, role) VALUES
('Admin', 'FitSpace', 'admin', 'admin@fitspace.fr', '$2y$10$CcFcV.CZcoZK5DjP97cX2OSmSyaUPDhGLYoOl6IpFV3W9qP2qMhqW', 'admin');

INSERT INTO articles (title, slug, short_description, full_description, image, author_id, status, published_at) VALUES
('Abonnement Premium', 'abonnement-premium', 'Accès illimité à toutes les salles et cours collectifs.', 'L''abonnement Premium vous offre un accès illimité à l''ensemble de nos équipements cardio et musculation, ainsi qu''à tous les cours collectifs (yoga, spinning, HIIT, cross-training). Profitez également de vestiaires premium, casiers sécurisés et d''un suivi personnalisé avec un coach dédié une fois par mois.', 'premium.jpg', 1, 'published', NOW()),
('Abonnement Standard', 'abonnement-standard', 'L''essentiel pour progresser à votre rythme.', 'L''abonnement Standard inclut l''accès à la salle de musculation et cardio aux heures creuses et pleines. Idéal pour les sportifs autonomes qui souhaitent un rapport qualité-prix optimal. Vestiaires et douches inclus.', 'standard.jpg', 1, 'published', NOW()),
('Cours Collectifs', 'cours-collectifs', 'Plus de 30 cours par semaine animés par des coachs certifiés.', 'Rejoignez nos cours collectifs : yoga, pilates, spinning, Zumba, body pump, HIIT et bien plus. Planning flexible du lundi au dimanche. Réservation en ligne depuis votre espace membre.', 'cours.jpg', 1, 'published', NOW()),
('Coaching Personnel', 'coaching-personnel', 'Un programme sur mesure adapté à vos objectifs.', 'Bénéficiez d''un accompagnement individuel avec nos coachs diplômés. Bilan initial, programme personnalisé, suivi nutritionnel et ajustements réguliers pour atteindre vos objectifs : perte de poids, prise de masse ou remise en forme.', 'coaching.jpg', 1, 'published', NOW());
