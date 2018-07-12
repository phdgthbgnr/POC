var loadState = {

    preload:function(){

        /*
        var levelpr;
        var levelprx=0;

        levelprx = game.world.centerX-100;
        this.levelpr = game.add.graphics(levelprx, game.height/2);
        this.levelpr.lineStyle(15, 0xf7de00);
        this.levelpr.moveTo(0, 0);

        this.textLoad = game.add.sprite( game.world.centerX, game.height/2-20, null);
        this.loadingLabel = game.add.text(0, 0, 'loading :  0 %', {FontSize:'3px', fill:'#ffffff', align: 'center'});
        this.loadingLabel.anchor.setTo(0.5, 0.5);
        this.textLoad.addChild(this.loadingLabel);
        this.textLoad.fixedToCamera = true;
        */

        //game.niveau = 1;        // current level
        //game.freezerevol = 1;   // current evol freezer
        game.ptslifes = 100;    // pts  vie niveau 1
        game.freezerforce = 10;

        game.addDisplayLoader();

        game.load.onFileComplete.add(this.updateProgressBar, this);
        game.load.onLoadComplete.addOnce(this.loadcomplete, this);

        game.load.image('bkg', game.pathImg+'jpg/bg.jpg');
        game.load.image('logo', game.pathImg+'png/dbs_logo.png');
        game.load.image('goku', game.pathImg+'png/goku.png');
        game.load.image('copyright', game.pathImg+'png/copyright.png');
        game.load.image('toei_logo', game.pathImg+'png/toei_logo.png');

        game.load.spritesheet('play', '_img/play.png', 419, 87);
        game.load.spritesheet('howto', '_img/howtoplay.png', 419, 87);
        game.load.spritesheet('music', '_img/music.png', 46, 80);
        game.load.spritesheet('pause', '_img/pause.png', 106, 80);



        game.load.audio('clicb', [game.pathSnd+'Sound_clicbackwards.mp3', game.pathSnd+'Sound_clicbackwards.ogg', game.pathSnd+'Sound_clicbackwards.m4a']);
        game.load.audio('clicf', [game.pathSnd+'Sound_clicforwards.mp3', game.pathSnd+'Sound_clicforwards.ogg', game.pathSnd+'Sound_clicforwards.m4a']);

        game.load.audio('musicmenu', [game.pathSnd+'Music_2_MainMenu.mp3', game.pathSnd+'Music_2_MainMenu.ogg', game.pathSnd+'Music_2_MainMenu.m4a']);

        game.load.audio('musiclevel1', [game.pathSnd+'Music_2_Level1.mp3', game.pathSnd+'Music_2_Level1.ogg', game.pathSnd+'Music_2_Level1.m4a']);
        game.load.audio('musiclevel2', [game.pathSnd+'Music_2_Level2.mp3', game.pathSnd+'Music_2_Level2.ogg', game.pathSnd+'Music_2_Level2.m4a']);
        game.load.audio('musiclevel3', [game.pathSnd+'Music_2_Level3.mp3', game.pathSnd+'Music_2_Level3.ogg', game.pathSnd+'Music_2_Level3.m4a']);

        game.load.audio('allcards', [game.pathSnd+'Sound_2_AllCards.mp3', game.pathSnd+'Sound_2_AllCards.ogg', game.pathSnd+'Sound_2_AllCards.m4a']);
        game.load.audio('cardflip', [game.pathSnd+'Sound_2_CardFlip.mp3', game.pathSnd+'Sound_2_CardFlip.ogg', game.pathSnd+'Sound_2_CardFlip.m4a']);
        game.load.audio('cardmatch', [game.pathSnd+'Sound_2_CardMatch.mp3', game.pathSnd+'Sound_2_CardMatch.ogg', game.pathSnd+'Sound_2_CardMatch.m4a']);
        game.load.audio('cardnomatch', [game.pathSnd+'Sound_2_CardNotMatch.mp3', game.pathSnd+'Sound_2_CardNotMatch.ogg', game.pathSnd+'Sound_2_CardNotMatch.m4a']);


    },
    create:function(){

      game.scale.scaleMode = Phaser.ScaleManager.RESIZE;
      game.scale.pageAlignHorizontally = true;
      //game.renderer.renderSession.roundPixels = true;  // for pixel art
      //Phaser.Canvas.setImageRenderingCrisp(game.canvas);
      game.scale.refresh();

    },
    updateProgressBar:function (progress, cacheID, success, filesloaded, totalfiles){

        //console.log('progress : ' + progress);
        /*
        console.log('cacheID : ' + cacheID);
        console.log('success : ' + success);
        console.log('filesloaded : ' + filesloaded);
        console.log('totalfiles : ' + totalfiles);
        */
        game.processLoader(progress);

        //this.loadingLabel.text='Loading : ' + progress + ' %';
        //this.levelpr.lineTo(progress*2, 0);

    },

    loadcomplete:function(){
      game.destroyLoader();
      game.state.start('menu',true,false);
    }

};
