# Hotel Aurora — Guía del proyecto

## Stack

| Capa | Tecnología | Versión |
|------|-----------|---------|
| Framework | Laravel | 11.x |
| Lenguaje | PHP | 8.2+ (FPM) |
| Base de datos | MySQL | 8.0 |
| Frontend build | Vite | ^6.0 |
| CSS | Tailwind CSS | ^3.x |
| JS interactivo | Alpine.js | ^3.x |
| Templates | Blade | (nativo Laravel) |
| Web server | Nginx | alpine |
| Contenedores | Docker Compose | — |
| Node (HMR) | Node.js | 20 |

## Estructura de directorios relevante

```
hotel/
├── app/
│   ├── Http/
│   │   └── Controllers/        # Controladores (HomeController, etc.)
│   └── Models/                 # Eloquent models (Room, Reservation, Amenity, Testimonial)
├── database/
│   ├── migrations/             # Una migración por tabla
│   └── seeders/                # RoomSeeder, AmenitySeeder, TestimonialSeeder, DatabaseSeeder
├── docker/
│   ├── nginx/default.conf      # Config Nginx
│   └── php/Dockerfile          # PHP-FPM 8.2 con extensiones del proyecto
├── resources/
│   ├── css/app.css             # Entrada Tailwind
│   ├── js/app.js               # Entrada JS (Alpine.js)
│   └── views/
│       ├── components/         # Componentes Blade reutilizables
│       │   ├── nav.blade.php
│       │   ├── hero.blade.php
│       │   ├── room-card.blade.php
│       │   ├── amenity-card.blade.php
│       │   ├── testimonial-card.blade.php
│       │   └── footer.blade.php
│       ├── layouts/
│       │   └── app.blade.php   # Layout base con Tailwind + Alpine + Google Fonts
│       └── home.blade.php      # Página principal (/)
├── routes/
│   └── web.php                 # Solo rutas web
├── docker-compose.yml
├── .env / .env.example
└── CLAUDE.md
```

## Comandos comunes

```bash
# Entorno Docker
docker compose up -d            # Levanta todos los servicios en background
docker compose down             # Detiene y elimina contenedores
docker compose logs -f php      # Logs del contenedor PHP en tiempo real
docker compose exec php bash    # Shell dentro del contenedor PHP

# Laravel (dentro del contenedor PHP o con el alias)
php artisan migrate             # Corre migraciones pendientes
php artisan migrate:fresh --seed  # Recrea todas las tablas y seedea
php artisan db:seed             # Solo seeders
php artisan key:generate        # Genera APP_KEY en .env
php artisan config:clear        # Limpia caché de configuración
php artisan route:list          # Lista todas las rutas

# Assets (dentro del contenedor node o localmente con Node 20)
npm run dev                     # Vite dev server con HMR (corre en contenedor node)
npm run build                   # Build de producción
```

## Cómo correr el entorno desde cero

```bash
# 1. Copiar variables de entorno
cp .env.example .env

# 2. Levantar Docker
docker compose up -d

# 3. Instalar dependencias PHP (si no existe vendor/)
docker compose exec php composer install

# 4. Generar clave de aplicación
docker compose exec php php artisan key:generate

# 5. Correr migraciones y seeders
docker compose exec php php artisan migrate:fresh --seed

# 6. Acceder en el browser
open http://localhost:8080
```

## Convenciones del proyecto

### Naming

- **Modelos**: singular PascalCase → `Room`, `Reservation`, `Amenity`, `Testimonial`
- **Controladores**: PascalCase + Controller → `HomeController`, `ReservationController`
- **Migraciones**: snake_case con fecha → `2024_01_01_000001_create_rooms_table`
- **Vistas**: snake_case → `home.blade.php`, layouts en `layouts/`
- **Componentes Blade**: kebab-case → `<x-room-card>`, archivos en `resources/views/components/`
- **Rutas**: kebab-case → `/mis-reservas`, `/habitaciones/{slug}`
- **Clases CSS**: Tailwind utilities directamente; clases custom en `resources/css/app.css` solo si se repiten 3+ veces

### Dónde van las cosas

- **Helpers globales**: `app/Helpers/` + autoload en `composer.json` (no usar `helpers.php` en la raíz)
- **Componentes Blade**: `resources/views/components/` — componentes anónimos (sin clase PHP)
- **Layouts**: `resources/views/layouts/app.blade.php` — un solo layout base
- **Lógica de negocio pesada**: Services en `app/Services/` cuando un controlador supera ~50 líneas
- **Queries complejas**: Scopes en el modelo, no en el controlador

### Idioma

Todo el proyecto está en español: variables de entorno legibles, mensajes de validación, textos de UI. Sin i18n (no `__()`, no archivos `lang/`).

## Paleta de colores (Tailwind config)

```
neutral-50..950   → base, fondos, textos
gold-400/500/600  → acento principal (#B8962E / #9E7E1F / #7D6318)
```
