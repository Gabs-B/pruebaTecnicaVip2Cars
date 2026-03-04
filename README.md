# VIP2CARS - Prueba Técnica Laravel

Este proyecto es una API RESTful desarrollada en Laravel 10 para la gestión de vehículos y sus respectivos propietarios (contactos). Implementa un diseño robusto siguiendo las mejores prácticas de arquitectura y optimización de base de datos.

## Características Principales

- **Arquitectura**: Implementación de **Service Layer** para desacoplar la lógica de negocio.
- **Consultas Optimizadas**: Uso de **Query Scopes** en los modelos para encapsular la lógica de búsqueda.
- **Validación**: Form Requests personalizados con mensajes de error amigables.
- **Respuestas Limpias**: Uso de **API Resources** para estandarizar y limpiar la salida JSON.
- **Paginación y Búsqueda**: Sistema de búsqueda global (nombres, documentos, placas, etc.) integrado con paginación eficiente.

---

## Requisitos del Entorno

Asegúrate de tener instalados los siguientes componentes antes de iniciar:

- **PHP**: ^8.1
- **Composer**: ^2.0
- **Base de Datos**: MySQL / MariaDB
- **Requisitos de PHP**: ^8.1 con las extensiones estándar de Laravel (`bcmath`, `ctype`, `fileinfo`, [json](cci:7://file:///c:/Users/PC/Desktop/PruebaTecnicaPhp/package.json:0:0-0:0), `mbstring`, `openssl`, `pdo`, `tokenizer`, [xml](cci:7://file:///c:/Users/PC/Desktop/PruebaTecnicaPhp/phpunit.xml:0:0-0:0)). 
  *(Nota: La mayoría de estas extensiones ya vienen habilitadas por defecto en instalaciones estándar de PHP como XAMPP o Laragon).*
---

## Instalación y Configuración

Siga estos pasos para configurar el proyecto localmente:

1. **Clonar el repositorio**:
   ```bash
   git clone <url-del-repositorio>
   cd PruebaTecnicaPhp
   ```

2. **Instalar dependencias**:
   ```bash
   composer install
   ```

3. **Configurar variables de entorno**:
   Copia el archivo de ejemplo y configura tus credenciales de base de datos:
   ```bash
   cp .env.example .env
   ```
   Asegúrate de que la base de datos se llame **VIP2CARS**:
   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=VIP2CARS
   DB_USERNAME=tu_usuario
   DB_PASSWORD=tu_contraseña
   ```

4. **Generar la clave de la aplicación**:
   ```bash
   php artisan key:generate
   ```

---

## Puesta en Marcha

Una vez configurado, ejecuta los siguientes comandos para preparar la base de datos y levantar el servidor:

1. **Correr migraciones y Seeders**:
   Este comando creará las tablas optimizadas y llenará la base de datos con 20 registros de prueba de contactos y vehículos aleaotorios por contacto.
   ```bash
   php artisan migrate --seed
   ```

2. **Iniciar servidor local**:
   ```bash
   php artisan serve
   ```
   La API estará disponible en: `http://127.0.0.1:8000/api` o en `http://localhost:8000/api`

---

## Estructura de la BBDD

El proyecto utiliza una estructura relacional optimizada (tipos de datos de tamaño ajustado) para un mejor rendimiento:

### Tabla: `contactos`
| Campo | Tipo | Notas |
|---|-|---|
| `id` | BigInt (PK) | Auto-incremental |
| `nombres` | String(100) | Obligatorio |
| `apellidos` | String(100) | Obligatorio |
| `numero_documento` | String(20) | Único |
| `correo` | String(150) | Único, Formato Email |
| `telefono` | String(25) | Obligatorio |

### Tabla: `vehiculos`
| Campo | Tipo | Notas |
|---|-|---|
| `id` | BigInt (PK) | Auto-incremental |
| `placa` | String(15) | Única |
| `marca` | String(50) | Obligatorio |
| `modelo` | String(50) | Obligatorio |
| `anio_fabricacion` | UnsignedSmallInt | Ahorro de espacio (2 bytes) |
| `contacto_id` | Foreign Key | Relación con `contactos` (Cascade on delete) |

---

## Endpoints Principales

### Contactos
- `GET /api/contactos` (Soporta `search`, `page`)
- `GET /api/contactos/{id}` (Obtener un contacto específico)
- `POST /api/contactos`
- `PUT /api/contactos/{id}`
- `DELETE /api/contactos/{id}`

### Vehículos
- `GET /api/vehiculos` (Soporta `search` global en vehículos y propietarios, `page`)
- `GET /api/vehiculos/{id}` (Obtener un vehículo específico)
- `POST /api/vehiculos`
- `PUT /api/vehiculos/{id}`
- `DELETE /api/vehiculos/{id}`

---

## Pruebas con Postman

Para probar la API correctamente, asegúrese de agregar el header `Accept: application/json` en todas sus solicitudes.

### 1. Parámetros de Consulta (Query Params)
En las solicitudes `GET` de listado, puede utilizar los siguientes parámetros:
- `search`: Filtro global para buscar por diversos campos.
- `page`: Número de la página de resultados.
- `per_page`: Cantidad de resultados por página (por defecto 10).

**URL Ejemplo**: `http://localhost:8000/api/vehiculos?search=ABC&page=1&per_page=10`

### 2. Estructura del Body (JSON)

#### Gestión de Contactos (`POST` / `PUT`)
```json
{
    "nombres": "Juan Alberto",
    "apellidos": "Pérez Rojas",
    "numero_documento": "76543210",
    "correo": "juan.perez@email.com",
    "telefono": "987654321"
}
```

#### Gestión de Vehículos (`POST` / `PUT`)
```json
{
    "placa": "ABC-123",
    "marca": "Toyota",
    "modelo": "Corolla",
    "anio_fabricacion": 2022,
    "contacto_id": 1
}
```

