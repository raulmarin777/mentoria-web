document.addEventListener('DOMContentLoaded', () => {
    const character = document.querySelector('.character')
    const MAXIMUN_HEIGHT = 250
    const GRAVITY = 0.9
    const KEY_UP = 38

    let bottom = 0

    function jump(){
        //Codigo Saltar
        let timerUp = setInterval(() => {
            if (bottom >= MAXIMUN_HEIGHT){
                //detener el salto
                clearInterval(timerUp)
                //bajar al personaje
            }
            bottom += 30
            character.style.bottom = (bottom * GRAVITY) + 'px';
        }, 20)
    }

    document.addEventListener('keydown', (event) => {
        switch (event.keyCode) {
            case KEY_UP:
                jump()
                break; 
        }
    })
    
})