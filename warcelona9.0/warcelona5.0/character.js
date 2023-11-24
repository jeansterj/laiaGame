
export class Character {
    constructor(x, y) {
        this.x = x;
        this.y = y;
        this.health = 5; 
        this.speed = 3.5;
        this.width = 70; 
        this.height = 70; 
        this.attackPower = 10;
        this.lastShot = 0;
        this.projectileSize = 20;
        this.shotCooldown = 250; 
        this.knockBackForce = 5;
        this.invulnerableUntil = 0; 
        this.invulnerableDuration = 1000; 
        this.experience = 0;
        this.level = 1;
        this.expNextLevel = 100; 
        this.element = document.createElement('div');
        this.element.classList.add('character');
        document.getElementById('gameContainer').appendChild(this.element);       
        this.updatePosition();
        this.updateHealthDisplay();
        this.createExpBar();
        this.updateExpBar();
        this.upgrades = 3;
        this.doubleshoot =  false;
        this.piercingShoot =  false;
        this.contactDamage = false;
        this.pairshoot = false;
        this.omnishoot = false;
        this.isChoosing = false;
        this.lifeSteal = false;
    }
    
    takeDamage(damage) {
        if (Date.now() > this.invulnerableUntil) {
            this.health -= damage;
            this.invulnerableUntil = Date.now() + this.invulnerableDuration;         
            this.blinkCharacter();         
            
            if (this.health <= 0) {
                location.reload();
            }
        }
    }
    
    blinkCharacter() {
        const blinkTimes = 5; 
        const blinkDuration = 200; 
        
        for (let i = 0; i < blinkTimes; i++) {
            setTimeout(() => this.element.style.visibility = 'hidden', i * 2 * blinkDuration);
            setTimeout(() => this.element.style.visibility = 'visible', (i * 2 + 1) * blinkDuration);
        }
    }
    
    hasCollidedWith(enemy) {
        const characterRect = {
            left: this.x+12,
            right: this.x + this.width-12,
            top: this.y+12,
            bottom: this.y + this.height-12
        };
    
        const enemyRect = {
            left: enemy.x,
            right: enemy.x + enemy.width,
            top: enemy.y,
            bottom: enemy.y + enemy.height
        };
    
        return !(characterRect.left > enemyRect.right ||
                 characterRect.right < enemyRect.left ||
                 characterRect.top > enemyRect.bottom ||
                 characterRect.bottom < enemyRect.top);
    }
  
    handleArrowKeys(keysPressed) {

        const gameContainer = document.getElementById('gameContainer');
        const rect = gameContainer.getBoundingClientRect();        
        const screenWidth = rect.width;
        const screenHeight = rect.height;
        
        if (keysPressed.ArrowUp && this.y > 0) this.y -= this.speed;
        if (keysPressed.ArrowDown && this.y < screenHeight-70) this.y += this.speed;
        if (keysPressed.ArrowLeft && this.x > 0) this.x -= this.speed;
        if (keysPressed.ArrowRight && this.x < screenWidth-70) this.x += this.speed;        
     
        this.updatePosition();
    }

    updatePosition() {
        this.element.style.left = `${this.x}px`;
        this.element.style.top = `${this.y}px`;
    }
   
    canShoot() {
        const now = Date.now();
        if (now - this.lastShot > this.shotCooldown) {
            this.lastShot = now;
            return true;
        }
        return false;
    }

    updateHealthDisplay() {
        const healthContainer = document.getElementById('healthContainer');
        healthContainer.innerHTML = ''; 
        for (let i = 0; i < this.health; i++) {
            const healthCircle = document.createElement('div');
            healthCircle.classList.add('healthCircle');
            healthContainer.appendChild(healthCircle);
        }
    }

    gainExperience(amount) {
        this.experience += amount;
        if (this.experience >= this.expNextLevel) {
            this.levelUp();
            
        }
        this.updateExpBar();
    }

    levelUp() {
        this.level++;
        this.experience -= this.expNextLevel;
        this.expNextLevel = Math.floor(this.expNextLevel * 1.5);
        this.levelText.textContent = `Nivel: ${this.level}`; 
        this.showUpgradeOptions();
    }

