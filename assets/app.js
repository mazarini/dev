/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './scss/app.scss';

// Add jQuery
const $ = require('jquery');

// create global $ to use jQuery
global.$ = global.jQuery = $;

// Add javascript from popper
// require('popper.js')

// Add javascript from bootstrap
require('bootstrap');

// start the Stimulus application
//import './bootstrap';
