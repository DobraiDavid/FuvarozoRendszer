# Fuvarozó Rendszer - Laravel

Egy egyszerű fuvarozó/szállítmányozó rendszer Laravel keretrendszerben, ahol adminisztrátorok munkákat hozhatnak létre és fuvarozókhoz rendelhetik azokat.

## Funkciók

### Adminisztrátor funkciói:
- Munkák létrehozása, módosítása, törlése
- Munkák fuvarozókhoz rendelése
- Összes munka megtekintése státusszal
- Státusz alapú szűrés
- Értesítések sikertelen munkákról

### Fuvarozó funkciói:
- Regisztráció
- Saját munkák megtekintése
- Munkák státuszának frissítése (Kiosztva → Folyamatban → Elvégezve/Sikertelen)

## Telepítés

### 1. Repository klónozása

```bash
git clone https://github.com/DobraiDavid/FuvarozoRendszer
cd FuvarozoRendszer
```

### 2. Függőségek telepítése

```bash
composer install
```

### 3. .env fájl konfigurálása

```bash
cp .env.example .env
php artisan key:generate
```

A `.env` fájlban állítsd be az adatbázis kapcsolatot:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fuvarozo_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Adatbázis migrációk futtatása

```bash
php artisan migrate
```

### 5. Tesztadatok generálása

```bash
php artisan db:seed
```

### 6. Szerver indítása

```bash
php artisan serve
```

A rendszer elérhető lesz: `http://localhost:8000`


## Tesztelés

PHPUnit tesztek futtatása:

```bash
php artisan test --filter=MunkaTest
```
