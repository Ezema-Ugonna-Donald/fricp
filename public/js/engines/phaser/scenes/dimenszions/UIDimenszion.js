// import {FrciPPoster} from "./dimenszions/entitiesz/FricPPoster.js"

let UIDimenszion = new Phaser.Scene ("Anin")

let homeSzrc 
let entitie

UIDimenszion.preload = () => {
    // UIDimenszion.load.image ("load-bg", "img/landingPage/pelloDisplayed.png")
    // UIDimenszion.load.image ("load-img", "img/landingPage/fricP-loadingImg.png")

    homeSzrc = UIDimenszion.scene.get ("Obu")

    // entitie = new Phaser.GameObjects.Sprite (homeSzrc, Number (Number (window.innerWidth) / 2) - 150, Number (Number (window.innerHeight) / 2) - 293, "fricP-poster")

    entitie = homeSzrc.add.image (Number (Number (window.innerWidth) / 2) - 150, Number (Number (window.innerHeight) / 2) - 293, "fricP-poster")

    console.log("anom?!")
}

UIDimenszion.create = () => {
    // UIDimenszion.scene.start ("Load")

    UIDimenszion.entitie.on ("pointerdown", () => {
        console.log ("mettu")
        UIDimenszion.events.emit ("ma")
    })
}

UIDimenszion.getEntities = () => {
    return entitie
}