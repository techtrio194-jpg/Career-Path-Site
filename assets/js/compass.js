(function () {
    const canvas = document.getElementById('career-compass');
    const fallback = document.getElementById('compass-fallback');
    if (!canvas) return;

    function showFallback() {
        canvas.style.display = 'none';
        if (fallback) fallback.classList.add('is-visible');
    }

    const hasWebGL = (function () {
        try {
            const test = document.createElement('canvas');
            return !!(window.WebGLRenderingContext && (test.getContext('webgl') || test.getContext('experimental-webgl')));
        } catch (e) {
            return false;
        }
    })();

    if (!hasWebGL || typeof THREE === 'undefined') {
        showFallback();
        return;
    }

    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const stage = canvas.parentElement;
    let renderer;
    try {
        renderer = new THREE.WebGLRenderer({ canvas: canvas, antialias: true, alpha: true });
    } catch (e) {
        showFallback();
        return;
    }
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    renderer.setClearColor(0x000000, 0);

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(42, 1, 0.1, 40);
    camera.position.set(0, 0.35, 6.2);

    const group = new THREE.Group();
    scene.add(group);

    scene.add(new THREE.AmbientLight(0xffffff, 0.55));
    const key = new THREE.DirectionalLight(0x4f7cff, 1.15);
    key.position.set(3, 4, 5);
    scene.add(key);
    const rim = new THREE.PointLight(0x7c5cfc, 18, 18);
    rim.position.set(-3, -1, 2);
    scene.add(rim);
    const warm = new THREE.PointLight(0xffffff, 8, 12);
    warm.position.set(0, 2.4, 3);
    scene.add(warm);

    const coreGeo = new THREE.SphereGeometry(0.72, 32, 32);
    const coreMat = new THREE.MeshPhysicalMaterial({
        color: 0x10182c,
        metalness: 0.55,
        roughness: 0.22,
        clearcoat: 0.7,
        clearcoatRoughness: 0.2,
        emissive: 0x142044,
        emissiveIntensity: 0.35
    });
    const core = new THREE.Mesh(coreGeo, coreMat);
    group.add(core);

    const glowGeo = new THREE.SphereGeometry(0.92, 24, 24);
    const glowMat = new THREE.MeshBasicMaterial({
        color: 0x4f7cff,
        transparent: true,
        opacity: 0.12
    });
    group.add(new THREE.Mesh(glowGeo, glowMat));

    const ringGeo = new THREE.TorusGeometry(1.18, 0.045, 16, 80);
    const ringMat = new THREE.MeshStandardMaterial({
        color: 0x4f7cff,
        metalness: 0.7,
        roughness: 0.25,
        emissive: 0x4f7cff,
        emissiveIntensity: 0.35
    });
    const ring = new THREE.Mesh(ringGeo, ringMat);
    ring.rotation.x = Math.PI / 2.15;
    group.add(ring);

    const outerGeo = new THREE.TorusGeometry(1.85, 0.018, 12, 100);
    const outerMat = new THREE.MeshStandardMaterial({
        color: 0x7c5cfc,
        metalness: 0.4,
        roughness: 0.3,
        emissive: 0x7c5cfc,
        emissiveIntensity: 0.25,
        transparent: true,
        opacity: 0.85
    });
    const outer = new THREE.Mesh(outerGeo, outerMat);
    outer.rotation.x = Math.PI / 2.4;
    group.add(outer);

    const ticks = new THREE.Group();
    const tickGeo = new THREE.BoxGeometry(0.035, 0.16, 0.02);
    const tickMat = new THREE.MeshStandardMaterial({ color: 0xd7e2ff, metalness: 0.4, roughness: 0.3 });
    for (let i = 0; i < 12; i++) {
        const tick = new THREE.Mesh(tickGeo, tickMat);
        const angle = (i / 12) * Math.PI * 2;
        tick.position.set(Math.cos(angle) * 1.18, 0.02, Math.sin(angle) * 1.18);
        tick.lookAt(0, 0, 0);
        ticks.add(tick);
    }
    group.add(ticks);

    const needle = new THREE.Group();
    const north = new THREE.Mesh(
        new THREE.ConeGeometry(0.08, 0.72, 10),
        new THREE.MeshStandardMaterial({ color: 0x4f7cff, emissive: 0x4f7cff, emissiveIntensity: 0.4, metalness: 0.5, roughness: 0.25 })
    );
    north.position.y = 0.36;
    const south = new THREE.Mesh(
        new THREE.ConeGeometry(0.07, 0.58, 10),
        new THREE.MeshStandardMaterial({ color: 0x9aa6b8, metalness: 0.5, roughness: 0.3 })
    );
    south.position.y = -0.29;
    south.rotation.x = Math.PI;
    needle.add(north, south);
    group.add(needle);

    const nodeGroup = new THREE.Group();
    const nodeColors = [0x4f7cff, 0x7c5cfc, 0x5ad0ff, 0x8b7cff, 0x3d8bff, 0xa78bfa];
    const nodeGeo = new THREE.SphereGeometry(0.09, 16, 16);
    for (let i = 0; i < 6; i++) {
        const node = new THREE.Mesh(
            nodeGeo,
            new THREE.MeshStandardMaterial({
                color: nodeColors[i],
                emissive: nodeColors[i],
                emissiveIntensity: 0.45,
                metalness: 0.3,
                roughness: 0.35
            })
        );
        node.userData.offset = (i / 6) * Math.PI * 2;
        nodeGroup.add(node);
    }
    group.add(nodeGroup);

    const dest = new THREE.Mesh(
        new THREE.OctahedronGeometry(0.16, 0),
        new THREE.MeshStandardMaterial({
            color: 0xffffff,
            emissive: 0x7c5cfc,
            emissiveIntensity: 0.7,
            metalness: 0.6,
            roughness: 0.2
        })
    );
    dest.position.set(2.15, 0.85, 0.2);
    group.add(dest);

    const destRing = new THREE.Mesh(
        new THREE.TorusGeometry(0.28, 0.018, 10, 40),
        new THREE.MeshBasicMaterial({ color: 0x7c5cfc, transparent: true, opacity: 0.7 })
    );
    destRing.position.copy(dest.position);
    destRing.rotation.x = Math.PI / 2;
    group.add(destRing);

    const curve = new THREE.CatmullRomCurve3([
        new THREE.Vector3(-2.2, -0.6, 0.4),
        new THREE.Vector3(-0.8, 0.1, 1.1),
        new THREE.Vector3(0.4, 0.35, 0.2),
        new THREE.Vector3(1.4, 0.55, -0.4),
        new THREE.Vector3(2.15, 0.85, 0.2)
    ]);
    const pathGeo = new THREE.TubeGeometry(curve, 64, 0.018, 8, false);
    const pathMat = new THREE.MeshBasicMaterial({ color: 0x4f7cff, transparent: true, opacity: 0.55 });
    group.add(new THREE.Mesh(pathGeo, pathMat));

    const particleCount = 90;
    const positions = new Float32Array(particleCount * 3);
    for (let i = 0; i < particleCount; i++) {
        positions[i * 3] = (Math.random() - 0.5) * 7;
        positions[i * 3 + 1] = (Math.random() - 0.5) * 4.5;
        positions[i * 3 + 2] = (Math.random() - 0.5) * 4;
    }
    const pGeo = new THREE.BufferGeometry();
    pGeo.setAttribute('position', new THREE.BufferAttribute(positions, 3));
    const particles = new THREE.Points(
        pGeo,
        new THREE.PointsMaterial({ color: 0x9bb6ff, size: 0.03, transparent: true, opacity: 0.7 })
    );
    scene.add(particles);

    let pointerX = 0;
    let pointerY = 0;
    let targetX = 0;
    let targetY = 0;
    let running = true;

    function resize() {
        const rect = stage.getBoundingClientRect();
        const width = Math.max(rect.width, 1);
        const height = Math.max(rect.height || canvas.clientHeight || 520, 1);
        renderer.setSize(width, height, false);
        camera.aspect = width / height;
        camera.updateProjectionMatrix();
    }

    resize();
    window.addEventListener('resize', resize);

    stage.addEventListener('pointermove', function (event) {
        const rect = stage.getBoundingClientRect();
        pointerX = ((event.clientX - rect.left) / rect.width) * 2 - 1;
        pointerY = ((event.clientY - rect.top) / rect.height) * 2 - 1;
    });

    document.addEventListener('visibilitychange', function () {
        running = document.visibilityState === 'visible';
    });

    const clock = new THREE.Clock();

    function animate() {
        requestAnimationFrame(animate);
        if (!running) return;

        const t = clock.getElapsedTime();
        const speed = reduceMotion ? 0 : 1;

        targetX += (pointerX * 0.35 - targetX) * 0.05;
        targetY += (pointerY * 0.2 - targetY) * 0.05;
        camera.position.x = targetX * 0.8;
        camera.position.y = 0.35 + targetY * 0.35;
        camera.lookAt(0, 0.1, 0);

        group.rotation.y = t * 0.12 * speed;
        ring.rotation.z = t * 0.18 * speed;
        outer.rotation.z = -t * 0.1 * speed;
        needle.rotation.z = Math.sin(t * 0.9) * 0.18 * (speed || 0.15);
        dest.rotation.y = t * 0.8 * (speed || 0.2);
        destRing.rotation.z = t * 0.6 * (speed || 0.2);

        nodeGroup.children.forEach(function (node, i) {
            const a = node.userData.offset + t * 0.35 * (speed || 0.15);
            const radius = 1.85;
            node.position.set(Math.cos(a) * radius, Math.sin(a * 1.4) * 0.18, Math.sin(a) * radius);
            node.scale.setScalar(1 + Math.sin(t * 2 + i) * 0.12);
        });

        particles.rotation.y = t * 0.03 * (speed || 0.1);
        renderer.render(scene, camera);
    }

    animate();
})();
