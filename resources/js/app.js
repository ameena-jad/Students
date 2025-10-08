// Import jQuery
import $ from 'jquery';
window.$ = window.jQuery = $;

// Import separate JavaScript modules
import { initFormValidation } from './validation.js';
import { initTableSearch } from './table.js';

// Initialize when DOM is ready
$(document).ready(function() {
    initFormValidation();
    initTableSearch();
});
