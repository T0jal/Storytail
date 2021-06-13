<template>
<div>
    <router-view/>
</div>
</template>
<script>
export default{
    created() {
    this.$http.interceptors.response.use(undefined, function (err) {
      return new Promise(function (resolve, reject) {
        if (err.status === 401 && err.config && !err.config.__isRetryRequest) {
          this.$store.dispatch(logout)
        }
        throw err;
      });
    });
  }
}
</script>

<style>
:root {
    --orange-100: #E1700F;
    --orange-200: #E95A0C;
    --grey-100: #F3F3F5;
    --grey-300:#9999A1;
    --black-transparency: #000000d0;
    --black: #000000;
    --white: #ffffff;
}

@font-face {
    font-family: 'earwig';
    src: url(../../fonts/earwig.ttf);
}
@font-face {
    font-family: 'babyeliot';
    src: url(../../fonts/babyliot.otf);
}

body {
    font-family: 'Montserrat', sans-serif;
    font-size: 18px;
    background-color: var(--grey-100);
    overflow-y:scroll;
}

.logo {
    font-family: babyeliot;
    color: var(--orange-100);
}
.logo:hover {
    transition: color 0.5;
    color: white;
}
.title {
    font-family: earwig;
    font-size: 64px;
    color: var(--orange-200);
}

.bold {
    font-weight: bold;
}

.text-center {
    text-align: center;
}

.section-body {
    background-color: white;
}

.sort-filter a{
    color: var(--white);
    text-decoration: none;
}
.sort-filter span{
    font-family: babyeliot;
    color: var(--black);
}

.nav-filter {
    background-color: var(--white);
    padding: 10px 0;
}

.nav-filter a.nav-link{
    color: var(--grey-300);
    font-weight: bold;
}
.nav-filter a.nav-link:hover{
    color: var(--orange-200);
    text-decoration-line: underline;
    text-underline-offset: 25px;
    text-decoration-thickness: 2px;
}

.nav-filter a.nav-link.active{
    color: var(--orange-200);
    text-decoration-line: underline;
    text-underline-offset: 25px;
    text-decoration-thickness: 2px;
}

.footer-top {
    background-color: var(--orange-100);
    padding: 40px 0 0 0;
}

.footer-bottom {
    background-color: var(--black);
}

.logo-circle img{
    position: relative;
    background-color: var(--orange-100);
    border: 4px solid var(--white);
    border-radius: 50%;
    padding: 6px;
    top: 35px;
}

footer .nav-link {
    font-weight: bold;
    text-align: center;
    font-size: 14px;
    transition: opacity .15s ease-in-out;
}

footer .footer-bottom a {
    color: white;
    font-size: 14px;
    transition: opacity .15s ease-in-out;
}

footer .footer-bottom a:hover, .footer-top a:hover {
    opacity: 0.65;
    color: white;
    text-decoration: none;
}

/*Boostrap overide*/
.bg-dark{
    background-color: var(--black-transparency) !important;
}
.nav-link{
    color: var(--white);
}
.btn-orange{
    background-color: var(--orange-100);
    color: var(--white);
}
.hero {
    background-image: url("../../images/hero.jpg");
    height: 480px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
}
.hero .content {
    padding-top: 240px;
}

.form-control {
    border: 0;
}

.section-body img.card-img-top {
    width: 100%;
    height: 225px;
}

.section-body .card {
    border: 0;
}

.card-title{
    position: absolute;
    top: 190px;
    width: 100%;
    background-color: var(--black-transparency);
    color:var(--white);
    text-align: center;
}
.card-title h3{
    font-weight: bold;
    font-size: 14px;
    padding: 10px 0;
    margin: 0;
}

.card .btn {
    width: 60%;
}

.btn {
    font-weight: bold;
}
.loading {
    margin: 30px auto;
    width: 140px;
    text-align: center;
    color: #fff;
    z-index: 9;
    background: var(--orange-100);
    padding: 8px 18px;
    border-radius: 5px;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity .5s
}
.fade-enter, .fade-leave-to {
  opacity: 0
}

.rate {
    float: left;
    height: 46px;
    padding: 0 10px;
    text-align: center;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:42px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}

button.swal2-confirm.swal2-styled{
    background-color:var(--orange-100);
}
</style>
