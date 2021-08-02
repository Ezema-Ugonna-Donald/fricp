let FrciPPoster = new Phaser.Class ({
    Extends: Phaser.Physics.Arcade.Sprite,

    initialize: () => {
        let abtPoster,
        ui, 
        abtPosterNa = false

        let homeSzrc = () => {
            Phaser.Scene.call (this, { key: " Obu" })
        }
    },
    preload: () => {
        ui = homeSzrc.scene.get ("Anin")
        // abtPoster = homeSzrc.add.sprite (Number (Number (window.innerWidth) / 2) - 150, Number (Number (window.innerHeight) / 2) - 293, "fricP-poster")
        abtPoster = ui.getEntities ()
        
        abtPoster.setOrigin ( 0 , 0 )
        abtPoster.setScale ( 0.3 , 0.3 )
    },
    create: () => {
    },
    update: () => {
        ui.events.on ("ma", () => {
            abtPosterNa = true

            console.log ("mae")
        })
    }
})

// (scene, x, y, key) => {
    
//     let abtPoster
//     let ui
//     let abtPosterNa = false
//     let abtPosterHovr00
//     let abtPosterHovr01

//     let preload = () => {
//         abtPoster = scene.add.sprite (x, y, key).setInteractive ()
//         // abtPoster = HomeSpace.add.image (0, 0, "fricP-poster")
//         abtPoster.setOrigin ( 0 , 0 )
//         abtPoster.setScale ( 0.3 , 0.3 )
//     }

//     let create = () => {
//         abtPosterHovr00 = scene.add.graphics ()

//         abtPosterHovr01 = scene.add.graphics ()

//         ui = scene.scene.get ("Anin")
//     }

//     let update = () => {
//         ui.events.on ("ma", () => {
//             abtPosterNa = true
//             console.log ("mae")
    
//             // if (HomeSpace.abtPosterNa === true)
    
//             abtPosterHovr00.fillStyle (0X0D00FF, 0.76)
//             abtPosterHovr00.filRect (Number (Number (window.innerWidth) / 2) - 142, Number (abtPoster.displayWidth) + 94, Number (Number (window.innerHeight) / 2) - 340, Number (abtPoster.displayHeight) - 94)
//             abtPosterHovr00.depth = -1
//         })
//     }

// }

// let FricPPoster = new Phaser.GameObjects.Sprite ((Number (Number (window.innerWidth) / 2) - 150, Number (Number (window.innerHeight) / 2) - 293, "fricP-poster")).setInteractive ()


// export default FrciPPoster