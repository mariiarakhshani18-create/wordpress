import '../styles/main.scss';
import { SceneManager } from './modules/SceneManager.js';
import { UIManager } from './modules/UIManager.js';

document.addEventListener('DOMContentLoaded', () => {
    console.log('Automation Studio Frontend Initialized');

    new UIManager();

    const canvas = document.getElementById('webgl-canvas');
    if (canvas) {
        new SceneManager(canvas);
    }
});
