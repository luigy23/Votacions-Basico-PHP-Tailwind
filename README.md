# Sistema de Votaciones Electrónicas 🗳️

## 📋 Descripción
Sistema web robusto para gestionar procesos de votación digital, desarrollado con tecnologías modernas y seguras:
- PHP con arquitectura MVC
- MySQL
- Tailwind CSS

Este sistema permite una gestión completa de procesos electorales digitales, incluyendo administración de candidatos, votaciones seguras y generación de informes detallados.

## ✨ Características Principales
- 🔐 Autenticación y registro de usuarios
- 👥 Roles de usuario (admin/votante)
- 👨‍💼 Gestión de candidatos (CRUD)
- 🔒 Sistema de votación seguro
- 📊 Generación de reportes en PDF
- 📱 Interfaz responsiva con Tailwind CSS
- 🛡️ Protección contra votos duplicados
- ⚡ Visualización de resultados en tiempo real

## 🏗️ Estructura del Proyecto
```
├── Controller/
│   ├── Candidato.php
│   ├── Resultados.php
│   ├── Usuario.php
│   └── Voto.php
├── Model/
│   ├── Candidato.php
│   ├── Resultados.php
│   ├── Usuario.php
│   └── Voto.php
├── Views/
│   ├── admin/
│   │   └── candidatos.php
│   ├── votaciones/
│   │   └── votar.php
│   ├── Login.php
│   ├── Register.php
│   ├── resultados.php
│   └── generar_reporte.php
├── Layouts/
│   └── Header.php
├── conexion.php
├── index.php
└── db.sql
```

## 🔧 Requisitos
- PHP 7.4 o superior
- MySQL 5.7 o superior
- Servidor web (Apache/Nginx)
- Extensión PDO de PHP
- FPDF library

## 🚀 Instalación
1. Clonar el repositorio
2. Importar `db.sql` en MySQL
3. Configurar `conexion.php` con credenciales de base de datos
4. Asegurar permisos de escritura en directorio de reportes
5. Configurar servidor web apuntando al directorio del proyecto

## 💾 Configuración de Base de Datos
El archivo `db.sql` contiene la estructura de:
- Tabla usuarios (gestión de usuarios)
- Tabla candidatos (registro de candidatos)
- Tabla votos (registro de votaciones)
- Tabla elecciones (gestión de procesos electorales)

## 🛠️ Funcionalidades

### 👥 Módulo de Usuarios
- Registro de nuevos usuarios
- Login/Logout
- Gestión de sesiones
- Validación de datos

### ⚙️ Módulo de Administración
- CRUD completo de candidatos
- Visualización de resultados
- Generación de reportes PDF

### 🗳️ Módulo de Votación
- Interface intuitiva para votar
- Validación de voto único
- Confirmación de voto

### 📊 Módulo de Resultados
- Visualización en tiempo real
- Exportación a PDF
- Estadísticas detalladas

## 🔒 Seguridad
- Protección contra SQL Injection
- Validación de formularios
- Control de acceso por roles
- Encriptación de contraseñas
- Sanitización de datos

## 📖 Uso

### Para administradores:
1. Gestión de candidatos
2. Visualización de resultados
3. Generación de reportes

### Para votantes:
1. Emisión de voto
2. Consulta de resultados

## 🤝 Contribución
1. Fork del repositorio
2. Crear rama para nueva funcionalidad
3. Commit de cambios
4. Push a la rama
5. Crear Pull Request

## 📝 Licencia
MIT License

## 👨‍💻 Autor
**Luigy Devs**
- [LinkedIn](https://www.linkedin.com/in/luigy/)
- luigyleonardo23@gmail.com
- [luigydevs.com](https://www.luigydevs.com)

## 📈 Estado del Proyecto
En desarrollo activo
