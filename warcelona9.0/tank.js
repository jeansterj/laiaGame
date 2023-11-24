import { Enemy } from './enemy.js';

export class TankEnemy extends Enemy {
    constructor(x = 80, y = 80, health = 200) {
      super(x, y, health);
      this.speed = 0.2;     
      this.element.classList.add('tank'); 
    }}