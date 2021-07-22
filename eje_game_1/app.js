document.addEventListener('DOMContentLoaded', () => {
    const character = document.querySelector('.character')
    const MAXIMUN_HEIGHT = 500
    const GRAVITY = 0.9
    const KEY_UP = 38
    const KEY_LEFT = 37
    const KEY_RIGHT = 39
    const KEY_DOWN = 40

    let timerDown
    let timerUp
    let timerLeft
    let timerRight


    let isGoingLeft = false
    let isGoingRight = false
    let isJumping = false

    let bottom = 0
    let left = 0

    function jump(){
        //Codigo Saltar
        character.classList.add('character')
        character.classList.remove('character-sliding')

        if (isJumping) return
        isJumping=true
        timerUp = setInterval(() => {
            if (bottom >= MAXIMUN_HEIGHT){
                //detener el salto
                clearInterval(timerUp)
                //bajar al personaje
                timerDown = setInterval(() =>{
                    if (bottom <= 0){
                        clearInterval(timerDown)
                        isJumping = false
                    }
                    bottom -= 5
                    character.style.bottom = bottom + 'px'
                }, 20)
            }
            bottom += 30
            character.style.bottom = (bottom * GRAVITY) + 'px';
        }, 20)
    }

    function sliceLeft() {
        character.classList.add('character-sliding')
        character.classList.remove('character')

        if (isGoingRight){
            clearInterval(timerRight)
            isGoingRight = false
        }
        if (isGoingLeft) return
        isGoingLeft = true

        timerLeft = setInterval(() => {
            left -= 5
            character.style.left = left + 'px'
        }, 20)
    }

    function sliceRight() {
        character.classList.add('character-sliding')
        character.classList.remove('character')

        if (isGoingLeft){
            clearInterval(timerLeft)
            isGoingLeft = false
        }
        if (isGoingRight) return
        isGoingRight = true

        timerRight = setInterval(() => {
            left += 5
            character.style.left = left + 'px'
        }, 20)
    }

    function stand() {
        character.classList.add('character')
        character.classList.remove('character-sliding')
        clearInterval(timerLeft)
        clearInterval(timerRight)
        clearInterval(timerDown)
        clearInterval(timerUp)

        isGoingLeft = false
        isGoingRight = false
        isJumping = false
    }    

    document.addEventListener('keydown', (event) => {
        switch (event.keyCode) {
            case KEY_UP:
                jump()
                break; 
            case KEY_LEFT:
                sliceLeft()
                break; 
            case KEY_RIGHT:
                sliceRight()
                break; 
            case KEY_DOWN:
                stand()
                break; 
        }
    })
})