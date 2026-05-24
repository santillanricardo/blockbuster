# Blockbuster API — Documentación

Base URL: `http://127.0.0.1:8000/api`

## Autenticación
La API usa Laravel Sanctum (tokens).

### POST /api/login
Obtener token de acceso.
**Body:** `{ "email": "admin@blockbuster.com", "password": "password" }`
**Respuesta:** `{ "token": "...", "user": { ... } }`

### POST /api/logout
Cerrar sesión (requiere token).
**Header:** `Authorization: Bearer {token}`

---

## Endpoints de Películas

| Método | Endpoint | Auth | Descripción |
|--------|----------|------|-------------|
| GET | /api/peliculas | No | Listar todas las películas |
| GET | /api/peliculas/{id} | No | Ver una película |
| POST | /api/peliculas | Sí | Crear película |
| PUT | /api/peliculas/{id} | Sí | Actualizar película |
| DELETE | /api/peliculas/{id} | Sí | Eliminar película |

## Ejemplos de respuesta

**GET /api/peliculas**
```json
{
  "data": [
    {
      "id": 1,
      "titulo": "El Padrino",
      "genero": "Drama",
      "anio": 1972,
      "copias_disponibles": 3
    }
  ],
  "total": 1
}
```

**Códigos HTTP usados:**
- 200 OK
- 201 Created
- 401 Unauthorized
- 404 Not Found
- 422 Unprocessable Entity