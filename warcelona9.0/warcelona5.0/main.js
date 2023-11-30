import { Character } from './character.js';
import { Projectile } from './projectile.js';
import { EnemySpawner } from './enemySpawner.js';
import { ChargeEnemy } from './chargeEnemy.js';
import { Enemy } from './enemy.js';

const character = new Character(80, 80);
const projectiles = [];
const enemySpawner = new EnemySpawner(1750);

let keysPressed = {};

window.addEventListener('keydown', (event) => {
    keysPressed[event.code] = true;
});

window.addEventListener('keyup', (event) => {
    keysPressed[event.code] = false;
});

function startTimer() {
    let totalSeconds = 0;
    setInterval(() => {
        totalSeconds++;
        const timerElement = document.getElementById('timer');
        timerElement.textContent = formatTime(totalSeconds);
    }, 1000);
}

function difficulty()
{ 
    if(character.level == 2)
    {
        enemySpawner.chargeEnemyRate = 0.1;
        enemySpawner.spawnRate = 650;
        enemySpawner.normalH = 20;
    }
    else if(character.level == 3)
    {
        enemySpawner.areaDamageEnemyRate = 0.1;
        enemySpawner.spawnRate = 550;       
    }
    else if(character.level == 4)
    {
        enemySpawner.spawnRate = 450; 
    }
    else if(character.level == 5)
    {
        enemySpawner.tankEnemyRate = 0.1;        
        
    }
    else if(character.level == 6)
    {
        
        enemySpawner.chargeEnemyRate = 0.15;       
        enemySpawner.spawnRate = 350; 
        
    }
    else if(character.level == 7)
    {
        enemySpawner.explosionEnemyRate = 0.1;       
        
    }
    else if(character.level == 8)
    {
        enemySpawner.spawnRate = 300;    
        
    }
    else if(character.level == 9)
    {             
         
        enemySpawner.tankEnemyRate = 0.12;
        enemySpawner.explosionEnemyRate = 0.15;  
        enemySpawner.chargeEnemyRate = 0.2;
        enemySpawner.areaDamageEnemyRate = 0.15;
                
    }
    else if(character.level == 10)
    {             
        enemySpawner.spawnRate = 250; 
                
    }  
}

function formatTime(totalSeconds) {
    const minutes = Math.floor(totalSeconds / 60).toString().padStart(2, '0');
    const seconds = (totalSeconds % 60).toString().padStart(2, '0');   
    return `${minutes}:${seconds}`;
}

function createStartScreen() {
    const startScreen = document.createElement('div');
    startScreen.id = 'start-screen';

    const startButton = document.createElement('button');
    startButton.classList.add('start-button');
    startButton.addEventListener('click', startGame);

    startScreen.appendChild(startButton);
    document.body.appendChild(startScreen);
}

function startGame() {
    const startScreen = document.getElementById('start-screen');
    document.body.removeChild(startScreen);   
    startTimer();
    requestAnimationFrame(gameLoop);
}


function gameLoop() {
    if(!character.isChoosing)
    {
        character.handleArrowKeys(keysPressed);    
        handleShooting(keysPressed);    
        enemySpawner.update(character);
        difficulty();

        let toDestroy = { enemies: [], projectiles: [] };

        character.updateHealthDisplay();
    
        enemySpawner.enemies.forEach((enemy) => {      
            if (character.hasCollidedWith(enemy) && !character.invulnerable) {
                character.takeDamage(enemy.damage);                         
            }
            if (character.hasCollidedWith(enemy) && character.contactDamage)
            {               
                enemy.takeDamage(500); 
            }
            if (enemy.health <= 0) {
                toDestroy.enemies.push(enemy);
                if(character.lifeSteal)
                {
                    const life = Math.floor(Math.random() * 100);
                    if(life <= 5)
                    {
                        character.health += 1 
                    }
                }            
            }
        });

        
        projectiles.forEach((projectile) => {
            projectile.move();
            if (projectile.isOutOfScreen()) {
                toDestroy.projectiles.push(projectile);
            }
        });
    
        projectiles.forEach((projectile) => {
            enemySpawner.enemies.forEach((enemy) => {
                if (projectile.hasCollidedWith(enemy)) {
                    enemy.takeDamage(character.attackPower);
                    enemy.applyKnockback(projectile.direction, character.knockBackForce);
                    if(!character.piercingShoot) toDestroy.projectiles.push(projectile);                              
                }
            });
        });
        
        toDestroy.enemies.forEach(enemy => {
            const index = enemySpawner.enemies.indexOf(enemy);
            if (index > -1) {
                enemySpawner.enemies.splice(index, 1);
                enemy.destroy();
                character.gainExperience(10);
            }
        });
        
        toDestroy.projectiles.forEach(projectile => {
            const index = projectiles.indexOf(projectile);
            if (index > -1) {
                projectiles.splice(index, 1);
                projectile.destroy();
            }
        });
    }

    requestAnimationFrame(gameLoop);
}

