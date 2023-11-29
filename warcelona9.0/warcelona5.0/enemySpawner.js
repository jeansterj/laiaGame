import { Enemy } from './enemy.js';
import { ChargeEnemy } from './chargeEnemy.js';
import { AreaDamageEnemy } from './bulky.js'; 

export class EnemySpawner {
  constructor(spawnRate, chargeEnemyRate = 0.1, areaDamageEnemyRate = 0.1) {
    this.enemies = [];
    this.spawnRate = spawnRate;
    this.lastSpawn = Date.now();
    this.chargeEnemyRate = chargeEnemyRate;
    this.areaDamageEnemyRate = areaDamageEnemyRate;
  }

  update(character) {
    const now = Date.now();
  
    if (now - this.lastSpawn > this.spawnRate) {      
      const side = Math.floor(Math.random() * 4);
      let x, y;
  
      switch (side) {
        case 0: 
          x = -30;
          y = Math.random() * window.innerHeight;
          break;
        case 1: 
          x = Math.random() * window.innerWidth;
          y = -30;
          break;
        case 2: 
          x = window.innerWidth + 30;
          y = Math.random() * window.innerHeight;
          break;
        case 3: 
          x = Math.random() * window.innerWidth;
          y = window.innerHeight + 30;
          break;
      }  
      let enemy;
      const rand = Math.random();
  
      if (rand < this.chargeEnemyRate) {
        enemy = new ChargeEnemy(x, y);
      } else if (rand < this.chargeEnemyRate + this.areaDamageEnemyRate) {
        enemy = new AreaDamageEnemy(x, y);
      } else {
        enemy = new Enemy(x, y);
      }  
      this.enemies.push(enemy);
      this.lastSpawn = now;
    }
  
    this.enemies.forEach(enemy => {
      enemy.update(character);
    });
  }}