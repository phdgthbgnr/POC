var finishState = {

    init:function(params){
      this.levelID = params.levelID;
      this.curbmpTime = params.btmp;
      this.mn = params.chrono['min'];
      this.sc = params.chrono['sec'];
      //console.log(this.mn +' / '+this.sc);
    },

    preload:function(){

      console.log('this.levelID finish ' + this.levelID );

      this.unit = '';

      var sky2 = game.add.sprite(0,0,'bkg');
      sky2.y = 0;
      game.set2Scale(sky2);

      game.addDisplayLoader();

      game.load.onFileComplete.add(this.filecomplete, this);
      game.load.onLoadComplete.add(this.loadcomplete, this);

      if(this.levelID < 3){
        game.load.image('bulle', game.pathText+'allcards.png');
        game.load.spritesheet('go', '_img/go.png', 427, 98);
      }else{
        game.load.image('bulle', game.pathText+'congrat.png');
        game.load.spritesheet('go', '_img/play_again.png', 280, 60);
      }

      game.load.image('tracking04', game.pathTrack+'pixel.gif?r=finish'+this.levelID+'&time='+this.mn+'-'+this.sc);
      
      this.levelID++;

      game.load.image('bfinish', game.pathText+'finished.png');
      

      if(this.mn == 1){
        game.load.image('minute', game.pathText+'minute.png');
        this.unit = 'minutes';
      };
      
      if(this.mn > 1){
        game.load.image('minute', game.pathText+'minutes.png');
        this.unit = 'minutes';
      };

      if(this.mn == 0){
        game.load.image('minute', game.pathText+'secondes.png');
        this.unit = 'secondes';
      };

      

    },

    create:function(){

        this.clicf = game.add.audio('clicf');

        game.addMusicButton();
        game.addPauseButton();

        var goku = game.add.sprite(0,0,'goku');
        goku.y = 0;
        goku.alpha = 1;
        game.set2Scale(goku);
        game.set2Position(370,60,goku);

        var readytx = game.add.image(0,0,'bulle');
        readytx.anchor.set(0,0);
        game.set2Scale(readytx);
        readytx.x = 0;
        readytx.y = game.get1Position(160);
        readytx.alpha = 0;

        var go = game.add.button(0,0,'go', this.start, this, 1, 0, 2);
        go.name='go';
        go.alpha = 0;
        game.set2ButtonScale(go);
        if(this.levelID <4){
          game.set2Position(-30, 340, go);
        }else{
          game.set2Position(90, 440, go);
        }

        var finished = game.add.image(0,0,'bfinish');
        game.set2Scale(finished);

        var minute = game.add.image(0,0,'minute');
        minute.smoothed = true;
        game.set2Scale(minute);
        minute.anchor.set(0.5,0.5);
        if(this.unit == 'minutes'){
          game.set2Position(210,112,minute);
        }else if(this.unit=='secondes'){
          game.set2Position(248,112,minute);
        }else{
          game.set2Position(214,112,minute);
        }

        var tt;
        for(var i=0; i<this.curbmpTime.length; i++){

          if(this.unit == 'minutes' || this.unit == 'minute'){
            if(i==0 && this.curbmpTime[i].key != 'ch0'){
              tt = game.add.image(0,0,this.curbmpTime[i].key);
              game.set2Scale(tt);
              game.set2Position(76,91,tt);
            }
            if(i==1){
              tt = game.add.image(0,0,this.curbmpTime[i].key);
              game.set2Scale(tt);
              game.set2Position(102,91,tt);
            }
            if(i==2 && this.sc > 0){
              tt = game.add.image(0,0,this.curbmpTime[i].key);
              game.set2Scale(tt);
              game.set2Position(286,91,tt);
            }
            if(i==3 && this.sc > 0){
              tt = game.add.image(0,0,this.curbmpTime[i].key);
              game.set2Scale(tt);
              game.set2Position(312,91,tt);
            }
          }

          if(this.unit == 'secondes'){
            if(i==2 && this.curbmpTime[i].key != 'ch0'){
              tt = game.add.image(0,0,this.curbmpTime[i].key);
              game.set2Scale(tt);
              game.set2Position(100,91,tt);
            }
            if(i==3){
              tt = game.add.image(0,0,this.curbmpTime[i].key);
              game.set2Scale(tt);
              game.set2Position(126,91,tt);
            }
          }
        }

        var tween1 = game.add.tween(goku).from( { x: -goku.width/2, alpha: 0 }, 300, "Sine.easeInOut");
        var tween2 = game.add.tween(readytx).to( { alpha: 1 }, 300, "Sine.easeInOut");
        var tween3 = game.add.tween(go).to( { alpha: 1 }, 300, "Sine.easeInOut");
        tween1.start();
        tween1.chain(tween2);
        tween2.chain(tween3);
    },

    start:function(e,p){
      this.clicf.play('', 0, .3, false, true);
      if(this.levelID < 4){
        game.state.start('play', true, false, {levelID:this.levelID });
      }
      if(this.levelID==4){
        game.state.start('menu', true, false);
      }
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
