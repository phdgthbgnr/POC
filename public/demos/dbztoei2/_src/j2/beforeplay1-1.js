var beforeState = {

    preload:function(){

      var sky2 = game.add.sprite(0,0,'bkg');
      sky2.y = 0;
      game.set2Scale(sky2);

      game.addDisplayLoader();

      game.load.onFileComplete.add(this.filecomplete, this);
      game.load.onLoadComplete.add(this.loadcomplete, this);

      game.load.image('readytxt', game.pathText+'hello-1.png');
      game.load.spritesheet('go', '_img/go.png', 427, 98);

      game.load.image('tracking01', game.pathTrack+'pixel.gif?r=beforeplay');
  },

    create:function(){

        //game.niveau = 1;        // current level
        //game.freezerevol = 1;   // current evol freezer
        game.ptslifes = 100;    // pts  vie niveau 1
        game.freezerforce = 10;

        this.clicf = game.add.audio('clicf');



        game.addMusicButton();
        game.addPauseButton();

        var goku = game.add.sprite(0,0,'goku');
        goku.y = 0;
        goku.alpha = 1;
        game.set2Scale(goku);
        game.set2Position(370,60,goku);

        var readytx = game.add.image(0,0,'readytxt');
        readytx.anchor.set(0,0);
        game.set2Scale(readytx);
        readytx.x = 0;
        readytx.y = game.get1Position(90);
        readytx.alpha = 0;

        var go = game.add.button(0,0,'go', this.start, this, 1, 0, 2);
        go.name='go';
        go.alpha = 0
        game.set2ButtonScale(go);
        game.set2Position(30, 340, go);

        var tween1 = game.add.tween(goku).from( { x: -goku.width/2, alpha: 0 }, 300, "Sine.easeInOut");
        var tween2 = game.add.tween(readytx).to( { alpha: 1 }, 300, "Sine.easeInOut");
        var tween3 = game.add.tween(go).to( { alpha: 1 }, 300, "Sine.easeInOut");
        tween1.start();
        tween1.chain(tween2);
        tween2.chain(tween3);
    },

    start:function(e,p){
        this.clicf.play('', 0, .3, false, true);
        game.state.start('play', true, false, { levelID:1 });
    },

    filecomplete:function(progress, cacheID, success, filesloaded, totalfiles){
        //console.log(progress);
        game.processLoader(progress)
    },

    loadcomplete:function(){
        game.destroyLoader();
        //console.log('complete');
    }
}
