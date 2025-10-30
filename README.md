# 🧩 Trabajo Práctico N°5 - PWD

Este proyecto consiste en desarrollar una aplicación web **PHP**, que debe validar un usuario, siguiendo el patrón **Modelo-Vista-Controlador (MVC)** para la cátedra de **Programación Web Dinámica**.

---

## 🎯 Objetivos Principales

El objetivo es, a partir de un MVC, que un cliente al intentar acceder a la página se valide o no su usuario

---

### 🧠 1. Modelo (Capa de Datos)

**Crear un ORM Básico:**  
Por cada tabla de la base de datos, se debe crear una clase PHP.

**Atributos y Métodos:**  
Cada clase debe incluir:

- 🧩 Variables para cada columna de la tabla  
- ⚙️ Métodos `get()` y `set()` para cada variable  
- 💾 Métodos CRUD 

---

### ⚙️ 2. Controlador (Capa de Lógica)

**Intermediario:**  
Debe conectar el **Modelo** con la **Vista**, procesando las peticiones del usuario.

#### Clase `Session`
Implementar una clase para gestionar la sesión del usuario con los siguientes métodos:

| Método | Descripción |
|--------|--------------|
| `__construct()` | Inicia la sesión |
| `iniciar($user, $pass)` | Guarda los datos del usuario en la sesión |
| `validar()` | Comprueba si la sesión es válida |
| `activa()` | Verifica si hay una sesión activa |
| `getUsuario()` | Devuelve los datos del usuario logueado |
| `getRol()` | Devuelve el rol del usuario logueado |
| `cerrar()` | Cierra la sesión |

---

### 🖥️ 3. Vista (Capa de Presentación)

#### 📄 `Vista/login.php`
Formulario de inicio de sesión que envía los datos a un script de acción (`accion/verificarLogin.php`).  
- Si el login es **correcto**, redirige a `paginaSegura.php`.  
- Si **falla**, vuelve a mostrar el formulario con un mensaje de error.

#### 👥 `Vista/listarUsuario.php`
Página que muestra todos los usuarios registrados.  
Permite:
- Actualizar datos del usuario.  
- Realizar un **borrado lógico**.

#### 🔒 `Vista/paginaSegura.php`
Página protegida a la que solo se puede acceder si la sesión se inició correctamente.

---

> ✍️ **Autor:** Facundo Ledesma  
> 📘 **Materia:** Programación Web Dinámica (PWD)
