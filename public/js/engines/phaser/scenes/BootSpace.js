
// let scene = Phaser.Game.get ("xtumza")
let BootSpace = new Phaser.Scene ("Boot")

BootSpace.preload = () => {
    BootSpace.load.image ("load-bg", "img/landingPage/pelloDisplayed.png")
    BootSpace.load.image ("load-img", "img/landingPage/fricP-loadingImg.png")
}

BootSpace.create = () => {
    BootSpace.scene.start ("Load")
}
// export default BootScene
