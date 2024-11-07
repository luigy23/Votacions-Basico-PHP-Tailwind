-- Users table
CREATE TABLE usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'usuario') DEFAULT 'usuario',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Candidates table
CREATE TABLE candidatos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    foto VARCHAR(255),
    partido VARCHAR(100),
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Votes table
CREATE TABLE votos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT,
    candidato_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (candidato_id) REFERENCES candidatos(id),
    UNIQUE KEY unique_vote (usuario_id, candidato_id)
);

-- Elections table
CREATE TABLE elecciones (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT,
    fecha_inicio DATETIME NOT NULL,
    fecha_fin DATETIME NOT NULL,
    estado ENUM('pendiente', 'activa', 'finalizada') DEFAULT 'pendiente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Election_Candidates table (relationship between elections and candidates)
CREATE TABLE eleccion_candidatos (
    eleccion_id INT,
    candidato_id INT,
    FOREIGN KEY (eleccion_id) REFERENCES elecciones(id),
    FOREIGN KEY (candidato_id) REFERENCES candidatos(id),
    PRIMARY KEY (eleccion_id, candidato_id)
);