# API Documentation

---

# Login

## Endpoint
POST /login

---

## Controller
AuthController.php

---

## Method
login()

---

## Deskripsi
Digunakan untuk proses login admin.

---

## Parameter

| Nama | Tipe |
|---|---|
| username | string |
| password | string |

---

## Response Success

```json
{
  "status": "success",
  "message": "Login berhasil"
}
```

---

# Tambah Mahasiswa

## Endpoint
POST /mahasiswa/store

---

## Controller
MahasiswaController.php

---

## Method
store()

---

## Deskripsi
Digunakan untuk menambahkan data mahasiswa.

---

## Parameter

| Nama | Tipe |
|---|---|
| nim | string |
| nama | string |
| jurusan | string |

---

## Response Success

```json
{
  "status": "success",
  "message": "Data mahasiswa berhasil ditambahkan"
}
```