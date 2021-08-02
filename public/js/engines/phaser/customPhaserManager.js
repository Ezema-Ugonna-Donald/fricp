import BootScene from "./scene/BootSpace.js"
import LoadingScene from "./scene/loadingScene.js"
// import LoadingScene from "./scene/loadingScene.js"


let xtumza = new Phaser.Game ('xtumza')
// let xtumzascene = new Phaser.Game ('xtumzascene')
// let LoadingScene = new Phaser.Scene.add ("Load")
// let BootScene = new Phaser.Scene.add ("Boot")

xtumza.init = () => {
    
}

xtumza.preload = () => {
    // this.load.image ("load-img", "img/landingPage/fricP-loadingImg.png")
    this.scene.get ("Boot")
    this.scene.get ("Load")
    this.scene.get ("Obu")
    this.scene.get ("Anin")
}

xtumza.create = () => {
    // let loadingImg = this.add. ()
    // this.scene.get ("Boot")
    // this.scene.get ("Load")
    // this.scene.get ("Obu")
    // this.scene.get ("Anin")
    this.scene.start ("Boot")
}

xtumza.update = () => {

}

// let config = {
//     type: Phaser.AUTO,
//     scale: {
//       parent: "fric-p-dimension",
//       mode: Phaser.Scale.RESIZE,
//       width: "100%",
//       height: "100%",
//     },
//     physics: {
//       default: 'arcade',
//       arcade: {
//         // gravity: { y: 0 },
//         debug: true
//       }
//     }
// };

// let deuzsdomceo = new Phaser.Game (config)

export default xtumza
