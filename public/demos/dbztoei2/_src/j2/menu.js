var menuState = {

    preload:function(){
        //game.load.audio('clicf', [game.pathSnd+'Sound_clicforwards.mp3', game.pathSnd+'Sound_clicforwards.ogg', game.pathSnd+'Sound_clicforwards.m4a']);
    },

    create: function(){

        this.music = game.add.audio('musicmenu');
        this.clicf = game.add.audio('clicf');

        //this.sdecoded=false;
        //game.sound.setDecodedCallback([ this.clicf ], this.soundIsDecoded, this);


        var splash = game.add.sprite(0,0,'bkg');
        var goku = game.add.sprite(0,0,'goku');
        //var persoidle = perso1.animations.add('idle');

        var toei = game.add.sprite(0,0,'toei_logo');
        var buttonp = game.add.button(0,0,'play', this.start, this, 1, 0, 2);
        var howto = game.add.button(0,0,'howto', this.howto, this, 1, 0, 2);
        var copyright = game.add.sprite(0,0,'copyright');

        //var music = game.add.button(0,0,'music', game.musiconoff, this, 1, 0, 2);

        var logo = game.add.sprite(0,0,'logo');
        logo.y=-300;

        splash.y = 0;
        game.set2Scale(splash);

        game.set2Scale(logo);

        game.set2ScaleP(goku,.8);
        game.set2Position(80,230,goku);

        game.set2Scale(toei);
        game.set2Position(705,525,toei);

        game.set2ButtonScale(buttonp);
        game.set2Position(380,316,buttonp);

        game.set2ButtonScale(howto);
        game.set2Position(380,385,howto);

        game.set2Scale(copyright);
        game.set2Position(5,575,copyright);

        splash.smoothed = true;
        buttonp.smoothed = true;
        buttonp.input.useHandCursor = true;
        logo.smoothed = true;
        goku.smoothed = true;

        //game.camera.setBoundsToWorld();
        var duree = 800;
        game.camera.flash(0x000000, duree, false);

        //perso1.animations.play('idle', 12, true);

        var tween1 = game.add.tween(goku).from( { x: game.width }, 300, "Sine.easeInOut");
        tween1.start();

        //setTimeout(function(){
        game.add.tween(logo).to( { y: 15 }, 800, Phaser.Easing.Bounce.Out, true, duree/3);
        //},(duree/3));

        game.add.tween(buttonp).from( { x: game.width+200 }, 300, Phaser.Easing.Circular.Out, true, duree+400);
        game.add.tween(howto).from( { x: game.width+200 }, 300, Phaser.Easing.Circular.Out, true, duree+600);

        game.input.doubleTapRate = 200;
        //game.input.circle = 66;
        game.input.mouse.enabled = true;
        game.input.maxPointers = 1;
        game.input.touch.enabled = true;
        game.input.touch.start();

        //game.input.onMouseDown = this.downmouse;

        //game.input.onDown.add(this.touchDown, this);
        //game.input.onUp.add(this.touchUp, this);
        //game.input.addMoveCallback(this.callbackmove,this);
        game.input.touch.callbackContext = this;
        //game.input.touch.touchStartCallback = this.onTouchStart;
        //game.input.touch.touchEnterCallback = this.onTouchEnter;
        //game.input.touch.touchEndCallback = this.onTouchEnd;

        this.music.play('', 0, .3, true, true);

        game.addMusicButton();
        game.addPauseButton();

        //game.sound.play('musicmenu');

        //var nameLabel = game.add.text(80, 80, 'xxx', {font:'50px Arial', fill:'#ffffff'});
        // var startLabel = game.add.text(80, game.world.height-80,'Press the "W" key to start',{font:'25px Arial',fill:'#ffffff'});
        // var wkey = game.input.keyboard.addKey(Phaser.Keyboard.W);
        // wkey.onDown.addOnce(this.start,this);
    },
    start: function(){
        //game.scale.setUserScale(.75, .75);
        //game.scale.refresh();
        this.music.destroy();
        this.clicf.play('', 0, .3, false, true);
        game.createDialogue();
        game.state.start('beforeplay');
    },
    howto:function(){
        this.music.destroy();
        this.clicf.play('', 0, .5, false, true);
        game.state.start('howto');
    },
    render:function(){
       // game.debug.soundInfo(this.clicf, 32, 32);
        //game.debug.cameraInfo(game.camera, 10, 40);
        //game.debug.spriteBounds(this.goku,'#ff0000',false);
       // game.debug.body(this.goku,'#ff0000',true);
      //  if (this.fireball) {
      //   game.debug.spriteBounds(this.fireball,'#f7de00',false);
      //   game.debug.body(this.fireball,'#ff00ea',true);
      //  }
        //game.debug.spriteCoords(this.goku, true, true);
      },

      update:function(){

      },

      touchDown:function(e,p){ // p = pointerEvent, e = e.Pointer
        // trick pour intercepter clic sur button
        console.log(e);
        if(e.interactiveCandidates.length>0 && (e.interactiveCandidates[0].sprite.id == 'btpause' || e.interactiveCandidates[0].sprite.id == 'btmusic')) return;

      },

      soundIsDecoded:function(e){
          this.sdecoded=true;
      }

};
