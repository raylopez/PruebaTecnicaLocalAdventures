# 🚀 Prueba técnica Backend LocalAdventures

Este repositorio contiene una aplicación desarrollada con **Laravel**, para generar facturas de clientes

---

## 🧰 Tecnologías utilizadas

* **Laravel** (Framework PHP)
* **PHP** ^8.x
* **Composer**
* **MySQL** (Base de datos)
* **Blade** (para plantillas pdf)
* **Dom-Pdf** (para crear pdfs)

---

## 📍 Rutas/Endpoints

Estos son los endpoints que se utilizan:

* `POST - /api/invoice/generate-head` Para generar el reporte completo
* `GET - invoice/{invoiceId}/pdf` Para generar un PDF de una factura
* `GET - /api/company/{companyId}/clients` Para obtener los clientes de una empresa
* `GET - /api/company/{id}/clients/invoices` Para obtener las facturas de una empresa

---

## 📁 Estructura del proyecto

```
app/
├── Enums/
├── Http/
│   ├── Controllers/
└── Requests/
├── Models/

database/
├── migrations/
├── seeders/

routes/
├── web.php

resources/
├── views/
│   ├── pdfs/
├── js/
├── css/
```
