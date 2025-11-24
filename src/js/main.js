// import '../styles/main.scss'; // Handled separately via Sass
import { SceneManager } from './modules/SceneManager.js';
import { UIManager } from './modules/UIManager.js';

document.addEventListener('DOMContentLoaded', () => {
    console.log('Automation Studio Frontend Initialized');

    new UIManager();

    const canvas = document.getElementById('webgl-canvas');
    if (canvas) {
        new SceneManager(canvas);
    }

    // Preloader Logic
    window.addEventListener('load', () => {
        const preloader = document.getElementById('preloader');
        if (preloader) {
            setTimeout(() => {
                preloader.classList.add('hidden');
            }, 800); // Slight delay for smooth transition
        }
    });
});