    showUpgradeOptions() {
        const upgradeOptions = [
            { name: 'Ataque+', effect: () => this.attackPower += 1 },
            { name: 'Ataque++', effect: () => this.attackPower += 2.5 },
            { name: 'Ataque+++', effect: () => this.attackPower *= 1.75},
            { name: 'Salud+', effect: () => this.health += 1 },
            { name: 'Salud+++', effect: () => this.health += 5 },
            { name: 'Velocidad+', effect: () => this.speed += 0.75 },
            { name: 'Velocidad++', effect: () => this.speed += 2 },
            { name: 'Velocidad-- Ataque++', effect: () => {this.speed *= 0.3; this.attackPower += 5}},           
            { name: 'Velocidad de ataque+', effect: () => this.shotCooldown *= 0.9 },
            { name: 'Velocidad de ataque++', effect: () => this.shotCooldown *= 0.8 }, 
            { name: 'Velocidad de ataque+++  Ataque ---', effect: () => {this.shotCooldown *= 0.3; this.attackPower *=0.2}}, 
            { name: 'Triple Disparo', effect: () => this.doubleshoot = true },
            { name: 'Proyectil mas grande  Ataque+++', effect: () => {this.shotCooldown /= 0.6; this.attackPower += 10;this.projectileSize += 40,this.changeProjectileSize(this.projectileSize,this.projectileSize)}}, 
            { name: 'Proyectil mas grande', effect: () =>{this.projectileSize += 10, this.changeProjectileSize(this.projectileSize,this.projectileSize)}}, 
            { name: 'Hazte mas pequeño', effect: () =>{this.width -= 20, this.height -= 20, this.changeCaracterSize(this.width,this.height)}}, 
            { name: 'Disparo perforante', effect: () => this.piercingShoot = true },       
            { name: 'Salud++', effect: () => this.health += 2 },  
            { name: 'Velocidad+++ Velocidad de ataque++', effect: () => {this.speed *= 2; this.shotCooldown * 0.8}}, 
            { name: 'Salud+ Ataque+', effect: () => {this.health += 1; this.attackPower += 0.5}},  
            { name: 'Salud--- Ataque+++', effect: () => {this.health = 1; this.attackPower *= 3}},   
            { name: 'Salud--- Velocidad de ataque +++', effect: () => {this.health = 1; this.shotCooldown *= 0.3}}, 
            { name: 'Doble disparo', effect: () => this.pairshoot = true},     
            { name: 'Hazte mas grande', effect: () =>{this.width += 10, this.height +=10, this.changeCaracterSize(this.width,this.width)}},
            { name: 'Hazte mas grande Ataque+', effect: () =>{this.width += 5, this.height +=5, this.changeCaracterSize(this.width,this.width),this.attackPower += 1}},    
            { name: 'Daño de contacto', effect: () => this.contactDamage = true},
            { name: 'Aumenta el tiempo de invulnerabilidad', effect: () => this.invulnerableDuration = 2000},
            { name: 'Aumenta el tiempo de invulnerabilidad ++', effect: () => this.invulnerableDuration = 3500}, 
            { name: 'Aumenta el tiempo de invulnerabilidad +++', effect: () => this.invulnerableDuration = 5000},    
            { name: 'Dispara en todas las direcciones Velocidad de Ataque ---', effect: () => {this.omnishoot = true, this.shotCooldown *= 4}},
            { name: 'Todo - opciones++', effect: () => {this.shotCooldown/= 0.8, this.attackPower *= 0.8, this.speed *= 0.8, this.upgrades += 2}},
            { name: 'Todo ++ opciones--', effect: () => {this.shotCooldown*= 0.6, this.attackPower *= 1.5, this.speed *= 1.3, this.upgrades -= 2}},
            { name: 'Todo +', effect: () => {this.shotCooldown*= 0.7, this.attackPower *= 1.2, this.speed *= 1.1}},
            { name: 'Retroceso ++', effect: () => this.knockBackForce += 10},
            { name: 'Retroceso+ Ataque+', effect: () => {this.knockBackForce += 5, this.attackPower += 0.7}},
            { name: 'Retroceso+ Velocidad de ataque++', effect: () => {this.knockBackForce += 5, this.shotCooldown *= 0.8}},
            { name: 'Ataque ++ Velocidad de ataque-', effect: () => {this.attackPower *= 1.25, this.shotCooldown /= 0.9}},
            { name: 'Hazte mas grande Retroceso+++', effect: () =>{this.width += 10, this.height +=10, this.changeCaracterSize(this.width,this.width),this.knockBackForce += 15}},
            { name: 'Hazte mas pequeño Velocidad++', effect: () =>{this.width -= 20, this.height -= 20, this.changeCaracterSize(this.width,this.height), this.speed *= 1.5}},
            { name: 'Robo de vida', effect: () => this.lifeSteal = true},
            { name: 'Robo de vida Velocidad de ataque+++', effect: () =>{ this.shotCooldown *= 0.5,this.lifeSteal = true}},
            { name: 'Salud--- Opciones+++', effect: () => {this.health = 1; this.upgrades += 5}},                                 
                                  
        ];

        const selectedUpgrades = this.selectRandomUpgrades(upgradeOptions, this.upgrades);    
        const upgradeMenu = document.createElement('div');
        upgradeMenu.id = 'upgrade-menu';
        document.body.appendChild(upgradeMenu);
    
        selectedUpgrades.forEach(option => {
            const button = document.createElement('button');
            button.innerText = option.name;
            button.onclick = () => {
                option.effect();
                document.body.removeChild(upgradeMenu);
                this.isChoosing = false;
            };
            upgradeMenu.appendChild(button);
        });
    
        this.isChoosing = true;
    }

    selectRandomUpgrades(upgrades, count) {
        const shuffled = [...upgrades].sort(() => 0.5 - Math.random());
        return shuffled.slice(0, count);
        } 
  
  
    changeProjectileSize(newWidth, newHeight) 
    {
      
        const style = document.createElement('style');
        style.type = 'text/css';
        
      
        style.innerHTML = `.projectile { width: ${newWidth}px; height: ${newHeight}px; }`;
        
      
        document.head.appendChild(style);
    }

    

    changeCaracterSize(newWidth, newHeight) 
    {
        
        const style = document.createElement('style')
        style.type = 'text/css';        
       
        style.innerHTML = `.character { width: ${newWidth}px; height: ${newHeight}px; }`;
       
        document.head.appendChild(style);
    }

    createExpBar() {
        const expContainer = document.createElement('div');
        expContainer.id = 'expContainer';       
        this.levelText = document.createElement('div');
        this.levelText.id = 'levelText';
        this.levelText.style.position = 'absolute';
        this.levelText.style.top = '-25px';
        this.levelText.style.width = '100%';
        this.levelText.style.textAlign = 'center';
        this.levelText.textContent = `Nivel: ${this.level}`;
        const expBar = document.createElement('div');
        expBar.id = 'expBar';        

        expContainer.appendChild(expBar);
        document.body.appendChild(expContainer);
        expContainer.appendChild(this.levelText); 
        document.body.appendChild(expContainer);  
    }

    updateExpBar() {
        const expBar = document.getElementById('expBar');
        const expPercentage = (this.experience / this.expNextLevel) * 100;
        expBar.style.width = `${expPercentage}%`;
    }


}
