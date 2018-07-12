var playState = {

  init:function(params){
    this.levelID = params.levelID;
    this.lignes = 0;
    this.colonnes = 0;
    this.chrono = {'min':0,'sec':0};
    this.initialTime = 0;

    //console.log('this.levelID ' + this.levelID);

    switch(this.levelID){
      case 1:
      this.lignes = 4;
      this.colonnes = 3;
      this.bordureX = game.get1Position(20);
      break;
      case 2:
      this.lignes = 4;
      this.colonnes = 4;
      this.bordureX = game.get1Position(5);
      break;
      case 3:
      this.lignes = 5;
      this.colonnes = 4;
      this.bordureX = game.get1Position(5);
      break;
    }

    this.filenames = ['prs01','prs02','prs03','prs04','prs05','prs06','prs07','prs08','prs09','prs10'];

    this.filenames = game.shuffleArray(this.filenames);
    this.tableau = new Array(); // tableau d'images uniques 6 - 8 - 10
    this.nbimages = (this.lignes*this.colonnes)/2;
    for (var i = 0; i<this.nbimages; i++){
      this.tableau.push(this.filenames[i]);
    };

    this.tabimgs = new Array(); // tableau position images

    this.curSelect = new Array();
    this.totSelect = new Array();

  },

  preload:function(){

    if(this.levelID==1){  
      this.scb = game.ismobile == true ? 1.05 : .99; // ratio bulle texte pour mobile
    }else{
      this.scb = game.ismobile == true ? 1.0 : .99;
    }

    var splash = game.add.sprite(0,0,'bkg');
    splash.y = 0;
    game.set2Scale(splash);

    game.addMusicButton();
    game.addPauseButton();

    game.addDisplayLoader();

    game.load.onFileComplete.add(this.filecomplete, this);
    game.load.onLoadComplete.add(this.loadcomplete, this);

    // persos + cadres + cards
    for (var i = 0; i < this.tableau.length; i++){
      game.load.image(this.tableau[i], game.pathImg+'png/' + this.tableau[i] + '.png');
    }

    game.load.image('cadre1', game.pathImg+'png/lv' + this.levelID + '_cadre1.png');
    game.load.image('cadre2', game.pathImg+'png/lv' + this.levelID + '_cadre1.png');

    game.load.image('verso1', game.pathImg+'png/verso1.png')
    game.load.image('verso2', game.pathImg+'png/verso2.png')

    // chiffres
    for(var i = 0; i<10; i++){
      game.load.image('ch'+i, game.pathImg+'png/' + i + '.png');
    }
    game.load.image('period', game.pathImg+'png/period.png')
    game.load.image('levels', game.pathText+'level'+this.levelID+'.png');
    game.load.image('btimer', game.pathText+'timer.png');

    game.load.spritesheet('txt1', game.pathText+'txt1-1.png',194*game.mratio,104*game.mratio);

    game.load.image('tracking02', game.pathTrack+'pixel.gif?r=play'+this.levelID);

  },

  create:function(){

    // music
    switch(this.levelID){
      case 1:
      this.music = game.add.audio('musiclevel1');
      break;
      case 2:
      this.music = game.add.audio('musiclevel2');
      break;
      case 3:
      this.music = game.add.audio('musiclevel3');
      break;
    }

    // bruitage
    this.cardflip = game.add.audio('cardflip');
    this.cardmatch = game.add.audio('cardmatch');
    this.cardnomatch = game.add.audio('cardnomatch');
    this.allcards = game.add.audio('allcards');


    this.flipSpeed = 300; // vitesse retourneùent carte
    this.flipZoom = 1.2;
    this.initScale = game.get2Scale();
    this.delayFlip = 600;  // delai retournement quand cartes correpondent pas
    this.isFlipping = false;

    this.levels = game.add.image(0,0,'levels');
    this.btimer = game.add.image(0,0,'btimer');
    this.levels.anchor.set(1,0);
    this.btimer.anchor.set(1,0);
    game.set2Scale(this.levels);
    game.set2Scale(this.btimer);
    game.set2Position(800,80,this.levels);
    game.set2Position(800,130,this.btimer);

    // initialisation affichage timer
    var ch1 = game.add.image(0,0,'ch0');
    ch1.anchor.set(1,0);
    game.set2Scale(ch1);
    var ch2 = game.add.image(0,0,'ch0');
    ch2.anchor.set(1,0);
    game.set2Scale(ch2);
    var ch3 = game.add.image(0,0,'ch0');
    ch3.anchor.set(1,0);
    game.set2Scale(ch3);
    var ch4 = game.add.image(0,0,'ch0');
    ch4.anchor.set(1,0);
    game.set2Scale(ch4);
    this.curbmpTime = new Array(ch1,ch2,ch3,ch4);

    this.period = game.add.image(0,0,'period');
    this.period.anchor.set(1,0);
    game.set2Scale(this.period);

    game.set2Position(794,160,ch4);
    game.set2Position(768,160,ch3);
    game.set2Position(742,155,this.period);
    game.set2Position(730,160,ch2);
    game.set2Position(704,160,ch1);

    var goku = game.add.sprite(0,0,'goku');
    goku.smoothed = true;
    game.set2ScaleP(goku,.5);
    goku.anchor.set(0,0);
    game.set2Position(600,280,goku);

    // texte
    this.texte = game.add.sprite(0,0,'txt1');
    game.set2ButtonScaleP(this.texte,this.scb);
    if(this.levelID==1){
      game.set2Position(698,270,this.texte);
    }else{
      game.set2Position(708,270,this.texte);
    }
    
    this.texte.anchor.set(0.5,0.5);
    this.texte.scale.setTo(0.1,0.1);
    this.texte.visible = false;


    for (var i = 0; i<this.tableau.length; i++){
      // creation des couples
      for(var ii = 0; ii<2; ii++){
        var ob = new Object();
        ob['pos'] = 0;
        ob['name'] = this.tableau[i];
        ob['verso'] = '';
        ob['recto'] = '';
        this.tabimgs.push(ob);
      }
    }

    this.tabimgs = game.shuffleArray(this.tabimgs);

    // creation des images  ---------------------------------------
    var padding = this.levelID == 1 ? game.get1Position(4) :game.get1Position(1);
    var dx = game.get1Position(this.bordureX);
    var dy = game.get1Position(20);
    var l = 0;

    for (var i = 0; i < this.tabimgs.length; i++){
      this.tabimgs[i]['pos'] = i;
      var n = (i%2)+1;
      var c = (i%this.colonnes);
      if(c == 0 && i >= this.colonnes){
        l++;
      }
      // iversion 1 ligne sur 2 de la couleur du cadre de depart
      if(this.colonnes%2 == 0){
        n = l%2 == 1 ? n-1 : n;
        n = l%2 == 1 && n == 0 ? n = 2: n;
      }

      // cadres
      var cadre = game.add.image(0,0,'cadre'+n);
      cadre.anchor.set(0.5,0.5);
      var w1 = cadre.width;
      var h1 = cadre.height;
      game.set2Scale(cadre);
      var w2 = cadre.width/2;
      var h2 = cadre.height/2;
      var w = cadre.width+padding;
      var h = cadre.height+padding;
      var ix = dx+w*c;
      var iy = dy+h*l;
      cadre.x=ix+this.bordureX+w2;
      cadre.y=iy+h2;

      // mask recto / verso
      var mask = game.make.bitmapData(w1-2, h1-2); // -2 : evite debordement sur transparence du cadre
      mask.fill(0, 209, 23);

      // recto vignettes (perso)
      var masked = game.make.bitmapData(w1, h1);
      var recto = game.add.image(0,0,this.tabimgs[i]['name']);
      var sc = parseFloat(w1/recto.width).toFixed(2);
      recto.scale.setTo(sc,sc);
      masked.alphaMask(recto,mask);
      recto.destroy();
      var rectof = game.add.image(0,0,masked); // +1 : evite débordement sur transparence du cadre en haut à gauche
      rectof.anchor.set(0.5,0.5);
      rectof.x = ix+this.bordureX+1+w2;
      rectof.y = iy+1+h2;
      this.tabimgs[i]['recto'] = rectof;
      game.set2Scale(rectof);
      // on retourne la carte
      rectof.scale.setTo(0,this.flipZoom);

      // verso vignettes
      var masked2 = game.make.bitmapData(w1, h1);
      var verso = game.add.image(0,0,'verso'+n);
      verso.scale.setTo(sc,sc);
      masked2.alphaMask(verso,mask);
      verso.destroy();
      var versof = game.add.image(0,0,masked2); // +1 : evite débordement sur transparence du cadre en haut à gauche
      versof.anchor.set(0.5,0.5);
      versof.x = ix+this.bordureX+1+w2;
      versof.y = iy+1+h2;
      this.tabimgs[i]['verso'] = versof;
      game.set2Scale(versof);
      var ii = i < 10 ? '0'+i : i;
      cadre.name = 'perso'+i;
      cadre.data={'pos':i,'isflipping':false};
      cadre.inputEnabled = true;
      cadre.events.onInputUp.add(this.buttonUp,this);
      cadre.bringToTop();

    } // fin boucle
    // -----------------------------------------------------------

    //Timer
    this.ctimer = game.time.create(false);
    this.ctimer.loop(1000, this.displayTimer, this);
    this.ctimer.start();

    this.music.play('', 0, .2, true, true);

  },

  filecomplete:function(progress, cacheID, success, filesloaded, totalfiles){
      //console.log('progress : ' + progress);
      game.processLoader(progress);
    },

  loadcomplete:function(){
      game.destroyLoader();
      //console.log('complete');
  },

  buttonUp:function(e){
    var pos = e.data['pos'];

    // flip premiere carte
    if(this.curSelect.length < 2 && e.data['isflipping'] == false && this.isFlipping == false) {
      this.cardflip.play('', 0, .3, false, true);
      e.data['isflipping'] = true;
      this.curSelect.push({'pos':pos,'e':e});

      this.flipTween = game.add.tween(this.tabimgs[pos]['verso'].scale).to({ x: 0, y: this.flipZoom }, this.flipSpeed / 2, Phaser.Easing.Linear.None);
      this.flipCadre = game.add.tween(e.scale).to({ x: 0, y: this.flipZoom }, this.flipSpeed / 2, Phaser.Easing.Linear.None);
      this.backFlipTween = game.add.tween(this.tabimgs[pos]['recto'].scale).to({ x: this.initScale, y: this.initScale }, this.flipSpeed / 2, Phaser.Easing.Linear.None);
      this.backFlipCadre = game.add.tween(e.scale).to({ x: this.initScale, y: this.initScale }, this.flipSpeed / 2, Phaser.Easing.Linear.None);
      this.flipTween.onComplete.add(function(){
        this.backFlipTween.start();
        this.backFlipCadre.start();
      }, this);
      this.backFlipTween.onComplete.add(function(){
         //this.isFlipping = false;
      }, this);

      this.flipTween.start();
      this.flipCadre.start();

    };

    // flip deuxieme carte
    if(this.curSelect.length == 2 ){
      game.input.enabled = false;
      this.isFlipping = true;
      var p1 = this.curSelect[0]['pos'];
      var p2 = this.curSelect[1]["pos"];
      var e1 = this.curSelect[0]['e'];
      var e2 = this.curSelect[1]['e'];
      e1.inputEnabled = false;
      e2.inputEnabled = false;
      this.ctimer.pause();
    
      // regarde si les 2 cartes correspondent
      if(this.tabimgs[p1]['name'] == this.tabimgs[p2]['name'] && p1 != p2){
        // gagné !
        this.curSelect = new Array();
        this.totSelect.push(this.tabimgs[p1]);
        if(this.totSelect.length == this.tabimgs.length/2){
          this.ctimer.stop();
          this.tweenAndText(3);
        }else{
          var i = Math.floor(Math.random() * 2) + 1; // 1 ou 2
          this.tweenAndText(i);
        }
      }else{
        tt = this;
        this.tweenAndText(0);
        setTimeout(function(){
          if(tt.curSelect.length==2){
            // perdu !
            // reverse verso
            tt.ctimer.resume();
            var i = 0;
            var p = tt.curSelect[i]['pos'];
            var e = tt.curSelect[i]['e'];
            this.flipTween2 = game.add.tween(tt.tabimgs[p]['recto'].scale).to({ x: 0, y: tt.flipZoom }, tt.flipSpeed / 2, Phaser.Easing.Linear.None);
            this.flipTween2.onComplete.add(function(){
              this.backFlipTween2.start();
              this.backFlipCadre2.start();
              e.data['isflipping'] = false;
              e.inputEnabled = true;
            }, this);
            this.flipCadre2 = game.add.tween(e.scale).to({ x: 0, y: tt.flipZoom }, tt.flipSpeed / 2, Phaser.Easing.Linear.None);
            this.backFlipCadre2 = game.add.tween(e.scale).to({ x: tt.initScale, y: tt.initScale }, tt.flipSpeed / 2, Phaser.Easing.Linear.None);
            this.backFlipTween2 = game.add.tween(tt.tabimgs[p]['verso'].scale).to({ x: tt.initScale, y: tt.initScale }, tt.flipSpeed / 2, Phaser.Easing.Linear.None);
            this.flipTween2.start();
            this.flipCadre2.start();

            var ib = 1;
            var pb = tt.curSelect[ib]['pos'];
            var eb = tt.curSelect[ib]['e'];
            this.flipTween22 = game.add.tween(tt.tabimgs[pb]['recto'].scale).to({ x: 0, y: tt.flipZoom }, tt.flipSpeed / 2, Phaser.Easing.Linear.None);
            this.flipTween22.onComplete.add(function(){
              this.backFlipTween22.start();
              this.backFlipCadre22.start();
              eb.data['isflipping'] = false;
              eb.inputEnabled = true;
            }, this);
            this.flipCadre22 = game.add.tween(eb.scale).to({ x: 0, y: tt.flipZoom }, tt.flipSpeed / 2, Phaser.Easing.Linear.None);
            this.backFlipCadre22 = game.add.tween(eb.scale).to({ x: tt.initScale, y: tt.initScale }, tt.flipSpeed / 2, Phaser.Easing.Linear.None);
            this.backFlipCadre22.onComplete.add(function(){tt.isFlipping = false; game.input.enabled = true; tt.curSelect = new Array();})
            this.backFlipTween22 = game.add.tween(tt.tabimgs[pb]['verso'].scale).to({ x: tt.initScale, y: tt.initScale }, tt.flipSpeed / 2, Phaser.Easing.Linear.None);
            this.flipTween22.start();
            this.flipCadre22.start();
          };
        }, tt.delayFlip);

      }
    }
  },

  displayTimer:function(){

    this.initialTime++;
    var ts = this.initialTime;
    ts %= 3600;
    var mns = Math.floor(ts / 60); // minutes
    var sc = ts % 60; // secondes
    var smns = mns < 10 ? '0'+mns : ''+mns;
    var ssc = sc < 10 ? '0'+sc : ''+sc;

    this.chrono['sec'] = sc;
    this.chrono['min'] = mns;

    var ms = smns+ssc;
    var tab = ms.split('');

    //console.log(ssc.substring(ssc.length-1,ssc.length));
    this.curbmpTime[3].loadTexture('ch'+tab[3],0);
    this.curbmpTime[2].loadTexture('ch'+tab[2],0);
    this.curbmpTime[1].loadTexture('ch'+tab[1],0);
    this.curbmpTime[0].loadTexture('ch'+tab[0],0);

  },

  tweenAndText:function(f){
    this.texte.frame = f;
    this.texte.visible = true;
    // texte goku
    var tweentext = game.add.tween(this.texte.scale).to({ x: this.initScale*this.scb, y: this.initScale*this.scb }, 300, Phaser.Easing.Elastic.Out);
    tweentext.start();
    tweentext.onComplete.add(function(){
      if (f == 0) this.cardnomatch.play('', 0, .3, false, true);
      if (f == 1 || f == 2) this.cardmatch.play('', 0, .3, false, true);
      if (f == 3) {
        this.music.stop();
        this.allcards.play('', 0, .3, false, true);
      }
      var dflip = this.delayFlip/1.8;
      if (f==3) dflip = 1000;
      var endtweentext = game.add.tween(this.texte.scale).to( { x:.1, y:.1 }, 200, Phaser.Easing.Elastic.In, true, dflip);
      endtweentext.onComplete.add(function(){
        this.texte.visible = false;
        if (f == 1 || f == 2) {
          this.isFlipping = false;
          game.input.enabled = true;
          this.ctimer.resume();
        }
        if (f == 3) {
          this.levelID;
          this.isFlipping = false;
          game.input.enabled = true;
          game.state.start('finish', true, false, {levelID:this.levelID, btmp:this.curbmpTime, chrono:this.chrono });
        }
      },this);
    },this);

  }



}
