
let verseconfig = {
  type: Phaser.AUTO,
  scale: {
    parent: "fric-p-dimension",
    mode: Phaser.Scale.RESIZE,
    // autoCenter: Phaser.Scale.CENTER_BOTH,
    // max: {
      // width: this.width,
      // height: this.height,
    // }
    width: "100%",
    height: "100%",
  },
  scene: [
    BootSpace, 
    LoadingSpace, 
    HomeSpace, 
    // UIDimenszion
    // FrciPPoster,
  ],
  // {
  //   initialize: [
  //     BootSpace, 
  //     LoadingSpace, 
  //     HomeSpace, 
  //     UIDimenszion,
  //     FrciPPoster,
  //   ],
  //   preload: () => {
      
  //   }
  // },
  physics: {
    default: 'arcade',
    arcade: {
      gravity: { y: 0 },
      debug: true
    }
  },
  backgroundColor: "ffa500"
}; 

let verseinario = new Phaser.Game (verseconfig)