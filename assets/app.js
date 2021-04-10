/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';


//Import Components & styles

/**
 * Aside Index Default
 */
import './components/indexDefault/aside/aside.scss';
import './components/indexDefault/aside/aside';
/**
 * Main Index Default
 */
import './components/indexDefault/main/main.scss';
import './components/indexDefault/main/main';

/**
 * Login Form styles
 */
import './components/indexDefault/forms/login.scss';
