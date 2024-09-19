## README - Backend para la Gestión de Libros

Este proyecto es la parte **Backend** de un sistema de gestión de libros desarrollado en **Laravel**. A continuación, se detallan los pasos para configurar y ejecutar el backend de manera local.

---

### Prerrequisitos

#### Backend (Laravel):
- **PHP**: 8.3.11 o superior
- **Composer**: 2.7.9
- **MySQL**: 8.0.39 (Para gestionar la base de datos)

---

### Instrucciones para Ejecutar el Backend

1. **Clonar el repositorio**:

   Ejecuta el siguiente comando para clonar el repositorio de GitHub:

   ```bash
   git clone https://github.com/evelynnaranjobeez/bookstore-backend.git
   ```

2. **Configurar el archivo `.env`**:

   Después de clonar el repositorio, copia el archivo `.env.example` a `.env` y ajusta la configuración de la base de datos a tus credenciales locales de MySQL:

   ```bash
   cp .env.example .env
   ```

   Edita el archivo `.env` y configura los parámetros de tu base de datos:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=bookstore_bd
   DB_USERNAME=root
   DB_PASSWORD=tu_contraseña
   ```

3. **Instalar dependencias**:

   En la raíz del proyecto, ejecuta el siguiente comando para instalar todas las dependencias de Laravel:

   ```bash
   composer install
   ```

4. **Migrar la base de datos**:

   Si ya tienes la base de datos configurada, ejecuta las migraciones para crear las tablas en MySQL:

   ```bash
   php artisan migrate
   ```

   Luego, si necesitas datos de prueba (seeders), puedes ejecutarlos con el siguiente comando:

   ```bash
   php artisan db:seed
   ```

5. **Iniciar el servidor**:

   Finalmente, inicia el servidor local de Laravel con el siguiente comando:

   ```bash
   php artisan serve
   ```

   Esto ejecutará el servidor en `http://127.0.0.1:8000`.

---

### Funcionalidades del Backend

- **Sistema de autenticación con roles**: Implementado con **Laravel Sanctum** para permitir que los usuarios se autentiquen y gestionen permisos diferenciados. Los roles incluidos son:
  - **Admin**: Acceso completo a todas las funcionalidades.
  - **Operativo**: Acceso limitado a ciertas funcionalidades.

- **Gestión de usuarios y roles**: Administración completa de los usuarios y sus roles a través de la API.

- **Gráficos de indicadores basados en API externa**: Los gráficos de indicadores, como la esperanza de vida, están integrados mediante datos obtenidos de la API del Banco Mundial.

---

### Ejemplos de Uso

#### Acceso como **Admin**:

Correo electrónico: `admin@example.com`  
Contraseña: `123456`

#### Acceso como **Operativo**:

Correo electrónico: `user@example.com`  
Contraseña: `123456`

---

### Versiones Utilizadas

- **PHP**: 8.3.11
- **Laravel**: 9.x
- **MySQL**: 8.0.39
- **Composer**: 2.7.9

---

### Notas Adicionales

Este backend se conecta con un **frontend** desarrollado en **Flutter**. Asegúrate de tener ambos proyectos corriendo en paralelo y configurados correctamente.
