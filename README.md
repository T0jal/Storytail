# Storytail  - Virtual Library Management System

This project was created as a Final Group Project of a full-stack programming degree.

The client asked for a WebApp that would allow Users to not only read books, but also hear the pages being narrated and have the possibility of watching a video.

The main technologies used were the Laravel Framework and Vue.js.

The WebApp is divided into 2 parts:

- Backoffice -> Accessible by the Admin and where he can control de App. It has a complete CRUD for books, authors, activities, images, etc. The front-end of the backoffice was made using Laravel Blade Templates and Bootstrap.
- Frontoffice -> Accessible by all and where the books can be read/heard. The User also has access to an editable profile page. This is a SPA made with Vue.js that consumes our Laravel API. Original CSS. 
## Deployment

Make sure you have PHP 7.4 installed.

To deploy this project run:

```bash
  composer install
```
```bash
  npm install
```
```bash
  composer dump-autoload && php artisan cache:clear && php artisan config:clear && php artisan route:clear && php artisan view:clear && php artisan optimize
```
```bash
  php artisan serve
```
  
## Authors

All the developers worked on the project as a whole, especially the back-end. The database was co-designed.

- [@António 'Tojal' Rocha](https://www.github.com/T0jal) - Focused on the CRUD for the backoffice and the front-end of the backoffice, implementing the whole visual layer for the Admin.  
- [@Emanuel Teixeira](https://www.github.com/manecz) - Focused on the front-end of the frontoffice creating it from scratch using Vue.js. Also improved the CRUD API as needed. Implemented Axios, VueX and JWT.
- João Carvalhinho - Focused on the overall back-end. Worked on the Models, CRUD, implemented the DB and Authentication, created a Tag System.

  
## 🔗 Links
[![portfolio](https://img.shields.io/badge/my_portfolio-000?style=for-the-badge&logo=ko-fi&logoColor=white)](http://www.tojal.pt/)
[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/antoniopedrosilvarocha)
