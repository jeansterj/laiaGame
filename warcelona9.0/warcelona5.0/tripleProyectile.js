import { Projectile } from './projectile.js';

export class TripleShotProjectile extends Projectile {
    constructor(x, y, direction) {
        super(x, y, direction);
        this.tripleShot = true;
    }

    move() {
        super.move(); // Mueve el proyectil principal

        // Solo calcula y mueve los proyectiles adicionales si es triple disparo
        if (this.tripleShot) {
            this.moveAdditionalProjectiles();
        }
    }

    moveAdditionalProjectiles() {
        // Ángulo en radianes para 20 grados
        const angle = 20 * (Math.PI / 180);

        // Calcular la dirección para los proyectiles adicionales
        const directions = this.calculateAdditionalDirections(angle);

        // Mover proyectiles adicionales
        directions.forEach(dir => {
            this.x += dir.x * this.speed;
            this.y += dir.y * this.speed;
            this.updatePosition();
        });
    }

    calculateAdditionalDirections(angle) {
        const directions = [];
        // Direcciones adicionales basadas en el ángulo
        for (let i = -1; i <= 1; i += 2) {
            const newAngle = angle * i;
            const dx = Math.cos(newAngle);
            const dy = Math.sin(newAngle);
            directions.push({ x: dx, y: dy });
        }
        return directions;
    }
}
