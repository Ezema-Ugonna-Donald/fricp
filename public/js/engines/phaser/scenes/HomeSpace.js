// import { FrciPPoster } from "./dimenszions/entitiesz/FricPPoster.js"

let HomeSpace = new Phaser.Class ({

    Extends: Phaser.Scene,

    initialize: function HomeSpace () 
    {
        Phaser.Scene.call (this, { key: " Obu" })
    },

    preload: () => 
    {
    // HomeSpace.load.image ("load-bg", "img/landingPage/pelloDisplayed.png")
    // HomeSpace.load.image ("load-img", "img/landingPage/fricP-loadingImg.png")

    
    // abtPoster = new FrciPPoster ().abtPoster
    
    // realSpace.abt = realSpace.world.entitie
    
    //
    
    // abtPoster = scene.add.sprite (, , ).setInteractive ()
    //     // abtPoster = HomeSpace.add.image (0, 0, "fricP-poster")
    //     abtPoster.setOrigin ( 0 , 0 )
    //     abtPoster.setScale ( 0.3 , 0.3 )
    
    
    console.log ("loadinBg")
    
    // abtPoster = realSpace.scene.getEntities ()
    },

    create: () => 
    {
        // HomeSpace.scene.start ("Load")
        
        let homeBg = this.add.image (0, 0, "obu-bg")
        
        homeBg.setOrigin ( 0 , 0 )
        homeBg.setScale ( 0.94 , 0.87 )
        
    },

    update: () => 
    {
        // 
    }
})