function handleShooting(keysPressed) {
    if (character.canShoot()) {
        const middleX = character.x + (character.width / 2-10);
        const middleY = character.y + (character.height / 2-10);

        let shotFired = false;

        if (keysPressed['KeyW']) {
            if(character.pairshoot == false)
            {
            projectiles.push(new Projectile(middleX, middleY, 'up'));
            }

            if(character.pairshoot)
            {
                const middleX = character.x + (character.width / 2-15);
                const middleY = character.y + (character.height / 2-20);
                projectiles.push(new Projectile(middleX, middleY, 'up'));
                projectiles.push(new Projectile(middleX+10, middleY, 'up'));

            }

            if(character.doubleshoot)
            {
                projectiles.push(new Projectile(middleX, middleY, 'up-right'));
                projectiles.push(new Projectile(middleX, middleY, 'up-left'));
            }

            if(character.doubleshoot && character.pairshoot)  
            {              
                projectiles.push(new Projectile(middleX+10, middleY, 'up-right'));
                projectiles.push(new Projectile(middleX-10, middleY, 'up-left'));                
            }     
            
            if(character.omnishoot)
            {
                projectiles.push(new Projectile(middleX, middleY, 'up'));
                projectiles.push(new Projectile(middleX, middleY, 'up-right'));
                projectiles.push(new Projectile(middleX, middleY, 'up-left'));
                projectiles.push(new Projectile(middleX, middleY, 'left'));
                projectiles.push(new Projectile(middleX, middleY, 'down-left'));
                projectiles.push(new Projectile(middleX, middleY, 'down'));
                projectiles.push(new Projectile(middleX, middleY, 'down-right'));
                projectiles.push(new Projectile(middleX, middleY, 'right'));
            }
            shotFired = true;
        } 
        if (keysPressed['KeyA']) {
            if(character.pairshoot == false)
            {
            projectiles.push(new Projectile(middleX, middleY, 'left'));
            }
            if(character.pairshoot)
            {
                const middleX = character.x + (character.width / 2-15);
                const middleY = character.y + (character.height / 2-20);
                projectiles.push(new Projectile(middleX, middleY, 'left'));
                projectiles.push(new Projectile(middleX, middleY+10, 'left'));

            }
            if(character.doubleshoot)
            {
                projectiles.push(new Projectile(middleX, middleY, 'up-left'));
                projectiles.push(new Projectile(middleX, middleY, 'down-left'));
            } 

            if(character.doubleshoot && character.pairshoot)  
            {                
                projectiles.push(new Projectile(middleX-10, middleY, 'up-left'));
                projectiles.push(new Projectile(middleX-10, middleY, 'down-left'));                
            }      
            
            if(character.omnishoot)
            {
                projectiles.push(new Projectile(middleX, middleY, 'up'));
                projectiles.push(new Projectile(middleX, middleY, 'up-right'));
                projectiles.push(new Projectile(middleX, middleY, 'up-left'));
                projectiles.push(new Projectile(middleX, middleY, 'left'));
                projectiles.push(new Projectile(middleX, middleY, 'down-left'));
                projectiles.push(new Projectile(middleX, middleY, 'down'));
                projectiles.push(new Projectile(middleX, middleY, 'down-right'));
                projectiles.push(new Projectile(middleX, middleY, 'right'));
            }
            shotFired = true;
        } 
        if (keysPressed['KeyS']) {
            if(character.pairshoot == false)
            {
            projectiles.push(new Projectile(middleX, middleY, 'down'));
            }
            if(character.pairshoot)
            {
                const middleX = character.x + (character.width / 2-15);
                const middleY = character.y + (character.height / 2-20);
                projectiles.push(new Projectile(middleX, middleY, 'down'));
                projectiles.push(new Projectile(middleX+10, middleY, 'down'));

            }

            if(character.doubleshoot)
            {
                projectiles.push(new Projectile(middleX, middleY, 'down-right'));
                projectiles.push(new Projectile(middleX, middleY, 'down-left'));
            } 
            
            if(character.doubleshoot && character.pairshoot)  
            {                
                projectiles.push(new Projectile(middleX+10, middleY, 'down-right'));
                projectiles.push(new Projectile(middleX-10, middleY, 'down-left'));                
            }  
            
            if(character.omnishoot)
            {
                projectiles.push(new Projectile(middleX, middleY, 'up'));
                projectiles.push(new Projectile(middleX, middleY, 'up-right'));
                projectiles.push(new Projectile(middleX, middleY, 'up-left'));
                projectiles.push(new Projectile(middleX, middleY, 'left'));
                projectiles.push(new Projectile(middleX, middleY, 'down-left'));
                projectiles.push(new Projectile(middleX, middleY, 'down'));
                projectiles.push(new Projectile(middleX, middleY, 'down-right'));
                projectiles.push(new Projectile(middleX, middleY, 'right'));
                
            }
            shotFired = true;
        } 
        if (keysPressed['KeyD']) {
            if(character.pairshoot == false)
            {
            projectiles.push(new Projectile(middleX, middleY, 'right'));
            }
            if(character.pairshoot)
            {
                const middleX = character.x + (character.width / 2-15);
                const middleY = character.y + (character.height / 2-20);
                projectiles.push(new Projectile(middleX, middleY, 'right'));
                projectiles.push(new Projectile(middleX, middleY+10, 'right'));

            }
            if(character.doubleshoot)
            {
                projectiles.push(new Projectile(middleX, middleY, 'down-right'));
                projectiles.push(new Projectile(middleX, middleY, 'up-right'));
            }

            if(character.doubleshoot && character.pairshoot)  
            {               
                projectiles.push(new Projectile(middleX+10, middleY, 'down-right'));
                projectiles.push(new Projectile(middleX+10, middleY, 'up-right'));                
            }     
            if(character.omnishoot)
            {
                projectiles.push(new Projectile(middleX, middleY, 'up'));
                projectiles.push(new Projectile(middleX, middleY, 'up-right'));
                projectiles.push(new Projectile(middleX, middleY, 'up-left'));
                projectiles.push(new Projectile(middleX, middleY, 'left'));
                projectiles.push(new Projectile(middleX, middleY, 'down-left'));
                projectiles.push(new Projectile(middleX, middleY, 'down'));
                projectiles.push(new Projectile(middleX, middleY, 'down-right'));
                projectiles.push(new Projectile(middleX, middleY, 'right'));
            }

            shotFired = true;
        }

        if (shotFired) {
            character.lastShot = Date.now();
        }
    }
}

createStartScreen();

