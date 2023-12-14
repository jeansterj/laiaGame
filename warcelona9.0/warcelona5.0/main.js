import { Character } from './character.js';
import { Projectile } from './projectile.js';
import { TripleShotProjectile } from './tripleProyectile.js';
import { EnemySpawner } from './enemySpawner.js';
import { ChargeEnemy } from './chargeEnemy.js';
import { Enemy } from './enemy.js';
import { GameManager } from '../../apps/gameManager.js';
import { Orbital } from './orbital.js';

const character = new Character(80, 80);
const projectiles = [];
const enemySpawner = new EnemySpawner(1750);



let keysPressed = {};

const orbital = new Orbital(15,0.015,60);

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

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
  }
  
  function createStartScreen() {
    const startScreen = document.createElement('div');
    startScreen.id = 'start-screen';
    startScreen.style.position = 'absolute';
    startScreen.style.width = '100%';
    startScreen.style.height = '100%';
    startScreen.style.display = 'flex';
    startScreen.style.justifyContent = 'center';
    startScreen.style.alignItems = 'center';

    const startButton = document.createElement('button');
    startButton.classList.add('start-button');
    startButton.textContent = 'Start Game';
    startButton.addEventListener('click', startGame);

    startScreen.appendChild(startButton);
    document.body.appendChild(startScreen);
}

function startGame() {
    const startScreen = document.getElementById('start-screen');
    if (startScreen) {
        document.body.removeChild(startScreen);
    }
    showDialogueScreen(); 
}

function showDialogueScreen() {
    const dialogueScreen = document.createElement('div');
    dialogueScreen.id = 'dialogue-screen';
    dialogueScreen.style.position = 'fixed'; // Usar 'fixed' para cubrir toda la pantalla
    dialogueScreen.style.top = '0';
    dialogueScreen.style.left = '0';
    dialogueScreen.style.width = '100%';
    dialogueScreen.style.height = '100%';
    dialogueScreen.style.backgroundColor = 'rgba(0, 0, 0, 0.5)'; // Fondo negro con transparencia
    dialogueScreen.style.display = 'flex';
    dialogueScreen.style.flexDirection = 'column';
    dialogueScreen.style.justifyContent = 'center';
    dialogueScreen.style.alignItems = 'center';
    dialogueScreen.style.zIndex = '1000'; // Asegúrate de que esté por encima de otros elementos

    // Texto del diálogo
    const dialogueText = document.createElement('p');
    dialogueText.id = 'dialogue-text';
    dialogueText.style.color = 'white'; // Texto blanco para contraste
    dialogueText.style.fontSize = '24px'; // Tamaño del texto
    dialogueText.style.textAlign = 'center';
    dialogueText.style.padding = '20px';

    // Array de diálogos
    const dialogues = ["Bienvenido al juego", "Prepárate para la aventura", "¡Comencemos!"];
    let currentDialogue = 0;
    dialogueText.textContent = dialogues[currentDialogue];

    dialogueScreen.appendChild(dialogueText);

    // Evento de clic para cambiar de diálogo
    dialogueScreen.addEventListener('click', () => {
        currentDialogue++;
        if (currentDialogue < dialogues.length) {
            dialogueText.textContent = dialogues[currentDialogue];
        } else {
            document.body.removeChild(dialogueScreen);
            startTimer();
            requestAnimationFrame(gameLoop);
        }
    });

    document.body.appendChild(dialogueScreen);
}

function showGameOverScreen() {
    const gameOverScreen = document.createElement('div');
    gameOverScreen.id = 'game-over-screen';
    gameOverScreen.style.position = 'fixed';
    gameOverScreen.style.top = '0';
    gameOverScreen.style.left = '0';
    gameOverScreen.style.width = '100%';
    gameOverScreen.style.height = '100%';
    gameOverScreen.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
    gameOverScreen.style.display = 'flex';
    gameOverScreen.style.flexDirection = 'column';
    gameOverScreen.style.justifyContent = 'center';
    gameOverScreen.style.alignItems = 'center';
    gameOverScreen.style.zIndex = '1000';

    const gameOverText = document.createElement('p');
    gameOverText.id = 'game-over-text';
    gameOverText.style.color = 'white';
    gameOverText.style.fontSize = '24px';
    gameOverText.style.textAlign = 'center';
    gameOverText.style.padding = '20px';
    gameOverText.textContent = 'Game Over. Click to restart.';

    gameOverScreen.appendChild(gameOverText);

    gameOverScreen.addEventListener('click', () => {
        document.body.removeChild(gameOverScreen);
        restartGame(); // Función para reiniciar el juego
    });

    document.body.appendChild(gameOverScreen);
}

function restartGame() {
    
    location.reload();
}


function gameLoop() {
    
    if(!character.isChoosing)
    {      
        if (character.health <= 0) {  
                   
            setCookie('WarcelonaGameCompleted', 'true', 7);           
            showGameOverScreen(); 
            return; 
        }

        let  puntuacionInput = document.getElementsByName("puntuacion")[0];        
        puntuacionInput.value = 50;   

        character.handleArrowKeys(keysPressed);    
        handleShooting(keysPressed);    
        enemySpawner.update(character);
        difficulty();

        let toDestroy = { enemies: [], projectiles: [] };

        orbital.update(character, enemySpawner.enemies);

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
            projectiles.push(new TripleShotProjectile(middleX, middleY, 'up'));
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

