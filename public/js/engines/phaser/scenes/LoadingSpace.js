
let LoadingSpace = new Phaser.Scene ("Load")

// LoadingSpace.init = () => {
    let loadinBg
    let loadin
    let valTxt = ""

// }

LoadingSpace.preload = () => {
  LoadingSpace.load.image ("bg", "img/landingPage/violetFricp.png")
  LoadingSpace.load.image ("obu-bg", "img/landingPage/FricpObu.png")
  LoadingSpace.load.image ("obu-bg", "img/landingPage/FricpObu.png")
  LoadingSpace.load.image ("fricP-poster", "img/landingPage/fricPAboutPoster.png")

  loadinBg = LoadingSpace.add.image (0, 0, "load-bg")
  loadin = LoadingSpace.add.image (750, 250, "load-img")

  loadinBg.setOrigin (0 , 0)
  loadin.setOrigin (0 , 0)

  loadin.setScale (0.3 , 0.3)

  LoadingSpace.load.on ("progress", value => {
    valTxt = String (parseInt (value) * 100)
    // console.log (valTxt)

    LoadingSpace.diminndout = LoadingSpace.time.addEvent ({
      delay: 1350,
      repeat: valTxt === "100" ? 0 : 1, // it will repeat forever
      // repeat: 0, // it will repeat forever
      callback: () => {
        // update stats
        // console.log ("what")
        
        
      },
      callbackScope: LoadingSpace
    });
  })


  // console.log ("loadsp")

}

LoadingSpace.create = () => {
    // loadin.setRot

    // LoadingSpace.diminndout ()

    if (valTxt == "100")
    {
      // console.log ("huh?")
      LoadingSpace.scene.start ("Obu")
      
    }

    
}

// LoadingSpace.update = () => {
//   LoadingSpace.diminndout ()
// }



// export default LoadingScene