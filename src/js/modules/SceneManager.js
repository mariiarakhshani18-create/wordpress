import * as THREE from 'three';

export class SceneManager {
    constructor(canvas) {
        this.canvas = canvas;
        this.scene = new THREE.Scene();
        this.camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        this.renderer = new THREE.WebGLRenderer({ canvas: this.canvas, alpha: true, antialias: true });
        this.clock = new THREE.Clock();

        this.init();
    }

    init() {
        this.renderer.setSize(window.innerWidth, window.innerHeight);
        this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

        this.camera.position.z = 6;

        // Add lights
        const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
        this.scene.add(ambientLight);

        this.pointLight = new THREE.PointLight(0xffffff, 1);
        this.pointLight.position.set(5, 5, 5);
        this.scene.add(this.pointLight);

        // Add objects
        this.createObjects();

        // Events
        window.addEventListener('resize', this.onResize.bind(this));
        window.addEventListener('scroll', this.onScroll.bind(this));

        this.animate();
    }

    createObjects() {
        // High detail sphere for morphing
        const geometry = new THREE.IcosahedronGeometry(2, 20);
        geometry.userData = { originalPositions: geometry.attributes.position.clone() };

        const material = new THREE.MeshStandardMaterial({
            color: 0x64748b, // Slate-500 (Muted Blue-Grey)
            wireframe: true,
            transparent: true,
            opacity: 0.3,
            roughness: 0.4,
            metalness: 0.6
        });

        this.sphere = new THREE.Mesh(geometry, material);
        this.scene.add(this.sphere);

        // Particles
        const particlesGeometry = new THREE.BufferGeometry();
        const particlesCount = 1500;
        const posArray = new Float32Array(particlesCount * 3);

        for (let i = 0; i < particlesCount * 3; i++) {
            posArray[i] = (Math.random() - 0.5) * 25;
        }

        particlesGeometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));
        const particlesMaterial = new THREE.PointsMaterial({
            size: 0.03,
            color: 0x94a3b8, // Slate-400
            transparent: true,
            opacity: 0.4,
            blending: THREE.AdditiveBlending
        });

        this.particles = new THREE.Points(particlesGeometry, particlesMaterial);
        this.scene.add(this.particles);
    }

    onResize() {
        this.camera.aspect = window.innerWidth / window.innerHeight;
        this.camera.updateProjectionMatrix();
        this.renderer.setSize(window.innerWidth, window.innerHeight);
    }

    onScroll() {
        const scrollY = window.scrollY;
        const height = document.documentElement.scrollHeight - window.innerHeight;
        const scrollPercent = scrollY / height;

        if (this.sphere) {
            // Movement: Traverse screen
            this.sphere.position.x = Math.sin(scrollPercent * Math.PI * 2) * 2.5;
            this.sphere.position.y = Math.cos(scrollPercent * Math.PI * 2) * 0.5;
            this.sphere.position.z = Math.sin(scrollPercent * Math.PI) * 1.5;

            // Rotation
            this.sphere.rotation.x = scrollY * 0.0005;
            this.sphere.rotation.y = scrollY * 0.001;
        }

        if (this.particles) {
            this.particles.rotation.y = -scrollY * 0.0001;
            this.particles.position.y = scrollY * 0.0005;
        }
    }

    animate() {
        requestAnimationFrame(this.animate.bind(this));

        const time = this.clock.getElapsedTime();

        // Vertex Morphing
        if (this.sphere) {
            const positionAttribute = this.sphere.geometry.attributes.position;
            const originalPositions = this.sphere.geometry.userData.originalPositions;

            for (let i = 0; i < positionAttribute.count; i++) {
                const x = originalPositions.getX(i);
                const y = originalPositions.getY(i);
                const z = originalPositions.getZ(i);

                // Complex noise pattern
                const noise = Math.sin(x * 1.5 + time * 0.5) *
                    Math.cos(y * 1.5 + time * 0.5) *
                    Math.sin(z * 1.5 + time * 0.5);

                const morphFactor = 1 + noise * 0.15;

                positionAttribute.setXYZ(i, x * morphFactor, y * morphFactor, z * morphFactor);
            }

            positionAttribute.needsUpdate = true;
            this.sphere.rotation.y += 0.001;
        }

        if (this.particles) {
            this.particles.rotation.y -= 0.0002;
            this.particles.material.opacity = 0.3 + Math.sin(time * 0.5) * 0.1;
        }

        this.renderer.render(this.scene, this.camera);
    }
}
