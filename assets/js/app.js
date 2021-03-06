/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.scss');
require('@fortawesome/fontawesome-free/css/all.min.css');
require('summernote/dist/summernote-bs4');
require('summernote/dist/summernote-bs4.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
var $ = require('jquery');
import 'bootstrap';
import 'slick-carousel';
import "./onScroll";
import './slider';
import "./previewUpload";
import "./modal";
import "./backToTop";
import "./contact";
import "./add-like";
import "./showMore";
import "./summernote";
